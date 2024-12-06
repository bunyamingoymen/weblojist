@extends('admin.layouts.main')
@section('admin_index_body')
    @php
        $count = 1;
    @endphp
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12" style="display: inline-block;">
                        <a class="btn btn-primary mb-3" style="float: right;" href="#" onclick="addNewCargo()">
                            <i class="mdi mdi-plus-circle-outline"></i> {{ lang_db('New') }}
                        </a>
                    </div>
                    <form action="{{ route('admin_page', ['params' => 'other/cargoCompanies']) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div id="CargoDivId">
                            @foreach ($cargo_companies as $item)
                                <div class="col-lg-8 mt-3">
                                    <input type="hidden" id="code_{{ $count }}" class="cargo_codes" name="codes[]"
                                        value="{{ $item->code ?? '' }}" required readonly>

                                    <input type="hidden" id="key_{{ $count }}" class="cargo_keys" name="keys[]"
                                        value="{{ $item->key ?? '' }}" required readonly>

                                    <div class="row">
                                        @if (file_exists(public_path($item->optional_5)))
                                            <div class="col-lg-2 mt-4">
                                                <img src="{{ $item->optional_5 ? asset($item->optional_5) : 'Not Exit' }}"
                                                    alt="{{ $item->value ?? '' }}"
                                                    style="max-height: 50px; max-width: 50px;">
                                            </div>
                                        @endif
                                        <div class="col-lg-4">
                                            <label
                                                for="value_{{ $count }}">{{ lang_db('Cargo Company Name') }}</label>
                                            <input type="text" id="value_{{ $count }}" name="values[]"
                                                class="form-control cargo_values" value="{{ $item->value ?? '' }}">
                                        </div>
                                        <div class="col-lg-4 mt-4">
                                            <input type="file" id="optional_5_{{ $count }}"
                                                class="custom-file-input cargo_optionals_5" name="optional_5[]">
                                            <label class="custom-file-label" for="optional_5_{{ $item->code }}">
                                                {{ lang_db('Choose file...') }}
                                            </label>
                                        </div>
                                        <div class="col-lg-2 mt-4">
                                            <a href="{{ route('admin_page', ['params' => 'other/cargoCompanies/delete']) }}?code={{ $item->code }}"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $count++;
                                @endphp
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
        var count = 0;

        function addNewCargo() {
            var html = `
                <div class="col-lg-8 mt-3" id="cargo_${count}">
                    <input type="hidden" id="code_${count}" class="cargo_codes" name="codes[]" value="-1" required readonly>
                    <input type="hidden" id="key_${count}" class="cargo_keys" name="keys[]" value="cargo_companies" required readonly>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="value_${count}">{{ lang_db('Cargo Company Name') }}</label>
                            <input type="text" id="value_${count}" name="values[]"
                                class="form-control cargo_values" value="">
                        </div>
                        <div class="col-lg-4 mt-4">
                            <label class="custom-file-label" for="optional_5_${count}">
                                {{ lang_db('Choose file...') }}
                            </label>
                            <input type="file" id="optional_5_${count}"
                                class="custom-file-input cargo_optionals_5" name="optional_5[]">
                                <label class="custom-file-label" for="optional_5_${count}">
                                    {{ lang_db('Choose file...') }}
                                </label>
                        </div>
                        <div class="col-lg-2 mt-4">
                            <button type="button" class="btn btn-danger" onclick="cancelNewCargo(${count})">{{ lang_db('Cancel') }}</button>
                        </div>
                    </div>
                </div>`

            count++;

            var data = getOldValue();

            document.getElementById('CargoDivId').innerHTML += html;

            setOldValue(data);
        }

        function getOldValue() {
            var cargo_codes = document.getElementsByClassName('cargo_codes');
            var cargo_keys = document.getElementsByClassName('cargo_keys');
            var cargo_values = document.getElementsByClassName('cargo_values');
            var cargo_optionals_5 = document.getElementsByClassName('cargo_optionals_5');

            var cargo_codes_values = [];
            var cargo_keys_values = [];
            var cargo_values_values = [];
            var cargo_optionals_5_values = [];

            for (let i = 0; i < cargo_codes.length; i++) {
                if (cargo_codes[i]) cargo_codes_values.push([cargo_codes[i].id, cargo_codes[i].value]);
                if (cargo_keys[i]) cargo_keys_values.push([cargo_keys[i].id, cargo_keys[i].value]);
                if (cargo_values[i]) cargo_values_values.push([cargo_values[i].id, cargo_values[i].value]);
                if (cargo_optionals_5[i]) cargo_optionals_5_values.push([cargo_optionals_5[i].id, cargo_optionals_5[i]
                    .value
                ]);
            }
            return [cargo_codes_values, cargo_keys_values, cargo_values_values, cargo_optionals_5_values];
        }

        function setOldValue(data) {
            if (data.length < 4) return false;

            var cargo_codes_values = data[0];
            var cargo_keys_values = data[1];
            var cargo_values_values = data[2];
            var cargo_optionals_5_values = data[3];

            for (let i = 0; i < cargo_codes_values.length; i++) {
                if (
                    cargo_codes_values[i] &&
                    cargo_codes_values[i].length >= 2 &&
                    document.getElementById(cargo_codes_values[i][0])
                ) {
                    document.getElementById(cargo_codes_values[i][0]).value = cargo_codes_values[i][1];
                }


                if (
                    cargo_keys_values[i] &&
                    cargo_keys_values[i].length >= 2 &&
                    document.getElementById(cargo_keys_values[i][0])) {

                    document.getElementById(cargo_keys_values[i][0]).value = cargo_keys_values[i][1];
                }


                if (
                    cargo_values_values[i] &&
                    cargo_values_values[i].length >= 2 &&
                    document.getElementById(cargo_values_values[i][0])
                ) {
                    document.getElementById(cargo_values_values[i][0]).value = cargo_values_values[i][1];
                }

                if (
                    cargo_optionals_5_values[i] &&
                    cargo_optionals_5_values[i].length >= 2 &&
                    document.getElementById(cargo_optionals_5_values[i][0])
                ) {
                    document.getElementById(cargo_optionals_5_values[i][0]).value = cargo_optionals_5_values[i][1];
                }

            }

            return true;

        }

        function cancelNewCargo(count) {
            var data = getOldValue();
            if (document.getElementById('cargo_' + count)) document.getElementById('cargo_' + count).remove();
            setOldValue(data);
        }

        $(document).ready(function() {
            count = {{ $count }};
        });
    </script>
@endsection
