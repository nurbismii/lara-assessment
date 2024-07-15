<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Evaluasi - Login</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

  <style>
    div.main {
      background: #0264d6;
      /* Old browsers */
      background: -moz-radial-gradient(center, ellipse cover, #0264d6 1%, #1c2b5a 100%);
      /* FF3.6+ */
      background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(1%, #0264d6), color-stop(100%, #1c2b5a));
      /* Chrome,Safari4+ */
      background: -webkit-radial-gradient(center, ellipse cover, #0264d6 1%, #1c2b5a 100%);
      /* Chrome10+,Safari5.1+ */
      background: -o-radial-gradient(center, ellipse cover, #0264d6 1%, #1c2b5a 100%);
      /* Opera 12+ */
      background: -ms-radial-gradient(center, ellipse cover, #0264d6 1%, #1c2b5a 100%);
      /* IE10+ */
      background: radial-gradient(ellipse at center, #0264d6 1%, #1c2b5a 100%);
      /* W3C */
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0264d6', endColorstr='#1c2b5a', GradientType=1);
      /* IE6-9 fallback on horizontal gradient */
      height: calc(100vh);
      width: 100%;
    }

    [class*="fontawesome-"]:before {
      font-family: 'FontAwesome', sans-serif;
    }

    /* ---------- GENERAL ---------- */

    * {
      box-sizing: border-box;
      margin: 0px auto;

      &:before,
      &:after {
        box-sizing: border-box;
      }

    }

    body {

      color: #606468;
      font: 87.5%/1.5em 'Open Sans', sans-serif;
      margin: 0;
    }

    a {
      color: #eee;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    input {
      border: none;
      font-family: 'Open Sans', Arial, sans-serif;
      font-size: 14px;
      line-height: 1.5em;
      padding: 0;
      -webkit-appearance: none;
    }

    p {
      line-height: 1.5em;
    }

    .clearfix {
      zoom: 1;

      &:before,
      &:after {
        content: ' ';
        display: table;
      }

      &:after {
        clear: both;
      }

    }

    .container {
      left: 50%;
      position: fixed;
      top: 50%;
      transform: translate(-50%, -50%);
    }

    /* ---------- LOGIN ---------- */

    #login form {
      width: 250px;
    }

    #login,
    .logo {
      display: inline-block;
      width: 40%;
    }

    #login {
      border-right: 1px solid #fff;
      padding: 0px 22px;
      width: 59%;
    }

    .logo {
      color: #fff;
      font-size: 50px;
      line-height: 125px;
    }

    #login form span.fa {
      background-color: #fff;
      border-radius: 3px 0px 0px 3px;
      color: #000;
      display: block;
      float: left;
      height: 50px;
      font-size: 24px;
      line-height: 50px;
      text-align: center;
      width: 50px;
    }

    #login form input {
      height: 50px;
    }

    fieldset {
      padding: 0;
      border: 0;
      margin: 0;

    }

    #login form input[type="email"],
    input[type="password"] {
      background-color: #fff;
      border-radius: 0px 3px 3px 0px;
      color: #000;
      margin-bottom: 1em;
      padding: 0 16px;
      width: 200px;
    }

    #login form input[type="submit"] {
      border-radius: 3px;
      -moz-border-radius: 3px;
      -webkit-border-radius: 3px;
      background-color: #000000;
      color: #eee;
      font-weight: bold;
      /* margin-bottom: 2em; */
      text-transform: uppercase;
      padding: 5px 10px;
      height: 30px;
    }

    #login form input[type="submit"]:hover {
      background-color: #d44179;
    }

    #login>p {
      text-align: center;
    }

    #login>p span {
      padding-left: 5px;
    }

    .middle {
      display: flex;
      width: 600px;
    }
  </style>

</head>

<body class="bg-gradient-primary">
  <div class="main">
    <div class="container">
      <center>
        <div class="middle">
          <div id="login">
            <form action="{{route('login')}}" method="post">
              @csrf
              <fieldset class="clearfix">
                @include('layouts.message')
                <p>
                  <span class="fa fa-user"></span>
                  <input type="email" name="email" Placeholder="Email" required autofocus autocomplete="email">
                </p>
                <p>
                  <span class="fa fa-lock"></span>
                  <input type="password" name="password" Placeholder="Kata sandi" required>
                </p>
                <div>
                  <span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text" href="#">Lupa kata sandi</a></span>
                  <span style="width:50%; text-align:right;  display: inline-block;"><input type="submit" value="Masuk"></span>
                </div>
              </fieldset>
              <div class="clearfix"></div>
            </form>
            <div class="clearfix"></div>
          </div> <!-- end login -->
          <div class="logo">VDNI
            <div class="clearfix"></div>
          </div>
        </div>
      </center>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js')}}"></script>

</body>

</html>