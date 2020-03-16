@extends('layouts.app')




@section('content')
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-12">
          <div class="card">
            <a href="{{ route('profile.edit',$user->slug)}}" class="btn btn-floating btn-sm teal darken-1 pulse right"><i class="material-icons">edit</i></a>
              <div class="card-image center-align">
              <img class="card-img-top d-block mx-auto" style="height:200px !important;max-width:200px !important; margin:0 auto;" src="{{Storage::url($user->avatar)}}" alt="">
              </div>
              <div class="card-header mt-2"><div class="card-title"><span class="h4">{{ $user->name }}</span><friend-btn :user_id={{$user->id}}></friend-btn></div>  <p>{{ $user->about }} </p>              
              </div>
              <div class="card-body">
                <ul class="nav nav-tabs d-flex" id="myTab" role="tablist">
                  <li class="nav-item flex-fill">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="home" aria-selected="true">Basic</a>
                  </li>
                  <li class="nav-item flex-fill">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#social" role="tab" aria-controls="profile" aria-selected="false">Socials</a>
                  </li>
                  <li class="nav-item flex-fill">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#skill" role="tab" aria-controls="profile" aria-selected="false">Skill</a>
                  </li>
                </ul>
          

                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="home-tab">
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
                  </div>
                  <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="profile-tab">
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
                  <div class="tab-pane fade" id="skill" role="tabpanel" aria-labelledby="contact-tab">

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