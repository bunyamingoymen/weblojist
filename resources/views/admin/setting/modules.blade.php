@extends('admin.layouts.main')
@section('admin_index_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_page', ['params' => 'settings/modules']) }}" method="POST">
                        @csrf

                        <div class="col-lg-12 mb-3">
                            <div class="col-lg-12 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="show_about" id="show_about"
                                    {{ isset($show_about) && isset($show_about[0]) && $show_about[0]->value ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="show_about">{{ lang_db('Show About Section') }}</label>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="col-lg-12 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="show_page" id="show_page"
                                    {{ isset($show_page) && isset($show_page[0]) && $show_page[0]->value ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="show_page">{{ lang_db('Show Page Section') }}</label>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="col-lg-12 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="show_process" id="show_process"
                                    {{ isset($show_process) && isset($show_process[0]) && $show_process[0]->value ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="show_process">{{ lang_db('Show Proccess Section') }}</label>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="col-lg-12 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="show_services" id="show_services"
                                    {{ isset($show_services) && isset($show_services[0]) && $show_services[0]->value ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="show_services">{{ lang_db('Show Services Section') }}</label>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="col-lg-12 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="show_suppliers"
                                    id="show_suppliers"
                                    {{ isset($show_suppliers) && isset($show_suppliers[0]) && $show_suppliers[0]->value ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="show_suppliers">{{ lang_db('Show Suppliers Section') }}</label>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="col-lg-12 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="show_contact" id="show_contact"
                                    {{ isset($show_contact) && isset($show_contact[0]) && $show_contact[0]->value ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="show_contact">{{ lang_db('Show Contact Section') }}</label>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="col-lg-12 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="show_whatsapp" id="show_whatsapp"
                                    {{ isset($show_whatsapp) && isset($show_whatsapp[0]) && $show_whatsapp[0]->value ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="show_whatsapp">{{ lang_db('Show Whatsapp Section') }}</label>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="col-lg-12 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="show_user_login"
                                    id="show_user_login"
                                    {{ isset($show_user_login) && isset($show_user_login[0]) && $show_user_login[0]->value ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="show_user_login">{{ lang_db('Show User Login Section') }}</label>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="col-lg-12 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="show_page_titles"
                                    id="show_page_titles"
                                    {{ isset($show_page_titles) && isset($show_page_titles[0]) && $show_page_titles[0]->value ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="show_page_titles">{{ lang_db('Show Page Titles Sections') }}</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i>
                            {{ lang_db('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
