<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!--link rel="stylesheet" href="css/bootstrap.min.css"-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/mainpageloggedin.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
      
        <title>My Notes</title>
  </head>
  <body>
    <!-- Navigation Bar -->
     <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">

            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand">Online Notes</a>
                    <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="navbarCollapse">
                      <ul class="nav navbar-nav">
                        <li class="active"><a href="profilepage.php">Profile</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="mainpageloggedin.php">MyNotes</a></li>
                      </ul>
                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Logged in as <b><?php echo $_SESSION['username']?></b></a></li>
                        <li><a href="index.php?logout=1">Log out</a></li>
                      </ul>
                </div>
            </div>
    </nav>
      
    <!-- Container  -->
      <div class="container" id="buttons">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="buttons">
                    <button id="AddNote" type="button" class="btn btn-info btn-lg">Add Note</button>
                    <button id="Edit" type="button" class="btn btn-info btn-lg pull-right">Edit</button>

                    <button id="Done" type="button" class="btn btn-primary btn-lg pull-right">Done</button>
                    
                    <button id="AllNotes" type="button" class="btn btn-info btn-lg">All Notes</button>

                </div>
                
                <div id="notePad">
                    <texarea rows="10"></texarea>
                </div>
                
                <div id="notes" class="notes">
                    <!-- using ajax use php to get data from database -->
                </div>     
            </div>
          </div>
      </div>

    <!-- Footer -->
      <div class="footer">
        <div class="container">
            <p>DevelopmentIsland.com Copyright &copy; 2015-<?php $today = date("Y"); echo $today ?>.</p>
          </div>
      </div>
    <!-- jQuery -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!--script src="js/bootstrap.min.js"></script-->
      <!--script src="js/bootstrap.js"></script-->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script src="js/mynotes.js"></script>  
  </body>
</html>
