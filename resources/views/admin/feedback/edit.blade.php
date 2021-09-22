@extends('layouts.admin')
@section('title') Редактировать отзыв - @parent @stop

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Редактировать отзыв</h1>

    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('admin.feedback.update', ['feedback' => $feedback]) }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="customerName">Имя</label>
                    <input type="text" class="form-control" name="customerName" id="customerName" value="{{ $feedback->customerName }}">
                    @error('customerName') <div style="color:red;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="description">Отзыв</label>
                    <input type="text" class="form-control" name="description" id="description" value="{!! $feedback->description !!}">
                    @error('description') <div style="color:red;">{{ $message }}</div> @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

@endsection
