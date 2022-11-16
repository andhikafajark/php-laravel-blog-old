@extends('components.templates.admin')

@section('content')

    <h1 class="text-3xl font-bold text-gray-900 my-4">{{ $title }}</h1>
    <div class="w-full px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50">
        <form id="form" action="{{ route($route . '.update', $blogCategory) }}" method="post">

            @method('put')

            <div class="mb-4">
                <label for="title"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Title</label>
                <input type="text" id="title" name="title" value="{{ $blogCategory->title ?? '' }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Title">
                <label id="title-error" class="error" for="title"></label>
            </div>
            <div class="flex justify-end gap-1">
                <a href="{{ route($route . '.index') }}"
                   class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Back
                </a>
                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Save
                </button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            init()
        })

        function init() {
            handler()
        }

        function handler() {
            $('#form').validate({
                rules: {
                    title: {
                        required: true,
                        maxlength: 255
                    }
                },
                submitHandler: function (form, e) {
                    e.preventDefault()

                    const url = $(form).attr('action')
                    const method = $(form).attr('method')
                    const formData = new FormData(form)
                    const data = Object.fromEntries(formData.entries())

                    $.ajax({
                        url,
                        type: method,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: 'json',
                        data,
                        beforeSend: function () {
                            $(form).find('.error').hide()
                            $(form).find('button[type="submit"]').attr('disabled', true)
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        },
                        error: function (response) {
                            const responseJSON = response.responseJSON

                            if (response.status === 422) {
                                console.log(responseJSON)
                                for (const [key, value] of Object.entries(responseJSON?.data)) {
                                    $(form).find(`[name="${key}"]`).siblings('.error').html(value).show()
                                }
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: responseJSON.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        },
                        complete: function () {
                            $(form).find('button[type="submit"]').attr('disabled', false)
                        }
                    })
                }
            })
        }
    </script>

@endpush
