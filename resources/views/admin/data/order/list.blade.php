@extends('admin.layouts.main')
@section('admin_index_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12" style="display: inline-block;">
                        <a class="btn btn-primary mb-3" style="float: right;"
                            href="{{ route('admin_page', ['params' => $params . '/edit']) }}">
                            <i class="mdi mdi-plus-circle-outline"></i> Yeni
                        </a>
                    </div>

                    <div class="ag-theme-quartz mt-2 mb-2" style="height: 500px;" id="myGrid"></div>

                    <div id="paginate"></div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ route('assetFile', ['folder' => 'admin/libs/jquery', 'filename' => 'jquery.min.js']) }}"></script>

    <script src="{{ route('assetFile', ['folder' => 'admin/js', 'filename' => 'pageTable.js']) }}"></script>

    <script>
        function deleteItem(code, name) {
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
                    window.open(`{{ route('admin_page', ['params' => $params . '/delete']) }}?code=${code}`,
                        '_self');
                }
            })
        }
    </script>

    <script>
        function changePage(page) {
            var pageData = {
                page: page,
            }

            if (showingCount && showingCount != 10) {
                pageData.showingCount = showingCount;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                type: 'POST',
                url: `{{ route('admin_page', ['params' => $params]) }}`,
                data: pageData,
                success: function(response) {
                    var id = page <= 1 ? 1 : (page - 1) * showingCount + 1;
                    rowData = [];
                    var items = response.items;
                    var page_count = response.pageCount;
                    for (let i = 0; i < items.length; i++) {
                        var rowItem = {
                            id: id++,
                            code: sendData(items[i].code),
                            order_code: sendData(items[i].order_code),
                            status: sendData(items[i].status),
                            user_code: sendData(items[i].user_code),
                            user_name: sendData(items[i].user_name),
                            payment_method: sendData(items[i].payment_method),
                            price: sendData(items[i].price),
                            cargo_price: sendData(items[i].cargo_price),
                        }

                        rowData.push(rowItem);
                    }

                    getOtherData(page_count, page);

                }
            });

        }
    </script>


    <script>
        var columnDefs = [{
                headerName: "#",
                field: "id",
                maxWidth: 75,
            },
            {
                headerName: "{{ lang_db('Order Code') }}",
                field: "order_code",
                cellRenderer: function(params) {
                    return "#" + params.value;
                }
            },

            {
                headerName: "{{ lang_db('Name') }}",
                field: "user_name",
            },

            {
                headerName: "{{ lang_db('Name') }}",
                field: "payment_method",
                cellRenderer: function(params) {
                    var html = '';
                    if (params.value == 'Money Order')
                        html = "{{ lang_db('Money Order') }}";
                    else if (params.value == 'Credit Cart') {
                        html = "{{ lang_db('Credit Cart') }}";
                    } else html = params.value;
                    return html;
                }
            },

            {
                headerName: "{{ lang_db('Price') }}",
                field: "price",
            },
            {
                headerName: "{{ lang_db('Status') }}",
                field: "status",
                cellRenderer: function(params) {
                    var html = '';
                    if (params.value == '-1')
                        html = `<span class="badge badge-danger">{{ lang_db('Cancelled') }}</span>`;
                    else if (params.value == '0')
                        html = `<span class="badge badge-warning">{{ lang_db('Awaiting payment') }}</span>`;
                    else if (params.value == '1')
                        html = `<span class="badge badge-secondary">{{ lang_db('Awaiting Approval') }}</span>`;
                    else if (params.value == '2')
                        html = `<span class="badge badge-info">{{ lang_db('Getting ready') }}</span>`;
                    else if (params.value == '3')
                        html = `<span class="badge badge-primary">{{ lang_db('Shipped') }}</span>`;
                    else if (params.value == '4')
                        html = `<span class="badge badge-success">{{ lang_db('Delivered') }}</span>`;
                    else html = params.value;
                    return html;
                }
            },

            {
                headerName: "{{ lang_db('Actions') }}",
                field: "action",
                cellRenderer: function(params) {
                    var html = `<div class="row" style="justify-content: center;">`

                    html += `<div class="mr-2 ml-2">
                                    <a class="btn btn-warning btn-sm" href="{{ route('admin_page', ['params' => $params . '/edit']) }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="{{ lang_db('Update') }}"><i class="fas fa-edit"></i></a>
                                </div>`

                    html += `<div class="mr-2 ml-2">
                                    <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteItem('${params.data.code}', '${params.data.title}')" data-toggle="tooltip" data-placement="right" title="{{ lang_db('Delete') }}"><i class="fas fa-trash-alt"></i></a>
                                </div>`

                    html += `</div>`;

                    return html;
                },
                filter: false,
                cellEditorPopup: true,
                cellEditor: 'agSelectCellEditor',
                maxWidth: 125,
                minWidth: 125,
            },

        ]
        gridOptionsData(columnDefs);
        changePage(1);
    </script>
@endsection
