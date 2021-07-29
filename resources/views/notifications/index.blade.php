@extends('layouts.app')

@section('title', 'Notifications')

@section('css')
<style>
   
</style>
@endsection

@section('page', 'Notifications')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-2">
                <div class="card-body">
                    @if($notifications->isNotEmpty())
                        @foreach ($notifications as $notification)
                            <div class="card @if (empty($notification->read_at))
                                border-primary text-primary
                            @endif  w-100 mb-2">
                                <div class="card-body pl-1 py-1">
                                    <i class="fa fa-bell"></i><h6 class="card-title inline"> {{$notification->data['title']}}</h6>
                                    <hr>
                                    <h6 class="card-subtitle">{{$notification->data['text']}}</h6>
                                    <small class="card-text">{{$notification->created_at->format('d/m/Y')}}</small>
                                    <a href="{{route('notifications.show', [$notification->id])}}" class="stretched-link"></a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h4 class="card-title">There is no notifications.</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
