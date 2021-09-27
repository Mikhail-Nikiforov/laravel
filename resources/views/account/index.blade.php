<div>
    <h3>Привет, {{ Auth::user()->name }}</h3>
    <br>
    @if(Auth::user()->is_admin)
        <a href="{{ route('admin.index') }}" style="color: red;">В админку</a>
    @endif
    <br>
    <a href="{{ route('logout') }}">Выход</a>
</div>
