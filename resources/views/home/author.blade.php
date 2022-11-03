@extends('home.master')
@section('title', 'Book Shop')

@section('content')
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg sticky-top">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand logo" href="{{ route('index') }}">Book Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

                    <li class="nav-item"><a class="nav-link" aria-current="page" href="{{ route('index') }}">Home</a></li>
                    
                    <li class="nav-item dropdown @if(Request::segment(1) != 'about' && Request::segment(1) != '')
                                activeItem
                            @endif
                        ">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Authors</a>
                        <ul class="dropdown-menu scrollable-menu" aria-labelledby="navbarDropdown" >
                            @foreach ($authors as $author)
                            <li><a class="dropdown-item" href="/authors/{{ $author->id }}/books">{{ $author->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                </ul>
                {{-- Search Form --}}
                <form action="{{ route('index') }}" method="GET" class="mb-2 mb-md-0">
                    <div class="input-group">
                        <input type="search" id="form1" class="form-control shadow-none" name="query" placeholder="Search here......">
                        <button type="submit" class="btn btn-dark me-2">
                        <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
                <form action="{{ route('cart.list') }}" class="d-flex" method="GET">
                    @csrf
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">{{ Cart::getTotalQuantity(); }}</span>
                    </button>
                </form>

                {{-- login, logout --}}
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($data as $value)
                    <div class="col mb-5">
                        <div class="card h-100 border-0">
                            <!-- Product image-->
                            <img src="{{ url('/images/'.$value->image) }}" alt="" class="card-img-top">
                            <!-- Product details-->
                            <div class="card-body p-2">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h6 class="text-start text-secondary">{{ $value->author->name }}</h6>
                                    <h5 class="fw-bolder">{{ $value->name }}</h5>
                                    <!-- Product price-->
                                    {{ $value->price }} (ကျပ်)
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer pt-0 border-top-0 bg-transparent">
                                <div class="">
                                    <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $value->id }}" name="bookId">
                                        <input type="hidden" value="{{ $value->name }}" name="name">
                                        <input type="hidden" value="{{ $value->price }}" name="price">
                                        <input type="hidden" value="{{ url('/images/'.$value->image) }}"  name="image">
                                        <input type="hidden" value="1" name="quantity">
                                        <button id="btn" class="btn btn-outline-dark mt-auto btn-sm mb-1 mb-md-0">Add To Cart <i class="bi-cart-fill"></i></button>
                                        <a href="/books/detail/{{$value->id}}" class="btn btn-outline-dark btn-sm">View >></a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- {{ $data->links() }} --}}
        </div>
    </section>
        
@endsection

@section('footer')
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Book Shop 2022</p></div>
    </footer>
@endsection