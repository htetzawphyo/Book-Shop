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

                {{-- Cart total quantity --}}
                <form action="{{ route('cart.list') }}" class="d-flex me-3" method="GET">
                    @csrf
                    <button class="btn btn-outline-dark p-1" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">{{ Cart::getTotalQuantity(); }}</span>
                    </button>
                </form>

                {{-- login, logout --}}
                <ul class="navbar-nav">
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

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card my-5">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>quantity</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php 
                                    $i = 1;
                                ?>
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td>{{ $i; }}</td>
                                        <td><img src="{{$item->attributes->image}}" style="height: 100px"></td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <form action="{{ route('cart.update') }}" method="POST" name="submit">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id}}" >
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="max-width: 4rem"
                                                     class="shadow-none form-control text-center me-3" onchange="autoSubmit()" readonly>
                                            </form>
                                        </td>
                                        <td id="total">{{ $item->quantity * $item->price }}</td>
                                        <td>
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}" name="id">
                                                <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i> Clear  </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php 
                                        $i++;
                                    ?>
                                @endforeach
                                <tr>
                                    <th scope="row"></th>
                                    <td colspan="2" class="text-center fw-bold">Total</td>
                                    <td class="fw-bold">{{ Cart::getTotalQuantity(); }}</td>
                                    <td class="fw-bold">{{ Cart::getSubTotal() }}</td>
                                    <td>
                                        <form action="{{ route('cart.clear') }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i> Clear All</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2">
                                        <form action="{{ route('order') }}" method="POST">
                                            @csrf
                                            <button class="btn btn-dark" type="submit">Order Now >> <i class="bi-cart-fill me-1"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        // For logout
        function submitForm(){
            if(confirm('Are you sure you want to logout?')){
                document.getElementById('logout-form').submit();
            }
        }

        function autoSubmit(){
            document.forms['submit'].submit();
        }      
        
    </script>
    
@endsection