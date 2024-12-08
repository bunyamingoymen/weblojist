@extends('admin.layouts.main')
@section('admin_index_body')
    @php
        $active_theme = getActiveTheme();
    @endphp
    @if ($active_theme == 'becki')
        @include('admin.setting.background.becki')
    @elseif ($active_theme == 'akea')
        @include('admin.setting.background.akea')
    @endif
@endsection
