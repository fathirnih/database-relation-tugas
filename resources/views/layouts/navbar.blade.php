<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ url('/') }}">
      <span class="text-primary">King</span> Blog
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('posts*') ? 'active' : '' }}" href="{{ route('posts.index') }}">Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}" href="{{ url('/categories') }}">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
