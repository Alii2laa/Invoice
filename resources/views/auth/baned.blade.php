@extends('layouts.master2')

@section('title')
    تسجيل الدخول
@stop

@section('style')
    <style>
        .btns{
            display: flex;
            justify-content: space-around;
            margin-top: 25px;
        }


        html,body{
            width: 100%;
            height: 100%;
            margin: 0!important;
        }

        *{
            box-sizing: border-box;
        }
        #app{
            background: black;
            display: flex;
            height: 100%;
            justify-content: center;
            align-items: center;
            color: #54FE55;
            text-shadow: 0px 0px 10px ;
            font-size: 6rem;
            flex-direction: column;

        }
        .txt {
            font-size: 1.8rem;
        }
        @keyframes blink {
            0%   {opacity: 0}
            49%  {opacity: 0}
            50%  {opacity: 1}
            100% {opacity: 1}
        }

        .blink {
            animation-name: blink;
            animation-duration: .8s;
            animation-iteration-count: infinite;
        }
    </style>
@endsection

@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')

    <div id="app">
        <div class="blink">إيقاف مؤقت !!</div>
        <div class="txt">
            عفواً هذا الحساب موقف مؤقتاً برجاء التواصل مع الادمن<span class="blink">_</span>
            <div class="btns">
                <a class='btn btn-primary' href='mailto:someone@yoursite.com'>تواصل معنا</a>
                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">تسجيل خروج <i class="bx bx-log-out"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>

@endsection
@section('js')
@endsection
