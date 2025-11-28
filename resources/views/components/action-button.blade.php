@props([
    'type' => 'edit', // default: edit
    'url' => '#',
    'title' => ucfirst($type),
])

@php
    // Warna hover & ikon tergantung tipe tombol
    $styles = [
        'edit' => [
            'hover' => 'hover:bg-yellow-100 dark:hover:bg-gray-800',
            'icon' => 'pencil-line',
        ],
        'manage' => [
            'hover' => 'hover:bg-blue-100 dark:hover:bg-gray-800',
            'icon' => 'sliders-horizontal',
        ],
        'acc' => [
            'hover' => 'hover:bg-green-100 dark:hover:bg-green-800',
            'icon' => 'check',
        ],
        'reject' => [
            'hover' => 'hover:bg-red-100 dark:hover:bg-red-800',
            'icon' => 'x',
        ],
        'delete' => [
            'hover' => 'hover:bg-red-100 dark:hover:bg-gray-800',
            'icon' => 'trash',
        ],
        'detail' => [
            'hover' => 'hover:bg-slate-200 dark:hover:bg-black',
            'icon' => 'eye',
        ],
        'view' => [
            'hover' => 'hover:bg-slate-200 dark:hover:bg-black',
            'icon' => 'eye',
        ],
    ];

    $hoverClass = $styles[$type]['hover'] ?? 'hover:bg-gray-100 dark:hover:bg-gray-800';
    $iconName = $styles[$type]['icon'] ?? 'circle';
@endphp

<a href="{{ $url }}" title="{{ $title }}"
    class="p-2.5 border-2 border-gray-300 dark:border-gray-700 rounded-xl {{ $hoverClass }} dark:text-white focus:outline-none cursor-pointer">
    <img src="{{ asset('assets/images/icons/' . $iconName . '.svg') }}" alt="{{ $title }}"
        class="h-4 w-4 block dark:hidden">
    <img src="{{ asset('assets/images/icons/' . $iconName . '-dark.svg') }}" alt="{{ $title }}"
        class="h-4 w-4 hidden dark:block">
</a>
