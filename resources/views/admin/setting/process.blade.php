@extends('admin.layouts.main')
@section('admin_index_body')
    @php
        $blogs = App\Models\Main\Page::Where('delete', 0)->where('type', 1)->get();
        $pages = App\Models\Main\Page::Where('delete', 0)->where('type', 2)->get();
        $suppliers = App\Models\Main\Page::Where('delete', 0)->where('type', 3)->get();
    @endphp
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12" style="display: inline-block;">
                        <a class="btn btn-primary mb-3" style="float: right;" href="#" onclick="addNewProcess()">
                            <i class="mdi mdi-plus-circle-outline"></i> {{ lang_db('New') }}
                        </a>
                    </div>
                    <form action="{{ route('admin_page', ['params' => 'settings/process']) }}" method="POST">
                        @csrf
                        @foreach ($process_title as $pro_title)
                            <div id="process_{{ $pro_title->code }}" class="processes mb-5">
                                <input type="hidden" name="codes[]" value="{{ $pro_title->code ?? -1 }}" required readonly>
                                <input type="hidden" name="keys[]" value="{{ $pro_title->key ?? 'processes' }}" required
                                    readonly>
                                <div class="col-lg-12 row mt-3">
                                    <div class="col-lg-8">
                                        <div>
                                            <label for="">{{ lang_db('Main Title') }}</label>
                                            <input type="text" class="form-control" name="values[]" id=""
                                                value="{{ $pro_title->value ?? '' }}"
                                                placeholder="{{ lang_db('Enter Main Title') }}">
                                        </div>
                                        <div hidden>
                                            <input type="hidden"
                                                name="optional_2[]"value="{{ $pro_title->optional_2 ?? '' }}">

                                            <input type="hidden"
                                                name="optional_3[]"value="{{ $pro_title->optional_3 ?? '' }}">

                                            <input type="hidden"
                                                name="optional_4[]"value="{{ $pro_title->optional_4 ?? '' }}">
                                        </div>
                                        <div class="mt-3">
                                            <textarea name="optional_1[]" cols="30" rows="10" hidden>{{ $pro_title->optional_1 ?? '' }}</textarea>
                                        </div>

                                    </div>
                                </div>
                                @foreach ($language as $item)
                                    @if ($item->optional_2 == 'main_language')
                                        @continue
                                    @endif

                                    <div class="col-xl-8 mt-3">
                                        <div class="card text-white bg-primary">
                                            <div class="card-body">
                                                <h3 class="card-title font-size-16 mt-0 text-white">{{ $item->value }}
                                                </h3>
                                                <div class="card-text">

                                                    <div class="col-lg-12">
                                                        <label for="">{{ lang_db('Main Title') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="language[{{ $item->optional_1 }}][value][]"
                                                            id=""
                                                            value="{{ $pro_title->value ? lang_db($pro_title->value, $type = -1, $locale = $item->optional_1) : '' }}"
                                                            placeholder="{{ lang_db('Enter Main Title') }}">
                                                    </div>
                                                    <div class="col-lg-12 mt-3">
                                                        <textarea name="language[{{ $item->optional_1 }}][optional_1][]" id="" cols="30" rows="10"
                                                            class="form-control" hidden>{{ $pro_title->optional_1 ? lang_db($pro_title->optional_1, $type = -1, $locale = $item->optional_1) : '' }}</textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <div id="processDivId">
                            @foreach ($processes as $pro)
                                <div id="process_{{ $pro->code }}" class="processes">
                                    <input type="hidden" name="codes[]" value="{{ $pro->code ?? -1 }}" required readonly>
                                    <input type="hidden" name="keys[]" value="{{ $pro->key ?? 'processes' }}" required
                                        readonly>
                                    <div class="col-lg-12 row mt-3">
                                        <div class="col-lg-8">
                                            <div>
                                                <label for="">{{ lang_db('Title') }}</label>
                                                <input type="text" class="form-control" name="values[]" id=""
                                                    value="{{ $pro->value ?? '' }}"
                                                    placeholder="{{ lang_db('Enter Title') }}">
                                            </div>
                                            <div class="mt-3">
                                                <label for="">{{ lang_db('Icon') }}</label>
                                                <input type="text" class="form-control" name="optional_2[]"
                                                    id="" value="{{ $pro->optional_2 ?? '' }}"
                                                    placeholder="{{ lang_db('Enter Icon') }}">
                                            </div>

                                            <div class="col-lg-12 row mt-2">
                                                <label for="path">{{ lang_db('URL') }}: </label>
                                                <select name="path" id="path_{{ $pro->code }}" class="form-control"
                                                    onchange="changePathType('{{ $pro->code }}')">
                                                    <option value="#"
                                                        {{ (isset($pro) && $pro->optional_3 == '#') || !isset($pro) ? 'selected' : '' }}>
                                                        {{ lang_db('No URL') }}</option>

                                                    <option value="contact"
                                                        {{ isset($pro) && $pro->optional_3 == 'contact' ? 'selected' : '' }}>
                                                        {{ lang_db('Contact') }}</option>

                                                    <option value="blogs"
                                                        {{ isset($pro) && $pro->optional_3 == 'blogs' ? 'selected' : '' }}>
                                                        {{ lang_db('Blogs') }}</option>

                                                    <option value="products"
                                                        {{ isset($pro) && $pro->optional_3 == 'products' ? 'selected' : '' }}>
                                                        {{ lang_db('Products') }}</option>

                                                    <option value="gallery"
                                                        {{ isset($pro) && $pro->optional_3 == 'gallery' ? 'selected' : '' }}>
                                                        {{ lang_db('Gallery') }}</option>

                                                    <option value="specific_page"
                                                        {{ isset($pro) && count($pages->where('short_name', str_replace('/p/', '', $pro->optional_3))) >= 1 ? 'selected' : '' }}>
                                                        {{ lang_db('A specific Page') }}</option>

                                                    <option value="specific_blog"
                                                        {{ isset($pro) && count($blogs->where('short_name', str_replace('/p/', '', $pro->optional_3))) >= 1 ? 'selected' : '' }}>
                                                        {{ lang_db('A specific Blog') }}</option>

                                                    <option value="specific_supplier"
                                                        {{ isset($pro) && count($suppliers->where('short_name', str_replace('/p/', '', $pro->optional_3))) >= 1 ? 'selected' : '' }}>
                                                        {{ lang_db('A specific Supplier') }}</option>

                                                    <option value="manuel_input" {{ isset($pro) ? 'selected' : '' }}>
                                                        {{ lang_db('Manuel Input') }}</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-12 row mt-2" id="specific_section_{{ $pro->code }}"
                                                hidden>
                                                <div class="col-lg-12 row mt-2"
                                                    id="specific_section_page_{{ $pro->code }}" hidden>
                                                    <label for="">Bağlantı Sayfası: </label>
                                                    <select name="specific_selectbox_page_{{ $pro->code }}"
                                                        id="specific_selectbox_page_{{ $pro->code }}"
                                                        class="form-control"
                                                        onchange="selectURL('{{ $pro->code }}', this.value)">
                                                        @foreach ($pages as $page)
                                                            <option value="/p/{{ $page->short_name }}"
                                                                {{ isset($pro) && $page->short_name == str_replace('/p/', '', $pro->optional_3) ? 'selected' : '' }}>
                                                                {{ lang_db($page->title) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-12 row mt-2"
                                                    id="specific_section_blog_{{ $pro->code }}" hidden>
                                                    <label for="">Bağlantı Sayfası: </label>
                                                    <select name="specific_selectbox_blog_{{ $pro->code }}"
                                                        id="specific_selectbox_blog_{{ $pro->code }}"
                                                        class="form-control"
                                                        onchange="selectURL('{{ $pro->code }}', this.value)">
                                                        @foreach ($blogs as $blog)
                                                            <option value="/p/{{ $blog->short_name }}"
                                                                {{ isset($pro) && $blog->short_name == str_replace('/p/', '', $pro->optional_3) ? 'selected' : '' }}>
                                                                {{ lang_db($blog->title) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-12 row mt-2"
                                                    id="specific_section_supplier_{{ $pro->code }}" hidden>
                                                    <label for="">Bağlantı Sayfası: </label>
                                                    <select name="specific_selectbox_supplier_{{ $pro->code }}"
                                                        id="specific_selectbox_supplier_{{ $pro->code }}"
                                                        class="form-control"
                                                        onchange="selectURL('{{ $pro->code }}', this.value)">
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="/p/{{ $supplier->short_name }}"
                                                                {{ isset($pro) && $supplier->short_name == str_replace('/p/', '', $pro->optional_3) ? 'selected' : '' }}>
                                                                {{ lang_db($supplier->title) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 row mt-2" id="manuel_url_{{ $pro->code }}" hidden>
                                                <label
                                                    for="manuel_input_{{ $pro->code }}">{{ lang_db('Manuel Input') }}:
                                                </label>
                                                <input type="text" class="form-control"
                                                    id="manuel_input_{{ $pro->code }}" name="manuel_input[]"
                                                    oninput='syncInputs("manuel_input_{{ $pro->code }}", "optional_3_{{ $pro->code }}")'
                                                    value="{{ $pro->optional_3 ?? '' }}">
                                            </div>

                                            <div class="col-lg-12 row mt-2" id="optional_3{{ $pro->code }}"
                                                style="display: none">
                                                <label for="optional_3_{{ $pro->code }}">
                                                </label>
                                                <input type="text" class="form-control"
                                                    id="optional_3_{{ $pro->code }}" name="optional_3[]"
                                                    value="{{ $pro->optional_3 ?? '' }}">
                                            </div>

                                            <div
                                                class="mt-3 col-lg-12 custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="open_different_page_{{ $pro->code }}"
                                                    name="open_different_page_{{ $pro->code }}"
                                                    onchange="selectDifferentPage('{{ $pro->code }}', this)"
                                                    {{ isset($pro) && $pro->optional_4 ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                    for="open_different_page_{{ $pro->code }}">{{ lang_db('Open In Different Page') }}</label>
                                            </div>

                                            <div class="col-lg-12 row mt-2" id="optional_4{{ $pro->code }}"
                                                style="display: none">
                                                <label for="optional_4_{{ $pro->code }}">
                                                </label>
                                                <input type="text" class="form-control"
                                                    id="optional_4_{{ $pro->code }}" name="optional_4[]"
                                                    value="{{ $pro->optional_4 ?? '0' }}">
                                            </div>

                                            <div class="mt-3">
                                                <label for="">{{ lang_db('Description') }}</label>
                                                <textarea name="optional_1[]" id="" class="form-control" cols="30" rows="10"
                                                    placeholder="{{ lang_db('Enter Description') }}">{{ $pro->optional_1 ?? '' }}</textarea>
                                            </div>

                                        </div>
                                        <div class="col-lg-2">
                                            <div class="col-lg-3 btn btn-danger"
                                                onclick="deleteProcess('{{ $pro->code }}', '{{ $pro->value }}' )"
                                                style="height:100%; widht:100%; display: flex; justify-content: center; align-items: center;">
                                                <i class="fas fa-trash-alt fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($language as $item)
                                        @if ($item->optional_2 == 'main_language')
                                            @continue
                                        @endif

                                        <div class="col-xl-8 mt-3">
                                            <div class="card text-white bg-primary">
                                                <div class="card-body">
                                                    <h3 class="card-title font-size-16 mt-0 text-white">
                                                        {{ $item->value }}
                                                    </h3>
                                                    <div class="card-text">

                                                        <div class="col-lg-12">
                                                            <label for="">{{ lang_db('Title') }}</label>
                                                            <input type="text" class="form-control"
                                                                name="language[{{ $item->optional_1 }}][value][]"
                                                                id=""
                                                                value="{{ $pro->value ? lang_db($pro->value, $type = -1, $locale = $item->optional_1) : '' }}"
                                                                placeholder="{{ lang_db('Enter Title') }}">
                                                        </div>
                                                        <div class="col-lg-12 mt-3">
                                                            <label for="">{{ lang_db('Description') }}</label>
                                                            <textarea name="language[{{ $item->optional_1 }}][optional_1][]" id="" cols="30" rows="10"
                                                                class="form-control" placeholder="{{ lang_db('Enter Description') }}">{{ $pro->optional_1 ? lang_db($pro->optional_1, $type = -1, $locale = $item->optional_1) : '' }}</textarea>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i>
                            {{ lang_db('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var addNewProcessCount = 0;

        function getOldValue() {
            let values = [];
            const elements = document.querySelectorAll('input, textarea, select, checkbox, radio');

            elements.forEach((element) => {
                if (element.type === 'checkbox' || element.type === 'radio') {
                    values.push(element.checked);
                } else {
                    values.push(element.value);
                }
            });

            return values;
        }

        function setOldValue(data) {
            const elements = document.querySelectorAll('input, textarea, select, checkbox, radio');

            elements.forEach((element, index) => {
                if (index < data.length) {
                    if (element.type === 'checkbox' || element.type === 'radio') {
                        element.checked = data[index];
                    } else {
                        element.value = data[index];
                    }
                }
            });
        }

        function addNewProcess() {
            var data = getOldValue();
            addNewProcessCount++;
            var html = `
                <div id="process_${addNewProcessCount}" class="processes">
                    <input type="hidden" name="codes[]" value="-1" required readonly>
                    <input type="hidden" name="keys[]" value="processes" required readonly>
                    <div class="col-lg-12 row mt-3">
                        <div class="col-lg-8">
                            <div>
                                <label for="">{{ lang_db('Title') }}</label>
                                <input type="text" class="form-control" name="values[]" id="" value=""
                                    placeholder="{{ lang_db('Enter Title') }}">
                            </div>
                            <div class="mt-3">
                                <label for="">{{ lang_db('Icon') }}</label>
                                <input type="text" class="form-control" name="optional_2[]" id="" value=""
                                    placeholder="{{ lang_db('Enter Icon') }}">
                            </div>

                            <div class="col-lg-12 row mt-2">
                                <label for="path">{{ lang_db('URL') }}: </label>
                                <select name="path" id="path_${addNewProcessCount}" class="form-control"
                                    onchange="changePathType('${addNewProcessCount}')">

                                    <option value="#" selected>{{ lang_db('No URL') }}</option>
                                    <option value="contact">{{ lang_db('Contact') }}</option>
                                    <option value="blogs">{{ lang_db('Blogs') }}</option>
                                    <option value="products">{{ lang_db('Products') }}</option>
                                    <option value="products">{{ lang_db('Gallery') }}</option>
                                    <option value="specific_page">{{ lang_db('A specific Page') }}</option>
                                    <option value="specific_blog">{{ lang_db('A specific Blog') }}</option>
                                    <option value="specific_supplier">{{ lang_db('A specific Supplier') }}</option>
                                    <option value="manuel_input">{{ lang_db('Manuel Input') }}</option>

                                </select>
                            </div>

                            <div class="col-lg-12 row mt-2" id="specific_section_${addNewProcessCount}"
                                hidden>
                                <div class="col-lg-12 row mt-2"
                                    id="specific_section_page_${addNewProcessCount}" hidden>
                                    <label for="">Bağlantı Sayfası: </label>
                                    <select name="specific_selectbox_page_${addNewProcessCount}"
                                        id="specific_selectbox_page_${addNewProcessCount}"
                                        class="form-control"
                                        onchange="selectURL('${addNewProcessCount}', this.value)">
                                        @foreach ($pages as $page)
                                            <option value="/p/{{ $page->short_name }}">
                                                {{ lang_db($page->title) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12 row mt-2"
                                    id="specific_section_blog_${addNewProcessCount}" hidden>
                                    <label for="">Bağlantı Sayfası: </label>
                                    <select name="specific_selectbox_blog_${addNewProcessCount}"
                                        id="specific_selectbox_blog_${addNewProcessCount}"
                                        class="form-control"
                                        onchange="selectURL('${addNewProcessCount}', this.value)">
                                        @foreach ($blogs as $blog)
                                            <option value="/p/{{ $blog->short_name }}">
                                                {{ lang_db($blog->title) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12 row mt-2"
                                    id="specific_section_supplier_${addNewProcessCount}" hidden>
                                    <label for="">Bağlantı Sayfası: </label>
                                    <select name="specific_selectbox_supplier_${addNewProcessCount}"
                                        id="specific_selectbox_supplier_${addNewProcessCount}"
                                        class="form-control"
                                        onchange="selectURL('${addNewProcessCount}', this.value)">
                                        @foreach ($suppliers as $supplier)
                                            <option value="/p/{{ $supplier->short_name }}">
                                                {{ lang_db($supplier->title) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12 row mt-2" id="manuel_url_${addNewProcessCount}" hidden>
                                <label
                                    for="manuel_input_${addNewProcessCount}">{{ lang_db('Manuel Input') }}:
                                </label>
                                <input type="text" class="form-control"
                                    id="manuel_input_${addNewProcessCount}" name="manuel_input[]"
                                    value="">
                            </div>

                            <div class="col-lg-12 row mt-2" id="optional_3${addNewProcessCount}"
                                style="display: none">
                                <label for="optional_3_${addNewProcessCount}">
                                </label>
                                <input type="text" class="form-control"
                                    id="optional_3_${addNewProcessCount}" name="optional_3[]"
                                    value="">
                            </div>

                            <div
                                class="mt-3 col-lg-12 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input"
                                    id="open_different_page_${addNewProcessCount}"
                                    name="open_different_page_${addNewProcessCount}"
                                    onchange="selectDifferentPage('${addNewProcessCount}', this)">
                                <label class="custom-control-label"
                                    for="open_different_page_${addNewProcessCount}">{{ lang_db('Open In Different Page') }}</label>
                            </div>

                            <div class="col-lg-12 row mt-2" id="optional_4${addNewProcessCount}"
                                style="display: none">
                                <label for="optional_4_${addNewProcessCount}">
                                </label>
                                <input type="text" class="form-control"
                                    id="optional_4_${addNewProcessCount}" name="optional_4[]"
                                    value="0">
                            </div>
                            <div class="mt-3">
                                <label for="">{{ lang_db('Description') }}</label>
                                <textarea name="optional_1[]" id="" class="form-control" cols="30" rows="10"
                                    placeholder="{{ lang_db('Enter Description') }}"></textarea>
                            </div>

                        </div>
                        <div class="col-lg-2">
                            <div class="col-lg-3 btn btn-danger"
                                onclick="cancelNewProcess('${addNewProcessCount}')"
                                style="height:100%; widht:100%; display: flex; justify-content: center; align-items: center;">
                                <i class="fas fa-trash-alt fa-2x"></i>
                            </div>
                        </div>
                    </div>
                `
            @foreach ($language as $item)
                @if ($item->optional_2 == 'main_language')
                    @continue
                @endif

                html += `
                        <div class="col-xl-8 mt-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h3 class="card-title font-size-16 mt-0 text-white">{{ $item->value }}</h3>
                                    <div class="card-text">
                                        <div class="col-lg-12">
                                            <label for="">{{ lang_db('Title') }}</label>
                                            <input type="text" class="form-control" name="language[{{ $item->optional_1 }}][value][]" id="" value="" placeholder="{{ lang_db('Enter Title') }}">
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <label for="">{{ lang_db('Description') }}</label>
                                            <textarea name="language[{{ $item->optional_1 }}][optional_1][]" id="" cols="30" rows="10" class="form-control" placeholder="{{ lang_db('Enter Description') }}"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
            @endforeach

            html += `</div>`

            document.getElementById('processDivId').innerHTML += html;

            setOldValue(data);
        }

        function cancelNewProcess(count) {
            document.getElementById('process_' + count).remove();
        }

        function deleteProcess(code, name) {
            Swal.fire({
                title: `{{ lang_db('Are you sure') }}`,
                text: `{{ lang_db('Do you want to delete this data') }}?(${name})`,
                icon: 'warning',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `{{ lang_db('Approve') }}`,
                denyButtonText: `{{ lang_db('Cancel') }}`,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open(`{{ route('admin_page', ['params' => 'settings/process/delete']) }}?code=${code}`,
                        '_self');
                }
            })
        }
    </script>

    <script>
        function changePathType(code) {
            const path_type = document.getElementById('path_' + code).value;
            if (path_type === 'specific_page' || path_type === 'specific_blog' || path_type ===
                'specific_supplier') {
                document.getElementById('specific_section_' + code).hidden = false;
                document.getElementById('manuel_url_' + code).hidden = true;
                if (path_type === 'specific_page') {
                    document.getElementById('specific_section_page_' + code).hidden = false;
                    document.getElementById('specific_section_blog_' + code).hidden = true;
                    document.getElementById('specific_section_supplier_' + code).hidden = true;
                    @if ($pages->isNotEmpty())
                        selectURL(code, '/p/{{ $pages->first()->short_name }}');
                    @else
                        selectURL(code, '');
                    @endif

                } else if (path_type === 'specific_blog') {
                    document.getElementById('specific_section_page_' + code).hidden = true;
                    document.getElementById('specific_section_blog_' + code).hidden = false;
                    document.getElementById('specific_section_supplier_' + code).hidden = true;

                    @if ($blogs->isNotEmpty())
                        selectURL(code, '/p/{{ $blogs->first()->short_name }}');
                    @else
                        selectURL(code, '');
                    @endif
                } else {
                    document.getElementById('specific_section_page_' + code).hidden = true;
                    document.getElementById('specific_section_blog_' + code).hidden = true;
                    document.getElementById('specific_section_supplier_' + code).hidden = false;

                    @if ($suppliers->isNotEmpty())
                        selectURL(code, '/p/{{ $suppliers->first()->short_name }}');
                    @else
                        selectURL(code, '');
                    @endif
                }
            } else if (path_type === 'manuel_input') {
                selectURL(code, '')
                document.getElementById('specific_section_' + code).hidden = true;
                document.getElementById('manuel_url_' + code).hidden = false;
            } else {
                selectURL(code, '#')
                document.getElementById('specific_section_' + code).hidden = true;
                document.getElementById('manuel_url_' + code).hidden = true;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($processes as $pro)
                var selectedPath = "{{ $pro->optional_3 ?? '#' }}";
                var pathSelect = document.getElementById('path_{{ $pro->code }}');
                selectURL('{{ $pro->code }}', "{{ $pro->optional_3 ?? '#' }}");
                if (selectedPath === '#') {
                    pathSelect.value = '#';
                    document.getElementById('specific_section_{{ $pro->code }}').hidden = true;
                    document.getElementById('manuel_url_{{ $pro->code }}').hidden = true;
                } else if (selectedPath === 'contact') {
                    pathSelect.value = 'contact';
                    document.getElementById('specific_section_{{ $pro->code }}').hidden = true;
                    document.getElementById('manuel_url_{{ $pro->code }}').hidden = true;
                } else if (selectedPath === 'blogs') {
                    pathSelect.value = 'blogs';
                    document.getElementById('specific_section_{{ $pro->code }}').hidden = true;
                    document.getElementById('manuel_url_{{ $pro->code }}').hidden = true;
                } else if (selectedPath === 'products') {
                    pathSelect.value = 'products';
                    document.getElementById('specific_section_{{ $pro->code }}').hidden = true;
                    document.getElementById('manuel_url_{{ $pro->code }}').hidden = true;
                } else if (selectedPath === 'gallery') {
                    pathSelect.value = 'gallery';
                    document.getElementById('specific_section_{{ $pro->code }}').hidden = true;
                    document.getElementById('manuel_url_{{ $pro->code }}').hidden = true;
                } else if (
                    {{ isset($pro) && count($pages->where('short_name', str_replace('/p/', '', $pro->optional_3))) >= 1 ? 'true' : 'false' }}
                ) {
                    document.getElementById('specific_section_{{ $pro->code }}').hidden = false;
                    document.getElementById('manuel_url_{{ $pro->code }}').hidden = true;
                    pathSelect.value = 'specific_page';
                    document.getElementById('specific_section_page_{{ $pro->code }}').hidden = false;
                    document.getElementById('specific_section_blog_{{ $pro->code }}').hidden = true;
                    document.getElementById('specific_section_supplier_{{ $pro->code }}').hidden = true;
                } else if (
                    {{ isset($pro) && count($blogs->where('short_name', str_replace('/p/', '', $pro->optional_3))) >= 1 ? 'true' : 'false' }}
                ) {
                    document.getElementById('specific_section_{{ $pro->code }}').hidden = false;
                    document.getElementById('manuel_url_{{ $pro->code }}').hidden = true;
                    pathSelect.value = 'specific_blog';
                    document.getElementById('specific_section_pag_{{ $pro->code }}').hidden = true;
                    document.getElementById('specific_section_blog_{{ $pro->code }}').hidden = false;
                    document.getElementById('specific_section_supplier_{{ $pro->code }}').hidden = true;
                } else if (
                    {{ isset($pro) && count($suppliers->where('short_name', str_replace('/p/', '', $pro->optional_3))) >= 1 ? 'true' : 'false' }}
                ) {
                    document.getElementById('specific_section_{{ $pro->code }}').hidden = false;
                    document.getElementById('manuel_url_{{ $pro->code }}').hidden = true;
                    pathSelect.value = 'specific_supplier';
                    document.getElementById('specific_section_page_{{ $pro->code }}').hidden = true;
                    document.getElementById('specific_section_blog_{{ $pro->code }}').hidden = true;
                    document.getElementById('specific_section_supplier_{{ $pro->code }}').hidden = false;
                } else {
                    pathSelect.value = 'manuel_input';
                    document.getElementById('specific_section_{{ $pro->code }}').hidden = true;
                    document.getElementById('manuel_url_{{ $pro->code }}').hidden = false;
                }
            @endforeach

        });

        function selectURL(code, value) {
            const path_type = document.getElementById('path_' + code).value;
            //const manuel_input = document.getElementById('manuel_input_' + code);
            //manuel_input.hidden = false;
            if (path_type === 'contact' ||
                path_type === 'blogs' ||
                path_type === 'products' ||
                path_type === 'gallery'
            ) {
                if (path_type === 'contact') {
                    document.getElementById('optional_3_' + code).value = 'contact';
                } else if (path_type === 'blogs') {
                    document.getElementById('optional_3_' + code).value = 'blogs';
                } else if (path_type === 'products') {
                    document.getElementById('optional_3_' + code).value = 'products';
                } else if (path_type === 'gallery') {
                    document.getElementById('optional_3_' + code).value = 'gallery';
                }
            } else if (path_type === 'specific_page' ||
                path_type === 'specific_blog' ||
                path_type === 'specific_supplier' ||
                path_type === 'manuel_input') {
                document.getElementById('optional_3_' + code).value = value;
            } else {
                document.getElementById('optional_3_' + code).value = '#';
            }
        }

        function syncInputs(input1_val, input2_val) {
            var input1 = document.getElementById(input1_val);
            var input2 = document.getElementById(input2_val);

            input2.value = input1.value;
        }
    </script>

    <script>
        function selectDifferentPage(code, checkbox) {
            if (checkbox.checked) {
                document.getElementById('optional_4_' + code).value = '1';
            } else {
                document.getElementById('optional_4_' + code).value = '0';
            }
        }
    </script>
@endsection
