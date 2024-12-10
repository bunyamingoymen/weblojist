@extends('index.genz.layouts.main')
@section('index_body')
    <div class="cover-home3 shadow-page-404">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 col-lg-12 ml-auto mr-auto">
                    <div class="box-page-404">
                        <div class="text-center mb-150 mt-100">
                            <div class="box-404 row">
                                <div class="col-lg-6">
                                    <div class="image-404">
                                        <img src="{{ asset('defaultFiles/genz/page/404.svg') }}" alt="Genz">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="info-404 text-start mt-60">
                                        <h3 class="color-linear mb-20">{{ lang_db('Page not found!', 1) }}</h3>
                                        <p class="text-xl color-gray-500">
                                            {{ lang_db('It looks like this page does not exist.', 1) }}
                                            {{ lang_db('You can go to the home page by clicking the button below.', 1) }}
                                        </p>
                                        <div class="mt-25"><a class="btn btn-linear hover-up"
                                                href="{{ route('index.index') }}">{{ lang_db('Home', 1) }}</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
