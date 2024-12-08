@extends('admin.layouts.main')
@section('admin_index_body')
    @php
        $active_theme_type = getActiveTheme();
    @endphp
    @include("admin.setting.background.{$active_theme_type}")
@endsection
