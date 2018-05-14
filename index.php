<?php

// include('register.php');
session_start();

include('includes/functions.php');

// $formEmail = '';
$loginError = '';
$formName = '';
$formUsername = '';
$hashedPass = '';
// $formEmail = '';

// if login form was submitted
if (isset( $_POST['login'] ) ) {

  // code...
  $formUsername = validateFormData($_POST['username']);
  // $formEmail = validateFormData($_POST['email']);
  $formPassword = validateFormData($_POST['password']);


  // connect to database
  include('includes/connection.php');

  // create query
  $query = "SELECT username, name, password FROM users WHERE username='$formUsername'";

  // store the result
  $result = mysqli_query($conn, $query);

  // verify if result is returned
  if( mysqli_num_rows($result) > 0 ) {

    // store basic user data in variables
    while( $row = mysqli_fetch_assoc($result) ) {
      $formUsername     = $row['username'];
      $name             = $row['name'];
      $dBformPass       = $row['password'];
    }

    $hashedPass = password_hash('1234', PASSWORD_DEFAULT);
    // verify hashed password with submitted password
    if( password_verify($formPassword, $hashedPass ) ) {

      // correct login details!
      // store data in SESSION Variables
      $_SESSION['loggedInUser'] = $name;
      echo $_SESSION['loggedInUser'];

      // redirects user to clients page
      header( "Location: clients.php");
    } else { // hashed password didn't verify

      // error message
      $loginError = "<div class='alert alert-danger'> Wrong username / password combination.  Try again. </div>";
    }

  } else { // there are no results in database

     // error message
     $loginError = "<div class='alert alert-danger'> User does not exist.  Try again. <a class='close' data-dismiss='alert'>&times;</a></div>";
  }
  mysqli_close($conn);
}

// close mysql connection



include('includes/header.php');

// $password = password_hash("1234", PASSWORD_DEFAULT);
// echo $password;
?>

<h1>Client Address Book</h1>
<p class="lead">Log in to your account.</p>

<?php if(isset($loginError)) {echo $loginError; }
?>

<form class="form-inline" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>" method="post">
    <div class="form-group">
        <label for="login-username" class="sr-only">Username</label>
        <input type="text" class="form-control" id="login-username" placeholder="username" name="username" value="<?php echo $formUsername; ?>">
    </div>
    <!-- <div class="form-group">
        <label for="login-email" class="sr-only">Email</label>
        <input type="text" class="form-control" id="login-email" placeholder="email" name="email" value="">
    </div> -->
    <div class="form-group">
        <label for="login-password" class="sr-only">Password</label>
        <input type="password" class="form-control" id="login-password" placeholder="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="login">Login</button>
     <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
</form>

<?php
include('includes/footer.php');
?>
