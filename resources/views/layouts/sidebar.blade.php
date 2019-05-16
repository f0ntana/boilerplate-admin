<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="#">
            <img src="{{ url('img/logo.png') }}" class="navbar-brand-img mx-auto" alt="...">
        </a>

        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="{{ url('/') }}">
                        <i class="fe fe-home"></i> Dashboard
                    </a>
                </li>

                @if(Gate::check('users.index') || Gate::check('roles.index') || Gate::check('companies.index'))
                <li class="nav-item">
                    <a class="nav-link" href="#sidebarPages" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarPages">
                        <i class="fe fe-file"></i> Cadastros
                    </a>
                    <div id="sidebarPages" class="collapse {{ request()->is(['users', 'roles', 'companies']) ? 'show' : '' }}">
                        <ul class="nav nav-sm flex-column">
                            @can('roles.index')
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link {{ (request()->is('roles') ? 'active' : '') }}">
                                    <i class="fe fe-hash"></i> Papéis
                                </a>
                            </li>
                            @endcan

                            @can('users.index')
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link {{ (request()->is('users') ? 'active' : '') }}">
                                    <i class="fe fe-user"></i>Usuários
                                </a>
                            </li>
                            @endcan
                            @can('companies.index')
                            <li class="nav-item">
                                <a href="{{ route('companies.index') }}" class="nav-link {{ (request()->is('companies') ? 'active' : '') }}">
                                    <i class="fe fe-truck"></i> Empresas
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
