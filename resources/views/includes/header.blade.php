<nav class="navbar navbar-expand-md bg-body-tertiary shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home.index') }}">
      dmisl
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form method="POST" action="{{ route('search') }}" class="d-flex" role="search">
        @csrf
        <input name="search" class="search form-control me-auto rounded-pill p-2 bg-grey border-0" type="search" placeholder="{{ __('Пошук') }}" aria-label="Search">
      </form>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item bg-grey rounded-circle me-2">
          <a class="nav-link active" aria-current="page" href="#"><img class="navbar-img" src="{{ asset('chat.png') }}"></a>
        </li>
        <li class="nav-item dropdown bg-grey rounded-circle me-2">
          <div class="btn-group dropstart">
            <a class="nav-link" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="navbar-img" src="{{ asset('/storage/avatar-'.auth()->user()->id.'.png') }}" alt="">
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="{{ route('profile.index') }}">
                  {{ __('Профіль') }}
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                  {{ __('Вийти') }}
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
