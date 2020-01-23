@extends('layouts.back.app')

@section('title', 'Категории')

@push('css')
    <link href="{{ asset('/assets/back/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <ul>
                <li style="list-style: none">
                    <a class="btn bg-light-green waves-effect" href="{{ route('admincategory.create') }}"><i class="material-icons">add_circle</i> Новая Категория </a>
                </li>
            </ul>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Таблица Категорий
                            <span class="badge btn-info">{{ $categories->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>№ П/п</th>
                                    <th>Имя</th>
                                    <th>Количество Постов</th>
                                    <th>Создан</th>
                                    <th>Обновлен</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>№ П/п</th>
                                    <th>Имя</th>
                                    <th>Количество Постов</th>
                                    <th>Создан</th>
                                    <th>Обновлен</th>
                                    <th>Действие</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach( $categories as $key => $category )
                                <tr>

                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->posts->count() }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>{{ $category->updated_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admincategory.edit',$category->id) }}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">mode_edit</i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" onclick="deleteCategory({{ $category->id }})">
                                            <i class="material-icons">delete_forever</i>
                                        </button>
                                        <form id="delete-form-{{ $category->id }}" action="{{ route('admincategory.destroy', $category->id) }}" method="post" style="display: none;">
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
        function deleteCategory(id) {
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
