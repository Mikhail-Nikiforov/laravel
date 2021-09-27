@extends('layouts.admin')
@section('title') Добавить пользователя - @parent @stop

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Добавить пользователя</h1>

    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('admin.users.store') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                    @error('name') <div style="color:red;">{{ $message }}</div> @enderror

                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                    @error('email') <div style="color:red;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="tel" class="form-control" name="password" id="password" value="{{ old('password') }}">
                    @error('password') <div style="color:red;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="is_admin">Администратор</label>
                    <input type="checkbox" style="width: 30px; margin: 1px" class="form-control" name="is_admin" id="is_admin" value="1" @if(old('is_admin') == 1) checked @endif>
                    @error('is_admin') <div style="color:red;">{{ $message }}</div> @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

@endsection
