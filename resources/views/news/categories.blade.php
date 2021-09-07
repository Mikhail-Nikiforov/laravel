@extends('layouts.main')
@section('content')

    <div class="col-lg-4">
        <!-- Categories widget-->
        <div class="card mb-4">
            <div class="card-header">Categories</div>
            <div class="card-body">
                <div class="row">
                    <ul class="list-unstyled mb-0 d-flex flex-wrap justify-content-lg-between">
                        @forelse($categoriesList as $category)
                            <li>
                                <a href="<?=route('news.categories.showFiltered', ['category_id' => $category['id']])?>"><?=$category['ru']?></a>
                            </li>
                        @empty
                            <h2>Категорий нет</h2>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <!-- Side widget-->
        <div class="card mb-4">
            <div class="card-header">Side Widget</div>
            <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
        </div>
    </div>

@endsection



