@extends('layouts.admin')
@section('title') Добавить отзыв - @parent @stop

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Добавить отзыв</h1>

    </div>
    <div class="row">
        <div class="col-md-12">

            <form method="post" action="{{ route('admin.feedback.store') }}">
                @csrf

                <div class="form-group">
                    <label for="customerName">Имя</label>
                    <input type="text" class="form-control" name="customerName" id="customerName" value="{{ old('customerName') }}">
                    @error('customerName') <div style="color:red;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="description">Описание</label>
                    <input type="text" class="form-control" name="description" id="description" value="{!! old('description') !!}">
                    @error('description') <div style="color:red;">{{ $message }}</div> @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

@endsection
