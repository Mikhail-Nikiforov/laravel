<div class="col-lg-4">
    <!-- Categories widget-->
    <div class="card mb-4">
        <div class="card-header">Categories</div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <ul class="list-unstyled mb-0">
                        <li><a href="#!">Web Design</a></li>
                        <li><a href="#!">HTML</a></li>
                        <li><a href="#!">Freebies</a></li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="list-unstyled mb-0">
                        <li><a href="#!">JavaScript</a></li>
                        <li><a href="#!">CSS</a></li>
                        <li><a href="#!">Tutorials</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Side widget-->
    <div class="card mb-4">
        <div class="card-header">Side Widget</div>
        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Форма обратной связи</div>
        <div class="card-body">
            <form method="post" action="{{ route('feedback') }}">
                @csrf
                <div class="form-group">
                    <label for="title">Ваше имя</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }} " required>
                </div>
                <div class="form-group">
                    <label for="title">Отзыв</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }} " required>
                </div>
                <button type="submit" class="btn btn-primary my-2">Сохранить</button>
            </form>
        </div>
    </div>
</div>
