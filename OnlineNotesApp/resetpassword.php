<?php
session_start();

include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PASSWORD RESET</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        
        <style>
            h1{
                color: purple;
            }
            .contractForm{
                border: 1px solid #7c73f6;
                margin-top: 50px;
                border-radius: 15px;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10 contractForm">
                    <h1>Reset Password:</h1>
                    <div id="resultmessage"></div>
                    <?php
                        if(!isset($_GET['user_id']) || !isset($_GET['key'])) {
                            echo '<div class="alert alert-danger">There was an error. It is possible that the link given in an email wasn not processed. Did you click on the email link?</div>';
                            exit;
                        }
                    $user_id = $_GET['user_id'];
                    $key = $_GET['key'];
                    $time = time() - 86400;
                    
                    // Prepare variables for the query
                    $user_id = $db->escapeString ( $user_id );
                    $key =  $db->escapeString ( $key );
                    
                    // RUN the Query: Check the combo user_id and key exists and less than 24h old
                    $sql = "SELECT user_id FROM forgotpassword WHERE rkey='$key' AND user_id='$user_id' AND time > '$time' AND status='pending'";

 
                    $sql_count = "SELECT count(user_id) FROM forgotpassword WHERE rkey='$key' AND user_id='$user_id' AND time > '$time' AND status='pending'";
 
                    $db->exec('BEGIN');
                    $ret_count = $db->query($sql_count);
                    
                    if ( $ret_count !== 1){
                        echo '<div class="alert alert-danger">Please try again.</div>';
                        $db->close();
                        exit;
                    }
                    
                    $db->exec('COMMIT');
                    
                    echo "<form method=post id='passwordreset'>
                        <input type=hidden name=key value=$key>
                        <input type=hidden name=user_id value=$user_id>
                        <div class='form-group'>
                            <label for='password2'>Enter new Password:</label>
                            <input type='password' name='password2' id='password2' placeholder='Re-enter Password' class='form-control'>
                        </div>
                        <input type='submit' name='resetpassword' class='btn btn-success btn-lg' value='Reset Password'>
                    </form>";
                    ?>
                </div>
            </div>
        </div>
    
                
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!--Script for Ajax Call to storeresetpassword.php which processes form data-->
        <script>
            
        $("#passwordreset").submit(function(event){
           event.preventDefault();
            var datapost = $(this).serializeArray();
            
            // Send to signup.php using AJAX
            $.ajax ({
               url: "storeresetpassword.php",
               type: "POST",
               data: datapost,
               success: function(data){
                   $('#resultmessage').html(data);
               },
                error: function(){
                    $('resultmessage').html("<div class='alert alert-danger'>There was an error with Ajax. Retry later.</div>");
                }
            });
        });
        </script>
    </body>
</html>