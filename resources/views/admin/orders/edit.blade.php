@extends('layouts.admin')
@section('title') Редактировать заказ - @parent @stop

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Редактировать заказ</h1>

    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('admin.orders.update', ['order' => $order]) }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="customerName">Имя заказчика</label>
                    <input type="text" class="form-control" name="customerName" id="customerName" value="{{ $order->customerName }}">
                    @error('customerName') <div style="color:red;">{{ $message }}</div> @enderror

                </div>

                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="tel" class="form-control" name="phone" id="phone" value="{{ $order->phone }}">
                    @error('phone') <div style="color:red;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ $order->email }}">
                    @error('email') <div style="color:red;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="description">Описание</label>
                    <input type="text" class="form-control" name="description" id="description" value="{{ $order->description }}">
                    @error('description') <div style="color:red;">{{ $message }}</div> @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

@endsection
