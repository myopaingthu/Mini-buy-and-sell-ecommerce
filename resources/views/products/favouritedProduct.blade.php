@extends('layouts.app')

@section('title', 'Products')

@section('css')
<style>
    .card-size{
        width: 15rem;
        height: 18rem; 
    }
    .text-size{
            overflow: hidden;
            text-overflow: ellipsis;
        }
    @media only screen and (max-width: 600px) {
        .card-size{
        width: 10rem;
        height: 14rem; 
        }
        .text-size{
            font-size: 15px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    }
</style>
@endsection

@section('page')
Saved Products
<span class="badge badge-secondary">{{$products->count()}}</span>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="container-fluid mt-3 mt-sm-0">
            <div class="row row-cols-2 row-cols-md-5">
            @foreach ($products as $product)
                <div class="col mb-3">
                <div class="card card-size">
                    @if($product->images->count() > 0)
                    <img src="{{asset('images/'.$product->images->first()->name)}}" class="card-img-top" style="height: 50%;"  alt="...">
                    @else
                    <img src="{{asset('image/20210505144131.jpg')}}" class="card-img-top" style="max-height: 50%;"  alt="...">
                    @endif
                    <div class="card-body text-size">
                        <h6 class="card-title">{{$product->price}} mmk</h6>
                        <p class="card-text">{{$product->name}}</p>
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
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $(".card").hover(function(){
        $(this).addClass("text-white bg-dark");
        }, function(){
        $(this).removeClass("text-white bg-dark");
        });
    });
</script>
@endsection
