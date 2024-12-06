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
                        <a class="btn btn-primary mb-3" style="float: right;" href="#" onclick="addNewEmail()">
                            <i class="mdi mdi-plus-circle-outline"></i> {{ lang_db('New') }}
                        </a>
                    </div>
                    <form action="{{ route('admin_page', ['params' => 'settings/contact/email']) }}" method="POST">
                        @csrf
                        <div id="EmailDivId">
                            @foreach ($emails as $item)
                                <div class="col-lg-8 mt-3">
                                    <input type="hidden" id="code_{{ $count }}" class="email_codes" name="codes[]"
                                        value="{{ $item->code ?? '' }}" required readonly>

                                    <input type="hidden" id="key_{{ $count }}" class="email_keys" name="keys[]"
                                        value="{{ $item->key ?? '' }}" required readonly>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label
                                                for="value_{{ $count }}">{{ lang_db('E-mail Address Name') }}</label>
                                            <input type="text" id="value_{{ $count }}" name="values[]"
                                                class="form-control email_values" value="{{ $item->value ?? '' }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label
                                                for="optional_1_{{ $count }}">{{ lang_db('E-mail Address') }}</label>
                                            <input type="text" id="optional_1_{{ $count }}" name="optional_1[]"
                                                class="form-control email_optionals_1"
                                                value="{{ $item->optional_1 ?? '' }}">
                                        </div>
                                        <div class="col-lg-2 mt-4">
                                            <a href="{{ route('admin_page', ['params' => 'settings/contact/email/delete']) }}?code={{ $item->code }}"
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

        function addNewEmail() {
            var html = `
                <div class="col-lg-8 mt-3" id="email_${count}">
                    <input type="hidden" id="code_${count}" class="email_codes" name="codes[]" value="-1" required readonly>
                    <input type="hidden" id="key_${count}" class="email_keys" name="keys[]" value="emails" required readonly>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="value_${count}">{{ lang_db('E-mail Address Name') }}</label>
                            <input type="text" id="value_${count}" name="values[]"
                                class="form-control email_values" value="">
                        </div>
                        <div class="col-lg-4">
                            <label for="optional_1_${count}">{{ lang_db('E-mail Address') }}</label>
                            <input type="text" id="optional_1_${count}" name="optional_1[]"
                                class="form-control email_optionals_1" value="">
                        </div>
                        <div class="col-lg-2 mt-4">
                            <button type="button" class="btn btn-danger" onclick="cancelNewEmail(${count})">{{ lang_db('Cancel') }}</button>
                        </div>
                    </div>
                </div>`

            count++;

            var data = getOldValue();

            document.getElementById('EmailDivId').innerHTML += html;

            setOldValue(data);
        }

        function getOldValue() {
            var email_codes = document.getElementsByClassName('email_codes');
            var email_keys = document.getElementsByClassName('email_keys');
            var email_values = document.getElementsByClassName('email_values');
            var email_optionals_1 = document.getElementsByClassName('email_optionals_1');

            var email_codes_values = [];
            var email_keys_values = [];
            var email_values_values = [];
            var email_optionals_1_values = [];

            for (let i = 0; i < email_codes.length; i++) {
                if (email_codes[i]) email_codes_values.push([email_codes[i].id, email_codes[i].value]);
                if (email_keys[i]) email_keys_values.push([email_keys[i].id, email_keys[i].value]);
                if (email_values[i]) email_values_values.push([email_values[i].id, email_values[i].value]);
                if (email_optionals_1[i]) email_optionals_1_values.push([email_optionals_1[i].id, email_optionals_1[i]
                    .value
                ]);
            }
            return [email_codes_values, email_keys_values, email_values_values, email_optionals_1_values];
        }

        function setOldValue(data) {
            if (data.length < 4) return false;

            var email_codes_values = data[0];
            var email_keys_values = data[1];
            var email_values_values = data[2];
            var email_optionals_1_values = data[3];

            for (let i = 0; i < email_codes_values.length; i++) {
                if (
                    email_codes_values[i] &&
                    email_codes_values[i].length >= 2 &&
                    document.getElementById(email_codes_values[i][0])
                ) {
                    document.getElementById(email_codes_values[i][0]).value = email_codes_values[i][1];
                }


                if (
                    email_keys_values[i] &&
                    email_keys_values[i].length >= 2 &&
                    document.getElementById(email_keys_values[i][0])) {

                    document.getElementById(email_keys_values[i][0]).value = email_keys_values[i][1];
                }


                if (
                    email_values_values[i] &&
                    email_values_values[i].length >= 2 &&
                    document.getElementById(email_values_values[i][0])
                ) {
                    document.getElementById(email_values_values[i][0]).value = email_values_values[i][1];
                }

                if (
                    email_optionals_1_values[i] &&
                    email_optionals_1_values[i].length >= 2 &&
                    document.getElementById(email_optionals_1_values[i][0])
                ) {
                    document.getElementById(email_optionals_1_values[i][0]).value = email_optionals_1_values[i][1];
                }

            }

            return true;

        }

        function cancelNewEmail(count) {
            var data = getOldValue();
            if (document.getElementById('email_' + count)) document.getElementById('email_' + count).remove();
            setOldValue(data);
        }

        $(document).ready(function() {
            count = {{ $count }};
        });
    </script>
@endsection
