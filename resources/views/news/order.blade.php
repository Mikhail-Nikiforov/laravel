@extends('layouts.main')
@section('title') Форма заказа - @parent @stop

@section('content')
    <!-- Page Heading -->
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-10">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Форма заказа</h1>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif
                        <form method="post" action="{{ route('order.new') }}">
                            @csrf
                            <div class="form-group">
                                <label for="customerName">Имя</label>
                                <input type="text" class="form-control" name="customerName" id="customerName" value="{{ old('customerName') }}">
                            </div>
                            <div class="form-group">
                                <label for="telephone">Номер телефона</label>
                                <input type="tel" class="form-control" name="telephone" id="telephone" value="{{ old('telephone') }}">
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail адрес</label>
                                <input type="email" class="form-control" name="email" id="email" value="{!! old('email') !!}">
                            </div>

                            <div class="form-group">
                                <label for="info">Какие данные вы хотите получить? Из какого источника?</label>
                                <textarea class="form-control" name="info" id="info">{!! old('info') !!}</textarea>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
