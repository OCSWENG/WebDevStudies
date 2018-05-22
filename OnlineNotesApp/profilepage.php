<?php
session_start();
if(!isset($_SESSION['userid'])){
    header("location:index.php");
}
include ('connection.php');

$userid = $_SESSION['userid'];

//get username and email
$sql = "SELECT * FROM users WHERE userid='$userid'";
$sql_count = "SELECT COUNT(*) as count  FROM users WHERE userid='$userid'";
$db->exec('BEGIN');
$result = $db->query($sql);

$count = $db->numRows($sql_count);

if($count == 1){
    $row = $result->fetchArray(SQLITE3_ASSOC);
    $username = $row['username'];
    $email = $row['email']; 
}else{
    echo "There was an error retrieving the username and email from the database";   
}
$db->exec("COMMIT");

?>
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
      
        <title>Profile</title>
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
                        <li class="active"><a href="#">Profile</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="mainpageloggedin.php">MyNotes</a></li>
                      </ul>
                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Logged in as <b><?php echo $username; ?></b></a></li>
                        <li><a href="index.php?logout=1">Log out</a></li>
                      </ul>
                </div>
            </div>
    </nav>
      
    <!-- Container  -->
      <div class="container" id="buttons">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <h2>General Account Settings:</h2>
                
                <div class="table-responsive">
                    <table class="table table-hover table-condensed table-bordered">
                        <tr data-target="#updateusername" data-toggle="modal"><td>UserName</td><td><?php echo $username; ?></td></tr>
                        <tr data-target="#updateemail" data-toggle="modal"><td>Email</td><td><?php echo $email ?></td></tr>
                        <tr data-target="#updatepassword" data-toggle="modal"><td>Password</td><td>Hidden</td></tr> 
                    </table>
                </div>
            </div>
          </div>
      </div>


      <!-- update user name Form -->
      <form method="post" id="updateUserNameForm">
          <div class="modal" id="updateusername" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button class="close" data-dismiss="modal">
                            &times;
                          </button>
                          <h4 id="myModalLabel">
                            Edit UserName:
                          </h4>
                      </div>
       
                  <div class="modal-body">
                      <div id="updateusernamemesage"></div>
                      
                      <div class="form-group">
                          <label for="userName" class="sr-only">UserName:</label>
                          <input class="form-control" type="text" name="userName" id="userName" placeholder="userName" maxlength="50" value="<?php echo $username; ?>">
                      </div>
                  </div>
                  
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                        Update
                      </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>                    
                </div>      
              </div>
              </div>
          
          </div>
      </form>

      <!-- update email form -->
      <form method="post" id="updateEmailForm">
        <div class="modal" id="updateemail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">
                            &times;
                        </button>
                        <h4 id="myModalLabel">
                            Enter new email:
                        </h4>
                    </div>
                    <div class="modal-body">
                        <!-- update email message from PHP file -->
                        <div id="updateEmail"></div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email:</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" maxlength="50" value="<?php echo $email ?>">                            
                        </div>                  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                        Update
                        </button> 
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                        </button>                    
                    </div>
                </div>
            </div>
        </div>
      </form>
 
      <!-- update password form -->
      <form method="post" id="updatepasswordform">
        <div class="modal" id="updatepassword" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">
                            &times;
                        </button>
                        <h4 id="myModalLabel">
                            Enter Current and New password:
                        </h4>                    
                    </div>
                    <div class="modal-body">
                        <div id="updatepasswordmessage"></div>
                        <div class="form-group">
                            <label for="currentpassword" class="sr-only">Your Current Password:</label>
                            <input class="form-control" type="password" name="currentpassword" id="currentpassword" placeholder="Your Current Password" maxlength="30">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Choose a Password:</label>
                            <input class="form-control" type="password" name="password" id="password" placeholder="Choose a Password" maxlength="30">
                        </div>                        
                         <div class="form-group">
                            <label for="password2" class="sr-only">Confirm Password:</label>
                            <input class="form-control" type="password" name="password2" id="password2" placeholder="Confirm Password" maxlength="30">
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Change
                        </button>     
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
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

       <script src="js/profile.js"></script>
  </body>
</html>
