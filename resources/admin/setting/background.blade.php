@extends('admin.layouts.main')
@section('admin_index_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_page', ['params' => 'settings/background']) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <input type="hidden" name="codes[]" value="{{ $backgroudSettings[0]->code ?? '' }}" required
                                readonly>
                            <input type="hidden" name="keys[]" value="{{ $backgroudSettings[0]->key ?? '' }}" required
                                readonly>
                            <input type="file" class="custom-file-input" id="choose_file_1" name="optional_5[]" hidden>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="backgroudSettings_video" name="values[]"
                                    class="custom-control-input" value="video"
                                    {{ $backgroudSettings[0]->value == 'video' ? 'checked' : '' }}
                                    onclick='changeBackgroudType("video")'>
                                <label class="custom-control-label"
                                    for="backgroudSettings_video">{{ lang_db('Video') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="backgroudSettings_slider" name="values[]"
                                    class="custom-control-input" value="slider"
                                    {{ $backgroudSettings[0]->value == 'slider' ? 'checked' : '' }}
                                    onclick='changeBackgroudType("slider")'>
                                <label class="custom-control-label"
                                    for="backgroudSettings_slider">{{ lang_db('Slider') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="backgroudSettings_picture" name="values[]"
                                    class="custom-control-input" value="picture"
                                    {{ $backgroudSettings[0]->value == 'picture' ? 'checked' : '' }}
                                    onclick='changeBackgroudType("picture")'>
                                <label class="custom-control-label"
                                    for="backgroudSettings_picture">{{ lang_db('Picture') }}</label>
                            </div>
                        </div>

                        <div id="Backgrounds">
                            @foreach ($backgrouds as $item)
                                <div class="mt-5 row backgroudSettings_{{ $item->value }}" style="align-items: center"
                                    hidden>
                                    <input type="hidden" name="codes[]" value="{{ $item->code ?? '' }}" required readonly>
                                    <input type="hidden" name="keys[]" value="{{ $item->key ?? '' }}" required readonly>
                                    <input type="hidden" name="values[]" value="{{ $item->value ?? '' }}" required
                                        readonly>
                                    @if ($item->value == 'video')
                                        <div class="col-lg-5">
                                            @if (file_exists(public_path($item->optional_5)))
                                                <video width="320" height="240" controls>
                                                    <source
                                                        src="{{ $item->optional_5 ? asset($item->optional_5) : 'Not Exit' }}"
                                                        type="video/mp4">
                                                    <source src="{{ $item->optional_5 ? asset($item->optional_5) : 'Not Exit' }}"
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
                                    @else
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

        function changeBackgroudType(type) {
            var selectedType = document.getElementsByClassName('backgroudSettings_' + type);

            for (let i = 0; i < selectedType.length; i++) {
                selectedType[i].hidden = false;
            }
            document.getElementById('sliderNewButtonDiv').hidden = true;
            var video = document.getElementsByClassName('backgroudSettings_video');
            var slider = document.getElementsByClassName('backgroudSettings_slider');
            var picture = document.getElementsByClassName('backgroudSettings_picture');

            if (type == 'video') {
                for (let i = 0; i < slider.length; i++) {
                    slider[i].hidden = true;
                }
                for (let i = 0; i < picture.length; i++) {
                    picture[i].hidden = true;
                }
            } else if (type == 'slider') {
                document.getElementById('sliderNewButtonDiv').hidden = false;
                for (let i = 0; i < video.length; i++) {
                    video[i].hidden = true;
                }
                for (let i = 0; i < picture.length; i++) {
                    picture[i].hidden = true;
                }
            } else if (type == 'picture') {

                for (let i = 0; i < video.length; i++) {
                    video[i].hidden = true;
                }
                for (let i = 0; i < slider.length; i++) {
                    slider[i].hidden = true;
                }
            }
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
            changeBackgroudType('{{ $backgroudSettings[0]->value }}');
        })
    </script>
@endsection
