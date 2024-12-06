@extends('admin.layouts.main')
@section('admin_index_body')
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
                            <img src="{{ asset(Auth::guard('admin')->user()->image ?? 'defaultFiles/user/default_user.webp') }}"
                                alt="Profile" class="profile-image" id="profileImage">
                            <div class="profile-upload-box mt-3"
                                onclick="document.getElementById('profileImageInput').click()">
                                <form action="{{ route('admin.change.image') }}" id="changeProfileImage" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" id="profileImageInput" name="profileImageInput" accept="image/*"
                                        onchange="handleProfileImageChange(this)">
                                </form>
                                <i class="mdi mdi-camera font-size-24"></i>
                            </div>
                        </div>
                        <h5 class="font-size-16 mb-1">{{ Auth::guard('admin')->user()->name }}</h5>
                        <p class="text-muted mb-2">@ {{ Auth::guard('admin')->user()->username }}</p>
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
                        <form action="{{ route('admin.change.profile') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{ lang_db('Name') }}</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ Auth::guard('admin')->user()->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">{{ lang_db('Username') }}</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            value="{{ Auth::guard('admin')->user()->username }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">{{ lang_db('E-Mail') }}</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ Auth::guard('admin')->user()->email }}">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    {{ lang_db('Update') }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Şifre Değiştirme -->
                    <div class="form-section">
                        <h4 class="form-section-title">Şifre Değiştirme</h4>
                        <form action="{{ route('admin.change.password') }}" method="POST">
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
    </script>
@endsection
