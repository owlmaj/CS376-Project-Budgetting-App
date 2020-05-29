<?php
require('user_class.php');

$message = "";

//if the form has been submitted
if(isset($_POST["email"]) && isset($_POST["pwd"]) && isset($_POST["pin"]))
{
    $email = trim($_POST["email"]);
    $pwd = trim($_POST["pwd"]);
    $pin = trim($_POST["pin"]);

    $user = new User($email, $pwd, $pin);
    $result = $user->register();

    if($result === false){
	$message = "Error: There was a problem creating your account. Please ensure the form was filled out correctly.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <script type="text/javascript" src="js/regis_val.js"></script>

    <style type="text/css">
    .err_msg
    {
	color:red;
    }
    </style>

    <title>Register</title>
</head>
<body>

    <!-- The big ol' banner thing on the top -->

    <div class="row jumbotron">
        <h1>Percent Budgets</h1>
    </div>

    <!-- ===================================== -->
    <!-- Here is the form for the registration -->
    <!-- ===================================== -->

    <div class="container">
        <h2>Registration</h2>
	<br/>
        <form id="register" action="register.php" method="POST">

            <!-- The bootstrap form-group for the email field -->
	    <div class="err_msg" id="email_msg"></div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" />
            </div>

            <!-- The bootstrap form-group for the password field -->
	    <div class="err_msg" id="pwd_msg"></div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" />
            </div>

            <!-- The bootstrap form-group for the pin field -->
	    <div class="err_msg" id="pin_msg"></div>
            <div class="form-group">
                <label for="pwd">Pin:</label>
                <input type="password" class="form-control" id="pin" placeholder="Enter pin" name="pin" />
            </div>
	    <div class="err_msg"><?=$message?></div>
	    <br/>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <br />
    <br />

    <script type = "text/javascript"  src = "js/regis-r.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
