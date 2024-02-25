<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/card.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary ">
        <a class="navbar-brand text-white" href="#">Navbar</a>

        <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active text-white" href="#">Home</a>
                <a class="nav-item nav-link active text-white" href="blogs">upload</a>
                <a class="nav-item nav-link active text-white" href="logout">logout</a>


            </div>
        </div>
    </nav>

    <section class="light">
        <div class="container py-2">
            <div class="h1 text-center text-dark" id="pageHeaderTitle">My Cards Light</div>
            @foreach ($Blog as $d)
                <article class="postcard light blue">
                    <a class="postcard__img_link" href="#">
                        <img class="postcard__img" src="https://picsum.photos/1000/1000" alt="Image Title" />
                    </a>
                    <div class="postcard__text t-dark">
                        <h1 class="postcard__title blue"><a href="#">{{ $d['title'] }}</a></h1>
                        <div class="postcard__subtitle small">
                            <time datetime="2020-05-25 12:00:00">
                                <i class="fas fa-calendar-alt mr-2"></i>Mon, May 25th 2020
                            </time>
                        </div>
                        <div class="postcard__bar"></div>
                        <div class="postcard__preview-txt">{{ $d['description'] }}</div>
                        <ul class="postcard__tagbox">
                            <li class="tag__item"><i class="fas fa-tag mr-2"></i>{{ $d['title'] }}</li>
                            <li class="tag__item"><i class="fas fa-clock mr-2"></i>{{ $d['title'] }}</li>
                        </ul>
                    </div>
                </article>
            @endforeach


        </div>
    </section>
</body>

</html>
