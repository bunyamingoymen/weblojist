@extends('admin.layouts.main')
@section('admin_index_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
                        {{ lang_db('Please enter the country code without the + sign. And do not leave any spaces. For example: 905555555555') }}
                    </div>
                    <form action="{{ route('admin_page', ['params' => 'settings/contact/whatsapp']) }}" method="POST">
                        @csrf
                        <div class="col-lg-8 mt-3">
                            <label for="whatsapp_phone">{{ lang_db('WhatsApp') }}</label>
                            <input type="hidden" name="keys[]" value="whatsapp_phone" required readonly>
                            <input type="hidden" name="codes[]" value="{{ $whatsapp_phone[0]->code ?? -1 }}" required
                                readonly>

                            <input type="number" class="form-control" name="values[]" id="whatsapp_phone"
                                value="{{ $whatsapp_phone[0]->value ?? '' }}"
                                placeholder="{{ lang_db('Enter Phone Number') }}">
                        </div>
                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i>
                            {{ lang_db('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
