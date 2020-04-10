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
                    <div class="card-header nb bg-custom text-white">Search</div>
                    <div class="card-body">
                        <form action="{{ route('search') }}" method="POST">
                            @csrf
                            <div class="form-group my-2 my-lg-0 par">
                                <input
                                name="key"
                                  class="form-control"
                                  type="search"
                                  placeholder="Search by name"
                                  aria-label="Search"
                                />
                                <button type="submit" class="btn btn-outline-success bg-white my-2 my-sm-0 nr cp">
                                    <i class="fas fa-search"></i>
                                  </button>
                              </div>
                        </form>
                    </div>
                    @if (isset($result))
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
                    @else
                        <p class="text-center">No Search result</p>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="card nb">
                    <div class="card-header nb bg-custom text-white">Skill category</div>
                    <div class="card-body">
                        <div class="form-group my-2 my-lg-0 par">
                            <input
                              class="form-control"
                              type="search"
                              placeholder="Search by name"
                              aria-label="Search"
                            />
                          </div>
                          <hr>
                          <h5>Most popular skills</h5>
                          @foreach ($skills as $item)
                          @if (isset($sid) && $sid==$item->id)
                            <a href="{{ route('search.cat',$item->id) }}" class="btn btn-sm nb text-white mr-1 mb-1 nr p-2 bg-custom2">{{ $item->name }} ({{ $item->users->count() }})</a>
                          @else
                            <a href="{{ route('search.cat',$item->id) }}" class="btn btn-sm nb text-white mr-1 mb-1 nr p-2 bg-custom">{{ $item->name }} ({{ $item->users->count() }})</a>
                          @endif
                          @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection