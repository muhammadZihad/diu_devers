@extends('layouts.app')

@section('title')
News feed
@endsection

@section('css')
<style>

.c-file::-webkit-file-upload-button {
  visibility: hidden;
}
.c-file{
  opacity:1;
    cursor:pointer;
  position:absolute;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background:transparent;
  z-index:999;
  border-radius:50%;
}
input:focus,textarea:focus{
    outline: none !important;
    box-shadow: none !important;
}
.c-file-div{
  overflow:hidden;
  position:relative;
  width:50px;
  height:35px;
  background:#2BBD91;
  transition:all 0.3s;
  overflow:hidden;
}
.c-file-div:hover{
    -webkit-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.28);
-moz-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.28);
box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.28);
}
.c-file-div a{
  font-size:25px;
  text-decoration:none;
  color:white ;
  width:100%;
  position:absolute;
  display:flex;
  top:50%;
  left:50%;
  z-index:2;
  transform:translate(-50%,-50%);
  justify-content:center;
}

textarea{
    border:none;
}
.modal-footer{
    justify-content:space-between;
}
.countchar{
    z-index: 1000;
    position: absolute;
    bottom: 5px;
    right: 10px;
    opacity: 0.5;
}
.modal-content{
    border-radius: 0 !important;
}
.ct{
    position: relative;
}
</style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
                                <li class="list-group-item nb"><b><a href="{{ route('friends') }}" class="text-custom">Friends</a></b></li>
                                <li class="list-group-item nb"><b><a href="{{ route('requests') }}" class="text-custom">Friend Requests</a></b></li>
                                <li class="list-group-item nb"><b><a href="{{ route('search.view') }}" class="text-custom">Search People</a></b></li>
                            </ul>
                    </div>
                </div>
            </div>
            {{-- This is newsfeed --}}
            <div class="col-md-6">
                <div class="row mb-3">
                    <div class="col-md-12 bg-white p-0">
                        <div class="d-flex justify-content-between align-items-center b1 p-2">
                            <div class="text-secondary">Working on a new <strong>project</strong> ?</div>
                            <button class="btn nr bg-custom text-white" data-toggle="modal" data-target="#exampleModalCenter"><strong>Post here</strong></button>
                        </div>
                    </div>


                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog " role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title text-custom" id="exampleModalLongTitle">Create New Post</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <div class="form-group ct">
                                    <textarea class="form-control nb" name="content" onkeyup="charcountupdate(this.value)" rows="4" placeholder="Say something about your project"></textarea>
                                    <span id="count" class="countchar">0/250</span>
                                </div>
                                <div class="input-group d-flex align-items-center">
                                        <i class="fas fa-link"></i>

                                    <input type="text" name="link" id="" class="form-control nb" placeholder="Project Link">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="c-file-div float-left">
                                    <input class="c-file" name="image" type="file">
                                    <a href="#"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
                                </div>   
                                <input type="submit" value="Post" class="btn bg-custom text-white nb nr">
                            </div>
                        </form>

                          </div>
                        </div>
                      </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        See friends posts
                        <hr>
                    </div>
                </div>
                <post :uid="{{ auth()->user()->id }}"></post>
            </div>
            {{-- This is right sidebar --}}
            <div class="col-md-3">
                <div class="d-none d-md-block sidebar p-0 ml-5">
                    <div class="card nb">
                        <div class="card-header bg-custom text-white">
                   Friend Requests

                        </div>
                        <div class="card-body">
                            <friend-req :myid="{{auth()->user()->id}}"></friend-req>
                        </div>
                    </div>
                <hr>
                <div class="card nb">
                    <div class="card-header bg-custom text-white">
                        Friends
                    </div>
                    <div class="card-body">
                        <friends-list></friends-list> 
                    </div>
                </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        function charcountupdate(str) {
	var lng = str.length;
	document.getElementById("count").innerHTML = lng + '/250';
}
    </script>
@endsection