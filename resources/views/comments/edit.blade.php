@extends('layouts.app')

@section('css')

@endsection

@section('page')
{{$comment->product->name}}
@endsection

@section('content')
<div class="container-fluid my-3">
    <div class="card">
        <div class="card-body">
            <form action="{{route('comments.update', [$comment->id])}}" method="POST">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <textarea class="form-control" style="height:60px" name="body" required>{{$comment->body}}</textarea>
                </div>
                <div class="form-group float-right">   
                    <button type="submit" class="btn btn-dark">
                        {{ __('Submit') }}
                    </button>
                </div>    
            </form>
        </div> 
    </div>
</div>
@endsection