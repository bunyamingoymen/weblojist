@extends('admin.layouts.main')
@section('admin_index_body')
    @php
        $active_theme_type = getActiveTheme();
    @endphp
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_page', ['params' => 'settings/themeSettings']) }}" method="POST">
                        @csrf
                        <div class="col-lg-8">
                            <label for="active_theme">{{ lang_db('Active Theme') }}</label>
                            <input type="hidden" name="codes[]" value="{{ $active_theme[0]->code ?? -1 }}" required readonly>
                            <input type="hidden" name="keys[]" value="{{ $active_theme[0]->key ?? 'active_theme' }}"
                                required readonly>
                            <select name="values[]" id="active_theme" class="form-control">
                                @foreach ($themes as $theme)
                                    <option value="{{ $theme->value ?? '' }}"
                                        {{ $active_theme[0]->value == $theme->value ? 'selected' : '' }}>
                                        {{ $theme->optional_2 ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @include("admin.setting.theme.{$active_theme_type}")

                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i>
                            {{ lang_db('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
