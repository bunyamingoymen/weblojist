@extends('admin.layouts.main')
@section('admin_index_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12" style="display: inline-block;">
                        <a class="btn btn-primary mb-3" style="float: right;" href="#" onclick="addNewFAQ()">
                            <i class="mdi mdi-plus-circle-outline"></i> {{ lang_db('New') }}
                        </a>
                    </div>
                    <form action="{{ route('admin_page', ['params' => 'settings/faq']) }}" method="POST">
                        @csrf
                        <div id="faqDivId">
                            @foreach ($faq_questions as $question)
                                <div id="faq_question_{{ $question->code }}" class="faq_questions">
                                    <input type="hidden" name="codes[]" value="{{ $question->code ?? -1 }}" required
                                        readonly>
                                    <input type="hidden" name="keys[]" value="{{ $question->key ?? 'faq_questions' }}"
                                        required readonly>
                                    <div class="col-lg-12 row mt-3">
                                        <div class="col-lg-8">
                                            <div>
                                                <label for="">{{ lang_db('Question') }}</label>
                                                <input type="text" class="form-control" name="values[]" id=""
                                                    value="{{ $question->value ?? '' }}"
                                                    placeholder="{{ lang_db('Enter Question') }}">
                                            </div>
                                            <div class="mt-3">
                                                <label for="">{{ lang_db('Answer') }}</label>
                                                <textarea name="optional_1[]" id="" class="form-control" cols="30" rows="10"
                                                    placeholder="{{ lang_db('Enter Answer') }}">{{ $question->optional_1 ?? '' }}</textarea>
                                            </div>

                                        </div>
                                        <div class="col-lg-2">
                                            <div class="col-lg-3 btn btn-danger"
                                                onclick="deleteFAQ('{{ $question->code }}', '{{ $question->value }}' )"
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
                                                    <h3 class="card-title font-size-16 mt-0 text-white">{{ $item->value }}
                                                    </h3>
                                                    <div class="card-text">

                                                        <div class="col-lg-12">
                                                            <label for="">{{ lang_db('Question') }}</label>
                                                            <input type="text" class="form-control"
                                                                name="language[{{ $item->optional_1 }}][value][]"
                                                                id=""
                                                                value="{{ $question->value ? lang_db($question->value, $type = -1, $locale = $item->optional_1) : '' }}"
                                                                placeholder="{{ lang_db('Enter Question') }}">
                                                        </div>
                                                        <div class="col-lg-12 mt-3">
                                                            <label for="">{{ lang_db('Introduction') }}</label>
                                                            <textarea name="language[{{ $item->optional_1 }}][optional_1][]" id="" cols="30" rows="10"
                                                                class="form-control" placeholder="{{ lang_db('Enter Answer') }}">{{ $question->optional_1 ? lang_db($question->optional_1, $type = -1, $locale = $item->optional_1) : '' }}</textarea>
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
        var addNewFaqCount = 0;

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

        function addNewFAQ() {
            var data = getOldValue();
            addNewFaqCount++;
            var html = `
                <div id="faq_question_${addNewFaqCount}" class="faq_questions">
                    <input type="hidden" name="codes[]" value="-1" required readonly>
                    <input type="hidden" name="keys[]" value="faq_questions" required readonly>
                    <div class="col-lg-12 row mt-3">
                        <div class="col-lg-8">
                            <div>
                                <label for="">{{ lang_db('Question') }}</label>
                                <input type="text" class="form-control" name="values[]" id="" value=""
                                    placeholder="{{ lang_db('Enter Question') }}">
                            </div>
                            <div class="mt-3">
                                <label for="">{{ lang_db('Answer') }}</label>
                                <textarea name="optional_1[]" id="" class="form-control" cols="30" rows="10"
                                    placeholder="{{ lang_db('Enter Answer') }}"></textarea>
                            </div>

                        </div>
                        <div class="col-lg-2">
                            <div class="col-lg-3 btn btn-danger"
                                onclick="cancelNewFAQ('${addNewFaqCount}')"
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
                                            <label for="">{{ lang_db('Question') }}</label>
                                            <input type="text" class="form-control" name="language[{{ $item->optional_1 }}][value][]" id="" value="" placeholder="{{ lang_db('Enter Question') }}">
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <label for="">{{ lang_db('Introduction') }}</label>
                                            <textarea name="language[{{ $item->optional_1 }}][optional_1][]" id="" cols="30" rows="10" class="form-control" placeholder="{{ lang_db('Enter Answer') }}"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
            @endforeach

            html += `</div>`

            document.getElementById('faqDivId').innerHTML += html;

            setOldValue(data);
        }

        function cancelNewFAQ(count) {
            document.getElementById('faq_question_' + count).remove();
        }

        function deleteFAQ(code, name) {
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
                    window.open(`{{ route('admin_page', ['params' => 'settings/faq/delete']) }}?code=${code}`,
                        '_self');
                }
            })
        }
    </script>
@endsection
