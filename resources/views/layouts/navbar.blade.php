{{-- <nav class="navbar navbar-light bg-primary ">
  <div class="container">
    <a class="navbar-brand fw-bolder text-light" href="{{route('home')}}">
{{ config('', 'Cengkeh') }}
</a>
</div>
</nav> --}}

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-3 bg-body rounded">
    <div class="container-fluid">
        <form action="{{ route('search') }}" method="get">
            @csrf
            <input name="search" type="hidden" value="" class="form-control w-25" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-sm" style="outline: 0px !important; box-shadow:none;">
            <button type="submit" style="border: none" class="navbar-brand fw-bold fs-2  bg-transparent "
                onclick="window.location.reload(true)">{{ config('app.name', 'Laravel') }}</button>
        </form>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item mt-3">
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{Auth::user()->email}}">
                        <button class="btn btn-danger w-100">Keluar</button>
                    </form>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                {{-- <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li> --}}
                {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> --}}
        </div>
    </div>
</nav>
