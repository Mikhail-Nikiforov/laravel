@extends('layouts.admin')
@section('title') Список ресурсов - @parent @stop
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Список ресурсов</h1>
        <a href="{{ route('admin.resources.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Добавить ресурс</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Название</th>
                        <th>Ссылка</th>
                        <th>Дата добавления</th>
                        <th>Управление</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($resources as $resource)
                        <tr>
                            <td>{{ $resource->id }}</td>
                            <td>{{ $resource->title }}</td>
                            <td>{{ $resource->link }}</td>
                            <td>{{ $resource->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.resources.edit', ['resource' => $resource->id]) }}">Ред.</a>
                                &nbsp;
                                <a href="javascript:;" class="delete" rel="{{ $resource->id }}">Уд.</a>
                            </td>
                        </tr>
                    @empty
                        <h2>Ресурсов нет</h2>
                    @endforelse

                    </tbody>

                </table>
                {!! $resources->links() !!}
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(function() {
            $(".delete").on('click', function() {
                var id = $(this).attr("rel");
                if(confirm("Подтверждаете удаление записи с #ID " + id)) {
                    $.ajax({
                        type: "delete",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/admin/resources/" + id,
                        success: function (response) {
                            alert("Запись успешно удалена");
                            console.log(response);
                            location.reload();
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }
            });
        });
    </script>
@endpush
