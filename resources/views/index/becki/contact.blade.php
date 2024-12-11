@extends('index.becki.layouts.main')
@section('index_body')
    @php
        $contact_title = getCachedKeyValue(['key' => 'contact_title', 'first' => true, 'refreshCache' => true]) ?? null;
        $contact_sub_title =
            getCachedKeyValue(['key' => 'contact_sub_title', 'first' => true, 'refreshCache' => true]) ?? null;

        $show_page_titles =
            getCachedKeyValue(['key' => 'show_page_titles', 'first' => true, 'refreshCache' => true]) ?? null;

        $use_sub_title_theme_db =
            getCachedKeyValue(['key' => 'sub_title_theme', 'first' => true, 'refreshCache' => true]) ?? null;
        $use_sub_title_theme = $use_sub_title_theme_db ? $use_sub_title_theme_db->value : 'pink';
    @endphp

    <style>
        .white-bg {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* En az ekranın %100 yüksekliğini kaplar */
            background-color: #f8f8f8;
            /* Arka plan rengi isteğe bağlı */

            justify-content: space-evenly;
            /* İçeriği dikey olarak ortalar */
            align-items: center;
            /* İçeriği yatay olarak ortalar */
        }
    </style>
    @include('index.becki.layouts.contact')
@endsection
