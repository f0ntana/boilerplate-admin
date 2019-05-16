<nav class="navbar navbar-expand-md navbar-light bg-white d-none d-md-flex">
    <div class="container-fluid">
        <a class="navbar-brand mr-auto" href="#!"></a>
        <div class="navbar-user">
            <div class="dropdown mr-4 d-none d-md-flex">
                <div class="dropdown">
                    <a href="#" class="avatar avatar-sm dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{url('img/logo.png')}}" alt="..." class="avatar-img rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#!" class="dropdown-item">Perfil</a>
                        <hr class="dropdown-divider">
                        <a href="{{ route('logout') }}" class="dropdown-item">Sair</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
