<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Изучаем основы</title>
    @vite(['resources/sass/app.scss'])
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav" style="background-color:#e3f2fd; margin:auto">
                    <!--a class="nav-link active" aria-current="page" href="#">Home</a-->
                    <a class="nav-link" href="{{ route('main.index') }}">Main</a>
                    <a class="nav-link" href="{{ route('post.index') }}">Posts</a>
                    <a class="nav-link" href="{{ route('contact.index') }}">Контакты</a>
                    <a class="nav-link" href="{{ route('about.index') }}">About</a>
                </div>
            </div>
        </div>
    </nav>
    <!--table class="table table-bordered table-success border-light text-center w-25" style="margin:10px auto">
        <tbody>
        <tr>
            <td><a href="{{ route('main.index') }}">Main</a></td>
            <td><a href="{{ route('post.index') }}">Posts</a></td>
            <td><a href="{{ route('contact.index') }}">Контакты</a></td>
            <td><a href="{{ route('about.index') }}">About</a></td>
        </tr>
        </tbody>
    </table-->
    @yield('content')
</div>
</body>
</html>