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
                
                <nav class="navbar navbar-expand-lg navbar-light navbar-right ">
                  <a class="navbar-brand" href="#">Online Notes</a>
                  <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav">
                      <li class="nav-item active">
                        <a class="nav-link" href="#">Profile <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Help</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="mainpageloggedin.php" data-toggle="modal">My Notes</a>
                      </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item"><a  class="nav-link" href="#">Logged in as <b><?php echo $username; ?></b></a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?logout=1">Log out</a></li>
                      </ul>
                  </div>
                </nav>
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
      <script
              src="https://code.jquery.com/jquery-3.3.1.min.js"
              integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
              crossorigin="anonymous">
      </script>
      <script src="js/bootstrap.min.js"></script>


      <script src="js/mynotes.js"></script>  
  </body>
</html>
