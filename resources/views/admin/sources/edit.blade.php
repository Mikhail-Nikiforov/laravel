@extends('layouts.admin')
@section('title') Редактировать источник - @parent @stop

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Редактировать источник</h1>

    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('admin.sources.update', ['source' => $source]) }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="name_source">Название</label>
                    <input type="text" class="form-control" name="name_source" id="name_source" value="{{ $source->name_source }}">
                    @error('name_source') <div style="color:red;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea class="form-control" name="description" id="description">{!! $source->description !!}</textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

@endsection
