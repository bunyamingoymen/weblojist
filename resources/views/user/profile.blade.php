@extends('user.layouts.main')
@section('user_index_body')
    <style>
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #556ee6;
        }

        .profile-upload-box {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .profile-upload-box input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .profile-upload-box:hover {
            border-color: #556ee6;
        }

        .address-card {
            transition: all 0.3s ease;
        }

        .address-card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .btn-add-address {
            height: 100%;
            min-height: 200px;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-add-address:hover {
            border-color: #556ee6;
            background-color: rgba(85, 110, 230, 0.1);
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .form-section-title {
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #f0f0f0;
        }
    </style>

    <!-- Profil Bilgileri -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div class="profile-image-container mb-4">
                            <img src="{{ asset(Auth::user()->image ?? 'defaultFiles/user/default_user.webp') }}"
                                alt="Profile" class="profile-image" id="profileImage">
                            <div class="profile-upload-box mt-3"
                                onclick="document.getElementById('profileImageInput').click()">
                                <form action="{{ route('user.change.image') }}" id="changeProfileImage" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" id="profileImageInput" name="profileImageInput" accept="image/*"
                                        onchange="handleProfileImageChange(this)">
                                </form>
                                <i class="mdi mdi-camera font-size-24"></i>
                            </div>
                        </div>
                        <h5 class="font-size-16 mb-1">{{ Auth::user()->name }}</h5>
                        <p class="text-muted mb-2">@ {{ Auth::user()->username }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <!-- Profil Bilgileri -->
                    <div class="form-section">
                        <h4 class="form-section-title">Profil Bilgileri</h4>
                        <form action="{{ route('user.change.profile') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{ lang_db('Name', 2) }}</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">{{ lang_db('Username', 2) }}</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            value="{{ Auth::user()->username }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">{{ lang_db('E-Mail', 2) }}</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ Auth::user()->email }}">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    {{ lang_db('Update', 2) }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Şifre Değiştirme -->
                    <div class="form-section">
                        <h4 class="form-section-title">Şifre Değiştirme</h4>
                        <form action="{{ route('user.change.password') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="currentPassword">Mevcut Şifre</label>
                                <input type="password" class="form-control" id="currentPassword" name="currentPassword">
                            </div>
                            <div class="form-group">
                                <label for="newPassword">Yeni Şifre</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Yeni Şifre (Tekrar)</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Şifreyi Değiştir
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- Adres Yönetimi -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Adreslerim</h4>
                    <div class="row" id="addressContainer">
                        <!-- Yeni Adres Ekleme Butonu -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 btn-add-address" onclick="openAddAddressModal()">
                                <div class="text-center">
                                    <i class="mdi mdi-plus-circle-outline font-size-24 text-primary"></i>
                                    <h5 class="mt-2 mb-0">{{ lang_db('Add New Address', 2) }}</h5>
                                </div>
                            </div>
                        </div>
                        <!-- Adres Kartları -->
                        @foreach ($addresses as $address)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 address-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="card-title mb-0">{{ $address->address_name }}</h5>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle text-muted"
                                                    data-toggle="dropdown">
                                                    <i class="mdi mdi-dots-vertical font-size-18"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#"
                                                        onclick="editAddress('{{ $address->code }}','{{ $address->address_name }}','{{ $address->address }}','{{ $address->city }}','{{ $address->county }}','{{ $address->post_code }}')">
                                                        <i class="mdi mdi-pencil mr-1"></i> {{ lang_db('Edit', 2) }}
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="#"
                                                        onclick="deleteAddress('{{ $address->code }}','{{ $address->address_name }}')">
                                                        <i class="mdi mdi-trash-can mr-1"></i> {{ lang_db('Delete', 2) }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="card-text">
                                            {{ $address->address }} <br>
                                            {{ $address->county }} / {{ $address->city }}<br>
                                            {{ $address->post_code }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Adres Ekleme Modal -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ lang_db('Address', 2) }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addressForm" action="{{ route('user.edit.address') }}" method="POST">
                        @csrf
                        <input type="hidden" name="code" id="addressCode" value="-1">
                        <div class="form-group">
                            <label>{{ lang_db('Address Title', 2) }}</label>
                            <input type="text" class="form-control"
                                placeholder="{{ lang_db('Example: Home, Work', 2) }}" name="address_name"
                                id="addressName">
                        </div>
                        <div class="form-group">
                            <label>{{ lang_db('Address', 2) }}</label>
                            <textarea class="form-control" rows="3" placeholder="{{ lang_db('Address', 2) }}" name="address"
                                id="address"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ lang_db('City', 2) }}</label>
                                    <input type="text" class="form-control" name="city" id="addressCity">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ lang_db('County', 2) }}</label>
                                    <input type="text" class="form-control" name="county" id="addressCounty">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ lang_db('Post Code', 2) }}</label>
                            <input type="text" class="form-control" name="post_code" id="addressPostCode">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-primary" onclick="saveAddress()">Kaydet</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Profil resmi değiştirme
        function handleProfileImageChange(input) {
            if (input.files && input.files[0]) {
                //var reader = new FileReader();
                //reader.onload = function(e) {
                //    document.getElementById('profileImage').src = e.target.result;
                //}
                //reader.readAsDataURL(input.files[0]);
                document.getElementById('changeProfileImage').submit();
            }
        }

        // Adres ekleme modalını aç
        function openAddAddressModal() {
            $('#addAddressModal').modal('show');
        }

        // Yeni adres kaydet
        function saveAddress() {
            // Input değerlerini al
            const fields = {
                addressName: document.getElementById('addressName').value,
                address: document.getElementById('address').value,
                addressCity: document.getElementById('addressCity').value,
                addressCounty: document.getElementById('addressCounty').value,
                addressPostCode: document.getElementById('addressPostCode').value,
            };

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Boş alanları bul
            const emptyFields = Object.entries(fields)
                .filter(([key, value]) => value.trim() === "")
                .map(([key]) => {
                    switch (key) {
                        case "addressName":
                            return "{{ lang_db('Address Title', 2) }}";
                        case "address":
                            return "{{ lang_db('Address', 2) }}";
                        case "addressCity":
                            return "{{ lang_db('City', 2) }}";
                        case "addressCounty":
                            return "{{ lang_db('County', 2) }}";
                        case "addressPostCode":
                            return "{{ lang_db('Post Code', 2) }}";

                    }
                });


            // Eğer boş alan varsa kullanıcıya göster
            if (emptyFields.length > 0) {
                Swal.fire({
                    type: "error",
                    title: "{{ lang_db('Error!', 2) }}",
                    text: `{{ lang_db('Please fill in the required fields', 2) }}. {{ lang_db('Empty fields', 2) }}: ${emptyFields.join(", ")}`,
                    background: '#fff'
                });
                return;
            }
            document.getElementById('addressForm').submit();
        }

        // Adres düzenle
        function editAddress(code, name, address, city, county, postCode) {
            document.getElementById('addressCode').value = code;
            document.getElementById('addressName').value = name;
            document.getElementById('address').value = address;
            document.getElementById('addressCity').value = city;
            document.getElementById('addressCounty').value = county;
            document.getElementById('addressPostCode').value = postCode;
            openAddAddressModal();
        }

        // Adres sil
        function deleteAddress(code, name) {
            Swal.fire({
                title: `{{ lang_db('Are you sure', 2) }}`,
                text: `{{ lang_db('Do you want to delete this data', 2) }}?(${name})`,
                icon: 'warning',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `{{ lang_db('Approve', 2) }}`,
                denyButtonText: `{{ lang_db('Cancel', 2) }}`,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open(`{{ route('user.delete.address') }}?code=${code}`,
                        '_self');
                }
            })
        }
    </script>
@endsection
