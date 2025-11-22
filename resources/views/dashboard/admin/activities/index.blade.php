@extends('dashboard.layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3">
            <div class="px-5 py-4 sm:px-6 sm:py-5 block">
                <h3 class="text-2xl font-medium text-gray-800 dark:text-white/90">
                    Daftar Kegiatan
                </h3>
            </div>


            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3">
                <div id="calendar" class="min-h-screen"></div>
            </div>

            @include('components.calendar-event-modal')

        </div>
    </div>
@endsection
