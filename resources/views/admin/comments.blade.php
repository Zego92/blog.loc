
@extends('layouts.back.app')

@section('title', 'Комментарии')

@push('css')
    <link href="{{ asset('/assets/back/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css">
@endpush

@section('content')
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Комментарии
                            <span class="badge btn-info">{{ $comments->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th class="text-center">Комментарий</th>
                                    <th class="text-center">Запись</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th class="text-center">Комментарий</th>
                                    <th class="text-center">Запись</th>
                                    <th>Действие</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($comments as $key => $comment)
                                    <tr>
                                        <td style="width: 45%">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a target="_blank" href="{{ route('post.details', $comment->post->slug) }}">
                                                        <img height="10%" class="media-object" src="{{ asset('/uploads/img/post/' . $comment->post->image) }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body text-right">
                                                    <h4 class="media-heading">
                                                        {{ $comment->user->name }}
                                                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                                                    </h4>
                                                    <p>{{ $comment->comment }}</p>
                                                    <a target="_blank" href="{{ route('post.details', $comment->post->slug . '#comments') }}"></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 45%">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a target="_blank" href="{{ route('post.details', $comment->post->slug) }}">
                                                        <img height="10%" class="media-object" src="{{ asset('/uploads/img/post/' . $comment->post->image) }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body text-right">
                                                    <a target="_blank" href="{{ route('post.details', $comment->post->slug . '#comments') }}">
                                                        <h4 class="media-heading">{{ str_limit($comment->post->title, '40') }}</h4>
                                                    </a>
                                                    <p><strong>{{ $comment->post->user->name }}</strong></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" onclick="deleteComment({{ $comment->id }})">
                                                <i class="material-icons">delete_forever</i>
                                            </button>
                                            <form id="delete-form-{{ $comment->id }}" action="{{ route('admincomment.destroy', $comment->id) }}" method="post" style="display: none;">
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
        function deleteComment(id) {
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
