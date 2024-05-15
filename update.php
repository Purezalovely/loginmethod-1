<?php
require_once('classes/database.php');
$con = new database();

if (empty($id = $_POST['id'])) {
  header('location:index.php');
} else {
  $id = $_POST['id'];
  $data = $con->viewdata($id);
}

if(isset($_POST['update'])) {
  //user information
  $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    //Address Information
    
    $street = $_POST['user_add_street'];
    $barangay = $_POST['user_add_barangay'];
    $city = $_POST['user_add_city'];
    $province = $_POST['user_add_province'];
    $user_id = $_POST['id'];

if ($password == $confirm) {
  if ($con-> updateUser($user_id, $firstname, $lastname, $birthday, $sex, $username, $password)) {
    // Update user Address

if (con->UpdateUserAddress($user_id, $street, $barangay, $city, $province)) {
  // Both update successful, redirect to a success page or display a success messge
  header('location:index.php');
  exit();
} else {
  // user address update failed
  $error = "Error occured while updating user address. Please try again";
     }
    }
     else{
      $error = "Error occured while updating user address. Please try again";

     }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MultiSave Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    .custom-container{
        width: 800px;
    }
    body{
    font-family: 'Roboto', sans-serif;
    }
  </style>

</head>
<body>

<div class="container custom-container rounded-3 shadow my-5 p-3 px-5">
  <h3 class="text-center mt-4"> Edit Data Form</h3>
  <form method="post" action="multisave.php">
    <!-- Personal Information -->
    <div class="card mt-4">
      <div class="card-header bg-info text-white">Personal Information</div>
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-6 col-sm-12">
            <label for="firstName">First Name:</label>
            <input type="text" class="form-control" name="firstname" valve="<?php echo $data['firstname'];?>" placeholder="Enter first name">

            <input type="hidden" value="<?php echo $rows['user_id'] ?>" name="id">
            <input type="submit" name="update" class="btn btn-primary btn-sm" value="Update" onclick="return confirm('Are you sure you want to update this user?')">
        </form>

          </div>
          <div class="form-group col-md-6 col-sm-12">
            <label for="lastName">Last Name:</label>
            <input type="text" class="form-control" name="lastname"  placeholder="Enter last name">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="birthday">Birthday:</label>
            <input type="date" class="form-control" name="birthday" >
          </div>
          <div class="form-group col-md-6">
            <label for="sex">Sex:</label>
            <select class="form-control" name="sex" >
              <option selected>Select Sex</option>
              <option value="Male" <?php if ($data['user_sex'] === 'Male')echo 'selected'; ?>>Male</option>
              <option>Female</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" name="username"  placeholder="Enter username">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" name="password"  placeholder="Enter password">
        </div>
        <div class="form-group">
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password">
</div>
      </div>
    </div>
    
    <!-- Address Information -->
    <div class="card mt-4">
      <div class="card-header bg-info text-white">Address Information</div>
      <div class="card-body">
        <div class="form-group">
          <label for="street">Street:</label>
          <input type="text" class="form-control" name="user_add_street"  placeholder="Enter street">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="barangay">Barangay:</label>
            <input type="text" class="form-control" name="user_add_barangay"  placeholder="Enter barangay">
          </div>
          <div class="form-group col-md-6">
            <label for="city">City:</label>
            <input type="text" class="form-control" name="user_add_city"  placeholder="Enter city">
          </div>
        </div>
        <div class="form-group">
          <label for="province">Province:</label>
          <input type="text" class="form-control" name="user_add_province"  placeholder="Enter province">
        </div>
      </div>
    </div>
    
    <!-- Submit Button -->
    
    <div class="container">
    <div class="row justify-content-center gx-0">
        <div class="col-lg-3 col-md-4"> 
        <input type="hidden" name="id" value="<?php echo $data['user_id']; ?>">
            <input type="submit" name="update" class="btn btn-outline-primary btn-block mt-4" value="Save">
        </div>
        <div class="col-lg-3 col-md-4"> 
            <a class="btn btn-outline-danger btn-block mt-4" href="login.php">Go Back</a>
        </div>
    </div>
</div>

</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<!-- Bootsrap JS na nagpapagana ng danger alert natin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>