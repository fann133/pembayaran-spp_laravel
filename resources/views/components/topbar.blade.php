@php
    $role_id = Auth::user()->role_id ?? null;
@endphp

@if($role_id == 1)
    @include('components.topbar-admin')
@elseif($role_id == 2)
    @include('components.topbar-siswa')
@elseif($role_id == 3)
    @include('components.topbar-guru')
@elseif($role_id == 4)
    @include('components.topbar-bendahara')
@elseif($role_id == 5)
    @include('components.topbar-kepsek')
@endif