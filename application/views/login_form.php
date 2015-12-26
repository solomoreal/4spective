<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <?php echo link_tag('assets/AdminLTE/css/bootstrap.min.css'); ?>
    

    <!-- Custom styles for this template -->
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #eee;
      }

      .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin .checkbox {
        font-weight: normal;
      }
      .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
           -moz-box-sizing: border-box;
                box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
      }
      .form-signin .form-control:focus {
        z-index: 2;
      }
      .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }
      .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }
    </style>

  </head>
  <body>

    <div class="container">


      <?php echo form_open('account/login_process', 'class="form-signin"', ''); ?>
        <h2 class="form-signin-heading">4Spective - Sign In</h2>
        <label for="inputEmail" class="sr-only">Username or Email</label>
        <input type="text" id="txt_user" name="txt_user" class="form-control" placeholder="Username or Email" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="txt_pass" name="txt_pass" class="form-control" placeholder="Password" required="">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->
  
</body></html>