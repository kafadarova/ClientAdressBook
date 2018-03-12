<?php
//starting the session of a user
session_start();

//include functions file
include('includes/functions.php') ;
//check if the login form is submitted

if( isset( $POST['login'])){
  //create variables
  // wrap data with validate function
  $formEmail = validateFormDate($_POST['email']);
  $formPass = validateFormDate($_POST['password']);


  //connect to database
  include ('includes/connection.php');

  //create query
  $query = "SELECT name, password FROM users WHERE email='$formEmail'";


  //store the result
  $result = mysqli_query( $conn, $query);

  //verify if result is returned

  if (mysqli_num_rows($result) > 0) {

    //store basic user data in variables
    while( $row = mysqli_fetch_assoc($result)){
      $name = $row['name'];
      $hashedPass = $row['password'];
    }

    //verify hashed password with submtted password
    if(password_verify( $formPass, $hashedPass)){

      //correct login details
      //store data in SESSION variables
      //while session active - global variables - accessable everywhere
      $_SESSION['loggedInUser'] = $name;

      //redirect user to clients page
        header("Location: clients.php");
    } else{
      //hashed password didn't veryfy
      //error message
      $loginError = "<div class='alert alert-danger'>Wrong username / password combination. Try again. </div>";
    }

  }else{
    //there are no result in datebase
    $loginError = "<div class='alert alert-danger'>No such  user in database. Please try again.<a class='close' data-dismiss='alert'>&times; </a></div>";

  }
}

//close mysql connection
mysqli_close($conn);
include ('includes/header.php');

// $password = password_hash("abc123", PASSWORD_DEFAULT);
// echo $password;
 ?>

<h1>Client Address Book</h1>
<p class="lead">Log in to your account</p>
<?php echo $loginError;  ?>

<form class="form-inline" action="<?php echo htmlspecialchars( $SERVER['PHP_SELF'])?>" method="post">
  <div class="form-group">
    <label for="login-email" class="sr-only">Email</label>
    <input type="text" class="form-control" id="login-email" placeholder="email" name="email" value="<?php echo $formEmail; ?>">
</div>
<div class="form-group">
  <label for="login-password" class="sr-only">Password</label>
  <input type="password" class="form-control" id="login-password" placeholder="password" name="password">
</div>
<button type="submit" class="btn btn-primary" name="login">Login</button>
</form>

<?php include ('includes/footer.php'); ?>
