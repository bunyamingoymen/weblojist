@php
    $active_theme_type = getActiveTheme();
    $backgroudSettings = App\Models\Main\KeyValue::Where('delete', 0)
        ->where('key', 'backgroudSettings')
        ->where('optional_4', $active_theme_type)
        ->first();

    $backgrouds = App\Models\Main\KeyValue::Where('delete', 0)
        ->where('key', 'backgrouds')
        ->where('optional_2', $active_theme_type)
        ->get();

    $backgroudTypes = App\Models\Main\KeyValue::Where('delete', 0)
        ->where('key', 'backgroudTypes')
        ->where('optional_4', $active_theme_type)
        ->get();

    $blogs = App\Models\Main\Page::Where('delete', 0)->where('type', 1)->get();
    $pages = App\Models\Main\Page::Where('delete', 0)->where('type', 2)->get();
    $suppliers = App\Models\Main\Page::Where('delete', 0)->where('type', 3)->get();
@endphp
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin_page', ['params' => 'settings/background']) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div>
                        <input type="hidden" name="codes[]" value="{{ $backgroudSettings->code ?? '' }}" required
                            readonly>
                        <input type="hidden" name="keys[]" value="{{ $backgroudSettings->key ?? '' }}" required
                            readonly>

                        @foreach ($backgroudTypes as $background_type)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="backgroudSettings_{{ $background_type->value }}"
                                    name="values[]" class="custom-control-input" value="{{ $background_type->value }}"
                                    {{ $backgroudSettings->value == $background_type->value ? 'checked' : '' }}
                                    onclick='changeBackgroudType("{{ $background_type->value }}")'>
                                <label class="custom-control-label"
                                    for="backgroudSettings_{{ $background_type->value }}">{{ $background_type->optional_1 }}</label>
                            </div>
                        @endforeach

                        <input type="hidden" name="optional_1[]" value="{{ $backgroudSettings->optional_1 ?? '' }}"
                            required readonly>
                        <input type="hidden" name="optional_2[]" value="{{ $backgroudSettings->optional_2 ?? '' }}"
                            required readonly>
                        <input type="hidden" name="optional_5[]" value="{{ $backgroudSettings->optional_5 ?? '' }}"
                            required readonly>
                        <input type="hidden" name="optional_6[]" value="{{ $backgroudSettings->optional_6 ?? '' }}"
                            required readonly>
                        <input type="hidden" name="optional_7[]" value="{{ $backgroudSettings->optional_7 ?? '' }}"
                            required readonly>
                        <input type="hidden" name="optional_8[]" value="{{ $backgroudSettings->optional_8 ?? '' }}"
                            required readonly>
                        <input type="hidden" name="optional_3[]" value="{{ $backgroudSettings->optional_3 ?? '' }}"
                            required readonly>
                        <input type="hidden" name="optional_4[]" value="{{ $backgroudSettings->optional_4 ?? '' }}"
                            required readonly>

                        <div hidden>
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
                                                        name="language[{{ $item->optional_1 }}][optional_6][]"
                                                        id=""
                                                        value=""
                                                        placeholder="{{ lang_db('Enter Main Title') }}">
                                                </div>
                                                <div class="col-lg-12 mt-3">
                                                    <textarea name="language[{{ $item->optional_1 }}][optional_7][]" id="" cols="30" rows="10"
                                                        class="form-control" hidden></textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>



                    </div>

                    <div id="Backgrounds">
                        @foreach ($backgrouds as $item)
                            <div class="mt-5 mb-5 row backgroudSettings_{{ $item->value }}"
                                style="align-items: center" hidden>
                                <input type="hidden" name="codes[]" value="{{ $item->code ?? '' }}" required readonly>
                                <input type="hidden" name="keys[]" value="{{ $item->key ?? '' }}" required readonly>
                                <input type="hidden" name="values[]" value="{{ $item->value ?? '' }}" required
                                    readonly>
                                <input type="hidden" name="optional_1[]" value="{{ $item->optional_1 ?? '' }}"
                                    required readonly>
                                <input type="hidden" name="optional_2[]" value="{{ $item->optional_2 ?? '' }}"
                                    required readonly>

                                @if ($item->value == 'slider')
                                    <div class="col-lg-12 row mt-3">
                                        <div class="col-lg-1">
                                            <div class="col-lg-12 btn btn-info"
                                                style="height:100%; width:100%; display: flex; justify-content: center; align-items: center; cursor: default;">
                                                {{ $loop->iteration }}.
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="col-lg-12 mt-5">
                                                @if (file_exists(public_path($item->optional_5)))
                                                    <img src="{{ $item->optional_5 ? asset($item->optional_5) : 'Not Exit' }}"
                                                        alt="{{ $item->value ?? '' }}" style="height: 100px;">
                                                @else
                                                    <p>Dosya Bulunamadı</p>
                                                @endif
                                            </div>

                                            <div class="custom-file col-lg-12 mt-2">
                                                <input type="file" class="custom-file-input"
                                                    id="choose_file_{{ $item->code }}" name="optional_5[]">
                                                <label class="custom-file-label" for="choose_file_{{ $item->code }}">
                                                    {{ lang_db('Choose file...') }}
                                                </label>
                                            </div>

                                            <div class="col-lg-12 row mt-3">
                                                <label for="">{{ lang_db('Title') }}</label>
                                                <input type="text" class="form-control" name="optional_6[]"
                                                    id="" value="{{ $item->optional_6 ?? '' }}"
                                                    placeholder="{{ lang_db('Enter Title') }}">
                                            </div>

                                            <div class="col-lg-12 row mt-3">
                                                <label for="">{{ lang_db('Description') }}</label>
                                                <textarea name="optional_7[]" id="" class="form-control" cols="30" rows="10"
                                                    placeholder="{{ lang_db('Enter Description') }}">{{ $item->optional_7 ?? '' }}</textarea>
                                            </div>

                                            @foreach ($language as $lang)
                                                @if ($lang->optional_2 == 'main_language')
                                                    @continue
                                                @endif

                                                <div class="col-xl-8 mt-3">
                                                    <div class="card text-white bg-primary">
                                                        <div class="card-body">
                                                            <h3 class="card-title font-size-16 mt-0 text-white">
                                                                {{ $lang->value }}
                                                            </h3>
                                                            <div class="card-text">

                                                                <div class="col-lg-12">
                                                                    <label
                                                                        for="">{{ lang_db('Title') }}</label>
                                                                    <input type="text" class="form-control"
                                                                        name="language[{{ $lang->optional_1 }}][optional_6][]"
                                                                        id=""
                                                                        value="{{ $item->optional_6 ? lang_db($item->optional_6, $type = -1, $locale = $lang->optional_1) : '' }}"
                                                                        placeholder="{{ lang_db('Enter Title') }}">
                                                                </div>
                                                                <div class="col-lg-12 mt-3">
                                                                    <label
                                                                        for="">{{ lang_db('Description') }}</label>
                                                                    <textarea name="language[{{ $lang->optional_1 }}][optional_7][]" id="" cols="30" rows="10"
                                                                        class="form-control" placeholder="{{ lang_db('Enter Description') }}">{{ $item->optional_7 ? lang_db($item->optional_7, $type = -1, $locale = $lang->optional_1) : '' }}</textarea>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="col-lg-12 row mt-2">
                                                <label for="">{{ lang_db('Date') }}</label>
                                                <input type="text" class="form-control" name="optional_8[]"
                                                    id="" value="{{ $item->optional_8 ?? '' }}"
                                                    placeholder="{{ lang_db('Enter Date') }}">
                                            </div>

                                            <div class="col-lg-12 row mt-3">
                                                <label for="path">{{ lang_db('URL') }}: </label>
                                                <select name="path" id="path_{{ $item->code }}"
                                                    class="form-control"
                                                    onchange="changePathType('{{ $item->code }}')">
                                                    <option value="#"
                                                        {{ (isset($item) && $item->optional_3 == '#') || !isset($item) ? 'selected' : '' }}>
                                                        {{ lang_db('No URL') }}</option>

                                                    <option value="contact"
                                                        {{ isset($item) && $item->optional_3 == 'contact' ? 'selected' : '' }}>
                                                        {{ lang_db('Contact') }}</option>

                                                    <option value="blogs"
                                                        {{ isset($item) && $item->optional_3 == 'blogs' ? 'selected' : '' }}>
                                                        {{ lang_db('Blogs') }}</option>

                                                    <option value="products"
                                                        {{ isset($item) && $item->optional_3 == 'products' ? 'selected' : '' }}>
                                                        {{ lang_db('Products') }}</option>

                                                    <option value="gallery"
                                                        {{ isset($item) && $item->optional_3 == 'gallery' ? 'selected' : '' }}>
                                                        {{ lang_db('Gallery') }}</option>

                                                    <option value="specific_page"
                                                        {{ isset($item) && count($pages->where('short_name', str_replace('/p/', '', $item->optional_3))) >= 1 ? 'selected' : '' }}>
                                                        {{ lang_db('A specific Page') }}</option>

                                                    <option value="specific_blog"
                                                        {{ isset($item) && count($blogs->where('short_name', str_replace('/p/', '', $item->optional_3))) >= 1 ? 'selected' : '' }}>
                                                        {{ lang_db('A specific Blog') }}</option>

                                                    <option value="specific_supplier"
                                                        {{ isset($item) && count($suppliers->where('short_name', str_replace('/p/', '', $item->optional_3))) >= 1 ? 'selected' : '' }}>
                                                        {{ lang_db('A specific Supplier') }}</option>

                                                    <option value="manuel_input" {{ isset($item) ? 'selected' : '' }}>
                                                        {{ lang_db('Manuel Input') }}</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-12 row mt-3" id="specific_section_{{ $item->code }}"
                                                hidden>
                                                <div class="col-lg-12 row mt-2"
                                                    id="specific_section_page_{{ $item->code }}" hidden>
                                                    <label for="">Bağlantı Sayfası: </label>
                                                    <select name="specific_selectbox_page_{{ $item->code }}"
                                                        id="specific_selectbox_page_{{ $item->code }}"
                                                        class="form-control"
                                                        onchange="selectURL('{{ $item->code }}', this.value)">
                                                        @foreach ($pages as $page)
                                                            <option value="/p/{{ $page->short_name }}"
                                                                {{ isset($item) && $page->short_name == str_replace('/p/', '', $item->optional_3) ? 'selected' : '' }}>
                                                                {{ lang_db($page->title) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-12 row mt-2"
                                                    id="specific_section_blog_{{ $item->code }}" hidden>
                                                    <label for="">Bağlantı Sayfası: </label>
                                                    <select name="specific_selectbox_blog_{{ $item->code }}"
                                                        id="specific_selectbox_blog_{{ $item->code }}"
                                                        class="form-control"
                                                        onchange="selectURL('{{ $item->code }}', this.value)">
                                                        @foreach ($blogs as $blog)
                                                            <option value="/p/{{ $blog->short_name }}"
                                                                {{ isset($item) && $blog->short_name == str_replace('/p/', '', $item->optional_3) ? 'selected' : '' }}>
                                                                {{ lang_db($blog->title) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-12 row mt-2"
                                                    id="specific_section_supplier_{{ $item->code }}" hidden>
                                                    <label for="">Bağlantı Sayfası: </label>
                                                    <select name="specific_selectbox_supplier_{{ $item->code }}"
                                                        id="specific_selectbox_supplier_{{ $item->code }}"
                                                        class="form-control"
                                                        onchange="selectURL('{{ $item->code }}', this.value)">
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="/p/{{ $supplier->short_name }}"
                                                                {{ isset($item) && $supplier->short_name == str_replace('/p/', '', $item->optional_3) ? 'selected' : '' }}>
                                                                {{ lang_db($supplier->title) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 row mt-3" id="manuel_url_{{ $item->code }}"
                                                hidden>
                                                <label
                                                    for="manuel_input_{{ $item->code }}">{{ lang_db('Manuel Input') }}:
                                                </label>
                                                <input type="text" class="form-control"
                                                    id="manuel_input_{{ $item->code }}" name="manuel_input[]"
                                                    oninput='syncInputs("manuel_input_{{ $item->code }}", "optional_3_{{ $item->code }}")'
                                                    value="{{ $item->optional_3 ?? '' }}">
                                            </div>

                                            <div class="col-lg-12 row mt-3" id="optional_3{{ $item->code }}"
                                                style="display: none">
                                                <label for="optional_3_{{ $item->code }}">
                                                </label>
                                                <input type="text" class="form-control"
                                                    id="optional_3_{{ $item->code }}" name="optional_3[]"
                                                    value="{{ $item->optional_3 ?? '' }}">
                                            </div>

                                            <div
                                                class="mt-3 col-lg-12 mb-5 custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="open_different_page_{{ $item->code }}"
                                                    name="open_different_page_{{ $item->code }}"
                                                    onchange="selectDifferentPage('{{ $item->code }}', this)"
                                                    {{ isset($item) && $item->optional_4 ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                    for="open_different_page_{{ $item->code }}">{{ lang_db('Open In Different Page') }}</label>
                                            </div>

                                            <div class="col-lg-12 row mt-3" id="optional_4{{ $item->code }}"
                                                style="display: none">
                                                <label for="optional_4_{{ $item->code }}">
                                                </label>
                                                <input type="text" class="form-control"
                                                    id="optional_4_{{ $item->code }}" name="optional_4[]"
                                                    value="{{ $item->optional_4 ?? '0' }}">
                                            </div>
                                        </div>
                                    </div>
                                @endif
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

<script src="{{ route('assetFile', ['folder' => 'admin/libs/jquery', 'filename' => 'jquery.min.js']) }}"></script>

<script>
    //Global fonksyion tanımlandı:
    window.changeBackgroudType = function(type) {
        //Gelen türe göre, gelen tür hariç hepsini gizli, gelen türü de gizli olmayan şekilde ayarlıyoruz.

        // Tüm arka plan türlerini tanımlıyoruz
        var allTypes = [];
        @foreach ($backgroudTypes as $background_type)
            allTypes.push('{{ $background_type->value }}')
            //Eğer yeni bir arkaplan ekleyeceksen direk buraya gelecektir db de varsa
        @endforeach

        // Gelen türü hidden=false yapıyoruz; (Görünür yapıyoruz yani)
        const selectedTypeClass = 'backgroudSettings_' + type;
        const selectedElements = document.getElementsByClassName(selectedTypeClass);
        for (let i = 0; i < selectedElements.length; i++) {
            selectedElements[i].hidden = false;
        }

        // Gelen türü listeden çıkar ve kalanları gizle
        allTypes
            .filter(bgType => bgType !== type) //bu kod gelen türün dönmemesini sağlar.
            .forEach(bgType => {
                //Gelen tür hariç bütün türleri teker teker dönüp hidden = true yapıyoruz. (Görünmez yapıyoruz yani)
                const elements = document.getElementsByClassName('backgroudSettings_' + bgType);
                for (let i = 0; i < elements.length; i++) {
                    elements[i].hidden = true;
                }
            });
    }

    $(document).ready(function() {
        changeBackgroudType('{{ $backgroudSettings->value }}');
    })
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
        @foreach ($backgrouds as $item)
            var selectedPath = "{{ $item->optional_3 ?? '#' }}";
            var pathSelect = document.getElementById('path_{{ $item->code }}');
            selectURL('{{ $item->code }}', "{{ $item->optional_3 ?? '#' }}");
            if (selectedPath === '#') {
                pathSelect.value = '#';
                document.getElementById('specific_section_{{ $item->code }}').hidden = true;
                document.getElementById('manuel_url_{{ $item->code }}').hidden = true;
            } else if (selectedPath === 'contact') {
                pathSelect.value = 'contact';
                document.getElementById('specific_section_{{ $item->code }}').hidden = true;
                document.getElementById('manuel_url_{{ $item->code }}').hidden = true;
            } else if (selectedPath === 'blogs') {
                pathSelect.value = 'blogs';
                document.getElementById('specific_section_{{ $item->code }}').hidden = true;
                document.getElementById('manuel_url_{{ $item->code }}').hidden = true;
            } else if (selectedPath === 'products') {
                pathSelect.value = 'products';
                document.getElementById('specific_section_{{ $item->code }}').hidden = true;
                document.getElementById('manuel_url_{{ $item->code }}').hidden = true;
            } else if (selectedPath === 'gallery') {
                pathSelect.value = 'gallery';
                document.getElementById('specific_section_{{ $item->code }}').hidden = true;
                document.getElementById('manuel_url_{{ $item->code }}').hidden = true;
            } else if (
                {{ isset($item) && count($pages->where('short_name', str_replace('/p/', '', $item->optional_3))) >= 1 ? 'true' : 'false' }}
            ) {
                document.getElementById('specific_section_{{ $item->code }}').hidden = false;
                document.getElementById('manuel_url_{{ $item->code }}').hidden = true;
                pathSelect.value = 'specific_page';
                document.getElementById('specific_section_page_{{ $item->code }}').hidden = false;
                document.getElementById('specific_section_blog_{{ $item->code }}').hidden = true;
                document.getElementById('specific_section_supplier_{{ $item->code }}').hidden = true;
            } else if (
                {{ isset($item) && count($blogs->where('short_name', str_replace('/p/', '', $item->optional_3))) >= 1 ? 'true' : 'false' }}
            ) {
                document.getElementById('specific_section_{{ $item->code }}').hidden = false;
                document.getElementById('manuel_url_{{ $item->code }}').hidden = true;
                pathSelect.value = 'specific_blog';
                document.getElementById('specific_section_pag_{{ $item->code }}').hidden = true;
                document.getElementById('specific_section_blog_{{ $item->code }}').hidden = false;
                document.getElementById('specific_section_supplier_{{ $item->code }}').hidden = true;
            } else if (
                {{ isset($item) && count($suppliers->where('short_name', str_replace('/p/', '', $item->optional_3))) >= 1 ? 'true' : 'false' }}
            ) {
                document.getElementById('specific_section_{{ $item->code }}').hidden = false;
                document.getElementById('manuel_url_{{ $item->code }}').hidden = true;
                pathSelect.value = 'specific_supplier';
                document.getElementById('specific_section_page_{{ $item->code }}').hidden = true;
                document.getElementById('specific_section_blog_{{ $item->code }}').hidden = true;
                document.getElementById('specific_section_supplier_{{ $item->code }}').hidden = false;
            } else {
                pathSelect.value = 'manuel_input';
                document.getElementById('specific_section_{{ $item->code }}').hidden = true;
                document.getElementById('manuel_url_{{ $item->code }}').hidden = false;
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
