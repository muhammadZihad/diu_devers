@extends('layouts.app')
@section('title')
Search
@endsection
@section('content')
    <div class="container">
        <div class="row justify-centnent-center">
                        {{-- This is left sidebar --}}
                        <div class="d-none d-md-block col-md-3">
                            <div class="sidebar bg-white">
                                <div class="card nb">
                                    <div class="card-header bg-custom text-white">My Profile</div>
                                </div>
                                <div class="card-body">
                                    <div class="img-box nr text-center">
                                        <img src="{{auth()->user()->avatar}}" alt="" class="avatar">
                                        </div>
                                        <ul class="list-group">
                                            <li class="list-group-item nb"><b><a href="{{'/'. auth()->user()->slug }}" class="text-custom">Profile</a></b></li>
                                            <li class="list-group-item nb"><b><a href="{{ route('home') }}" class="text-custom">News Feed</a></b></li>
                                            <li class="list-group-item nb"><b><a href="{{ route('friends') }}" class="text-custom">Friends</a></b></li>
                                            <li class="list-group-item nb"><b><a href="{{ route('requests') }}" class="text-custom">Friend Requests</a></b></li>
                                            <li class="list-group-item nb"><b><a href="{{ route('search.view') }}" class="text-custom">Search People</a></b></li>
                                        </ul>
                                </div>
                            </div>
                        </div>
            <div class="col-md-6">
                <div class="card nb">
                    <div class="card-header nb bg-custom text-white">Friends</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <ul class="list-group">
                                    @foreach ($result as $item)
                                    <li class="list-group-item d-flex align-items-center j-c-sb">
                                        <div class="info d-flex align-items-center">
                                            <a href="{{ route('profile.show',$item->slug) }}">
                                            <div class="s-img mr-2" style="background-image:url('{{ $item->avatar }}')">
                                                {{-- <img src="{{ $item->avatar }}" alt="" class="a-img"> --}}
                                            </div>
                                        </a>
                                            <div class="details d-flex flex-column">
                                                <a href="{{ route('profile.show',$item->slug) }}"><h5 class="text-custom">{{ $item->name }}</h5></a>
                                                <p>
                                                    @foreach ($item->skills as $s)
                                                        <a href="{{ route('search.cat',$s->id) }}"  class="text-muted"><u>{{ $s->name }}</u></a>
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                        @if ($item->id != auth()->user()->id)  
                                        <friend-btn :user_id="{{ $item->id }}"></friend-btn>
                                        @endif
                                    </li>
                                    @endforeach
                                  </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <div class="card nb">
                    <div class="card-header bg-custom text-white">
               Friend Requests

                    </div>
                    <div class="card-body">
                        <friend-req :myid="{{auth()->user()->id}}"></friend-req>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection