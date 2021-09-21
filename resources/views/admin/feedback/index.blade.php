@extends('layouts.admin')
@section('title') Список заказов - @parent @stop
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Список заказов</h1>
        <a href="{{ route('admin.orders.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Добавить заказ</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Имя заказчика</th>
                        <th>Описание</th>
                        <th>Дата добавления</th>
                        <th>Управление</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($feedbackList as $feedback)
                        <tr>
                            <td>{{ $feedback->id }}</td>
                            <td>{{ $feedback->customerName }}</td>
                            <td>{{ $feedback->description }}</td>
                            <td>{{ $feedback->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.feedback.edit', ['feedback' => $feedback->id]) }}">Ред.</a>
                                &nbsp;
                                <a href="">Уд.</a>
                            </td>
                        </tr>
                    @empty
                        <h2>Заказов нет</h2>
                    @endforelse

                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
