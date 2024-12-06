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
                        <a class="btn btn-primary mb-3" style="float: right;" href="#" onclick="addNewIBAN()">
                            <i class="mdi mdi-plus-circle-outline"></i> {{ lang_db('New') }}
                        </a>
                    </div>
                    <form action="{{ route('admin_page', ['params' => 'other/iban']) }}" method="POST">
                        @csrf
                        <div id="IBANDivId">
                            @foreach ($iban_informations as $item)
                                <div class="col-lg-8 mt-3">
                                    <input type="hidden" id="code_{{ $count }}" class="iban_codes" name="codes[]"
                                        value="{{ $item->code ?? '' }}" required readonly>

                                    <input type="hidden" id="key_{{ $count }}" class="iban_keys" name="keys[]"
                                        value="{{ $item->key ?? '' }}" required readonly>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="value_{{ $count }}">{{ lang_db('IBAN') }}</label>
                                            <input type="text" id="value_{{ $count }}" name="values[]"
                                                class="form-control iban_values" value="{{ $item->value ?? '' }}">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="optional_1_{{ $count }}">{{ lang_db('Bank Name') }}</label>
                                            <input type="text" id="optional_1_{{ $count }}" name="optional_1[]"
                                                class="form-control iban_optionals_1"
                                                value="{{ $item->optional_1 ?? '' }}">
                                        </div>
                                        <div class="col-lg-3">
                                            <label
                                                for="optional_2_{{ $count }}">{{ lang_db('Account owner') }}</label>
                                            <input type="text" id="optional_2_{{ $count }}" name="optional_2[]"
                                                class="form-control iban_optionals_2"
                                                value="{{ $item->optional_2 ?? '' }}">
                                        </div>
                                        <div class="col-lg-2 mt-4">
                                            <a href="{{ route('admin_page', ['params' => 'other/iban/delete']) }}?code={{ $item->code }}"
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

        function addNewIBAN() {
            var html = `
                <div class="col-lg-8 mt-3" id="iban_${count}">
                    <input type="hidden" id="code_${count}" class="iban_codes" name="codes[]" value="-1" required readonly>
                    <input type="hidden" id="key_${count}" class="iban_keys" name="keys[]" value="iban_informations" required readonly>
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="value_${count}">{{ lang_db('IBAN') }}</label>
                            <input type="text" id="value_${count}" name="values[]"
                                class="form-control iban_values" value="">
                        </div>
                        <div class="col-lg-3">
                            <label for="optional_1_${count}">{{ lang_db('Bank Name') }}</label>
                            <input type="text" id="optional_1_${count}" name="optional_1[]"
                                class="form-control iban_optionals_1" value="">
                        </div>
                         <div class="col-lg-3">
                            <label for="optional_2_${count}">{{ lang_db('Account owner') }}</label>
                            <input type="text" id="optional_2_${count}" name="optional_2[]"
                                class="form-control iban_optionals_2" value="">
                        </div>
                        <div class="col-lg-2 mt-4">
                            <button type="button" class="btn btn-danger" onclick="cancelNewIBAN(${count})">{{ lang_db('Cancel') }}</button>
                        </div>
                    </div>
                </div>`

            count++;

            var data = getOldValue();

            document.getElementById('IBANDivId').innerHTML += html;

            setOldValue(data);
        }

        function getOldValue() {
            var iban_codes = document.getElementsByClassName('iban_codes');
            var iban_keys = document.getElementsByClassName('iban_keys');
            var iban_values = document.getElementsByClassName('iban_values');
            var iban_optionals_1 = document.getElementsByClassName('iban_optionals_1');
            var iban_optionals_2 = document.getElementsByClassName('iban_optionals_2');

            var iban_codes_values = [];
            var iban_keys_values = [];
            var iban_values_values = [];
            var iban_optionals_1_values = [];
            var iban_optionals_2_values = [];

            for (let i = 0; i < iban_codes.length; i++) {
                if (iban_codes[i]) iban_codes_values.push([iban_codes[i].id, iban_codes[i].value]);
                if (iban_keys[i]) iban_keys_values.push([iban_keys[i].id, iban_keys[i].value]);
                if (iban_values[i]) iban_values_values.push([iban_values[i].id, iban_values[i].value]);
                if (iban_optionals_1[i]) iban_optionals_1_values.push([iban_optionals_1[i].id, iban_optionals_1[i].value]);
                if (iban_optionals_2[i]) iban_optionals_2_values.push([iban_optionals_2[i].id, iban_optionals_2[i].value]);
            }
            return [iban_codes_values, iban_keys_values, iban_values_values, iban_optionals_1_values,
                iban_optionals_2_values
            ];
        }

        function setOldValue(data) {
            if (data.length < 5) return false;

            var iban_codes_values = data[0];
            var iban_keys_values = data[1];
            var iban_values_values = data[2];
            var iban_optionals_1_values = data[3];
            var iban_optionals_2_values = data[4];

            for (let i = 0; i < iban_codes_values.length; i++) {
                if (
                    iban_codes_values[i] &&
                    iban_codes_values[i].length >= 2 &&
                    document.getElementById(iban_codes_values[i][0])
                ) {
                    document.getElementById(iban_codes_values[i][0]).value = iban_codes_values[i][1];
                }


                if (
                    iban_keys_values[i] &&
                    iban_keys_values[i].length >= 2 &&
                    document.getElementById(iban_keys_values[i][0])) {

                    document.getElementById(iban_keys_values[i][0]).value = iban_keys_values[i][1];
                }


                if (
                    iban_values_values[i] &&
                    iban_values_values[i].length >= 2 &&
                    document.getElementById(iban_values_values[i][0])
                ) {
                    document.getElementById(iban_values_values[i][0]).value = iban_values_values[i][1];
                }

                if (
                    iban_optionals_1_values[i] &&
                    iban_optionals_1_values[i].length >= 2 &&
                    document.getElementById(iban_optionals_1_values[i][0])
                ) {
                    document.getElementById(iban_optionals_1_values[i][0]).value = iban_optionals_1_values[i][1];
                }

                if (
                    iban_optionals_2_values[i] &&
                    iban_optionals_2_values[i].length >= 2 &&
                    document.getElementById(iban_optionals_2_values[i][0])
                ) {
                    document.getElementById(iban_optionals_2_values[i][0]).value = iban_optionals_2_values[i][1];
                }

            }

            return true;

        }

        function cancelNewIBAN(count) {
            var data = getOldValue();
            if (document.getElementById('iban_' + count)) document.getElementById('iban_' + count).remove();
            setOldValue(data);
        }

        $(document).ready(function() {
            count = {{ $count }};
        });
    </script>
@endsection
