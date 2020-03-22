<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome | {{ auth()->user()->name }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/style2.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/416893b2fc.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand mb-0 h1 logo">Dever's</span>
        <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();" >Logout <span class="sr-only">(current)</span></a>
              
              <form id="logout-form" action="{{ route('logout') }}" method="POST"
              style="display: none;">
              @csrf
          </form>
            </li>
        </ul>
      </nav>
    <div class="container-fluid bg-light">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <p class="text-center">Welcome <span class="logo">{{ auth()->user()->name }}</span>,<br>
                    Please fill the following information to complete your profile and proceed to your profile</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="" method="post">
                    <div class="form-group mb-4">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Tell us something about yourself..."></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label for="exampleFormControlSelect1"><i class="fas fa-cogs"></i> Interested technology</label>
                        <select class="js-select1 form-control " id="exampleFormControlSelect1" multiple>
                          <option>Hello</option>
                          <option>manala</option>
                          <option>pajsala</option>
                          <option>jeaosid</option>
                          <option>faawds</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1"><i class="fab fa-github-square"></i> Github link</label>
                        <input type="text" class="form-control"  placeholder="https://github.com/....">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1"><i class="fab fa-facebook-square"></i></i> Facebook link</label>
                        <input type="text" class="form-control" placeholder="https://facebook.com/....">
                      </div>

                      <div class="form-group mb-4">
                        <label for="exampleInputEmail1"><i class="fab fa-linkedin"></i> LinkedIn link</label>
                        <input type="text" class="form-control" placeholder="https://linkedin.com/....">
                      </div>

                      <div class="form-group mt-3">
                        <a class="btn btn-danger mbtn" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" >Not in the mood right now !</a>
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                      @csrf
                                  </form>
                        <button type="submit" class="btn mbtn sbtn float-right">Save & let me in</button>
                      </div>

                    </form>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
        $('.js-select1').select2({
            tags:true,
        });
});


</script>
</body>
</html>