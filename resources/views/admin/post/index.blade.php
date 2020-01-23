@extends('layouts.back.app')

@section('title', 'Посты')

@push('css')
    <link href="{{ asset('/assets/back/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <ul>
                <li style="list-style: none">
                    <a class="btn bg-light-green waves-effect" href="{{ route('adminpost.create') }}"><i class="material-icons">add_circle</i> Новый Пост </a>
                </li>
            </ul>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Таблица Постов
                            <span class="badge btn-info">{{ $posts->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>№ П/п</th>
                                    <th>Имя</th>
                                    <th>Автор</th>
                                    <th>Изображение</th>
                                    <th>Просмотры</th>
                                    <th>Статус</th>
                                    <th>Создан</th>
                                    <th>Обновлен</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>№ П/п</th>
                                    <th>Имя</th>
                                    <th>Автор</th>
                                    <th>Изображение</th>
                                    <th>Просмотры</th>
                                    <th>Статус</th>
                                    <th>Создан</th>
                                    <th>Обновлен</th>
                                    <th>Действие</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($posts as $key => $post)
                                <tr>

                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ str_limit($post->title, '10')}}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->image }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info waves-effect">{{ $post->view_count }}</button>
                                    </td>
                                    <td class="text-center">
                                        @if( $post->status == true )
                                            <button type="button" class="btn btn-success waves-effect">Одобрено</button>
                                        @else
                                            <button type="button" class="btn btn-danger waves-effect">Запрещено</button>
                                        @endif
                                    </td>

                                    <td>{{ $post->created_at }}</td>
                                    <td>{{ $post->updated_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('adminpost.edit',$post->id) }}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">mode_edit</i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" onclick="deletePost({{ $post->id }})">
                                            <i class="material-icons">delete_forever</i>
                                        </button>
                                        <form id="delete-form-{{ $post->id }}" action="{{ route('adminpost.destroy', $post->id) }}" method="post" style="display: none;">
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
        function deletePost(id) {
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
