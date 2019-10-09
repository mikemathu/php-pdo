<?php
include('includes/config.php');
include('includes/db.php');

$message = '';

if(isset($_POST['submit'])){
$password=$_POST['password'];
$newpassword=$_POST['newpassword'];
$renewpassword=$_POST['renewpassword'];
$username=$_POST['username'];
$updatedate=date('d-m-Y h:i:s', time());

if(empty($password) || empty($newpassword) ||  empty($renewpassword) ||empty($username)) {
    $message .= '
					<div class="alert alert-danger">
		                <h4><i class="icon fa fa-warning"></i> Error!</h4>
		                All field are required
		            </div>
		            <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
				';
    } else {
      if($newpassword != $renewpassword){
        $message .= '
        <div class="alert alert-danger">
            <h4><i class="icon fa fa-warning"></i> Error!</h4>
        passwords did not match
        </div>
        <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
    ';    
      }else{
        $sql ='SELECT password FROM members WHERE username=:username AND password=:password';
        $stmt= $pdo->prepare($sql);
        $stmt->execute(['username' => $username,'password' => $password]);
        $row = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        if($rowCount > 0){
            try{
            $sql = 'UPDATE members SET password =:newpassword, updatedate =:updatedate WHERE username=:username';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['newpassword' => $newpassword,'username' => $username, 'updatedate' => $updatedate]);
            echo 'Password successfully Updated';
            }
            catch(PDOException $e){
                $_SESSION['error'] = $e->getMessage();
                // header('location: '.$path);
            }
        } else {
        $message .= '
        <div class="alert alert-danger">
            <h4><i class="icon fa fa-warning"></i> Error!</h4>
            Your current password is wrong
        </div>
        <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
    ';   
        }      
      } 
    } 
 }
?>

<?php include('includes/header.php'); ?>
 <div class="container">
 <h1 class="justify-content-center">Registe</h1>
 
<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<div class="col-sm-9">
	        		<?php echo $message; ?>
	        	</div>
        <div class="form-group">
            <label for="Title">Old Password</label>
            <input type="text" id="oldpassword" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="authot">New Password</label>
            <input type="text" name="newpassword" id="newpassword" class="form-control">
        </div>
        <div class="form-group">
            <label for="authot">Re-enter Password</label>
            <input type="text" name="renewpassword" id="renewpassword" class="form-control">
        </div>
        <div class="form-group">
            <label for="authot">User Name</label>
            <input type="text" name="username" id="username" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </div>
      </form>
      
 </div>
 <?php include('includes/footer.php'); ?>