<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/card.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary ">
        <a class="navbar-brand text-white" href="#">Navbar</a>

        <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active text-white" href="#">Home</a>
                <a class="nav-item nav-link active text-white" href="blogs">upload</a>
                <a class="nav-item nav-link active text-white" href="blogs/{{session('user_id')}}">your Blogs</a>
                <a class="nav-item nav-link active text-white" href="logout">logout</a>


            </div>
        </div>
    </nav>

    <section class="light">
        <div class="container py-2">
            <div class="h1 text-center text-dark" id="pageHeaderTitle">My Cards Light</div>
            @foreach ($blogs as $b)
                <article class="postcard light blue">
                    {{-- Displaying Images --}}
                    <div id="carouselExampleControls" class="carousel slide w-75" data-ride="carousel">
                        <div class="carousel-inner">
                    @if ($b->images->count() > 0)
                            @foreach ($b->images as $image)
                            <div class="carousel-item card ">
                                <img src="blogs_images/{{$image['images']}}" class="d-block w-100 " alt="{{$image['images']}}">
                              </div>
                            @endforeach
                            @endif
                         
                                  
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="sr-only">Next</span>
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </a>
                              </div>
                    
                    <div class="postcard__text t-dark">
                        <h1 class="postcard__title blue"><a href="#">{{ $b['title'] }}</a></h1>
                        <div class="postcard__subtitle small">
                            <time datetime="2020-05-25 12:00:00">
                                <i class="fas fa-calendar-alt mr-2"></i>{{ $b['created_at']->diffForHumans() }}
                            </time>
                        </div>
                        <div class="postca_bar"></div>
                        <div class="postcard__preview-txt">{{ $b['description'] }}</div>
                        <ul class="postcard__tagbox">
                            <li class="tag__item"><i class="fas fa-tag mr-2"></i>{{ $b['link_title'] }}</li>
                            <li class="tag__item"><i class="fas fa-clock mr-2"></i>{{ $b['title'] }}</li>
                        </ul>
                    </div>
                </article>
                <script>
                    let card = document.getElementsByClassName('card');
                    console.log(card);
                    card[0].classList.add('active')
                    card[3].classList.add('active')
                    console.log(card);
                </script>
            @endforeach

        </div>
    </section>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
