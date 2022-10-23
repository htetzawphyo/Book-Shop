@extends('home.master')

@section('title', 'About')

@section('content')

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg sticky-top">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand logo" href="{{ route('index') }}">Book Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="{{ route('index') }}">Home</a></li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Authors</a>
                        <ul class="dropdown-menu scrollable-menu" aria-labelledby="navbarDropdown" >
                            @foreach ($authors as $author)
                            <li><a class="dropdown-item" href="/authors/{{ $author->id }}/books">{{ $author->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link {{Request::segment(1) == 'about' ? 'activeItem' : ''}}" href="{{ route('about') }}">About</a></li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="card m-5 h-100vh">
        <div class="card-body py-5 lh-lg ">
            <p>
                &emsp;&emsp; Book Shop website သည် မိတ်ဆွေတို့အတွက် အသုံးပြုရ လွယ်ကူစေရန်နှင့် အသုံးပြုရ မြန်ဆန်သွက်လက်နေအောင် ပြုလုပ်ထားသဖြင့် မိတ်ဆွေတို့အနေနှင့် ဤ website အား
                သုံးစွဲရာတွင် ကျေနပ်လိမ့်မည်ဟု မျှော်လင့်ပါတယ်ခင်ဗျာ။
                တစ်နေရာထဲမှာ ဈေးနှုန်းသက်သာပြီး စာအုပ်မျိုးစုံကို ဝယ်ယူလိုသော မိတ်ဆွေတို့အတွက်လည်း Book Shop မှ ကြိုဆိုပါအပ်ပါတယ်ခင်ဗျာ။
            </p>
            <p>
                &emsp;&emsp; Book Shop စာပေမှ စာအုပ်များသည် တစ်နိုင်ငံလုံးသို့ ဈေးနှုန်းသက်သာစွာဖြင့် ရောင်ချပေးလျက် ရှိပါသည်။
                မိတ်ဆွေတို့အတွက် သုတ၊ ရသ စုံလင်စွာ ခံစားနိုင်ဖို့အတွက် ကျွန်တော်တို့ Book Shop website သည် မိတ်ဆွေတို့နှင့်အတူ အမြဲအတူရှိနေပါတယ်ခင်ဗျာ။
                ဝယ်ယူရရှိနိုင်သော စာအုပ်များမှာ - ဘာသာရေး၊ ကျန်းမာရေး၊ အလှအပ၊ ဆေးပညာ၊ ဘာသာပြန်၊ တက်ကျမ်း၊ သုတ၊ ရသ၊ ကဗျာ၊ သမိုင်း၊ ရာဇဝင်၊ အတ္ထုပ္ပတ္တိ၊ ကာတွန်း၊ ပုံပြင်၊ ပန်းချီ၊ အားကစား၊ ဂီတ၊ ဗေဒင်၊
                လက္ခဏာ၊ မွေးမြူရေး၊ စိုက်ပျိုးရေး၊ အိမ်တွင်းမှု၊ နည်းပညာ၊ အတတ်ပညာ၊ ဥပဒေရေးရာ၊ ရေကြောင်းဆိုင်ရာ၊ လစဥ်အပါတ်ထုတ် ဂျာနယ်မဂ္ဂဇင်းများ၊ သင်ရိုးညွှန်းတမ်းစာအုပ်များ ရရှိနိုင်ပါတယ်ခင်ဗျာ။
            </p>
            <p>
                &emsp;&emsp; မိတ်ဆွေတို့အနေနှင့် ဤ website အား အသုံးပြုရာတွင် တစုံတရာ အခက်အခဲများ ရှိလာပါကလည်း ကျွန်တော့်တို့ customer servic mail တို့ အကြောင်းအရာစုံလင်စွာ တင်ပြထားနိုင်ပါတယ်။
                ကျွန်တော်တို့ customer service team ဘက်ကအနေနဲ့ မိတ်ဆွေတို့ကို အချိန်မရွေး ပြန်လှည်အကူအညီပေးနိုင်ရန် အသင့်ရှိနေပါတယ်ခင်ဗျ။
                မိတ်ဆွေတို့ အနေနှင့် သိရှိလိုသည့် အကြောင်းအရာ ပေါ်ပေါက်လာပါကလည်း ဖုန်းဖြင့်ဆက်၍သော်လည်းကောင်း၊ email ဖြင့် ဆက်သွယ်၍သော်လည်းကောင်း အချိန်မရွေး ဆက်သွယ်မေးမြန်နိုင်ပါတယ်ခင်ဗျာ။ သည့်အတွက်လည်း
                ကျွန်တော်တို့ဘက်ကအနေနှင့် မိတ်ဆွေတို့ကို ဖြေကြားပေးဖို့ အသင့်ရှိနေပါတယ်ခင်ဗျာ။
            </p>
        </div>
    </div>
@endsection