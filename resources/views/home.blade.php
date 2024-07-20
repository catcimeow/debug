@extends('layouts.app')

@section('content')
<style>
html, body {
    height: 100%;
    width: 100%;
    overflow: hidden; /* Prevents scrolling */
}

.container-fluid {
    height: 100%;
    width: 100%;
}

.carousel,
.carousel-inner,
.carousel-item,
.carousel-item img,
.carousel-item video {
    height: 100%;
    width: 100%;
}

.carousel-caption {
    top: 50%;
    transform: translateY(-50%);
    text-align: center;
    color: white;
    z-index: 2;
}

.welcome-message {
    position: absolute;
    top: 20px;
    left: 20px;
    font-size: 2rem;
    color: black;
    z-index: 2;
}

.carousel-item::before {
    content: ""; 
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.2); /* Adjust the opacity as needed */
    z-index: 1;
}
  
</style>
<div class="container-fluid p-0">
    @if(session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @endif

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="1000">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <video autoplay muted loop class="d-block w-100 h-100">
                    <source src="uploaded_files/cover.mp4" type="video/mp4">
                </video>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('uploaded_files/cake1.jpg') }}" class="d-block w-100 h-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('uploaded_files/cake2.jpg') }}" class="d-block w-100 h-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('uploaded_files/cake3.jpg') }}" class="d-block w-100 h-100" alt="Slide 3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

        <div class="carousel-caption d-none d-md-block text-black">
            <p class="text-lg">Indulge in the heavenly delights of our pastry goods,<br> where each bite is a celebration of flavor, texture, and artistry.</p>
            @if (!auth()->check() || !auth()->user()->is_admin )
                <div class="mt-10">
                    <a href="{{route('welcome')}}" class="btn bg-yellow-300 rounded-3xl py-3 px-8 font-medium inline-block mr-4 hover:bg-transparent hover:border-yellow-300 hover:text-white duration-300 hover border border-transparent">Order Now</a>
                </div>
            @endif
        </div>
    </div>

    <h1 class="welcome-message">Welcome 
        @if (auth()->check())
            @if (auth()->user()->is_admin)
                Admin
            @else
                to Cooking <br>Mamau Shop
            @endif
        @else
            to Cooking <br> Mamau Shop
        @endif
    </h1>
</div>
@endsection