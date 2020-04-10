@extends('layouts.app')

@section('title')
{{ $user->name }}
@endsection

@section('content')
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-3">
          <div class="card overflow-hidden">
            <div class="card-header text-white bg-custom text-center">Profile Picture</div>
            <div class="card nb">
            <img class="card-img-top img-thumbnail" src="{{$user->avatar}}" alt="">
            <div class="card-body">
              @if (auth()->user()->id == $user->id)
              <form action="{{route('image-save')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <input class="form-control" type="file" name="image" id="">
                </div>
                <input class="btn btn-sm bg-custom nb text-white form-control" type="submit" value="Save">
              </form>
              @else
              <div class="form-group">
                <button class="btn form-control nb bg-custom text-white">Hello, there !</button>
              </div>
              <friend-btn :user_id="{{$user->id}}"></friend-btn>
              @endif
            </div>
            </div>
          </div>
          <div class="card nb mt-2 bg-white">
            <div class="card-body">
              <ul class="list-group">
                  <li class="list-group-item nb"><b><a href="{{ route('home') }}" class="text-custom">News Feed</a></b></li>
                  <li class="list-group-item nb"><b><a href="{{ route('friends') }}" class="text-custom">Friends</a></b></li>
                  <li class="list-group-item nb"><b><a href="{{ route('requests') }}" class="text-custom">Friend Requests</a></b></li>
                  <li class="list-group-item nb"><b><a href="{{ route('search.view') }}" class="text-custom">Search People</a></b></li>
              </ul>
      </div>        </div>

        </div>
        <div class="col-md-8">
          <div class="card">
          <div class="card-header bg-custom text-white h5">{{$user->name}}</div>
          <div class="card-body">
           

            <blockquote class="blockquote mb-5">
              <p class="h6 mb-0">{{ $user->profile? $user->profile->about: 'N/A' }}</p>
            <footer class="blockquote-footer text-right">About me</footer>
            </blockquote>
            <div class="table-responsive">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th><i class="fas fa-user-tie"></i> Name</th>
                    <th>{{ $user->name }}</th>
                  </tr>
                  <tr>
                    <td class="text-nowrap"><i class="fas fa-envelope-open"></i></i> Primary email</td>
                  <td><a href="mailto:{{$user->email}}">{{ $user->email}}</a> </td>
                  </tr>
                  <tr>
                    <td class="text-nowrap"><i class="fas fa-envelope"></i> Secondary email</td>
                    <td><a href="mailto:{{$user->secondary_email}}">{{ $user->secondary_email ?: 'N/A' }}</a></td>
                  </tr>
                  <tr>
                    <td class="text-nowrap"><i class="fas fa-graduation-cap"></i> University</td>
                    <td>{{ $user->university ? $user->university->name : 'N/A'}}</td>
                  </tr>
                  <tr>
                    <td class="text-nowrap"><i class="fas fa-phone-square-alt"></i> Phone</td>
                    <td>{{ $user->profile? $user->profile->phone : 'N/A' }}</td>
                  </tr>
                  <tr class="text-wrap">
                    <td><i class="fab fa-facebook-square"> Facebook </td>
                  <td><u> <a href="{{ $user->social ? $user->social->fb ?: '#' : '#'}}" target="_blank">{{ $user->social ? $user->social->fb ?: 'N/A' : 'N/A'}}</u></a></td>
                  </tr>
                  <tr>
                    <td><i class="fab fa-github-square"> Github </td>
                    <td><u><a href="{{ $user->social ? $user->social->git ?: '#' : '#'}}" target="_blank">{{ $user->social ? $user->social->git ?: 'N/A' : 'N/A'}}</u></a></td>
                  </tr>
                  <tr>
                    <td><i class="fab fa-linkedin"> LinkedIn </i></td>
                    <td><u><a href="{{ $user->social ? $user->social->l_i ?: '#' : '#'}}" target="_blank">{{ $user->social ? $user->social->l_i ?: 'N/A' : 'N/A'}}</u></a></td>
                  </tr>
                  {{-- <tr>
                    <td>Stack Overflow</td>
                    <td>{{ $user->social->s_o ?: 'N/A'}}</td>
                  </tr> --}}
  
                  <tr>
                    <td><i class="fas fa-cogs"></i>  Skills</td>
                    <td>
                      @foreach ($user->skills as $item)
                          <a href="{{ route('search.cat',$item->id) }}"><span class="chp mb-1 {{auth()->user()->hasSkill($item->id) ? 'cmn' : ''}} "> {{ $item->name }} </span></a>
                      @endforeach
                      <small class="form-text cmntxt">This is the color of common skills</small>
                    </td>
                  </tr>
  
                </tbody>
              </table>
            </div>
          </div>
          </div>

        </div>
      </div>
    </div>
@endsection

@section('js')
    <script>

    </script>
@endsection