@extends('admin.layouts.main')
@section('admin_index_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_page', ['params' => $params]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($item))
                            <input type="hidden" name="code" value="{{ $item->code ?? -1 }}" required readonly>
                        @endif
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-3">
                                    <label for="productTitle">{{ lang_db('Title') }} *</label>
                                    <input type="text" id="productTitle" name="title" class="form-control"
                                        value="{{ $item->title ?? '' }}" required>
                                </div>
                                <div class="mt-3">
                                    <label for="productDescription">{{ lang_db('Content') }} *</label>
                                    <textarea id="productDescription" class="form-editor-tinymce" name="description">{{ $item->description ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 row mt-3">
                                <div class="col-lg-3">
                                    <label for="productCategory">{{ lang_db('Category') }}</label>
                                    <select name="category" id="productCategory" class="form-control">
                                        <option value="-1">{{ lang_db('Select Category') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->code }}"
                                                {{ isset($item) && $item->category == $category->code ? 'selected' : '' }}>
                                                {{ $category->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="productStock">{{ lang_db('Stock') }} *</label>
                                    <input type="number" id="productStock" name="stock" class="form-control"
                                        value="{{ $item->stock ?? '' }}" required>
                                </div>
                                <div class="col-lg-3">
                                    <label for="productCategory">{{ lang_db('Cargo Company') }}</label>
                                    <select name="cargo_company" id="productCategory" class="form-control">
                                        <option value="-1">{{ lang_db('Select Cargo Company') }}</option>
                                        @foreach ($cargo_companies as $cargo_company)
                                            <option value="{{ $cargo_company->code }}"
                                                {{ isset($item) && $item->cargo_company == $cargo_company->code ? 'selected' : '' }}>
                                                {{ $cargo_company->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="productTime">{{ lang_db('Cargo Time') }}</label>
                                    <input type="text" id="productTime" name="time" class="form-control"
                                        value="{{ $item->time ?? '' }}">
                                </div>
                            </div>

                            <div class="col-lg-12 row mt-3">
                                <div class="col-lg-6">
                                    <label for="productPriceWithoutVat">{{ lang_db('Price without VAT') }} *</label>
                                    <input type="number" id="productPriceWithoutVat" name="price_without_vat"
                                        class="form-control" value="{{ $item->price_without_vat ?? '' }}" required>
                                </div>

                                <div class="col-lg-6">
                                    <label for="productCargoPrice">{{ lang_db('Cargo Price') }} *</label>
                                    <input type="number" id="productCargoPrice" name="cargo_price" class="form-control"
                                        value="{{ $item->price ?? '' }}" required>
                                </div>
                            </div>

                            <div class="col-lg-12 row mt-3">
                                <div class="col-lg-6">
                                    <label for="productPrice">{{ lang_db('Price') }} ({{ lang_db('VAT included') }})
                                        *</label>
                                    <input type="number" id="productPrice" name="price" class="form-control"
                                        value="{{ $item->price ?? '' }}" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="productPriceType">{{ lang_db('Price Type') }}</label>
                                    <select name="priceType" id="productPriceType" class="form-control">
                                        <option value="-1">{{ lang_db('Select Price Type') }}</option>
                                        @foreach ($money_types as $money_type)
                                            <option value="{{ $money_type->code }}"
                                                {{ (isset($item) && $item->priceType == $money_type->code) || (!isset($item) && $loop->index == 0) ? 'selected' : '' }}>
                                                {{ $money_type->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-lg-12 row mt-3">
                                <div class="col-lg-12">
                                    <label class="" for="productImage">
                                        {{ lang_db('Choose Pictures') }}
                                    </label>
                                </div>
                                <div class="col-lg-10" style="margin-left: 10px">
                                    <div>
                                        <input type="file" class="custom-file-input" id="productImage" name="images[]"
                                            accept="image/*" multiple>
                                        <label class="custom-file-label" for="productImage">
                                            {{ lang_db('Choose files...') }}
                                        </label>
                                    </div>
                                    @if (isset($item) && isset($files))
                                        <div class="row mt-5">
                                            @foreach ($files as $file)
                                                <div class="col-lg-3 card text-white ml-2 mr-2"
                                                    style="background-color: #333; border-color: #333;">
                                                    <div class="d-flex justify-content-center align-items-center"
                                                        style="height: 150px;">
                                                        <img src="{{ $file->file ? asset($file->file) : '' }}"
                                                            alt="{{ $file->code ?? '' }}"
                                                            style="max-height: 100px; max-width: 100px; margin-right: 10px;">
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="deleteItem('{{ $file->code }}')"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 row mt-5 mb-5">
                            <div class="col-lg-6 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="productActive" name="active"
                                    {{ (isset($item) && $item->active) || !isset($item) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="productActive">{{ lang_db('Active') }}</label>
                            </div>
                        </div>

                        <div>
                            @foreach ($language as $lan)
                                @if ($lan->optional_2 == 'main_language')
                                    @continue
                                @endif
                                <div class="col-lg-12 mt-5">
                                    <div class="card text-white bg-primary">
                                        <div class="card-body">
                                            <h3 class="card-title font-size-16 mt-0 text-white">{{ $lan->value }}</h3>
                                            <div class="card-text">
                                                <div class="mt-3">
                                                    <label for="productTitle">{{ lang_db('Title') }}</label>
                                                    <input type="text" id="productTitle"
                                                        name="language[{{ $lan->optional_1 }}][title]"
                                                        class="form-control"
                                                        value="{{ isset($item->title) ? lang_db($item->title, $type = -1, $locale = $lan->optional_1) : '' }}">
                                                </div>
                                                <div class="mt-3">
                                                    <label for="productDescription">{{ lang_db('Content') }}</label>
                                                    <textarea id="productDescription" class="form-editor-tinymce" name="language[{{ $lan->optional_1 }}][description]">{{ isset($item->description) ? lang_db($item->description, $type = -1, $locale = $lan->optional_1) : '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i>
                            {{ lang_db('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteItem(code) {
            Swal.fire({
                title: `{{ lang_db('Are you sure') }}`,
                text: `{{ lang_db('Do you want to delete this data') }}?`,
                icon: 'warning',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `{{ lang_db('Approve') }}`,
                denyButtonText: `{{ lang_db('Cancel') }}`,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open(`{{ route('admin_page', ['params' => $params . '/deleteImage']) }}?code=${code}`,
                        '_self');
                }
            })
        }
    </script>
@endsection
