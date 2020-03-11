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

                    @foreach ($users as $item)
                    <div class="card text-center" style="width: 18rem;">
                        <img style="max-width:150px;max-height:150px;" src="{{Storage::url($item->avatar)}}" class="card-img-top mx-auto" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{ $item->name }}</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-body">
                        <a href="{{route('profile.show',$item->slug)}}" class="card-link">View Profile</a>
                        </div>
                      </div>
                    @endforeach
                            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
