@extends('admin.layouts.main')
@section('admin_index_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_page', ['params' => 'settings/contact/address']) }}" method="POST">
                        @csrf
                        <div class="col-lg-8 mt-3">
                            <label for="">{{ lang_db('Address') }}</label>
                            <input type="hidden" name="keys[]" value="addresses" required readonly>
                            <input type="hidden" name="codes[]" value="{{ $addresses[0]->code ?? -1 }}" required readonly>
                            <textarea name="values[]" id="site_description" cols="30" rows="10" class="form-control"
                                placeholder="Enter Address">{{ $addresses[0]->value ?? '' }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i>
                            {{ lang_db('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
