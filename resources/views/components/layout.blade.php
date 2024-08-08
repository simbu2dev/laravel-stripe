<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List | {{ $title }}</title>

    <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5">
        <div class="container">
            
            <a class="navbar-brand" href="/"><img src="{{asset('images/logo.png')}}" alt="logo" ></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">                       
                    </li>                   
                </ul>
                <form class="d-flex" method="GET" action="/">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for product..." name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <button class="btn btn-danger" type="button" onclick="window.location.href='/'">
                            <i class="fa-solid fa-xmark"></i>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    {{ $slot }}

</body>

</html>