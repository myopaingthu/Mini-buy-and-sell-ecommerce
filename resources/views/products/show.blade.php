@extends('layouts.app')

@section('css')
<style>
    .w-100
    {
      width: 100% !important;
      height: 75vh;
    }
    .card-size{
        width: 200px;
        height: 250px; 
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
      .w-100
    {
      height: 50vh;
    }
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
@endsection

@section('page', 'Product Detail')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          @if ($product->images->isNotEmpty())
            @foreach ($product->images as $key => $value)
            <div class="carousel-item {{$key == 0? 'active':''}}" style="height: 100%;">
                <img src="{{asset('storage/images/'.$value->name)}}" class="d-block w-100" alt="..."> 
            </div>
            @endforeach
          @else
                <img src="https://ui-avatars.com/api/?name={{$product->name}}" class="d-block w-100" alt="...">
          @endif
        </div>
        <a class="carousel-control-prev bg-secondary" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next bg-secondary" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    </div>
    @if (auth()->user()->id == $product->user_id)
      <div class="card">
        <div class="card-body text-center">
          <form action="{{route('products.destroy', [$product->id])}}" method="POST">
            @method('DELETE')
            @csrf
            <a href="{{route('products.edit', [$product->id])}}" class="btn btn-dark">Edit <i class="fa fa-edit"></i></a>
            <button type="submit" class="btn btn-dark">Delete <i class="fa fa-trash-alt"></i></button>
        </form>
        </div>
      </div>
    @endif
    </div>
    <div class="col-md-8">
      <div class="card mb-2">
        <div class="card-body p-4">
          <div class="form-group row">
            <div class="col-md-8">
              <h3 class="card-title">{{$product->name}}</h3>
              <span class="text-muted">{{$product->category->name}}</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-2">
              <h6 class="card-title">Asked price</h6>
            </div>
            <div class="col-md-6">
              <p class="card-text">{{$product->price}} MMK</p>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12 bg-light">
              {{$product->description}}
            </div>
          </div>
          <hr>
          <div class="row justify-content-center">
            <h5 class="car-title">Contact information</h5>
          </div>
          <div class="form-group row">
            <div class="col-md-2">
              <h6 class="card-title">Seller name</h6>
            </div>
            <div class="col-md-10">
              <p class="card-text">{{$product->user->role_id == 1 ? 'Second Boutique' : $product->user->name}}</p>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-2">
              <h6 class="card-title">Phone</h6>
            </div>
            <div class="col-md-10">
              <p class="card-text">{{$product->phone}}</p>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-2">
              <h6 class="card-title">From</h6>
            </div>
            <div class="col-md-10">
              <p class="card-text">{{$product->address}}</p>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-2">
              <h6 class="card-title">Uploaded date</h6>
            </div>
            <div class="col-md-10">
              <p class="card-text">{{$product->created_at->format('d/m/Y')}}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <h6 class="card-title">Want to negioate?</h6>
            </div>
            <div class="col-md-10">
              <a href="{{route('products.comments.index', [$product->id])}}" class="btn btn-dark">Comment Section <i class="fa fa-comments"></i></a>
            </div>
          </div>
          @if ($favourited == 0)
          <div class="row">
            <div class="col-md-2">
              <h6 class="card-title">Want to save?</h6>
            </div>
            <div class="col-md-10">
              <a class="btn btn-dark" href="{{route('favourites.store', ['user' => auth()->user()->id, 'product' => $product->id ])}}">Add to favourite <i class="fa fa-heart"></i></a>
            </div>
          </div>
          @else
          <div class="row">
            <div class="col-md-2">
              <h6 class="card-title">Want to unsave?</h6>
            </div>
            <div class="col-md-10">
              <a class="btn btn-dark" href="{{route('favourites.destroy', [$favourited])}}">Remove form favourite <i class="fa fa-trash-alt"></i></a>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <hr>
  <h5 class="card-title">Related products</h5>
  <div class="row no-gutters row-cols-2 row-cols-md-6">
    @foreach ($relatedProducts as $relatedProduct)
    <div class="col mb-3">
      <div class="card card-size card-hover">
          @if($relatedProduct->images->count() > 0)
          <img src="{{asset('storage/images/'.$relatedProduct->images->first()->name)}}" class="card-img-top" style="height: 60%;"  alt="...">
          @else
          <img src="{{asset('storage/images/16297091780.jpg')}}" class="card-img-top" style="height: 60%;"  alt="...">
          @endif
          <div class="card-body p-0">
              <h6 class="card-title mt-1 ml-1">{{$relatedProduct->price}} mmk</h6>
              <div class="card-text ml-1 text-size">{{$relatedProduct->name}}</div>
              <a href="{{route('products.show' , [$relatedProduct->id])}}" class="stretched-link"></a>
          </div>
      </div>
      </div>
    @endforeach
  </div>
  <hr>
  <h5 class="card-title">More products from this user</h5>
  <div class="row no-gutters row-cols-2 row-cols-md-6">
    @foreach ($userProducts as $userProduct)
    <div class="col mb-3">
      <div class="card card-size card-hover">
          @if($userProduct->images->count() > 0)
          <img src="{{asset('storage/images/'.$userProduct->images->first()->name)}}" class="card-img-top" style="height: 60%;"  alt="...">
          @else
          <img src="{{asset('storage/images/16297091780.jpg')}}" class="card-img-top" style="height: 60%;"  alt="...">
          @endif
          <div class="card-body p-0">
              <h6 class="card-title mt-1 ml-1">{{$userProduct->price}} mmk</h6>
              <div class="card-text ml-1 text-size">{{$userProduct->name}}</div>
              <a href="{{route('products.show' , [$userProduct->id])}}" class="stretched-link"></a>
          </div>
      </div>
      </div>
    @endforeach
  </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $(".card-hover").hover(function(){
        $(this).addClass("text-white bg-dark");
        }, function(){
        $(this).removeClass("text-white bg-dark");
        });
    });
</script>
@endsection

