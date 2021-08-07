<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Second Boutique - @yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
      
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        
        @yield('css')
        <style>
            .noti {
                position: relative;
                top: -8px;
            }
        </style>
        
    </head>
    <body>
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            @if (!(request()->is('products')))
                <div class="row mb-3">
                    <div class="col-md-12">
                    <div class="card-header row">
                        <a class="ml-1 btn-back" href="#"><i class="fa fa-arrow-left text-black"></i></a>
                        <h5 class="card-title m-auto">@yield('page')</h5>
                    </div>
                    </div>
                </div> 
            @endif
            
            @if ($message = Session::get('invalid-data'))
                <div class="toast bg-dark text-white" style="position: absolute; top: 20; left: 0; z-index: 5;" data-delay="5000">
                    <div class="toast-header">
                        <strong class="mr-auto">Opps!!</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        {{$message}}
                    </div>
                </div>
            @endif
            @if ($message = Session::get('success'))
                <div class="toast bg-dark text-white" style="position: absolute; top: 20; left: 0; z-index: 5;" data-delay="5000">
                    <div class="toast-header">
                        <strong class="mr-auto">Bravo!!</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        {{$message}}
                    </div>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="toast bg-danger text-black" style="position: absolute; top: 20; left: 0; z-index: 5;" data-delay="5000">
                    <div class="toast-header">
                        <strong class="mr-auto">Sorry..</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        {{$message}}
                    </div>
                </div>
            @endif 
            
            @yield('content')
            
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

        @yield('script')
        <script>
            $(".btn-back").click(function (){
                window.history.back();
                });
            $('.toast').toast('show');
        </script>

    </body>
</html>
