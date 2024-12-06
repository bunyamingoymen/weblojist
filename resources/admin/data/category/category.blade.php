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
                        <a class="btn btn-primary mb-3" style="float: right;" href="#" onclick="addNewCategory()">
                            <i class="mdi mdi-plus-circle-outline"></i> {{ lang_db('New') }}
                        </a>
                    </div>
                    <form action="{{ route('admin_page', ['params' => 'category']) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div id="CategoryDivId">
                            @foreach ($categories as $item)
                                <div class="col-lg-8 mt-3">
                                    <input type="hidden" id="code_{{ $count }}" class="category_codes"
                                        name="codes[]" value="{{ $item->code ?? '' }}" required readonly>

                                    <input type="hidden" id="key_{{ $count }}" class="category_keys" name="keys[]"
                                        value="{{ $item->key ?? '' }}" required readonly>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="value_{{ $count }}">{{ lang_db('Category Name') }}</label>
                                            <input type="text" id="value_{{ $count }}" name="values[]"
                                                class="form-control category_values" value="{{ $item->value ?? '' }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label
                                                for="optional_1_{{ $count }}">{{ lang_db('Category Type') }}</label>
                                            <select name="optional_1[]" id="optional_1_{{ $count }}"
                                                class="form-control category_optionals_1">
                                                @foreach ($category_types as $type)
                                                    <option value="{{ $type->value }}"
                                                        {{ $item->optional_1 == $type->value ? 'selected' : '' }}>
                                                        {{ lang_db($type->value) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2 mt-4">
                                            <a href="{{ route('admin_page', ['params' => 'category/delete']) }}?code={{ $item->code }}"
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

        function addNewCategory() {
            var html = `
                <div class="col-lg-8 mt-3" id="category_${count}">
                    <input type="hidden" id="code_${count}" class="category_codes" name="codes[]" value="-1" required readonly>
                    <input type="hidden" id="key_${count}" class="category_keys" name="keys[]" value="categories" required readonly>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="value_${count}">{{ lang_db('Category Name') }}</label>
                            <input type="text" id="value_${count}" name="values[]"
                                class="form-control category_values" value="">
                        </div>
                        <div class="col-lg-4">
                            <label
                                for="optional_1_${count}">{{ lang_db('Category Type') }}</label>
                            <select name="optional_1[]" id="optional_1_${count}" class="form-control category_optionals_1">
                                @foreach ($category_types as $type)
                                    <option value="{{ $type->value }}">
                                        {{ $type->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 mt-4">
                            <button type="button" class="btn btn-danger" onclick="cancelNewCategory(${count})">{{ lang_db('Cancel') }}</button>
                        </div>
                    </div>
                </div>`

            count++;

            var data = getOldValue();

            document.getElementById('CategoryDivId').innerHTML += html;

            setOldValue(data);
        }

        function getOldValue() {
            var category_codes = document.getElementsByClassName('category_codes');
            var category_keys = document.getElementsByClassName('category_keys');
            var category_values = document.getElementsByClassName('category_values');
            var category_optionals_1 = document.getElementsByClassName('category_optionals_1');

            var category_codes_values = [];
            var category_keys_values = [];
            var category_values_values = [];
            var category_optionals_1_values = [];

            for (let i = 0; i < category_codes.length; i++) {
                if (category_codes[i]) category_codes_values.push([category_codes[i].id, category_codes[i].value]);
                if (category_keys[i]) category_keys_values.push([category_keys[i].id, category_keys[i].value]);
                if (category_values[i]) category_values_values.push([category_values[i].id, category_values[i].value]);
                if (category_optionals_1[i]) category_optionals_1_values.push([category_optionals_1[i].id,
                    category_optionals_1[i]
                    .value
                ]);
            }
            return [category_codes_values, category_keys_values, category_values_values, category_optionals_1_values];
        }

        function setOldValue(data) {
            if (data.length < 4) return false;

            var category_codes_values = data[0];
            var category_keys_values = data[1];
            var category_values_values = data[2];
            var category_optionals_1_values = data[3];

            for (let i = 0; i < category_codes_values.length; i++) {
                if (
                    category_codes_values[i] &&
                    category_codes_values[i].length >= 2 &&
                    document.getElementById(category_codes_values[i][0])
                ) {
                    document.getElementById(category_codes_values[i][0]).value = category_codes_values[i][1];
                }


                if (
                    category_keys_values[i] &&
                    category_keys_values[i].length >= 2 &&
                    document.getElementById(category_keys_values[i][0])) {

                    document.getElementById(category_keys_values[i][0]).value = category_keys_values[i][1];
                }


                if (
                    category_values_values[i] &&
                    category_values_values[i].length >= 2 &&
                    document.getElementById(category_values_values[i][0])
                ) {
                    document.getElementById(category_values_values[i][0]).value = category_values_values[i][1];
                }

                if (
                    category_optionals_1_values[i] &&
                    category_optionals_1_values[i].length >= 2 &&
                    document.getElementById(category_optionals_1_values[i][0])
                ) {
                    document.getElementById(category_optionals_1_values[i][0]).value = category_optionals_1_values[i][1];
                }

            }

            return true;

        }

        function cancelNewCategory(count) {
            var data = getOldValue();
            if (document.getElementById('category_' + count)) document.getElementById('category_' + count).remove();
            setOldValue(data);
        }

        $(document).ready(function() {
            count = {{ $count }};
        });
    </script>
@endsection
