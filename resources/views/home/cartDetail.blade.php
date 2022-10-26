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
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
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

        // For Table

        // ======= Axios ======
        
        const i = 1;
        axios.get('/api/carts')
             .then( response => {
                 response.data.forEach( item => {
                     tableBody.innerHTML += `
                     <tr class="tableData" style="height: 100px">
                        <td>${i}</td>
                        <td class="titleList">` + `<img src="${item.image}" style="height: 100px">` + `</td>
                        <td class="descList">${item.name}</td>
                        <td class="descList">` + `<input type="number" class="shadow-none form-control text-center me-3" id="inputQuantity" value="${item.quantity}" style="max-width: 4rem" min="1" ">` + `</td>
                        <td class="descList">${item.price}</td>
                        <td>                           
                            
                            <button class="btn btn-danger btn-sm" onclick="deleteBtn(${item.id})">Clear</button>
                            </td>
                            </tr>
                            `
                            i++;
                })
             } )
             .catch( error => console.log(error) );
             
            
        
    </script>
    
@endsection