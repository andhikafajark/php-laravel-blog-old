@extends('components.templates.admin')

@push('styles')

    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" rel="stylesheet">
    <style>
        #table_wrapper #table_length select {
            background-position: right 0.1rem center;
            padding-right: 1.5rem;
        }
    </style>

@endpush

@section('content')

    <h1 class="text-3xl font-bold text-gray-900 my-4">{{ $title }}</h1>
    <a href="{{ route($route . '.create') }}"
       class="inline-block text-blue-400 hover:text-white border border-blue-400 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-3 text-center dark:border-blue-300 dark:text-blue-300 dark:hover:text-white dark:hover:bg-blue-400 dark:focus:ring-blue-900">
        <i class="fas fa-pen"></i> Create
    </a>
    <div class="w-full px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50">
        <table id="table" class="stripe">
            <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>

@endsection

@push('scripts')

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function () {
            init()
        })

        function init() {
            datatables()
            handler()
        }

        function datatables(filter) {
            if (window.dataTable !== undefined) window.dataTable.destroy()

            window.dataTable = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route($route . '.datatables') }}',
                    data: {
                        filter
                    }
                },
                responsive: true,
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'dt-center'
                    },
                    {data: 'title', name: 'title', orderable: true, searchable: true},
                    {data: 'is_active', name: 'is_active', orderable: true, searchable: false, className: 'dt-center'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'flex justify-center items-center gap-1'
                    },
                ]
            })
        }

        function handler() {
            $('#table').on('click', '.delete', function () {
                const url = $(this).data('url')

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url,
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })

                                    datatables()
                                }
                            },
                            error: function (response) {
                                Swal.fire({
                                    icon: 'error',
                                    title: response?.responseJSON?.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        })
                    }
                })
            })
        }
    </script>

@endpush
