@extends('admin.layouts.main')
@section('admin_index_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_page', ['params' => 'settings/themeSettings']) }}" method="POST">
                        @csrf

                        <div class="col-lg-8">
                            <label for="header_theme">{{ lang_db('Header Theme') }}</label>
                            <input type="hidden" name="codes[]" value="{{ $header_theme[0]->code ?? -1 }}" required readonly>
                            <input type="hidden" name="keys[]" value="{{ $header_theme[0]->key ?? 'header_theme' }}"
                                required readonly>
                            <select name="values[]" id="header_theme" class="form-control">
                                <option value="dark" {{ $header_theme[0]->value == 'dark' ? 'selected' : '' }}>
                                    {{ lang_db('Dark') }}</option>
                                <option value="white" {{ $header_theme[0]->value == 'white' ? 'selected' : '' }}>
                                    {{ lang_db('White') }}</option>
                            </select>
                        </div>
                        <div class="col-lg-8 mt-3">
                            <label for="sub_title_theme">{{ lang_db('Sub Title Theme') }}</label>
                            <input type="hidden" name="codes[]" value="{{ $sub_title_theme[0]->code ?? -1 }}" required
                                readonly>
                            <input type="hidden" name="keys[]"
                                value="{{ $sub_title_theme[0]->key ?? 'sub_title_theme' }}" required readonly>
                            <select name="values[]" id="sub_title_theme" class="form-control">
                                <option value="pink" {{ $sub_title_theme[0]->value == 'pink' ? 'selected' : '' }}>
                                    {{ lang_db('Pink') }}</option>
                                <option value="blue" {{ $sub_title_theme[0]->value == 'blue' ? 'selected' : '' }}>
                                    {{ lang_db('Blue') }}</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i>
                            {{ lang_db('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
