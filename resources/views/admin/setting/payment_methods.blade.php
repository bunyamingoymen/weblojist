@extends('admin.layouts.main')
@section('admin_index_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form id="paymentMethodsFormID"
                        action="{{ route('admin_page', ['params' => 'settings/paymentMethods']) }}" method="POST">
                        @csrf
                        @foreach ($payment_methods as $item)
                            <div class="custom-control custom-checkbox mt-3">
                                <input type="checkbox" class="custom-control-input"
                                    id="{{ $item->key }}_{{ $item->code }}"
                                    {{ isset($item->optional_1) && $item->optional_1 == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="{{ $item->key }}_{{ $item->code }}">{{ lang_db($item->value) }}</label>
                            </div>
                        @endforeach
                        <div id="inputFiles"> </div>
                        <button type="button" class="btn btn-primary float-right" onclick="submitForm()">
                            <i class="fas fa-save"></i>
                            {{ lang_db('Save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitForm() {
            var html = ``;

            @foreach ($payment_methods as $item)
                var code = "{{ $item->code }}"
                var key = '{{ $item->key }}';
                var value = "{{ $item->value }}"
                var optional_1 = document.getElementById('{{ $item->key }}_{{ $item->code }}').checked ? '1' : '0';
                html += `
                    <div>
                        <input type="hidden" name="codes[]" value="${code}" required readonly>
                        <input type="hidden" name="keys[]" value="${key}" required readonly>
                        <input type="hidden" name="values[]" value="${value}" required readonly>
                        <input type="hidden" name="optional_1[]" value="${optional_1}" required readonly>
                    </div>
                `
            @endforeach
            document.getElementById('inputFiles').innerHTML = html;
            document.getElementById('paymentMethodsFormID').submit();
        }
    </script>
@endsection
