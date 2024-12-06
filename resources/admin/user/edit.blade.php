@extends('admin.layouts.main')
@section('admin_index_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_page', ['params' => $params]) }}" method="POST"
                        enctype="multipart/form-data" id="editFormID">
                        @csrf
                        @if (isset($item))
                            <input type="hidden" name="code" value="{{ $item->code ?? -1 }}" required readonly>
                        @endif
                        <div class="row">
                            <div class="col-lg-8 row">
                                <div class="col-lg-4">
                                    <label for="name">{{ lang_db('Name') }} *</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ $item->name ?? '' }}" required>
                                </div>
                                <div class="col-lg-4">
                                    <label for="username">{{ lang_db('Username') }} *</label>
                                    <input type="text" id="username" name="username" class="form-control"
                                        value="{{ $item->username ?? '' }}" required>
                                </div>
                                <div class="col-lg-4">
                                    <label for="email">{{ lang_db('E-Mail') }} *</label>
                                    <input type="text" id="email" name="email" class="form-control"
                                        value="{{ $item->email ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-lg-8 row mt-3">
                                <div class="col-lg-6">
                                    <label for="password">{{ lang_db('Password') }} *</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        value="" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="repeat_password">{{ lang_db('Repeat password') }}</label>
                                    <input type="password" id="repeat_password" name="repeat_password" class="form-control"
                                        value="" required>
                                </div>
                            </div>
                            <div class="col-lg-4 row mt-3">
                                <div class="col-lg-12">
                                    <label class="" for="image">
                                        {{ lang_db('Choose Picture') }}
                                    </label>
                                </div>
                                <div class="col-lg-10">
                                    <div>
                                        <input type="file" class="custom-file-input" id="image" name="image"
                                            accept="image/*" multiple>
                                        <label class="custom-file-label" for="image">
                                            {{ lang_db('Choose file...') }}
                                        </label>
                                    </div>
                                    @if (isset($item) && isset($item->image))
                                        <div class="mt-5">
                                            <img src="{{ asset($item->image) }}" alt="{{ $item->name ?? '' }}"
                                                style="height: 200px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 row mt-5 mb-5">
                            <div class="col-lg-6 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="active" name="active"
                                    {{ (isset($item) && $item->active) || !isset($item) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="active">{{ lang_db('Active') }}</label>
                            </div>
                        </div>

                        <button type="button" onclick="submitEdit()" class="btn btn-primary float-right"><i
                                class="fas fa-save"></i>
                            {{ lang_db('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitEdit() {
            // Input değerlerini al
            const fields = {
                name: document.getElementById('name').value,
                username: document.getElementById('username').value,
                email: document.getElementById('email').value,
                @if (!isset($item))
                    password: document.getElementById('password').value,
                    repeat_password: document.getElementById('repeat_password').value,
                @endif
            };

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Boş alanları bul
            const emptyFields = Object.entries(fields)
                .filter(([key, value]) => value.trim() === "")
                .map(([key]) => {
                    switch (key) {
                        case "name":
                            return "{{ lang_db('Name') }}";
                        case "username":
                            return "{{ lang_db('Username') }}";
                        case "email":
                            return "{{ lang_db('E-Mail') }}";
                            @if (!isset($item))
                                case "password":
                                return "{{ lang_db('Password') }}";
                                case "repeat_password":
                                return "{{ lang_db('Repeat password') }}";
                            @endif
                    }
                });


            // Eğer boş alan varsa kullanıcıya göster
            if (emptyFields.length > 0) {
                Swal.fire({
                    icon: "error",
                    title: "{{ lang_db('Error!') }}",
                    text: `{{ lang_db('Please fill in the required fields') }}. {{ lang_db('Empty fields') }}: ${emptyFields.join(", ")}`,
                });
                return;
            }

            // E-posta doğrulama ve şifre eşleşme kontrolü
            if (!emailPattern.test(fields.email)) {
                Swal.fire({
                    icon: "error",
                    title: "{{ lang_db('Error!') }}",
                    text: "{{ lang_db('Please enter a valid email address') }}",
                });
                return;
            }

            //Şifre kontrolü
            if (fields.password !== fields.repeat_password) {
                Swal.fire({
                    icon: "error",
                    title: "{{ lang_db('Error!') }}",
                    text: "{{ lang_db('Password and Repeat Password do not match') }}",
                });
                return;
            }

            // Formu gönder
            document.getElementById('editFormID').submit();
        }
    </script>
@endsection
