@extends('layouts.app')




@section('content')
    <div id="app" class="container">
      <div class="row">
        <div class="col m8 s12">

          <div class="card blue-grey darken-2">
            <div class="card-content white-text">
            <a href="{{ route('profile.edit',$user->slug)}}" class="btn btn-floating btn-sm teal darken-1 pulse right"><i class="material-icons">edit</i></a>
              <div class="card-image center-align">
              <img style="height:200px !important;max-width:200px !important; margin:0 auto;" src="{{Storage::url($user->avatar)}}" alt="">
              </div>
              <div class="card-header"><span class="card-title">{{ $user->name }}</span>  <p>{{ $user->about }} </p></div>
              <div class="card-body">
                <div class="row">

              <ul class="tabs blue-grey darken-2">
                  <li class="tab"><a class="white-text" href="#foo">About</a></li>
                  <li class="tab"><a class="white-text" href="#bar">Skill</a></li>
              </ul>
            
              <div id="foo" class="col s12">
                <table>
                  <tbody>
                    <tr>
                      <td>Email</td>
                      <td>{{ $user->email }}</td>
                    </tr>
                    @if ($user->secondary_email)
                    <tr>
                      <td>Email</td>
                      <td>{{ $user->secondary_email }}</td>
                    </tr>
                    @endif
                    <tr>
                      <td>Gender</td>
                      <td>@if ($user->gender)
                          Male
                      @else
                          Female
                      @endif</td>
                    </tr>
                    <tr>
                      <td>University</td>
                      <td>Daffodil International University (BSc in CSE)</td>
                    </tr>
                    @foreach ($user->socials as $social)
                    <tr>
                      <td>{{ $social->name}}</td>
                    <td>  <a class="white-text" href="{{ $social->pivot->link }}" target="blank"><img class="mr-2" width="16px" src="{{Storage::url($social->avater) }}" alt="">{{  $social->pivot->link    }}</a> </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div id="bar" class="col s12">
                <table>
                  <tbody>
                    <tr>
                      <td>Email</td>
                      <td>{{ $user->email }}</td>
                    </tr>
                    @if ($user->secondary_email)
                    <tr>
                      <td>Email</td>
                      <td>{{ $user->secondary_email }}</td>
                    </tr>
                    @endif
                    <tr>
                      <td>Gender</td>
                      <td>
                      @if ($user->gender)
                          Male
                      @else
                          Female
                      @endif
                      </td>
                    </tr>
                    <tr>
                      <td>University</td>
                      <td>Daffodil International University (BSc in CSE)</td>
                    </tr>
                    @foreach ($user->socials as $social)
                    <tr>
                      <td>{{ $social->name}}</td>
                    <td>  <a class="white-text" href="{{ $social->pivot->link }}" target="blank"><img class="mr-2" width="16px" src="{{Storage::url($social->avater) }}" alt="">{{  $social->pivot->link    }}</a> </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
                </div>

            </div>
                
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