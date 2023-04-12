<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
         @php $lang =  session('locale') @endphp
        <a class="navbar-brand" href="#">Hello {{ Auth::user()->name ?? 'Guest'  }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
                @guest
                <a class="nav-link" href="{{route('auth.create')}}">Registration</a>
                <a class="nav-link" href="{{route('login')}}">Login</a>
                @else
                <a class="nav-link" href="{{route('user.list')}}">Users</a>
                <a class="nav-link" href="{{route('blog.index')}}">Blogs</a>
                <a class="nav-link" href="{{route('logout')}}">Logout</a>
                @endguest
                <a class="nav-link" href="{{route('lang', 'fr')}}">Français</a>
                <a class="nav-link" href="{{route('lang', 'en')}}">English</a>
        </div>
        </div>
    </div>
    </nav>

    <div class="container">
        @if(session('success'))
        <div class="row justify-content-center mt-2 mb-1">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show">{{ session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif
        @yield('content')
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>
