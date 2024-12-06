@extends('admin.layouts.main')
@section('admin_index_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_page', ['params' => 'settings/logo']) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div id="LogosDivId">
                            @foreach ($logos as $item)
                                <div class="col-lg-8 mt-3">
                                    <label for="">{{ lang_db($item->value) }}</label>
                                    <input type="hidden" name="codes[]" value="{{ $item->code ?? '' }}" required readonly>
                                    <input type="hidden" name="keys[]" value="{{ $item->key ?? '' }}" required readonly>
                                    <input type="hidden" name="values[]" value="{{ $item->value ?? '' }}" required
                                        readonly>

                                    <div class="row">
                                        <div class="col-lg-5">
                                            @if (file_exists(public_path($item->optional_5)))
                                                <img src="{{ $item->optional_5 ? asset($item->optional_5) : 'Not Exit' }}"
                                                    alt="{{ $item->value ?? '' }}"
                                                    style="max-height: 100px; max-width: 100px;">
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
                                    </div>
                                    <label><i>{{ $item->optional_1 ? lang_db($item->optional_1) : '' }}</i></label>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i>
                            {{ lang_db('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
