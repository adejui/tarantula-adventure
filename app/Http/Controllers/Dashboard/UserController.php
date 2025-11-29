<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $generations = User::select('generation')
            ->distinct()
            ->orderBy('generation', 'asc')
            ->pluck('generation');

        $majors = User::selectRaw('LOWER(major) as major') // lowercase biar gak duplikat kapital
            ->whereNotNull('major')
            ->distinct()
            ->orderBy('major', 'asc')
            ->pluck('major');

        $perPage = $request->get('perPage', 5);
        $search = $request->get('search');
        $status = $request->get('status');
        $major = $request->get('major');
        $generation = $request->get('generation');
        $batch = $request->get('batch'); // Tahun


        // Ambil semua user selain admin
        $query = User::where('role', '!=', 'admin')->orderBy('created_at', 'DESC');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        if ($status && $status !== 'all') $query->where('status', $status);
        if ($major && $major !== 'all') $query->where('major', $major);
        if ($generation && $generation !== 'all') $query->where('generation', $generation);

        $users = $query->paginate($perPage)->appends($request->all());

        if ($request->ajax()) {
            return view('dashboard.admin.users.partials.table', compact('users'))->render();
        }

        // VARIABEL YANG BISA KAMU UBAH SEWAKTU-WAKTU
        $prefixNRP = "TA";
        $prefixPassword = "tarantula";
        $startNumber = 1;

        $autoNRP = null;
        $autoPassword = null;

        if ($generation && $batch) {

            // Angkatan → uppercase
            $generation = strtoupper($generation);

            // Tahun (ambil 2 digit terakhir untuk NRP)
            $batch2 = substr($batch, -2);

            // Ambil NRP terakhir dari seluruh data (global)
            $last = User::where('nrp', 'like', "$prefixNRP.%")
                ->orderBy('id', 'desc')
                ->first();

            if ($last && preg_match('/\d{3}$/', $last->nrp, $matches)) {
                $nextNumber = intval($matches[0]) + 1;
            } else {
                $nextNumber = $startNumber;
            }

            // Format ke 3 digit
            $urutan = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            // Bentuk NRP
            $autoNRP = "$prefixNRP.$generation.$batch2.$urutan";

            // Bentuk Password
            $autoPassword = $prefixPassword . $batch;
        }


        return view('dashboard.admin.users.index', compact(
            'users',
            'autoNRP',
            'autoPassword',
            'prefixNRP',
            'prefixPassword',
            'generations',
            'majors',
        ));
    }
    public function generateNrpPassword(Request $request)
    {
        $prefixNRP = "TA";
        $prefixPassword = "tarantula";

        $generation = strtoupper($request->generation);
        $batch = substr($request->batch, -2);
        $fullBatch = $request->batch;

        if (!$generation || !$batch) {
            return response()->json([
                'nrp' => null,
                'password' => null
            ]);
        }

        $last = User::where('nrp', 'like', "$prefixNRP.%")
            ->orderBy('id', 'desc')
            ->first();

        $nextNumber = 1;

        if ($last && preg_match('/\d{3}$/', $last->nrp, $matches)) {
            $nextNumber = intval($matches[0]) + 1;
        }

        $urutan = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Bentuk NRP baru
        $nrp = "$prefixNRP.$generation.$batch.$urutan";
        $password = $prefixPassword . $fullBatch;

        return response()->json([
            'nrp' => $nrp,
            'password' => $password
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // dd($request->all());

        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('imgUsers', 'public');
        } else {
            // Gunakan foto default jika tidak ada upload
            $validated['photo'] = 'imgUsers/default-image.png';
        }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Data Anggota berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('dashboard.admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        // Prefix disini (biar bisa diganti sewaktu waktu)
        $prefixNRP = "TA";
        $prefixPassword = "tarantula";

        // CEK PASSWORD
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            $validated['password'] = $user->password;
        }

        // CEK FOTO
        if ($request->hasFile('photo')) {

            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $photoPath = $request->file('photo')->store('imgUsers', 'public');
            $validated['photo'] = $photoPath;
        } else {
            $validated['photo'] = $user->photo;
        }

        // UPDATE NRP JIKA GENERATION ATAU BATCH BERUBAH
        if (
            $validated['generation'] != $user->generation ||
            $validated['batch'] != $user->batch
        ) {
            $generation = strtoupper($validated['generation']);
            $batch2 = substr($validated['batch'], -2);

            // Ambil 3 digit nomor urut dari NRP lama
            $oldOrder = substr($user->nrp, -3);

            // Bentuk NRP baru (urutannya tetap sama)
            $validated['nrp'] = "$prefixNRP.$generation.$batch2.$oldOrder";
        } else {
            // Kalau tidak berubah, biarkan NRP lama
            $validated['nrp'] = $user->nrp;
        }

        // UPDATE PASSWORD OTOMATIS JUGA (KALAU MAU)
        // format: tarantula + tahun full
        if ($validated['batch'] != $user->batch) {
            $validated['password'] = bcrypt($prefixPassword . $validated['batch']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Data Anggota berhasil diperbarui!');
    }

    public function updatePhoto(Request $request, $id)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('photo')) {
            // Hapus foto lama kalau ada dan bukan default
            if ($user->photo && $user->photo !== 'imgUsers/default-image.png') {
                $oldPath = storage_path('app/public/' . $user->photo);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Simpan foto baru ke folder imgUsers di storage
            $path = $request->file('photo')->store('imgUsers', 'public');

            // Simpan path ke database
            $user->photo = $path;
            $user->save();
        }

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }


    public function deletePhoto($id)
    {
        $user = User::findOrFail($id);

        // pastikan user punya foto & bukan default
        if ($user->photo && $user->photo !== 'imgUsers/default-image.png') {

            $path = storage_path('app/public/' . $user->photo);

            // hapus file jika benar-benar ada
            if (file_exists($path)) {
                unlink($path);
            }

            // kosongkan kolom photo di database
            $user->photo = null;
            $user->save();
        }

        return back()->with('success', 'Foto profil berhasil dihapus.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Jika ada foto, hapus dari storage
        if (
            $user->photo &&
            !str_contains($user->photo, 'default-image.png') &&
            Storage::disk('public')->exists($user->photo)
        ) {
            Storage::disk('public')->delete($user->photo);
        }


        $user->delete();

        return redirect()->route('users.index')->with('success', 'Data Anggota berhasil dihapus!');
    }
}
