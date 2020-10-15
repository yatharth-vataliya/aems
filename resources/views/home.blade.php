@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">SOLO EVENT</div>

                <div class="panel-body text-center" style="overflow-y: scroll;overflow-x: hidden; height: 400px;">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    @foreach($solo as $event)
                    <div class="col-md-*">
                        <a href="{{ route('eventShow',['id'=>$event->id]) }}" class="btn btn-primary btn-block">{{ $event->event_name }}</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading text-center">GROUP EVENT</div>

                <div class="panel-body" style="overflow-y: scroll;overflow-x: hidden; height: 400px;">
                    @foreach($group as $event)
                    <div class="col-md-*">
                        <a href="{{ route('eventShow',['id'=>$event->id]) }}" class="btn btn-block btn-danger">{{ $event->event_name }}</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading text-center">OTHER EVENT</div>

                <div class="panel-body" style="overflow-y: scroll;overflow-x: hidden; height: 400px;">
                    @foreach($other as $event)
                    <div class="col-md-*">
                        <a href="{{ route('eventShow',['id'=>$event->id]) }}" class="btn btn-block btn-success">{{ $event->event_name }}</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
