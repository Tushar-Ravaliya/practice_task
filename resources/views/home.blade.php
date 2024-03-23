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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.19.1/dist/css/uikit.min.css" />

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary ">
        <a class="navbar-brand text-white" href="#">Navbar</a>

        <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active text-white" href="#">Home</a>
                <a class="nav-item nav-link active text-white" href="blogs">upload</a>
                <a class="nav-item nav-link active text-white" href="blogs/{{ session('user_id') }}">your Blogs</a>
                <a class="nav-item nav-link active text-white" href="logout">logout</a>


            </div>
        </div>
    </nav>

    <section class="light">
        <div class="container py-2">
            <div class="h1 text-center text-dark" id="pageHeaderTitle">My Cards Light</div>
            @foreach ($blogs as $b)
                <article class="postcard  ">


                    @if ($b->images->count() > 0)
                        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1"
                            uk-slider="center: true">

                            <ul class="uk-slider-items uk-grid">
                                @foreach ($b->images as $image)
                                    <li class="uk-width-3-4">
                                        <div class="uk-panel">
                                            <img src="blogs_images/{{ $image['images'] }}" alt=""
                                                style="height: 300px;">

                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href
                                uk-slidenav-previous uk-slider-item="previous"></a>
                            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next
                                uk-slider-item="next"></a>

                        </div>
                    @endif

                    <div class="postcard__text t-dark">
                        <h1 class="postcard__title blue"><a href="#">{{ $b['title'] }}</a></h1>
                        <div class="postcard__subtitle small">
                            <time datetime="2020-05-25 12:00:00">
                                <i class="fas fa-calendar-alt mr-2"></i>{{ $b['created_at']->diffForHumans() }}
                            </time>
                        </div>
                        <div class="postca_bar"></div>
                        <div class="postcard__preview-txt">{{ $b['description'] }}</div>
                        @foreach ($b->links as $link)
                        <ul class="postcard__tagbox">
                            <li class="tag__item"><i class="fas fa-tag mr-2"></i>{{ $link['link_title'] }}</li>
                            <li class="tag__item"><i class="fas fa-clock mr-2"></i><a href="{{URL::to('/')}}/url/{{ $link['links'] }}" target="_blank">{{ $link['links'] }}</a></li>
                        </ul>
                            @endforeach
                    </div>
                </article>
            @endforeach

        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.19.1/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.19.1/dist/js/uikit-icons.min.js"></script>
</body>

</html>
