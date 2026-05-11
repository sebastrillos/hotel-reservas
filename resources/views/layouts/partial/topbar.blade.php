<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        @php
            $user = Auth::user();
            $userPhoto = ($user && $user->photo) 
                ? asset('uploads/users/' . $user->photo) 
                : asset('backend/dist/img/user2-160x160.jpg');
        @endphp

        <div class="user-panel mt-2 pb-3 d-flex">
            <div class="image">
                <img src="{{ $userPhoto }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info" style="color:#6c757d">
                {{-- Validamos el nombre para que no explote en el error 404 --}}
                {{ $user ? $user->name : 'Invitado' }}
            </div>
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               title="Cerrar Sesión" role="button">
                <i class='fas fa-power-off' style='font-size:24px; color:red'></i>
            </a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
                @csrf
            </form>
        </li>
    </ul>
</nav>