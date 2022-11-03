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
                    <li class="nav-item"><a class="nav-link {{Request::segment(1) == '' ? 'activeItem' : ''}}" aria-current="page" href="{{ route('index') }}">Home</a></li>
                    
                    <li class="nav-item dropdown {{Request::segment(1) == 'authors' ? 'activeItem' : ''}}">
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

    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ url('/images/'.$book->image) }}" alt="..." /></div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">{{ $book->name }}</h1>
                    <div class="fs-5 mb-1 pt-3">
                        <span class="">{{ $book->price }} (ကျပ်)</span>
                    </div>
                    
                    <div class="text-success mb-5">
                        {{ $book->quantity }} in stock
                    </div>
                    @if (Session::has('msg'))
                        <div class="alert alert-danger mb-4">
                            {{ Session::get('msg') }}
                        </div>
                    @endif

                    <div class="card-footer pt-0 border-top-0 bg-transparent d-flex">
                        <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $book->id }}" name="bookId">
                            <input type="hidden" value="{{ $book->name }}" name="name">
                            <input type="hidden" value="{{ $book->price }}" name="price">
                            <input type="hidden" value="{{ url('/images/'.$book->image) }}"  name="image">
                            <input type="hidden" value="1" >
                            <input type="number" class="shadow-none form-control text-center me-3 d-inline" id="inputQuantity" value="1" style="max-width: 4rem" min="1" name="quantity">
                            <button class="btn btn-outline-dark flex-shrink-0">Add To Cart <i class="bi-cart-fill"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            {{--  --}}
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4  d-flex flex-row flex-nowrap  overflow-auto">
                @foreach ($books as $book)
                    <div class="col mb-5">                        
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ url('/images/'.$book->image) }}" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $book->name }}</h5>
                                    <!-- Product price-->
                                    {{ $book->price }} (ကျပ်)
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $book->id }}" name="bookId">
                                        <input type="hidden" value="{{ $book->name }}" name="name">
                                        <input type="hidden" value="{{ $book->price }}" name="price">
                                        <input type="hidden" value="{{ url('/images/'.$book->image) }}"  name="image">
                                        <input type="hidden" value="1" name="quantity">
                                        <button id="btn" class="btn btn-outline-dark mt-auto">Add To Cart <i class="bi-cart-fill"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
        
@endsection

@section('footer')
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Book Shop 2022</p></div>
    </footer>
@endsection

@section('script')
    <script>
        function submitForm(){
            if(confirm('Are you sure you want to logout?')){
                document.getElementById('logout-form').submit();
            }
        }
    </script>
@endsection