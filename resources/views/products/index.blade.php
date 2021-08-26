@extends('layouts.app')

@section('title', 'Products')

@section('css')
<style>
    .card-size{
        width: 185px;
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

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-3">
            <form action="{{route('search')}}" method="GET">
                @csrf
                <div class="input-group">
                    <input class="form-control py-2" name="search" type="search" placeholder="Search products...">
                    <span class="input-group-append">
                      <button class="btn btn-outline-secondary border-left-0 border" type="submit">
                            <i class="fa fa-search"></i>
                      </button>
                    </span>
                </div>
                @error('search')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </form>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-2">
            <div class="input-group is-invalid mr-auto">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="validatedInputGroupSelect"><i class="fa fa-calendar-alt"></i></label>
                </div>
                <input type="text" class="form-control date">
                <input type="hidden" class="from" name="from">
                <input type="hidden" class="to" name="to">
            </div>
        </div>
        <div class="col-md-3 col-6 form-inline">
            <div class="input-group is-invalid mr-auto">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="validatedInputGroupSelect"><i class="fa fa-filter"></i></label>
                </div>
                <select class="custom-select type" id="validatedInputGroupSelect" name="type">
                    <option value="date" @if (request()->type == 'date')
                        selected
                    @endif>Date</option>
                    <option value="price" @if (request()->type == 'price')
                        selected
                    @endif>Price</option>
                </select>
            </div>
            <div class="input-group is-invalid">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="validatedInputGroupSelect"><i class="fa fa-sort"></i></label>
                </div>
                <select class="custom-select sort" id="validatedInputGroupSelect" name="sort">
                    <option value="">Choose</option>
                    <option value="descend" @if (request()->sort == 'descend')
                        selected
                    @endif>Descend</option>
                    <option value="ascend" @if (request()->sort == 'ascend')
                        selected
                    @endif>Ascend</option>
                </select>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3">
            @include('layouts.sidebar')
            {{-- <div class="bg-gray mt-3">
                <form action="{{route('search')}}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input class="form-control py-2" name="search" type="search" placeholder="Search products...">
                        <span class="input-group-append">
                          <button class="btn btn-outline-secondary border-left-0 border" type="submit">
                                <i class="fa fa-search"></i>
                          </button>
                        </span>
                    </div>
                    @error('search')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </form>
                <hr>
                <div class="mt-3">
                    <form action="{{route('sort')}}" method="GET">
                        @csrf
                        <div class="form-group row">
                            <label for="type" class="col-4 col-form-label">{{ __('Sort by') }}</label>
                            <div class="col-8">
                            <select class="form-control" name="type">
                                <option value="date">Date</option>
                                <option value="price">Price</option>  
                            </select>
                            </div>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" name="sort" value="ascend" class="custom-control-input" required>
                            <label class="custom-control-label" for="customRadioInline1">Ascending</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" name="sort" value="descend" class="custom-control-input" required>
                            <label class="custom-control-label" for="customRadioInline2">Descending</label>
                        </div>
                        <button type="submit" class="btn btn-secondary">
                            {{ __('Sort') }}
                        </button>
                    </form>
                </div>
            </div> --}}
        </div>
        <div class="col-md-9">
            <div class="container-fluid mt-3 mt-sm-0 pl-0">
                <div class="row row-cols-2 row-cols-md-5">
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
                {!! $products->withQueryString()->links() !!}
            </div>
        </div> 
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $(".card").hover(function(){
        $(this).addClass("text-white bg-dark");
        }, function(){
        $(this).removeClass("text-white bg-dark");
        });

        $('.date').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            $('.from').val(start.format('YYYY-MM-DD'));
            $('.to').val(end.format('YYYY-MM-DD'));
            var from = $('.from').val();
            var to = $('.to').val();
            history.pushState(null, '', `?from=${from}&to=${to}`);
            window.location.reload();
        });

        var sorting = $('.sort').change(function(){
            var sort = $('.sort').val();
            var type = $('.type').val();
            history.pushState(null, '', `?type=${type}&sort=${sort}`);
            window.location.reload();
        });
    });
</script>
@endsection
