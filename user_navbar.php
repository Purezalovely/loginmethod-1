
<?php
$current_page = basename($_SERVER['PHP_SELF']);
require_once('classes/database.php');
$con = new Database();

$id = $_SESSION['user_id'];
$data = $con->viewdata($id);

// Assuming the profile picture URL is stored in the session or fetched from the database
$profilePicture = $_SESSION['profile_picture'] ?? 'path/to/default/profile_picture.jpg';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <!-- <a class="navbar-brand" href="#">Welcome, <?php echo $_SESSION['username']; ?>!</a> -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item <?php echo ($current_page == 'user_account.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="user_account.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php echo ($current_page == 'enrolphp.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="enrol.php">Enrol Now</a>
      </li>
      <li class="nav-item <?php echo ($current_page == 'enrolled_courses.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="enrolled_courses.php">My Courses</a>
      </li>
    </ul>
  </div>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
 

    
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="<?php echo $data['profile_picture']; ?>" width="30" height="30" class="rounded-circle mr-1"  alt="Profile Picture"> <?php echo $_SESSION['username']; ?>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changeProfilePictureModal"><i class="fas fa-user-circle"></i> Change Profile Picture</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateAccountInfoModal"><i class="fas fa-user-edit"></i> Update Account Information</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePasswordModal"><i class="fas fa-key"></i> Change Password</a>
            <a class="dropdown-item" href="#" onclick="logoutConfirm(); return false;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>

      </li>
    </ul>
  </div>
</nav>

<script>
  function logoutConfirm() {
  Swal.fire({
    title: 'Are you sure you want to log out?',
    text: 'You will be logged out of your account.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, log out'
  }).then((result) => {
    if (result.isConfirmed) {
      // Remove the status parameter from the URL
      const newUrl = window.location.origin + window.location.pathname;
      window.history.replaceState(null, null, newUrl);

      // Perform logout action here
      window.location.href = 'logout.php';
    }
  });
}
</script>