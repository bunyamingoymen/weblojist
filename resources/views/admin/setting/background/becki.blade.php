@php
    $active_theme_type = getActiveTheme();
    $backgroudSettings = App\Models\Main\KeyValue::Where('delete', 0)
        ->where('key', 'backgroudSettings')
        ->where('optional_4', $active_theme_type)
        ->first();

    $backgrouds = App\Models\Main\KeyValue::Where('delete', 0)
        ->where('key', 'backgrouds')
        ->where('optional_4', $active_theme_type)
        ->get();

    $backgroudTypes = App\Models\Main\KeyValue::Where('delete', 0)
        ->where('key', 'backgroudTypes')
        ->where('optional_4', $active_theme_type)
        ->get();
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
                        <input type="hidden" name="optional_4[]" value="{{ $backgroudSettings->optional_4 ?? '' }}"
                            required readonly>
                        <input type="file" class="custom-file-input" id="choose_file_1" name="optional_5[]" hidden>

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
                    </div>

                    <div id="Backgrounds">
                        @foreach ($backgrouds as $item)
                            <div class="mt-5 row backgroudSettings_{{ $item->value }}" style="align-items: center"
                                hidden>
                                <input type="hidden" name="codes[]" value="{{ $item->code ?? '' }}" required readonly>
                                <input type="hidden" name="keys[]" value="{{ $item->key ?? '' }}" required readonly>
                                <input type="hidden" name="values[]" value="{{ $item->value ?? '' }}" required
                                    readonly>
                                <input type="hidden" name="optional_4[]" value="{{ $item->optional_4 ?? '' }}"
                                    required readonly>
                                @if ($item->value == 'video')
                                    <div class="col-lg-5">
                                        @if (file_exists(public_path($item->optional_5)))
                                            <video width="320" height="240" controls>
                                                <source
                                                    src="{{ $item->optional_5 ? asset($item->optional_5) : 'Not Exit' }}"
                                                    type="video/mp4">
                                                <source
                                                    src="{{ $item->optional_5 ? asset($item->optional_5) : 'Not Exit' }}"
                                                    type="video/mov">
                                                {{ lang_db('Your browser does not support the video tag') }}
                                            </video>
                                        @else
                                            <p>Dosya Bulunamadı</p>
                                        @endif
                                    </div>
                                    <div class="custom-file col-lg-5">
                                        <input type="file" class="custom-file-input" id="videoUpload"
                                            name="optional_5[]" accept=".mp4 .mov">
                                        <label class="custom-file-label" for="choose_file_{{ $item->code }}">
                                            {{ lang_db('Choose file...') }}
                                        </label>
                                    </div>
                                @elseif ($item->value == 'slider')
                                    <div class="col-lg-5">
                                        @if (file_exists(public_path($item->optional_5)))
                                            <img src="{{ $item->optional_5 ? asset($item->optional_5) : 'Not Exit' }}"
                                                alt="{{ $item->value ?? '' }}" style="height: 100px;">
                                        @else
                                            <p>{{ lang_db('Not found file') }}</p>
                                        @endif
                                    </div>
                                    <div class="custom-file col-lg-5">
                                        <input type="file" class="custom-file-input"
                                            id="choose_file_{{ $item->code }}" name="optional_5[]">
                                        <label class="custom-file-label" for="choose_file_{{ $item->code }}">
                                            {{ lang_db('Choose file...') }}
                                        </label>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="{{ route('admin_page', ['params' => 'settings/background/delete']) }}?code={{ $item->code }}"
                                            class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                @elseif($item->value == 'picture')
                                    <div class="col-lg-5">
                                        @if (file_exists(public_path($item->optional_5)))
                                            <img src="{{ $item->optional_5 ? asset($item->optional_5) : 'Not Exit' }}"
                                                alt="{{ $item->value ?? '' }}" style="height: 100px;">
                                        @else
                                            <p>Dosya Bulunamadı</p>
                                        @endif
                                    </div>
                                    <div class="custom-file col-lg-5">
                                        <input type="file" class="custom-file-input"
                                            id="choose_file_{{ $item->code }}" name="optional_5[]">
                                        <label class="custom-file-label" for="choose_file_{{ $item->code }}">
                                            {{ lang_db('Choose file...') }}
                                        </label>
                                    </div>
                                @elseif($item->value == 'creative')
                                    <div class="col-lg-5">
                                        @if (file_exists(public_path($item->optional_5)))
                                            <img src="{{ $item->optional_5 ? asset($item->optional_5) : 'Not Exit' }}"
                                                alt="{{ $item->value ?? '' }}" style="height: 100px;">
                                        @else
                                            <p>Dosya Bulunamadı</p>
                                        @endif
                                    </div>
                                    <div class="custom-file col-lg-5">
                                        <input type="file" class="custom-file-input"
                                            id="choose_file_{{ $item->code }}" name="optional_5[]">
                                        <label class="custom-file-label" for="choose_file_{{ $item->code }}">
                                            {{ lang_db('Choose file...') }}
                                        </label>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div id="sliderNewButtonDiv" class="mt-5" hidden>
                        <a class="btn btn-warning mb-3" href="#" onclick="addNewSlider()">
                            <i class="mdi mdi-plus-circle-outline"></i> {{ lang_db('New') }}
                        </a>
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
    document.getElementById('videoUpload').addEventListener('change', function() {
        let file = this.files[0];

        // Dosya türünü kontrol et
        // if (file && file.type !== 'video/mp4') {
        //     alert("{{ lang_db('You can only upload .mp4 files') }}");
        //     this.value = ''; // Geçersiz dosyayı kaldır
        // }
        // Dosya boyutunu kontrol et
        if (file && file.size > 200 * 1024 * 1024) { // 5MB
            alert("{{ lang_db('The file size must not exceed 5MB') }}");
            this.value = ''; // Geçersiz dosyayı kaldır
        }
    });

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

        // slider türü için özel işlem
        document.getElementById('sliderNewButtonDiv').hidden = (type !== 'slider');
    }

    function addNewSlider() {
        var html = `<div class="mt-5 row backgroudSettings_slider" style="align-items: center">
                        <input type="hidden" name="codes[]" value="-1" required readonly>
                        <input type="hidden" name="keys[]" value="backgrouds" required readonly>
                        <input type="hidden" name="values[]" value="slider" required readonly>
                        <div class="col-lg-5">
                            <p>{{ lang_db('Choose file...') }}</p>
                        </div>
                        <div class="custom-file col-lg-5">
                            <input type="file" class="custom-file-input"
                                id="choose_file_${1}" name="optional_5[]">
                            <label class="custom-file-label" for="choose_file_${1}">
                                {{ lang_db('Choose file...') }}
                            </label>
                        </div>
                    </div>`;

        document.getElementById('Backgrounds').innerHTML += html;
        document.getElementById('sliderNewButtonDiv').hidden = true;
    }

    $(document).ready(function() {
        changeBackgroudType('{{ $backgroudSettings->value }}');
    })
</script>
