@extends('layouts.back.app')

@section('title', 'Подписчики')

@push('css')
    <link href="{{ asset('/assets/back/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Таблица Подписчиков
                            <span class="badge btn-info">{{ $subscribers->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Email</th>
                                    <th>Создан</th>
                                    <th>Обновлен</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>№</th>
                                    <th>Email</th>
                                    <th>Создан</th>
                                    <th>Обновлен</th>
                                    <th>Действие</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach( $subscribers as $key => $subscriber )
                                    <tr>

                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $subscriber->email }}</td>
                                        <td>{{ $subscriber->created_at }}</td>
                                        <td>{{ $subscriber->updated_at }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" onclick="deleteSubscriber({{ $subscriber->id }})">
                                                <i class="material-icons">delete_forever</i>
                                            </button>
                                            <form id="delete-form-{{ $subscriber->id }}" action="{{ route('adminsubscriber.destroy', $subscriber->id) }}" method="post" style="display: none;">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

    <script src="{{ asset('/assets/back/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('/assets/back/js/pages/tables/jquery-datatable.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        function deleteSubscriber(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Вы Уверены?',
                text: "Данные Восстановлению не Подлежат",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Да, Удалить',
                cancelButtonText: 'Отмена',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Отменено',
                        'Действие Успшно Отменено',
                        'error'
                    )
                }
            })
        }
    </script>

@endpush
