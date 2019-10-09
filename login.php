<?php
session_start();
include('includes/config.php');
include('includes/db.php');

$message = '';

if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if(empty($username) || empty($password)) {
      $message .= '
      <div class="alert alert-danger">
                <h4><i class="icon fa fa-warning"></i> Error!</h4>
                All field are required
            </div>
            <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
    ';
    } else {
    $sql="SELECT email,password FROM members WHERE username=? AND password=?";
    $stmt = $pdo->prepare($sql);   //Prepare
    $stmt->execute([$username, $password]);  //Execute
    $count = $stmt->rowCount();
    $row = $stmt->fetchALL();
     
    if($count == 1) {
      $_SESSION['username'] = $username;
      header("location:home.php");
      // if(isset($_SESSION['user'])){
      //   header('location: home.php');
      // }
      // if(isset($_SESSION['admin'])){
      //   header('location: admin.php');
      // }
    } else {
      $message .= '
      <div class="alert alert-danger">
                <h4><i class="icon fa fa-warning"></i> Error!</h4>
                Username/Password is wrong
            </div>
            <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
    ';
    }     
  }
}
?>

<?php include('includes/header.php'); ?>
 <div class="container">
 
<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<div class="col-sm-9">
	        		<?php echo $message; ?>
	        	</div>
        <div class="form-group">
            <label for="authot">Username</label>
            <input type="text" name="username" id="authot" class="form-control">
        </div>
        <div class="form-group">
            <label for="authot">Password</label>
            <input type="text" name="password" id="authot" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" name="login" value="Login" class="btn btn-primary">
        </div>
      </form>
      
 </div>
 <?php include('includes/footer.php'); ?>