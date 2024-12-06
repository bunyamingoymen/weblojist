@extends('admin.layouts.main')
@section('admin_index_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_page', ['params' => 'settings/contact/contactTitle']) }}" method="POST">
                        @csrf

                        <div class="col-lg-8">
                            <label for="">{{ lang_db('Contact Title') }}</label>
                            <input type="hidden" name="codes[]" value="{{ $contact_title[0]->code ?? -1 }}" required
                                readonly>
                            <input type="hidden" name="keys[]" value="{{ $contact_title[0]->key ?? 'contact_title' }}"
                                required readonly>
                            <input type="text" class="form-control" name="values[]" id="contact_title"
                                value="{{ $contact_title[0]->value ?? '' }}" placeholder="Enter Contact Title">
                        </div>
                        <div class="col-lg-8 mt-3">
                            <label for="">{{ lang_db('Contact Sub Title') }}</label>
                            <input type="hidden" name="keys[]" value="contact_sub_title" required readonly>
                            <input type="hidden" name="codes[]" value="{{ $contact_sub_title[0]->code ?? -1 }}" required
                                readonly>
                            <input type="text" class="form-control" name="values[]" id="contact_sub_title"
                                value="{{ $contact_sub_title[0]->value ?? '' }}" placeholder="Enter Contact Sub Title">
                        </div>

                        @foreach ($language as $item)
                            @if ($item->optional_2 == 'main_language')
                                @continue
                            @endif

                            <div class="col-xl-8 mt-5">
                                <div class="card text-white bg-primary">
                                    <div class="card-body">
                                        <h3 class="card-title font-size-16 mt-0 text-white">{{ $item->value }}</h3>
                                        <div class="card-text">

                                            <div class="col-lg-12">
                                                <label for="">{{ lang_db('Contact Title') }}</label>
                                                <input type="text" class="form-control"
                                                    name="language[{{ $item->optional_1 }}][value][]" id="contact_title"
                                                    value="{{ $contact_title[0]->value ? lang_db($contact_title[0]->value, $type = -1, $locale = $item->optional_1) : '' }}"
                                                    placeholder="Enter Contact Title">
                                            </div>
                                            <div class="col-lg-12 mt-3">
                                                <label for="">{{ lang_db('Contact Sub Title') }}</label>
                                                <input type="text" class="form-control"
                                                name="language[{{ $item->optional_1 }}][value][]" id="contact_sub_title"
                                                value="{{ $contact_sub_title[0]->value ? lang_db($contact_sub_title[0]->value, $type = -1, $locale = $item->optional_1) : '' }}"
                                                placeholder="Enter Contact Sub Title">
                                            </div>

                                        </div>
                                    </div>
                                </div>
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
