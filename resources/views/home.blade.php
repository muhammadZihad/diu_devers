@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <ul class="collection with-header">
                        <li class="collection-header"><h4>Profiles</h4></li>
                        @foreach ($users as $item)
                            
                    <li class="collection-item"><div>{{ $item->name }}<a href="{{route('profile',['slug'=>$item->slug])}}" class="secondary-content"><i class="material-icons">send</i></a></div></li>
                        @endforeach
                      </ul>
                            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
