<?php

session_start();

include('includes/functions.php');

// initializing variables

// REGISTER USER
if (isset($_POST['reg_user'])) {

  // $formUsername = "";
  // $formEmail    = "";
  // $err = "";
  // $em_error = "";
  // $password_err = "";

  // receive all input values from the form
  // code...
  $formUsername = validateNUFormData($_POST['username']);
  $formEmail = validateNUFormData($_POST['email']);
  $formPass_1 = validateNUFormData($_POST['password_1']);
  $formPass_2 = validateNUFormData($_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // if ($formUsername === '') { $err = "<div class='alert alert-danger'> Please enter a username</div>"; echo $err; }
  // if (!$_POST['email']) { $em_error = "<div class='alert alert-danger'> Email is required</div>"; echo $em_error; }
  // if (!$_POST['password_1']) { $password_err = "<div class='alert alert-danger'> Password is required</div>"; echo $password_err; }


  if ($formPass_1 != $formPass_2) {
  $password_err = "<div class='alert alert-danger'> The two passwords do not match</div>"; echo $password_err;
  }

  // connect to database
  include('includes/connection.php');

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $query =  "SELECT username, email FROM users WHERE username='$formUsername' OR email='$formEmail'";

  // store the result
  $result = mysqli_query($conn, $query);

  // verify if result is returned
  if (mysqli_num_rows($result) > 0 ) { // if user exists

      while( $user = mysqli_fetch_assoc($result) ) {
        $formUsername     = $user['username'];
        $formEmail        = $user['email'];
      }

    if ($user['username'] === $formUsername) {
      // $err = "Username already exists";
      // error message
      $loginError = "<div class='alert alert-danger'> Username already exists. </div>";
    }
    if($user['email'] === $formEmail) {
      // $err = "email already exists";
      $loginError = "<div class='alert alert-danger'> Email already exists </div>";
    }

  }else if(mysqli_num_rows($result) == 0 ){

    while( $user = mysqli_fetch_assoc($result) ) {
      $formUsername     = $user['username'];
      $formEmail        = $user['email'];
    }
  // Finally, register user if there are no errors in the form

   $hashedPass = password_hash($password_1, PASSWORD_DEFAULT);//encrypt the password before saving in the database

    $query = "UPDATE users
              SET name = '$name',
              username='$formUsername',
              email = '$formEmail',
              password = '$hashedPass'
              WHERE id= '$userID'";

    $update_result = mysqli_query($conn, $query);

    if($update_result)
     {
       $_SESSION['loggedInUser'] = $formUsername;
       $_SESSION['success'] = "You are now logged in";
       header('location: index.php');
     }else

        // something went Wrong
        echo "Error: ". $query . "<br>" . mysqli_error($conn);

    }
      mysqli_close($conn);

}


include('includes/header.php');

?>
