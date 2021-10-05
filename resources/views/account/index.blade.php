<div>
    <h3>Привет, {{ Auth::user()->name }}</h3>
    @if(Auth::user()->avatar)
        <br>
        <img src="{{ Auth::user()->avatar }}" style="width:200px;">
    @endif
    <br>
    @if(Auth::user()->is_admin)
        <a href="{{ route('admin.index') }}" style="color: red;">В админку</a>
    @endif
    <br>
    <a href="{{ route('logout') }}">Выход</a>
</div>
