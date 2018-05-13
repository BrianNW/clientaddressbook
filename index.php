<?php

session_start();

if (isset( $_POST['login'] ) ) {
  // code...
  $formUsername = $_POST['username'];
  $formEmail = $_POST['email'];
  $formPass = $_POST['password'];

  // connect to database
  include('includes/connection.php');

  // create query
  $query = "SELECT name, username, password FROM users WHERE email='$formEmail'";

  // store the result
  $result = mysqli_query($conn, $query);

  // verify if result is returned
  if( mysqli_num_rows($result) > 0 ) {

    // store basic user data in variables
    while( $row = mysqli_fetch_assoc($result) ) {
      $username     = $row['username'];
      $email        = $row['email'];
      $password     = $row['password'];
    }

    verify hashed password with submitted password
    if( password_verify( $formPass, $hashedPass ) ) {

      // correct login details!
      // store data in SESSION Variables
      $_SESSION['loggedInUser'] = $name;

      // redirects user to clients page
      header( "Location: clients.php");

    }

  }

}


include('includes/header.php');

// $password = password_hash("Start123!", PASSWORD_DEFAULT);
// echo $password;
?>

<h1>Client Address Book</h1>
<p class="lead">Log in to your account.</p>

<form class="form-inline" action="clients.php" method="post">
    <div class="form-group">
        <label for="login-username" class="sr-only">Username</label>
        <input type="text" class="form-control" id="login-username" placeholder="username" name="username">
    </div>
    <div class="form-group">
        <label for="login-email" class="sr-only">Email</label>
        <input type="text" class="form-control" id="login-email" placeholder="email" name="email">
    </div>
    <div class="form-group">
        <label for="login-password" class="sr-only">Password</label>
        <input type="password" class="form-control" id="login-password" placeholder="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="login">Login</button>
</form>

<?php
include('includes/footer.php');
?>
