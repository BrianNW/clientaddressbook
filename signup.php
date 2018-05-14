<?php

$formUsername = '';
$email = '';
include('register.php');
include('includes/header.php');

?>

<form class="form-inline" action="register.php " method="post" >
  	<div class="form-group">
  	  <label class="">Username</label>
  	  <input class="form-control" type="text" name="username" value="<?php echo $formUsername; ?>" required>
  	</div> <br>
  	<div class="form-group">
  	  <label class="">Email</label>
  	  <input class="form-control" type="email" name="email" value="<?php echo $email; ?>"required>
  	</div><br>
  	<div class="form-group">
  	  <label class="">Password</label>
  	  <input class="form-control" type="password" name="password_1"required>
  	</div><br>
  	<div class="form-group">
  	  <label class="">Confirm password</label>
  	  <input class="form-control" type="password" name="password_2"required>
  	</div><br>
  	<div class="form-group">
  	  <button type="submit" class="btn btn-primary" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="index.php">Sign in</a>
  	</p>
  </form>

<?php
include('includes/footer.php');
?>
