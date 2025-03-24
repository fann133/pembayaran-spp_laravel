@php
    $role_id = Auth::user()->role_id ?? null;
@endphp

@if($role_id == 1)
    @include('components.sidebar-admin')
@elseif($role_id == 2)
    @include('components.sidebar-siswa')
@elseif($role_id == 3)
    @include('components.sidebar-guru')
@elseif($role_id == 4)
    @include('components.sidebar-bendahara')
@elseif($role_id == 5)
    @include('components.sidebar-kepsek')
@endif