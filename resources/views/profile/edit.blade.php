@extends('layouts.app')




@section('content')
<div id="app" class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit Profile</div>
            <div class="card-body">
                <form action="">
                    <div class="row justify-content-center">
                        <div class="col-sm-6 text-center">
                            <img style="max-width:150px;max-height:150px" src="{{ Storage::url($user->avatar) }} " alt="">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Upload image</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1">
                              </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">About Yourself</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                    </div>
                    <ul class="nav nav-tabs d-flex" id="myTab" role="tablist">
                      <li class="nav-item flex-fill">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Basic Info</a>
                      </li>
                      <li class="nav-item flex-fill">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Socials</a>
                      </li>
                      <li class="nav-item flex-fill">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Skills</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputPassword4">Name</label>
                            <input type="text" class="form-control" id="inputName">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" name="email" id="inputEmail4">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-3">
                            <label for="inputPassword4">Phone Number</label>
                          <input type="text" class="form-control" placeholder="+880" value="" name="phone" id="inputName">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Secondary Email</label>
                            <input type="email" class="form-control" name="email2" id="inputEmail4">
                          </div>
                          <div class="form-group col-md-3">
                             <label for="inputPassword4">Gender</label>
                             <select name="gender" class="form-control" id="">
                              <option value="1" selected>Male</option>
                              <option value="0">Female</option>
                             </select>
                          </div>
                        </div>
                        <hr>
                        <div class="form-group">
                          <label for="inputAddress">Address</label>
                          <input type="text" class="form-control" id="inputAddress">
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" id="inputCity">
                          </div>
                          <div class="form-group col-md-4">
                            <label for="inputState">State</label>
                            <select id="inputState" class="form-control">
                              <option disabled selected>Choose...</option>
                              <option>...</option>
                            </select>
                          </div>
                          <div class="form-group col-md-2">
                            <label for="inputZip">Zip</label>
                            <input type="text" class="form-control" id="inputZip">
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      </div>
                      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                      </div>
                    </div>
            </div>
            <div class="card-footer">
              <input type="submit" class="btn btn-primary" value="Save">
            </form>

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