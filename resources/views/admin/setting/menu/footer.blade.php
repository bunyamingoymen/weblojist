@extends('admin.layouts.main')
@section('admin_index_body')
    @php
        $max_column = App\Models\Main\Menu::where('delete', 0)
            ->where('active', 1)
            ->where('type', 'footer')
            ->get()
            ->max(function ($menu) {
                return (int) $menu->column;
            });
    @endphp
    <style>
        .selected_menu {
            justify-content: space-between;
        }

        .selected_menu_active {
            background-color: #E3F2D0 !important;
            color: #71C078 !important;
        }

        .selected_menu_passive {
            background-color: #F8D7DB !important;
            color: #FC5661 !important;
        }
    </style>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_page', ['params' => 'settings/menu/footer']) }}" method="POST"
                        id="changeMenuFormID" enctype="multipart/form-data">
                        @csrf

                        @if (isset($selected_menu))
                            <div hidden>
                                <input type="text" name="code" id="code" value="{{ $selected_menu->code }}">
                            </div>
                        @endif

                        <div hidden>
                            <input type="hidden" name="type" id="type" value="footer">
                        </div>

                        <div class="col-lg-12 mt-2" hidden>
                            <label for="top_category">{{ lang_db('Select Top Menu') }}: </label>
                            <select name="top_category" id="top_category" class="form-control">
                                <option value="0">{{ lang_db('Top Menu') }}</option>
                            </select>
                        </div>

                        <div class="col-lg-12 mt-2">
                            <label for="row">{{ lang_db('Menu Row') }}: </label>
                            <input type="number" class="form-control" id="row" name="row"
                                value={{ $selected_menu->row ?? '1' }} min="1">
                        </div>

                        <div class="col-lg-12 mt-2">
                            <label for="column">{{ lang_db('Menu Column') }}: </label>
                            <input type="number" class="form-control" id="column" name="column"
                                value="{{ $selected_menu->column ?? '1' }}" min="1" max="4">
                        </div>

                        <div class="col-lg-12 mt-2">
                            <label for="column">{{ lang_db('Type') }}: </label>
                            <select name="footer_type" id="footer_type" class="form-control"
                                onchange="changeFooterType(this.value)">
                                <option value="title"
                                    {{ isset($selected_menu) && $selected_menu->footer_type == 'title' ? 'selected' : '' }}>
                                    {{ lang_db('Title') }}
                                </option>

                                <option value="image"
                                    {{ isset($selected_menu) && $selected_menu->footer_type == 'logo' ? 'selected' : '' }}>
                                    {{ lang_db('Image') }}
                                </option>

                                <option value="text"
                                    {{ isset($selected_menu) && $selected_menu->footer_type == 'text' ? 'selected' : '' }}>
                                    {{ lang_db('Text') }}
                                </option>

                                <option value="social_media"
                                    {{ isset($selected_menu) && $selected_menu->footer_type == 'social_media' ? 'selected' : '' }}>
                                    {{ lang_db('Social Media') }}
                                </option>

                                <option value="url"
                                    {{ (isset($selected_menu) && $selected_menu->footer_type == 'url') || !isset($selected_menu) ? 'selected' : '' }}>
                                    {{ lang_db('URL') }}
                                </option>
                            </select>
                        </div>

                        <div id="footerTypeTitleDiv" style="display: none;">
                            <div class="col-lg-12 mt-2">
                                <label for="footer_type_title">{{ lang_db('Title') }}: </label>
                                <input type="text" class="form-control" id="footer_type_title" name="footer_type_title"
                                    value="{{ $selected_menu->path ?? '' }}">
                            </div>

                            @foreach ($language as $item)
                                @if ($item->optional_2 == 'main_language')
                                    @continue
                                @endif
                                <div class="col-xl-8 mt-5">
                                    <div class="card text-white bg-primary">
                                        <div class="card-body">
                                            <h3 class="card-title font-size-16 mt-0 text-white">{{ $item->value }}</h3>
                                            <div class="card-text">

                                                <div class="col-lg-12">
                                                    <label
                                                        for="title_lan_{{ $item->optional_1 }}">{{ lang_db('Title') }}</label>
                                                    <input type="text" class="form-control"
                                                        name="language[{{ $item->optional_1 }}][title]"
                                                        id="title_lan_{{ $item->optional_1 }}"
                                                        value="{{ isset($selected_menu) && $selected_menu->title ? lang_db($selected_menu->title, $type = -1, $locale = $item->optional_1) : '' }}"
                                                        placeholder="Enter Title">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div id="footerTypeImageDiv" style="display: none;">
                            <div class="col-lg-10 mt-4 ml-3">
                                <div>
                                    <input type="file" class="custom-file-input" id="footer_type_image"
                                        name="footer_type_image" accept="image/*">
                                    <label class="custom-file-label" for="pageImage">
                                        {{ lang_db('Choose file...') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="footerTypeTextDiv" style="display: none;">
                            <div class="col-lg-12 mt-2">
                                <label for="footer_type_text">{{ lang_db('Text') }}: </label>
                                <textarea name="footer_type_text" id="footer_type_text" class="form-control" cols="30" rows="10">{{ $selected_menu->path ?? '' }}</textarea>
                            </div>

                            @foreach ($language as $item)
                                @if ($item->optional_2 == 'main_language')
                                    @continue
                                @endif
                                <div class="col-lg-12 mt-5">
                                    <div class="card text-white bg-primary">
                                        <div class="card-body">
                                            <h3 class="card-title font-size-16 mt-0 text-white">{{ $item->value }}</h3>
                                            <div class="card-text">

                                                <div class="col-lg-12">
                                                    <label for="text_lan_{{ $item->optional_1 }}">
                                                        {{ lang_db('Text') }}
                                                    </label>
                                                    <textarea name="language[{{ $item->optional_1 }}][footer_type_text]" id="text_lan_{{ $item->optional_1 }}"
                                                        class="form-control" cols="30" rows="10">{{ isset($selected_menu) && $selected_menu->title ? lang_db($selected_menu->title, $type = -1, $locale = $item->optional_1) : '' }}</textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div id="footerTypeUrlDiv" style="display: none;">
                            <div class="col-lg-12 mt-2">
                                <label for="title">{{ lang_db('Title') }}: </label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $selected_menu->title ?? '' }}">
                            </div>

                            @foreach ($language as $item)
                                @if ($item->optional_2 == 'main_language')
                                    @continue
                                @endif
                                <div class="col-xl-8 mt-5">
                                    <div class="card text-white bg-primary">
                                        <div class="card-body">
                                            <h3 class="card-title font-size-16 mt-0 text-white">{{ $item->value }}</h3>
                                            <div class="card-text">

                                                <div class="col-lg-12">
                                                    <label
                                                        for="title_lan_{{ $item->optional_1 }}">{{ lang_db('Title') }}</label>
                                                    <input type="text" class="form-control"
                                                        name="language[{{ $item->optional_1 }}][title]"
                                                        id="title_lan_{{ $item->optional_1 }}"
                                                        value="{{ isset($selected_menu) && $selected_menu->title ? lang_db($selected_menu->title, $type = -1, $locale = $item->optional_1) : '' }}"
                                                        placeholder="Enter Title">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-lg-12 mt-2">
                                <label for="path">{{ lang_db('URL') }}: </label>
                                <select name="path" id="path" class="form-control" onchange="changePathType()">
                                    <option value="#"
                                        {{ (isset($selected_menu) && $selected_menu->path == '#') || !isset($selected_menu) ? 'selected' : '' }}>
                                        {{ lang_db('No URL') }}</option>
                                    <option value="contact"
                                        {{ isset($selected_menu) && $selected_menu->path == 'contact' ? 'selected' : '' }}>
                                        {{ lang_db('Contact') }}</option>
                                    <option value="blogs"
                                        {{ isset($selected_menu) && $selected_menu->path == 'blogs' ? 'selected' : '' }}>
                                        {{ lang_db('Blogs') }}</option>
                                    <option value="products"
                                        {{ isset($selected_menu) && $selected_menu->path == 'products' ? 'selected' : '' }}>
                                        {{ lang_db('Products') }}</option>
                                    <option value="gallery"
                                        {{ isset($selected_menu) && $selected_menu->path == 'gallery' ? 'selected' : '' }}>
                                        {{ lang_db('Gallery') }}</option>
                                    <option value="specific_page"
                                        {{ isset($selected_menu) && count($pages->where('short_name', str_replace('/p/', '', $selected_menu->path))) >= 1 ? 'selected' : '' }}>
                                        {{ lang_db('A specific Page') }}</option>
                                    <option value="specific_blog"
                                        {{ isset($selected_menu) && count($blogs->where('short_name', str_replace('/p/', '', $selected_menu->path))) >= 1 ? 'selected' : '' }}>
                                        {{ lang_db('A specific Blog') }}</option>
                                    <option
                                        value="specific_supplier {{ isset($selected_menu) && count($suppliers->where('short_name', str_replace('/p/', '', $selected_menu->path))) >= 1 ? 'selected' : '' }}">
                                        {{ lang_db('A specific Supplier') }}</option>
                                    <option value="manuel_input" {{ isset($selected_menu) ? 'selected' : '' }}>
                                        {{ lang_db('Manuel Input') }}</option>
                                </select>
                            </div>

                            <div class="col-lg-12 mt-2" id="specific_section" hidden>
                                <div id="specific_section_page" hidden>
                                    <label for="">Bağlantı Sayfası: </label>
                                    <select name="specific_selectbox_page" id="specific_selectbox_page"
                                        class="form-control">
                                        @foreach ($pages as $page)
                                            <option value="/p/{{ $page->short_name }}"
                                                {{ isset($selected_menu) && $page->short_name == str_replace('/p/', '', $selected_menu->path) ? 'selected' : '' }}>
                                                {{ lang_db($page->title) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="specific_section_blog" hidden>
                                    <label for="">Bağlantı Sayfası: </label>
                                    <select name="specific_selectbox_blog" id="specific_selectbox_blog"
                                        class="form-control">
                                        @foreach ($blogs as $blog)
                                            <option value="/p/{{ $blog->short_name }}"
                                                {{ isset($selected_menu) && $blog->short_name == str_replace('/p/', '', $selected_menu->path) ? 'selected' : '' }}>
                                                {{ lang_db($blog->title) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="specific_section_supplier" hidden>
                                    <label for="">Bağlantı Sayfası: </label>
                                    <select name="specific_selectbox_supplier" id="specific_selectbox_supplier"
                                        class="form-control">
                                        @foreach ($suppliers as $supplier)
                                            <option value="/p/{{ $supplier->short_name }}"
                                                {{ isset($selected_menu) && $supplier->short_name == str_replace('/p/', '', $selected_menu->path) ? 'selected' : '' }}>
                                                {{ lang_db($supplier->title) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-2" id="manuel_url" hidden>
                                <label for="manuel_input">{{ lang_db('Manuel Input') }}: </label>
                                <input type="text" class="form-control" id="manuel_input" name="manuel_input"
                                    value={{ $selected_menu->path ?? '' }}>
                            </div>
                        </div>

                        <div class="row input m-3">
                            <div class="col-lg-12 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="active" name="active"
                                    {{ (isset($selected_menu) && $selected_menu->active) || !isset($selected_menu) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="active">{{ lang_db('Active') }}</label>
                            </div>
                        </div>

                        <div class="row input m-3">
                            <div class="col-lg-12 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="open_different_page"
                                    name="open_different_page"
                                    {{ isset($selected_menu) && $selected_menu->open_different_page ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="open_different_page">{{ lang_db('Open in different page') }}</label>
                            </div>
                        </div>

                        <div style="float: right;">
                            <button class="btn btn-primary" type="button" onclick="submitChangeMenuForm()">
                                <i class="mdi mdi-content-save"></i>
                                {{ lang_db('Save') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        @for ($i = 1; $i <= $max_column; $i++)
            @if (count($menu->where('column', $i)) <= 0)
                @continue;
            @endif
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12 dd home-module-custom-nestable">
                            <ol class="col-lg-12 dd-list">
                                @foreach ($menu->where('column', $i) as $item)
                                    <li value="{{ $item->row }}" class="dd-item home-module-custom-nestable-item"
                                        data-id="{{ $item->code }}">
                                        <div
                                            class="row dd-handle ml-2 mt-2 selected_menu {{ $item->active == 1 ? 'selected_menu_active' : 'selected_menu_passive' }}">
                                            <div>
                                                @if (is_null($item->footer_type) || $item->footer_type == 'url')
                                                    {{ $item->title }} {!! $item->open_different_page ? '<i class="fas fa-external-link-alt"></i>' : '' !!}
                                                @elseif ($item->footer_type == 'image')
                                                    <img src="{{ isset($item->path) ? asset($item->path) : lang_db('Not Exist') }}"
                                                        alt="{{ $item->path }}"
                                                        style="max-height: 50px; max-width: 50px;">
                                                @elseif($item->footer_type == 'text')
                                                    {{ $item->path }}
                                                @elseif($item->footer_type == 'social_media')
                                                    <b><i>{{ lang_db('Social Media Links') }}</i></b>
                                                @elseif ($item->footer_type == 'title')
                                                    <h4>{{ $item->path }}</h4>
                                                @endif

                                            </div>
                                            <div>
                                                <a href="{{ route('admin_page', ['params' => 'settings/menu/footer']) }}?code={{ $item->code }}"
                                                    data-toggle="tooltip" data-placement="right"
                                                    title="{{ lang_db('Edit') }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin_page', ['params' => 'settings/menu/footer/delete']) }}?code={{ $item->code }}"
                                                    data-toggle="tooltip" data-placement="left"
                                                    title="{{ lang_db('Delete') }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>

                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        @endfor

    </div>
    <script>
        function submitChangeMenuForm() {
            var title = 'bypass'; //document.getElementById('title').value;
            var row = document.getElementById('row').value;
            var column = document.getElementById('column').value;

            if (title == "") {
                Swal.fire({
                    icon: 'error',
                    title: "{{ lang_db('Error!') }}",
                    text: "{{ lang_db('Please fill in the required fields') }}",
                })
            } else if (row < 1 || column < 1) {
                Swal.fire({
                    icon: 'error',
                    title: "{{ lang_db('Error!') }}",
                    text: "{{ lang_db('Row or column cannot be negative') }}",
                })
            } else if (column > 4) {
                Swal.fire({
                    icon: 'error',
                    title: "{{ lang_db('Error!') }}",
                    text: "{{ lang_db('The maximum number of columns can be 4') }}",
                })
            } else {
                document.getElementById('changeMenuFormID').submit();
            }
        }

        function changePathType() {
            const path_type = document.getElementById('path').value;
            if (path_type === 'specific_page' || path_type === 'specific_blog' || path_type === 'specific_supplier') {
                document.getElementById('specific_section').hidden = false;
                document.getElementById('manuel_url').hidden = true;
                if (path_type === 'specific_page') {
                    alert('specific_page');
                    document.getElementById('specific_section_page').hidden = false;
                    document.getElementById('specific_section_blog').hidden = true;
                    document.getElementById('specific_section_supplier').hidden = true;
                } else if (path_type === 'specific_blog') {
                    alert('specific_blog');
                    document.getElementById('specific_section_page').hidden = true;
                    document.getElementById('specific_section_blog').hidden = false;
                    document.getElementById('specific_section_supplier').hidden = true;
                } else {
                    alert('specific_supplier');
                    document.getElementById('specific_section_page').hidden = true;
                    document.getElementById('specific_section_blog').hidden = true;
                    document.getElementById('specific_section_supplier').hidden = false;
                }
            } else if (path_type === 'manuel_input') {
                document.getElementById('specific_section').hidden = true;
                document.getElementById('manuel_url').hidden = false;
            } else {
                document.getElementById('specific_section').hidden = true;
                document.getElementById('manuel_url').hidden = true;
            }
        }

        function changeFooterType(footerType) {
            if (footerType == 'title') {
                $('#footerTypeTitleDiv').slideDown(200);
                $('#footerTypeImageDiv').slideUp(200);
                $('#footerTypeTextDiv').slideUp(200);
                $('#footerTypeUrlDiv').slideUp(200);
            } else if (footerType == 'image') {
                $('#footerTypeTitleDiv').slideUp(200);
                $('#footerTypeImageDiv').slideDown(200);
                $('#footerTypeTextDiv').slideUp(200);
                $('#footerTypeUrlDiv').slideUp(200);
            } else if (footerType == 'text') {
                $('#footerTypeTitleDiv').slideUp(200);
                $('#footerTypeImageDiv').slideUp(200);
                $('#footerTypeTextDiv').slideDown(200);
                $('#footerTypeUrlDiv').slideUp(200);
            } else if (footerType == 'url') {
                $('#footerTypeTitleDiv').slideUp(200);
                $('#footerTypeImageDiv').slideUp(200);
                $('#footerTypeTextDiv').slideUp(200);
                $('#footerTypeUrlDiv').slideDown(200);
            } else if (footerType == 'social_media') {
                $('#footerTypeTitleDiv').slideUp(200);
                $('#footerTypeImageDiv').slideUp(200);
                $('#footerTypeTextDiv').slideUp(200);
                $('#footerTypeUrlDiv').slideUp(200);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const selectedPath =
                "{{ isset($selected_menu) && $selected_menu->footer_type == 'url' && $selected_menu->path ? $selected_menu->path : '#' }}";
            const pathSelect = document.getElementById('path');

            const footerType = "{{ $selected_menu->footer_type ?? 'url' }}";
            changeFooterType(footerType);

            if (footerType == 'image') {

            } else if (footerType == 'text') {

            } else if (footerType == 'title') {

            } else if (footerType == 'social_media') {

            } else if (footerType == 'url') {
                if (selectedPath === '#') {
                    pathSelect.value = '#';
                    document.getElementById('specific_section').hidden = true;
                    document.getElementById('manuel_url').hidden = true;
                } else if (selectedPath === 'contact') {
                    pathSelect.value = 'contact';
                    document.getElementById('specific_section').hidden = true;
                    document.getElementById('manuel_url').hidden = true;
                } else if (selectedPath === 'blogs') {
                    pathSelect.value = 'blogs';
                    document.getElementById('specific_section').hidden = true;
                    document.getElementById('manuel_url').hidden = true;
                } else if (selectedPath === 'products') {
                    pathSelect.value = 'products';
                    document.getElementById('specific_section').hidden = true;
                    document.getElementById('manuel_url').hidden = true;
                } else if (selectedPath === 'gallery') {
                    pathSelect.value = 'gallery';
                    document.getElementById('specific_section').hidden = true;
                    document.getElementById('manuel_url').hidden = true;
                } else if (
                    {{ isset($selected_menu) && count($pages->where('short_name', str_replace('/p/', '', $selected_menu->path))) >= 1 ? 'true' : 'false' }}
                ) {
                    document.getElementById('specific_section').hidden = false;
                    document.getElementById('manuel_url').hidden = true;
                    pathSelect.value = 'specific_page';
                    document.getElementById('specific_section_page').hidden = false;
                    document.getElementById('specific_section_blog').hidden = true;
                    document.getElementById('specific_section_supplier').hidden = true;
                } else if (
                    {{ isset($selected_menu) && count($blogs->where('short_name', str_replace('/p/', '', $selected_menu->path))) >= 1 ? 'true' : 'false' }}
                ) {
                    document.getElementById('specific_section').hidden = false;
                    document.getElementById('manuel_url').hidden = true;
                    pathSelect.value = 'specific_blog';
                    document.getElementById('specific_section_page').hidden = true;
                    document.getElementById('specific_section_blog').hidden = false;
                    document.getElementById('specific_section_supplier').hidden = true;
                } else if (
                    {{ isset($selected_menu) && count($suppliers->where('short_name', str_replace('/p/', '', $selected_menu->path))) >= 1 ? 'true' : 'false' }}
                ) {
                    document.getElementById('specific_section').hidden = false;
                    document.getElementById('manuel_url').hidden = true;
                    pathSelect.value = 'specific_supplier';
                    document.getElementById('specific_section_page').hidden = true;
                    document.getElementById('specific_section_blog').hidden = true;
                    document.getElementById('specific_section_supplier').hidden = false;
                } else {
                    pathSelect.value = 'manuel_input';
                    document.getElementById('specific_section').hidden = true;
                    document.getElementById('manuel_url').hidden = false;
                }
            }

        });
    </script>
@endsection
