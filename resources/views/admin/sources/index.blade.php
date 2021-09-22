@extends('layouts.admin')
@section('title') Список источников - @parent @stop
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Список источников</h1>
        <a href="{{ route('admin.sources.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Добавить источник</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Колл-во новостей</th>
                        <th>Название</th>
                        <th>Дата добавления</th>
                        <th>Управление</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($sources as $source)
                        <tr>
                            <td>{{ $source->id }}</td>
                            <td>{{ $source->news_count }}</td>
                            <td>{{ $source->name_source }}</td>
                            <td>{{ $source->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.sources.edit', ['source' => $source->id]) }}">Ред.</a>
                                &nbsp;
                                <a href="javascript:;" class="delete" rel="{{ $source->id }}">Уд.</a>
                            </td>
                        </tr>
                    @empty
                        <h2>Источников нет</h2>
                    @endforelse

                    </tbody>

                </table>
                {!! $sources->links() !!}
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
                        url: "/admin/sources/" + id,
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
