@extends('layouts.admin')
@section('title') Список пользователей - @parent @stop
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Список пользователей</h1>
        <a href="{{ route('admin.users.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Добавить пользователя</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Имя</th>
                        <th>E-mail</th>
                        <th>Роль</th>
                        <th>Дата добавления</th>
                        <th>Управление</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->is_admin == 1)
                                    Администратор
                                @else
                                    Пользователь
                                @endif
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}">Ред.</a>
                                &nbsp;
                                <a href="javascript:;" class="delete" rel="{{ $user->id }}">Уд.</a>
                            </td>
                        </tr>
                    @empty
                        <h2>Пользователей нет</h2>
                    @endforelse

                    </tbody>

                </table>
                {!! $users->links() !!}
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
                        url: "/admin/users/" + id,
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
