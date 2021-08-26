@extends('layouts.app')

@section('css')

@endsection

@section('page')
{{$product->name}}
@endsection

@section('content')
<div class="container-fluid my-3">
    @if(!empty($comments))
     <div class="card">
        <div class="card-body">
            <h6 class="card-text"><span class="badge badge-secondary">{{$comments->count()}}</span> comments</h6>
                @foreach ($comments as $comment)
                <div class="form-group">
                    <label for="name">{{$comment->user->name}}</label><small class="form-text text-muted float-right">{{$comment->created_at->diffForHumans()}}</small>
                    <div class="col-md-12 bg-light">
                        {{$comment->body}}
                    </div>
                </div>
                @if (auth()->user()->id == $comment->user->id)
                <div class="row float-right mr-1">
                        <form action="{{route('comments.destroy', [$comment->id])}}" method="POST">
                            <a href="{{route('comments.edit', [$comment->id])}}" class="badge badge-secondary">Edit</a>
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="badge badge-secondary">Delete</button>
                        </form>
                    </div>
                    <div class="clearfix"></div> 
                @endif
                @endforeach
                {{ $comments->links() }}
            <hr>
            <form action="{{route('products.comments.store', [$product->id])}}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" style="height:60px" name="body" placeholder="What do you want to say about this product?" required>{{old('body')}}</textarea>
                </div>
                <div class="form-group float-right">   
                    <button type="submit" class="btn btn-dark">
                        {{ __('Submit') }}
                    </button>
                </div>    
            </form>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body">
            <form action="{{route('products.comments.store', [$product->id])}}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" style="height:60px" name="body" placeholder="What do you want to say about this product?" required></textarea>
                </div>
                <div class="form-group float-right">   
                    <button type="submit" class="btn btn-dark">
                        {{ __('Submit') }}
                    </button>
                </div>    
            </form>
        </div> 
    </div>
    @endif
</div>
@endsection
