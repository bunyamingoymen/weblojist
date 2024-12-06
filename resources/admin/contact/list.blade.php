@extends('admin.layouts.main')
@section('admin_index_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="ag-theme-quartz mt-2 mb-2" style="height: 500px;" id="myGrid"></div>

                    <div id="paginate"></div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ route('assetFile', ['folder' => 'admin/libs/jquery', 'filename' => 'jquery.min.js']) }}"></script>

    <script src="{{ route('assetFile', ['folder' => 'admin/js', 'filename' => 'pageTable.js']) }}"></script>

    <!--Silme sicript'i-->
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
    <!-- Sayfa Değiştirme Scripti-->
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
                            name: sendData(items[i].name),
                            email: sendData(items[i].email),
                            subject: sendData(items[i].subject),
                            text: sendData(items[i].text),
                        }

                        rowData.push(rowItem);
                    }

                    getOtherData(page_count, page);

                }
            });

        }
    </script>

    <!--Ag-gird Komutları-->
    <script>
        var columnDefs = [{
                headerName: "#",
                field: "id",
                maxWidth: 75,
            },
            {
                headerName: "{{ lang_db('Name') }}",
                field: "name",
            },
            {
                headerName: "{{ lang_db('E-Mail') }}",
                field: "email",
            },
            {
                headerName: "{{ lang_db('Subject') }}",
                field: "subject",
            },
            {
                headerName: "{{ lang_db('Message') }}",
                field: "text",
            },
            {
                headerName: "{{ lang_db('Actions') }}",
                field: "action",
                cellRenderer: function(params) {
                    var html = `<div class="row" style="justify-content: center;">`

                    html += `<div class="mr-2 ml-2">
                                    <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteItem('${params.data.code}', '${params.data.name}')" data-toggle="tooltip" data-placement="right" title="{{ lang_db('Delete') }}"><i class="fas fa-trash-alt"></i></a>
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
