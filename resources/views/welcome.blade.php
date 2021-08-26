<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Second Boutique</title>

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

        <style>
            .card-size{
                width: 195px;
                height: 250px; 
            }
            .noti {
                position: relative;
                top: -8px;
            }
            .text-size{
                height: 36px;
                line-height: 18px;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 2;
                overflow: hidden;
                margin-bottom: 4px;
                font-size: 16px;
                }
            @media only screen and (max-width: 600px) {
                .card-size{
                    width: 10rem;
                    height: 14rem; 
                }
                .text-size{
                    height: 36px;
                    line-height: 18px;
                    display: -webkit-box;
                    -webkit-box-orient: vertical;
                    -webkit-line-clamp: 2;
                    overflow: hidden;
                    margin-bottom: 4px;
                    font-size: 15px;
                }
            }
        </style>
        
    </head>
    <body>
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <div class="card-body">
                <div class="float-right">
                    <a class="btn btn-dark" href="{{route('products.index')}}">Explore more products <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="container-fluid mt-3 mt-sm-0">
                        <div class="row row-cols-2 row-cols-md-6">
                        @foreach ($products as $product)
                            <div class="col mb-3">
                            <div class="card card-size">
                                @if($product->images->count() > 0)
                                <img src="{{asset('storage/images/'.$product->images->first()->name)}}" class="card-img-top" style="height: 60%;"  alt="...">
                                @else
                                <img src="{{asset('storage/images/16297091780.jpg')}}" class="card-img-top" style="height: 60%;"  alt="...">
                                @endif
                                <div class="card-body p-0">
                                    <h6 class="card-title mt-1 ml-1">{{$product->price}} mmk</h6>
                                    <div class="card-text ml-1 text-size">{{$product->name}}</div>
                                    <a href="{{route('products.show' , [$product->id])}}" class="stretched-link"></a>
                                </div>
                            </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {!! $products->withQueryString()->links() !!}
            
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function(){
                $(".card").hover(function(){
                $(this).addClass("text-white bg-dark");
                }, function(){
                $(this).removeClass("text-white bg-dark");
                });
            });
        </script>

    </body>
</html>
