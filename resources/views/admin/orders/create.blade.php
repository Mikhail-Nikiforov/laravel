@extends('layouts.admin')
@section('title') Добавить заказ - @parent @stop

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Добавить заказ</h1>

    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('admin.orders.store') }}">
                @csrf

                <div class="form-group">
                    <label for="customerName">Имя заказчика</label>
                    <input type="text" class="form-control" name="customerName" id="customerName" value="{{ old('customerName') }}">
                    @error('customerName') <div style="color:red;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="tel" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                    @error('phone') <div style="color:red;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                    @error('email') <div style="color:red;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="description">Описание</label>
                    <input type="text" class="form-control" name="description" id="description" value="{{ old('description') }}">
                    @error('description') <div style="color:red;">{{ $message }}</div> @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

@endsection
@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
