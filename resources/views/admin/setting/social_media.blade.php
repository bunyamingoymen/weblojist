@extends('admin.layouts.main')
@section('admin_index_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_page', ['params' => 'settings/socialMedia']) }}" method="POST">
                        @csrf
                        @foreach ($social_media as $media)
                            <div class="col-lg-8 mt-3">
                                <label for="">{{ $media->optional_1 ?? '' }}</label>
                                <input type="hidden" name="codes[]" value="{{ $media->code ?? '' }}" required readonly>
                                <input type="hidden" name="keys[]" value="{{ $media->key ?? '' }}" required readonly>
                                <input type="hidden" name="optional_1[]" value="{{ $media->optional_1 ?? '' }}" required
                                    readonly>
                                <input type="hidden" name="optional_2[]" value="{{ $media->optional_2 ?? '' }}" required
                                    readonly>
                                <input type="hidden" name="optional_3[]" value="{{ $media->optional_3 ?? '' }}" required
                                    readonly>
                                <input type="hidden" name="optional_4[]" value="{{ $media->optional_4 ?? '' }}" required
                                    readonly>
                                <input type="text" name="values[]" class="form-control"
                                    value="{{ $media->value ?? '' }}">
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i>
                            {{ lang_db('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
