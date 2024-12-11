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
                        <a class="btn btn-primary mb-3" style="float: right;" href="#" onclick="addNewPhone()">
                            <i class="mdi mdi-plus-circle-outline"></i> {{ lang_db('New') }}
                        </a>
                    </div>
                    <form action="{{ route('admin_page', ['params' => 'settings/contact/phone']) }}" method="POST">
                        @csrf
                        <div id="PhoneDivId">
                            @foreach ($phones as $item)
                                <div class="col-lg-8 mt-3">
                                    <input type="hidden" id="code_{{ $count }}" class="phone_codes" name="codes[]"
                                        value="{{ $item->code ?? '' }}" required readonly>

                                    <input type="hidden" id="key_{{ $count }}" class="phone_keys" name="keys[]"
                                        value="{{ $item->key ?? '' }}" required readonly>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label
                                                for="value_{{ $count }}">{{ lang_db('Phone Number Name') }}</label>
                                            <input type="text" id="value_{{ $count }}" name="values[]"
                                                class="form-control phone_values" value="{{ $item->value ?? '' }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label
                                                for="optional_1_{{ $count }}">{{ lang_db('Phone Number') }}</label>
                                            <input type="text" id="optional_1_{{ $count }}" name="optional_1[]"
                                                class="form-control phone_optionals_1"
                                                value="{{ $item->optional_1 ?? '' }}">
                                        </div>
                                        <div class="col-lg-2 mt-4">
                                            <a href="{{ route('admin_page', ['params' => 'settings/contact/phone/delete']) }}?code={{ $item->code }}"
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

        function addNewPhone() {
            var html = `
                <div class="col-lg-8 mt-3" id="phone_${count}">
                    <input type="hidden" id="code_${count}" class="phone_codes" name="codes[]" value="-1" required readonly>
                    <input type="hidden" id="key_${count}" class="phone_keys" name="keys[]" value="phones" required readonly>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="value_${count}">{{ lang_db('Phone Number Name') }}</label>
                            <input type="text" id="value_${count}" name="values[]"
                                class="form-control phone_values" value="">
                        </div>
                        <div class="col-lg-4">
                            <label for="optional_1_${count}">{{ lang_db('Phone Number') }}</label>
                            <input type="text" id="optional_1_${count}" name="optional_1[]"
                                class="form-control phone_optionals_1" value="">
                        </div>
                        <div class="col-lg-2 mt-4">
                            <button type="button" class="btn btn-danger" onclick="cancelNewPhone(${count})">{{ lang_db('Cancel') }}</button>
                        </div>
                    </div>
                </div>`

            count++;

            var data = getOldValue();

            document.getElementById('PhoneDivId').innerHTML += html;

            setOldValue(data);
        }

        function getOldValue() {
            var phone_codes = document.getElementsByClassName('phone_codes');
            var phone_keys = document.getElementsByClassName('phone_keys');
            var phone_values = document.getElementsByClassName('phone_values');
            var phone_optionals_1 = document.getElementsByClassName('phone_optionals_1');

            var phone_codes_values = [];
            var phone_keys_values = [];
            var phone_values_values = [];
            var phone_optionals_1_values = [];

            for (let i = 0; i < phone_codes.length; i++) {
                if (phone_codes[i]) phone_codes_values.push([phone_codes[i].id, phone_codes[i].value]);
                if (phone_keys[i]) phone_keys_values.push([phone_keys[i].id, phone_keys[i].value]);
                if (phone_values[i]) phone_values_values.push([phone_values[i].id, phone_values[i].value]);
                if (phone_optionals_1[i]) phone_optionals_1_values.push([phone_optionals_1[i].id, phone_optionals_1[i]
                    .value
                ]);
            }
            return [phone_codes_values, phone_keys_values, phone_values_values, phone_optionals_1_values];
        }

        function setOldValue(data) {
            if (data.length < 4) return false;

            var phone_codes_values = data[0];
            var phone_keys_values = data[1];
            var phone_values_values = data[2];
            var phone_optionals_1_values = data[3];

            for (let i = 0; i < phone_codes_values.length; i++) {
                if (
                    phone_codes_values[i] &&
                    phone_codes_values[i].length >= 2 &&
                    document.getElementById(phone_codes_values[i][0])
                ) {
                    document.getElementById(phone_codes_values[i][0]).value = phone_codes_values[i][1];
                }


                if (
                    phone_keys_values[i] &&
                    phone_keys_values[i].length >= 2 &&
                    document.getElementById(phone_keys_values[i][0])) {

                    document.getElementById(phone_keys_values[i][0]).value = phone_keys_values[i][1];
                }


                if (
                    phone_values_values[i] &&
                    phone_values_values[i].length >= 2 &&
                    document.getElementById(phone_values_values[i][0])
                ) {
                    document.getElementById(phone_values_values[i][0]).value = phone_values_values[i][1];
                }

                if (
                    phone_optionals_1_values[i] &&
                    phone_optionals_1_values[i].length >= 2 &&
                    document.getElementById(phone_optionals_1_values[i][0])
                ) {
                    document.getElementById(phone_optionals_1_values[i][0]).value = phone_optionals_1_values[i][1];
                }

            }

            return true;

        }

        function cancelNewPhone(count) {
            var data = getOldValue();
            if (document.getElementById('phone_' + count)) document.getElementById('phone_' + count).remove();
            setOldValue(data);
        }

        $(document).ready(function() {
            count = {{ $count }};
        });
    </script>
@endsection
