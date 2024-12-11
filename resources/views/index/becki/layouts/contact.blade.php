@php
    $show_contact = getCachedKeyValue(['key' => 'show_contact', 'first' => true, 'refreshCache' => true]) ?? null;

    $contact_title = getCachedKeyValue(['key' => 'contact_title', 'first' => true, 'refreshCache' => true]) ?? null;
    $contact_sub_title =
        getCachedKeyValue(['key' => 'contact_sub_title', 'first' => true, 'refreshCache' => true]) ?? null;

    $use_sub_title_theme_db =
        getCachedKeyValue(['key' => 'sub_title_theme', 'first' => true, 'refreshCache' => true]) ?? null;
    $use_sub_title_theme = $use_sub_title_theme_db ? $use_sub_title_theme_db->value : 'pink';

    $show_details =
        (isset($address) && isset($address->value) && $address->value != null && $address->value != '') ||
        (isset($phones) && $phones->isNotEmpty()) ||
        (isset($emails) && $emails->isNotEmpty());
@endphp
@if ((isset($show_contact) && isset($show_contact->value) && $show_contact->value == '1') || !isset($show_contact))
    <section class="white-bg transition-none" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-8 centerize-col text-center">
                    <div class="section-title">
                        <h2
                            class="raleway-font {{ $use_sub_title_theme == 'pink' ? 'secondary-color' : 'default-color' }}">
                            {{ isset($contact_sub_title) ? lang_db($contact_sub_title->value, -1) : lang_db('Just Keep In Touch', 1) }}
                        </h2>
                        <h1 class="raleway-font">
                            {{ isset($contact_title) ? lang_db($contact_title->value, -1) : lang_db('Contact Us Now', 1) }}
                        </h1>
                    </div>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-70">

                @if ($show_details)
                    <div class="col-md-6 col-sm-6 col-xs-12 xs-mb-50">
                        @if ((isset($address) && isset($address->value)) || (isset($phones) && $phones->isNotEmpty()))
                            <div class="row mt-20">

                                @if (isset($address) && isset($address->value) && $address->value != null && $address->value != '')
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="section-title">
                                            <h2
                                                class="raleway-font {{ $use_sub_title_theme == 'pink' ? 'secondary-color' : 'default-color' }}">
                                                {{ lang_db('Address', 1) }}</h2>
                                            <p class="mt-30">{{ $address->value ?? '' }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if (isset($phones) && $phones->isNotEmpty())
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="section-title">
                                            <h2
                                                class="raleway-font {{ $use_sub_title_theme == 'pink' ? 'secondary-color' : 'default-color' }}">
                                                {{ lang_db('Office Numbers', 1) }}
                                            </h2>
                                            @foreach ($phones as $index => $phone)
                                                <p class="mb-0 {{ $index == 0 ? 'mt-30' : '' }}">
                                                    {{ $phone->value ?? '' }} : {{ $phone->optional_1 ?? '' }}
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                            </div>
                        @endif

                        @if (isset($emails) && $emails->isNotEmpty())
                            <div class="row mt-20">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="section-title">
                                        <h2
                                            class="raleway-font {{ $use_sub_title_theme == 'pink' ? 'secondary-color' : 'default-color' }}">
                                            {{ lang_db('Our E-mail', 1) }}</h2>
                                        @foreach ($emails as $index => $email)
                                            <p class="mb-0 {{ $index == 0 ? 'mt-30' : '' }}">
                                                {{ $email->value ?? '' }} : {{ $email->optional_1 ?? '' }}
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row mt-20">
                            <div class="col-md-12 social-icons-style-06">
                                <ul class="md-icon left-icon">
                                    @foreach ($social_media as $sm)
                                        @if ($sm->value == '' || is_null($sm->value))
                                            @continue;
                                        @endif
                                        <li>
                                            <a class="icon {{ $sm->optional_3 ?? '' }} icon-container"
                                                href="{{ $sm->value ?? '#.' }}">
                                                <i class="icofont fontawesome {{ $sm->optional_4 ?? '' }}"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                @endif

                <div class="{{ $show_details ? 'col-md-6 col-sm-6' : 'col-md-12 col-sm-12' }} col-xs-12">
                    <form name="contact-form" id="contact-form" method="POST" class="contact-form-style-01">
                        @csrf
                        <div class="messages"></div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label class="sr-only" for="name">{{ lang_db('Name', 1) }}</label>
                                    <input type="text" name="name" class="md-input" id="name"
                                        placeholder="{{ lang_db('Name', 1) }} *" required
                                        data-error="{{ lang_db('Please Enter Your Name', 1) }}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label class="sr-only" for="email">{{ lang_db('E-Mail', 1) }}</label>
                                    <input type="email" name="email" class="md-input" id="email"
                                        placeholder="{{ lang_db('E-Mail', 1) }} *" required
                                        data-error="{{ lang_db('Please Enter Your E-mail Address', 1) }}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="sr-only" for="subject">{{ lang_db('Subject', 1) }}</label>
                                    <input type="text" name="subject" class="md-input" id="subject"
                                        placeholder="{{ lang_db('Subject', 1) }}">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="sr-only" for="message">{{ lang_db('Message', 1) }}</label>
                                    <textarea name="message" class="md-textarea" id="message" rows="7" placeholder="{{ lang_db('Message', 1) }}"
                                        required data-error="{{ lang_db('Please Enter Your Message', 1) }}"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="text-left mt-20">
                                    <button type="submit" name="submit"
                                        class="btn btn-outline btn-md btn-circle btn-animate remove-margin"><span>
                                            {{ lang_db('Send Message', 1) }} <i
                                                class="ion-android-arrow-forward"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                @if (!$show_details && isset($social_media) && $social_media->isNotEmpty())
                    <div class="col-md-12 col-sm-12 col-xs-12 xs-mb-50">
                        <div class="row mt-20">
                            <div class="col-md-12 social-icons-style-06">
                                <ul class="md-icon left-icon">
                                    @foreach ($social_media as $sm)
                                        @if ($sm->value == '' || is_null($sm->value))
                                            @continue;
                                        @endif
                                        <li>
                                            <a class="icon {{ $sm->optional_3 ?? '' }} icon-container"
                                                href="{{ $sm->value ?? '#.' }}">
                                                <i class="icofont fontawesome {{ $sm->optional_4 ?? '' }}"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
