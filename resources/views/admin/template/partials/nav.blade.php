<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#" tabindex="-1">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users.index') }}" tabindex="-1">Usuarios</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('categories.index') }}" tabindex="-1" >Categorias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" tabindex="-1" >Articulos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" tabindex="-1" >Imagenes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" tabindex="-1" >Tags</a>
        </li>
      </ul>

      <ul class="navbar-nav mr-5">
        <li class="nav-item">
            <a class="nav-link" href="#" tabindex="-1" >Página principal</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>

            </div>
          </li>
      </ul>



      {{-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form> --}}
    </div>
  </nav>
