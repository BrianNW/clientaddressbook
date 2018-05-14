<?php

session_start();


// if user is not logged in
if( !isset($_SESSION['loggedInUser'])) {
  // send them to login page
  header("Location: index.php");
}

// connect to db
include('includes/connection.php');

include('includes/functions.php');

// if add button was submitted
if( isset( $_POST['add'])) {
  // set all variables to empty by default
  $clientName = $clientEmail = $clientAddress = $clientPhone = $clientCompany = $clientNotes = "";

  // check to see if inputs are empty
  // create variables with form data
  // wrap the data with our function

  if( !isset($_POST["clientName"])) {
      $nameError = "Please enter a name <br>";
  } else {
      $clientName = validateFormData( $_POST["clientName"] );
  }

  if( !isset($_POST["clientEmail"])) {
      $emailError = "Please enter an email <br>";
  } else {
      $clientEmail = validateFormData( $_POST["clientEmail"] );
  }


  // these inputs are not required so store whatever has been entered

  $clientPhone            = validateFormData( $_POST["clientPhone"] );
  $clientAddress          = validateFormData( $_POST["clientAddress"] );
  $clientCompany          = validateFormData( $_POST["clientCompany"] );
  $clientNotes            = validateFormData( $_POST["clientNotes"] );

  $query = '';

  // if required fields have data
  if( $clientName && $clientEmail) {

    // create query
      $query = "INSERT INTO clients (id, name, email, phone, address, company, notes, date_added) VALUES (NULL, '$clientName', '$clientEmail', '$clientPhone', '$clientAddress', '$clientCompany', '$clientNotes', CURRENT_TIMESTAMP)";

    // store results
    $result = mysqli_query( $conn, $query );

    // if query was successful
    if( $result) {
      // refresh page with query string
      header( "Location: clients.php?alert=success" );
    }else {
      // something went Wrong
      echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
  }
}

// close connection
mysqli_close($conn);

include('includes/header.php');

?>

<h1>Add Client</h1>

<?php
 // echo $_SESSION['loggedInUser'];
 ?>

<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>" method="post" class="row">
    <div class="form-group col-sm-6">
        <label for="client-name">Name *</label>
        <input type="text" class="form-control input-lg" id="client-name" name="clientName" value="" required>
    </div>
    <div class="form-group col-sm-6">
        <label for="client-email">Email *</label>
        <input type="text" class="form-control input-lg" id="client-email" name="clientEmail" value="" required>
    </div>
    <div class="form-group col-sm-6">
        <label for="client-phone">Phone</label>
        <input type="tel" class="form-control input-lg" id="client-phone" name="clientPhone" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-address">Address</label>
        <input type="text" class="form-control input-lg" id="client-address" name="clientAddress" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-company">Company</label>
        <input type="text" class="form-control input-lg" id="client-company" name="clientCompany" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-notes">Notes</label>
        <textarea type="text" class="form-control input-lg" id="client-notes" name="clientNotes"></textarea>
    </div>
    <div class="col-sm-12">
            <a href="clients.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" class="btn btn-lg btn-success pull-right" name="add">Add Client</button>
    </div>
</form>

<?php
include('includes/footer.php');
?>
