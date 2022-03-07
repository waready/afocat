<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('home') }}">
        <i class="c-sidebar-nav-icon cil-home"></i>Home
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation" >
        <i class="c-sidebar-nav-icon cil-user"></i>Afiliaciones
        {{-- agregar icon dropdow --}}
    </a>
    <div class="collapse" id="navbarToggleExternalContent">
        <ul>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link c-active" href="{{ route('afiliaciones') }}">
                    <i class="c-sidebar-nav-icon cil-user"></i>Afiliados
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link c-active" href="{{ route('vehiculo') }}">
                    <i class="c-sidebar-nav-icon cil-user"></i>Vehiculos
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link c-active" href="{{ route('afocat') }}">
                    <i class="c-sidebar-nav-icon cil-user"></i>Afocats
                </a>
            </li>
        </ul>
    </div>
</li>
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('home') }}">
        <i class="c-sidebar-nav-icon cil-layers"></i>Siniestros
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('home') }}">
        <i class="c-sidebar-nav-icon cil-settings"></i>Configuracion
    </a>
</li>
