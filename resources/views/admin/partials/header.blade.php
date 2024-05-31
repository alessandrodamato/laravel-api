<header>
  <nav class="navbar py-3 navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link me-3" href="{{route('home')}}">Vai al sito pubblico</a>
          </li>
          <li class="nav-item me-3">
            <a class="nav-link" href="{{route('admin.dashboard')}}">Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <button class="btn nav-link dropdown-toggle border-0" data-bs-toggle="dropdown" aria-expanded="false">
              Gestione
            </button>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{route('admin.projects.index')}}">Progetti</a></li>
              <li><a class="dropdown-item" href="{{route('admin.technologies-projects')}}">Progetti suddivisi per tecnologia</a></li>
              <li><a class="dropdown-item" href="{{route('admin.types-projects')}}">Progetti suddivisi per tipo</a></li>
              <li><a class="dropdown-item" href="{{route('admin.technologies.index')}}">Tecnologie</a></li>
              <li><a class="dropdown-item" href="{{route('admin.types.index')}}">Tipi</a></li>
            </ul>
          </li>
        </ul>
        <form action="{{route('logout')}}" method="POST" class="d-flex" role="search">
          @csrf
          <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-user"></i><span class="ms-2">{{Auth::user()->name}}</span>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{route('admin.profile')}}">Profilo</a></li>
              <li><a class="dropdown-item" href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li><button class="dropdown-item" type="submit">Logout</button></li>
            </ul>
          </div>
          <button class="btn btn-danger ms-3" type="submit"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
        </form>
      </div>
    </div>
  </nav>
</header>
