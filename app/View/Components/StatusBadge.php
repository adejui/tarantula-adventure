<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusBadge extends Component
{
    /**
     * Create a new component instance.
     */
    public $status;

    public function __construct($status)
    {
        $this->status = strtolower($status);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.status-badge');
    }

    public function label()
    {
        return match ($this->status) {
            'available' => 'Tersedia',
            'borrowed' => 'Dipinjam',
            'unavailable' => 'Tidak tersedia',
            'active' => 'Aktif',
            'inactive' => 'Tidak Aktif',
            'alumni' => 'Alumni',
            'member' => 'Anggota',
            'logistics' => 'Logistik',
            'leader' => 'Ketua',
            'admin' => 'Admin',
            'requested' => 'Diajukan',
            'approved' => 'Disetujui',
            'returned' => 'Dikembalikan',
            'rejected' => 'Ditolak',
            'late' => 'Terlambat',
            default => ucfirst($this->status),
        };
    }

    public function color()
    {
        return match ($this->status) {
            'available', 'published', 'active', 'approved', 'member' => 'bg-green-200 text-green-600 dark:bg-green-500/15 dark:text-green-400',
            'unavailable', 'draft', 'rejected', 'admin' => 'bg-red-200 text-red-600 dark:bg-red-500/15 dark:text-red-400',
            'requested' => 'bg-blue-200 text-blue-600 dark:bg-blue-500/15 dark:text-blue-400',
            'logistics', 'borrowed' => 'bg-yellow-200 text-yellow-600 dark:bg-yellow-500/15 dark:text-yellow-400',
            'alumni' => 'bg-violet-200 text-violet-600 dark:bg-violet-500/15 dark:text-violet-400',
            'inactive' => 'bg-gray-200 text-gray-600 dark:bg-gray-500/15 dark:text-gray-400',
            'late' => 'bg-orange-200 text-orange-600 dark:bg-orange-500/15 dark:text-orange-400',
            'returned' => 'bg-cyan-200 text-cyan-600 dark:bg-cyan-500/15 dark:text-cyan-400',
            default => 'bg-gray-200 text-gray-600 dark:bg-gray-500/15 dark:text-gray-400',
        };
    }
}
