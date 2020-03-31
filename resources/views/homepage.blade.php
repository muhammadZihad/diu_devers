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
            <div class="col-md-3">
                <div class="sidebar sticky-top">
                    <div class="img-box nr text-center">
                        <img src="{{asset('storage/avatar/cgqOYLnjNQwHlPFSZvGyDHSUwlVKwovQNbRJJyzx.jpeg')}}" alt="" class="avatar">
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item nb"><b><a href="#" class="text-custom">Profile</a></b></li>
                            <li class="list-group-item nb"><b><a href="#" class="text-custom">Friends</a></b></li>
                            <li class="list-group-item nb"><b><a href="#" class="text-custom">Friend Requests</a></b></li>
                            <li class="list-group-item nb"><b><a href="#" class="text-custom">Search People</a></b></li>
                        </ul>
                </div>
            </div>
            {{-- This is newsfeed --}}
            <div class="col-md-6">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center b1 p-2">
                            <div class="text-secondary">Working on a new <strong>project</strong> ?</div>
                            <button class="btn nr bg-custom text-white" data-toggle="modal" data-target="#exampleModalCenter"><strong>Post here</strong></button>
                        </div>
                    </div>


                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title text-custom" id="exampleModalLongTitle">Create New Post</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>




                            <div class="modal-body">
                                <form action="" method="POST">
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
                                    <input class="c-file" type="file">
                                    <a href="#"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
                                </div>   
                              <button type="button" class="btn bg-custom nb nr text-white">Post</button>
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
                <post></post>
                <post></post>
                <post></post>
            </div>
            {{-- This is right sidebar --}}
            <div class="col-md-3">
                <div class="sidebar .d-sm-none .d-md-block sticky-top">
                   <h5 class="text-custom">Friend Requests</h5>
                <friend-req :myid="{{auth()->user()->id}}"></friend-req>
                <hr>
                <h5 class="text-custom">Friends</h5>
                <friends-list></friends-list> 
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