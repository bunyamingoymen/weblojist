@extends('admin.layouts.main')
@section('admin_index_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12" style="display: inline-block;">
                        <a class="btn btn-primary mb-3" style="float: right;" href="#" onclick="addNewService()">
                            <i class="mdi mdi-plus-circle-outline"></i> {{ lang_db('New') }}
                        </a>
                    </div>
                    <form action="{{ route('admin_page', ['params' => 'settings/service']) }}" method="POST">
                        @csrf
                        @foreach ($service_title as $service)
                            <div id="service_{{ $service->code }}" class="services mb-5">
                                <input type="hidden" name="codes[]" value="{{ $service->code ?? -1 }}" required readonly>
                                <input type="hidden" name="keys[]" value="{{ $service->key ?? 'service_title' }}" required
                                    readonly>
                                <div class="col-lg-12 row mt-3">
                                    <div class="col-lg-8">
                                        <div>
                                            <label for="">{{ lang_db('Main Sub Title') }}</label>
                                            <input type="text" class="form-control" name="values[]" id=""
                                                value="{{ $service->value ?? '' }}"
                                                placeholder="{{ lang_db('Enter Main Sub Title') }}">
                                        </div>
                                        <div>
                                            <label for="">{{ lang_db('Main Title') }}</label>
                                            <input type="text" class="form-control" name="optional_1[]" id=""
                                                value="{{ $service->optional_1 ?? '' }}"
                                                placeholder="{{ lang_db('Enter Main Title') }}">
                                        </div>

                                        <div hidden>
                                            <input type="hidden" class="form-control" name="optional_3[]" id=""
                                                value="{{ $service->optional_3 ?? '' }}" placeholder="">
                                        </div>

                                        <input type="hidden" name="optional_4[]"value="{{ $service->optional_4 ?? '' }}">

                                        <div class="mt-3">
                                            <label for="">{{ lang_db('Main Description') }}</label>
                                            <textarea name="optional_2[]" id="" class="form-control" cols="30" rows="10"
                                                placeholder="{{ lang_db('Enter Main Description') }}">{{ $service->optional_2 ?? '' }}</textarea>
                                        </div>

                                    </div>
                                </div>
                                @foreach ($language as $item)
                                    @if ($item->optional_2 == 'main_language')
                                        @continue
                                    @endif

                                    <div class="col-xl-8 mt-3">
                                        <div class="card text-white bg-primary">
                                            <div class="card-body">
                                                <h3 class="card-title font-size-16 mt-0 text-white">{{ $item->value }}
                                                </h3>
                                                <div class="card-text">

                                                    <div class="col-lg-12">
                                                        <label for="">{{ lang_db('Main Sub Title') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="language[{{ $item->optional_1 }}][value][]"
                                                            id=""
                                                            value="{{ $service->value ? lang_db($service->value, $type = -1, $locale = $item->optional_1) : '' }}"
                                                            placeholder="{{ lang_db('Enter Main Sub Title') }}">
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label for="">{{ lang_db('Main Title') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="language[{{ $item->optional_1 }}][optional_1][]"
                                                            id=""
                                                            value="{{ $service->optional_1 ? lang_db($service->optional_1, $type = -1, $locale = $item->optional_1) : '' }}"
                                                            placeholder="{{ lang_db('Enter Main Title') }}">
                                                    </div>
                                                    <div class="col-lg-12 mt-3">
                                                        <label for="">{{ lang_db('Main Description') }}</label>
                                                        <textarea name="language[{{ $item->optional_1 }}][optional_2][]" id="" class="form-control" cols="30"
                                                            rows="10" placeholder="{{ lang_db('Enter Main Description') }}">{{ $service->optional_2 ? lang_db($service->optional_2, $type = -1, $locale = $item->optional_1) : '' }}</textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <div id="serviceDivId">
                            @foreach ($services as $service)
                                <div id="service_{{ $service->code }}" class="services">
                                    <input type="hidden" name="codes[]" value="{{ $service->code ?? -1 }}" required
                                        readonly>
                                    <input type="hidden" name="keys[]" value="{{ $service->key ?? 'services' }}" required
                                        readonly>
                                    <div class="col-lg-12 row mt-3">
                                        <div class="col-lg-8">
                                            <div>
                                                <label for="">{{ lang_db('Title') }}</label>
                                                <input type="text" class="form-control" name="values[]" id=""
                                                    value="{{ $service->value ?? '' }}"
                                                    placeholder="{{ lang_db('Enter Title') }}">
                                            </div>
                                            <div class="mt-3">
                                                <label for="">{{ lang_db('Icon') }}</label>
                                                <input type="text" class="form-control" name="optional_2[]"
                                                    id="" value="{{ $service->optional_2 ?? '' }}"
                                                    placeholder="{{ lang_db('Enter Icon') }}">
                                            </div>

                                            <div class="mt-3">
                                                <label for="">{{ lang_db('URL') }}</label>
                                                <input type="text" class="form-control" name="optional_3[]"
                                                    id="" value="{{ $service->optional_3 ?? '' }}"
                                                    placeholder="{{ lang_db('Enter URL') }}">
                                            </div>

                                            <div
                                                class="mt-3 col-lg-12 custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="open_different_page_{{ $service->code }}"
                                                    name="open_different_page_{{ $service->code }}"
                                                    onchange="selectDifferentPage('{{ $service->code }}', this)"
                                                    {{ isset($service) && $service->optional_4 ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                    for="open_different_page_{{ $service->code }}">{{ lang_db('Open In Different Page') }}</label>
                                            </div>

                                            <div class="col-lg-12 row mt-2" id="optional_4{{ $service->code }}"
                                                style="display: none">
                                                <label for="optional_4_{{ $service->code }}">
                                                </label>
                                                <input type="text" class="form-control"
                                                    id="optional_4_{{ $service->code }}" name="optional_4[]"
                                                    value="{{ $service->optional_4 ?? '0' }}">
                                            </div>
                                            <div class="mt-3">
                                                <label for="">{{ lang_db('Description') }}</label>
                                                <textarea name="optional_1[]" id="" class="form-control" cols="30" rows="10"
                                                    placeholder="{{ lang_db('Enter Description') }}">{{ $service->optional_1 ?? '' }}</textarea>
                                            </div>

                                        </div>
                                        <div class="col-lg-2">
                                            <div class="col-lg-3 btn btn-danger"
                                                onclick="deleteService('{{ $service->code }}', '{{ $service->value }}' )"
                                                style="height:100%; widht:100%; display: flex; justify-content: center; align-items: center;">
                                                <i class="fas fa-trash-alt fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($language as $item)
                                        @if ($item->optional_2 == 'main_language')
                                            @continue
                                        @endif

                                        <div class="col-xl-8 mt-3">
                                            <div class="card text-white bg-primary">
                                                <div class="card-body">
                                                    <h3 class="card-title font-size-16 mt-0 text-white">
                                                        {{ $item->value }}
                                                    </h3>
                                                    <div class="card-text">

                                                        <div class="col-lg-12">
                                                            <label for="">{{ lang_db('Title') }}</label>
                                                            <input type="text" class="form-control"
                                                                name="language[{{ $item->optional_1 }}][value][]"
                                                                id=""
                                                                value="{{ $service->value ? lang_db($service->value, $type = -1, $locale = $item->optional_1) : '' }}"
                                                                placeholder="{{ lang_db('Enter Title') }}">
                                                        </div>
                                                        <div class="col-lg-12 mt-3">
                                                            <label for="">{{ lang_db('Description') }}</label>
                                                            <textarea name="language[{{ $item->optional_1 }}][optional_1][]" id="" cols="30" rows="10"
                                                                class="form-control" placeholder="{{ lang_db('Enter Description') }}">{{ $service->optional_1 ? lang_db($service->optional_1, $type = -1, $locale = $item->optional_1) : '' }}</textarea>
                                                        </div>
                                                        <div>
                                                            <input type="hidden"
                                                                name="language[{{ $item->optional_1 }}][optional_2][]"value="">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
        var addNewServiceCount = 0;

        function getOldValue() {
            let values = [];
            const inputs = document.querySelectorAll('input, textarea');

            inputs.forEach((element) => {
                values.push(element.value);
            });

            return values;
        }

        function setOldValue(data) {
            const inputs = document.querySelectorAll('input, textarea');

            inputs.forEach((element, index) => {
                if (index < data.length) {
                    element.value = data[index];
                }
            });
        }

        function addNewService() {
            var data = getOldValue();
            addNewServiceCount++;
            var html = `
                <div id="service_${addNewServiceCount}" class="services">
                    <input type="hidden" name="codes[]" value="-1" required readonly>
                    <input type="hidden" name="keys[]" value="services" required readonly>
                    <div class="col-lg-12 row mt-3">
                        <div class="col-lg-8">
                            <div>
                                <label for="">{{ lang_db('Title') }}</label>
                                <input type="text" class="form-control" name="values[]" id="" value=""
                                    placeholder="{{ lang_db('Enter Title') }}">
                            </div>
                            <div class="mt-3">
                                <label for="">{{ lang_db('Icon') }}</label>
                                <input type="text" class="form-control" name="optional_2[]" id="" value=""
                                    placeholder="{{ lang_db('Enter Icon') }}">
                            </div>
                            <div class="mt-3">
                                <label for="">{{ lang_db('URL') }}</label>
                                <input type="text" class="form-control" name="optional_3[]" id="" value=""
                                    placeholder="{{ lang_db('Enter URL') }}">
                            </div>
                            <div
                                class="mt-3 col-lg-12 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input"
                                    id="open_different_page_${addNewServiceCount}"
                                    name="open_different_page_${addNewServiceCount}"
                                    onchange="selectDifferentPage('${addNewServiceCount}', this)">
                                <label class="custom-control-label"
                                    for="open_different_page_${addNewServiceCount}">{{ lang_db('Open In Different Page') }}</label>
                            </div>

                            <div class="col-lg-12 row mt-2" id="optional_4${addNewServiceCount}"
                                style="display: none">
                                <label for="optional_4_${addNewServiceCount}">
                                </label>
                                <input type="text" class="form-control"
                                    id="optional_4_${addNewServiceCount}" name="optional_4[]"
                                    value="0">
                            </div>
                            <div class="mt-3">
                                <label for="">{{ lang_db('Description') }}</label>
                                <textarea name="optional_1[]" id="" class="form-control" cols="30" rows="10"
                                    placeholder="{{ lang_db('Enter Description') }}"></textarea>
                            </div>

                        </div>
                        <div class="col-lg-2">
                            <div class="col-lg-3 btn btn-danger"
                                onclick="cancelNewService('${addNewServiceCount}')"
                                style="height:100%; widht:100%; display: flex; justify-content: center; align-items: center;">
                                <i class="fas fa-trash-alt fa-2x"></i>
                            </div>
                        </div>
                    </div>
                `
            @foreach ($language as $item)
                @if ($item->optional_2 == 'main_language')
                    @continue
                @endif

                html += `
                        <div class="col-xl-8 mt-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h3 class="card-title font-size-16 mt-0 text-white">{{ $item->value }}</h3>
                                    <div class="card-text">
                                        <div class="col-lg-12">
                                            <label for="">{{ lang_db('Title') }}</label>
                                            <input type="text" class="form-control" name="language[{{ $item->optional_1 }}][value][]" id="" value="" placeholder="{{ lang_db('Enter Title') }}">
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <label for="">{{ lang_db('Description') }}</label>
                                            <textarea name="language[{{ $item->optional_1 }}][optional_1][]" id="" cols="30" rows="10" class="form-control" placeholder="{{ lang_db('Enter Description') }}"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
            @endforeach

            html += `</div>`

            document.getElementById('serviceDivId').innerHTML += html;

            setOldValue(data);
        }

        function cancelNewService(count) {
            document.getElementById('service_' + count).remove();
        }

        function deleteService(code, name) {
            Swal.fire({
                title: `{{ lang_db('Are you sure') }}`,
                text: `{{ lang_db('Do you want to delete this data') }}?(${name})`,
                icon: 'warning',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `{{ lang_db('Approve') }}`,
                denyButtonText: `{{ lang_db('Cancel') }}`,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open(`{{ route('admin_page', ['params' => 'settings/service/delete']) }}?code=${code}`,
                        '_self');
                }
            })
        }
    </script>

    <script>
        function selectDifferentPage(code, checkbox) {
            if (checkbox.checked) {
                document.getElementById('optional_4_' + code).value = '1';
            } else {
                document.getElementById('optional_4_' + code).value = '0';
            }
        }
    </script>
@endsection
