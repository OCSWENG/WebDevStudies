<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!--link rel="stylesheet" href="css/bootstrap.min.css"-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/styling.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
      
        <title>OnlineNotes</title>
  </head>
  <body>
    <!-- Navigation Bar -->
     <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
            <div class="container-fluid">
               <nav class="navbar navbar-expand-lg navbar-light navbar-right ">
                  <a class="navbar-brand" >Online Notes</a>
                  <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                   
                  <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav">
                      <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Help</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link disabled" href="#loginModal" data-toggle="modal">Login</a>
                      </li>
                    </ul>
                  </div>
                </nav>
            </div>
    </nav>
      
    <!-- Jumbotron with Sign up Button -->
      <div class="jumbotron" id="myContainer">
            <h1>Online Notes App</h1>
            <p>Your Notes with you wherever you go.</p>
            <p>Easy to use, protects all your notes!</p>
            <button type="button" class="btn btn-lg green signup" data-target="#signupModal" data-toggle="modal">Sign up </button>
      </div>
    <!-- Login Form -->
      <form method="post" id="loginForm">
          <div class="modal" id="loginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button class="close" data-dismiss="modal">
                            &times;
                          </button>
                          <h4 id="myModalLabel">
                            Login:
                          </h4>
                      </div>

                  <div class="modal-body">
                      <div id="loginmesage"></div>
                      
                      <div class="form-group">
                          <label for="loginemail" class="sr-only">Email:</label>
                          
                          <input class="form-control" type="email" name="loginemail" id="loginemail" placeholder="Email" maxlength="50">
                      </div>
                      
                      <div class="form-group">
                          <label for="loginpassword" class="sr-only">Password</label>
                          <input class="form-control" type="password" name="loginpassword" id="loginpassword" placeholder="Password" maxlength="30">
                      </div>
                      
                      <div class="checkbox">  
                          <label>
                              <input type="checkbox" name="rememberme" id="rememberme">
                              Remember me 
                          </label>
                          <a class="pull-right" style="cursor: pointer" data-dismiss="modal" data-target="#forgotpasswordModal" data-toggle="modal">Forgot Password?</a>
                      </div>
                  </div>
                  
                  <div class="modal-footer">
                      <input class="btn green" name="login" type="submit" value="login">
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                      </button>
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="signupModal" data-toggle="modal">
                        Register
                      </button>
                  </div>
              </div>
              </div>
          
          </div>
      </form>
    <!-- Sign up form -->
      <form method="post" id="signupForm">
        <div class="modal" id="signupModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">
                            &times;
                        </button>
                        <h4 id="myModalLabel">
                            Sign up today and Start using our Online Notes App!
                        </h4>
                    </div>
                    <div class="modal-body">
                        <!-- Sign up message from PHP file -->
                        <div id="signupmessage"></div>
                        <div class="form-group">
                            <label for="username" class="sr-only">Username:</label>
                            <input class="form-control" type="text" name="username" id="username" placeholder="Username" maxlength="30">                            
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email:</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" maxlength="50">                            
                        </div>
                        <div class="form-group">
                            <label for="password2" class="sr-only">Confirm password</label>
                            <input class="form-control" type="password" name="password2" id="password2" placeholder="Confirm password" maxlength="30">                         
                        </div>                    
                    </div>
                    <div class="modal-footer">
                        <input class="btn green" name="signup" type="submit" value="Sign up">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                        </button>                    
                    </div>
                </div>
            </div>
        </div>
      </form>
    <!-- Forgot password form -->
      
      <form method="post" id="forgotpasswordform">
        <div class="modal" id="forgotpasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">
                            &times;
                        </button>
                        <h4 id="myModalLabel">
                            Forgot Password? Enter your email address:
                        </h4>                    
                    </div>
                    <div class="modal-body">
                        <div id="forgotpasswordmessage"></div>
                        <div class="form-group">
                            <label for="forgotemail" class="sr-only">Email:</label>
                            <input class="form-control" type="email" name="forgotemail" id="forgotemail" placeholder="Email" maxlength="50">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn green" name="forgotpassword" type="submit" value="Submit">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="signupModal" data-toggle="modal">
                            Register
                        </button>      
                    </div>
                </div>
            </div>
          </div>
      </form>
    <!-- Footer -->
      <div class="footer">
        <div class="container">
            <p>DevelopmentIsland.com Copyright &copy; 2015-<?php $today = date("Y"); echo $today ?>.</p>
          </div>
      </div>
    <!-- jQuery -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script
              src="https://code.jquery.com/jquery-3.3.1.min.js"
              integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
              crossorigin="anonymous">
      </script>
      <script src="js/bootstrap.min.js"></script>

      <script src="js/index.js"></script>
      
  </body>
</html>
