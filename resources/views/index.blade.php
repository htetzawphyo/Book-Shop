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
    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <!-- Header-->
    <header class="bg-dark py-3 shadow-lg"> 
        <div class="container px-4 px-lg-5">
            <div class="text-center text-white pb-3 fst-italic text-opacity-75 textShadow">
                <h1 class="display-4 fw-bolder">အရောင်းရဆုံး စာအုပ်</h1>
            </div>
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-inner">
                    @foreach ($items as $key => $item)    
                        <div class=" carousel-item {{$key == 0 ? 'active' : '' }} text-center" >
                            <img src="{{ url('/images/'.$item->book->image) }}" class="h-25" alt="...">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($books as $book)
                    <div class="col mb-5">
                        <div class="card h-100 border-0">
                            <!-- Product image-->
                            <img src="{{ url('/images/'.$book->image) }}" alt="" class="card-img-top">
                            <!-- Product details-->
                            <div class="card-body p-2">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h6 class="text-start text-secondary">{{ $book->author->name }}</h6>
                                    <h5 class="fw-bolder">{{ $book->name }}</h5>
                                    <!-- Product price-->
                                    {{ $book->price }} (ကျပ်)
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer pt-0 border-top-0 bg-transparent">
                                <div class="">
                                    <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $book->id }}" name="bookId">
                                        <input type="hidden" value="{{ $book->name }}" name="name">
                                        <input type="hidden" value="{{ $book->price }}" name="price">
                                        <input type="hidden" value="{{ url('/images/'.$book->image) }}"  name="image">
                                        <input type="hidden" value="1" name="quantity">
                                        <button id="btn" class="btn btn-outline-dark mt-auto btn-sm mb-1 mb-md-0">Add To Cart <i class="bi-cart-fill"></i></button>
                                        <a href="/books/detail/{{$book->id}}" class="btn btn-outline-dark btn-sm">View >></a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $books->withQueryString()->links() }}
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
        // For logout
        function submitForm(){
            if(confirm('Are you sure you want to logout?')){
                document.getElementById('logout-form').submit();
            }
        }

        // Success Message
        @if (session('success'))
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
        @endif
    </script>


@endsection