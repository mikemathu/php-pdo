<?php
include('includes/config.php');
include('includes/db.php');
 
$message = '';

// Check for Submission
if(isset($_POST['submit'])){
  // Get form data
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $repassword = $_POST['repassword'];

  if(empty($email) || empty($password)) {
    $message .= '
					<div class="alert alert-danger">
		                <h4><i class="icon fa fa-warning"></i> Error!</h4>
		                All field are required
		            </div>
		            <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
				';
    } else {
      if($password != $repassword){
        $message .= '
					<div class="alert alert-danger">
		                <h4><i class="icon fa fa-warning"></i> Error!</h4>
                    passwords did not match
		            </div>
		            <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
				';
        // echo "<script>alert('Invalid Details');</script>";
        // <script>Passwords did not match</script;
        // header('location: register.php');
    
      }
      else{
        $sql = 'SELECT * FROM members WHERE username = :username OR email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username,$email]);
        $row = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        if($rowCount > 0){
          $message .= '
					<div class="alert alert-danger">
		                <h4><i class="icon fa fa-warning"></i> Error!</h4>
		                The username or email already exists!
		            </div>
		            <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
				';
      } else {
        try{
          $sql="INSERT INTO members(username,email,password) VALUES(?,?,?)";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([$username, $email, $password]);
          $count = $stmt->rowCount();
  
          $lastInsertId = $pdo->lastInsertId();
      
      if($lastInsertId){
        $message .= '
              <div class="alert alert-success">
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        Account activated - Email: <b>'.$email.'</b>.
                    </div>
                    <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
            ';
  
      }
        }
        catch(PDOException $e){
          $message .= '
          <div class="alert alert-danger">
                    <h4><i class="icon fa fa-warning"></i> Error!</h4>
                    '.$e->getMessage().'
                </div>
                <h4>You may <a href="signup.php">Signup</a> or back to <a href="index.php">Homepage</a>.</h4>
        ';
        }
       
      }

       

        
       
      }  
}
}

    /*



  //Fetch Multiple  Posts Using Prepared Statement 
  // User Input
  $author = 'Mike';
  $is_published = true;
  $id = 1;
  $limit = 1;

  // Positional Params
  $sql = 'SELECT * FROM posts WHERE author = ? && is_published = ?';
  $stmt = $pdo->prepare($sql);   //Prepare
  $stmt->execute([$author, $is_published]);  //Execute
  $posts = $stmt->fetchAll();

  foreach($posts as $post){
    echo $post['title'] . '<br>';
  }

  // FETCH SINGLE POST
  $sql = 'SELECT * FROM posts WHERE id = :id';
  $stmt = $pdo->prepare($sql);
  // $stmt->execute(['id' => $id]);
  $post = $stmt->fetch();

  // echo $post['title'];

  // echo $postCount;

  // UPDATE DATA
  // $id = 8;
  // $body = 'This is the uupdated post';

  $sql = 'UPDATE posts SET body = :body WHERE id = :id';
  $stmt = $pdo->prepare($sql);
  // $stmt->execute(['body' => $body, 'id' => $id]);
  // echo 'Post Updated';

  // DELETE DATA
  // $id = 8;

  $sql = 'DELETE FROM posts WHERE id = :id';
  $stmt = $pdo->prepare($sql);
  // $stmt->execute(['id' => $id]);
  // echo 'Post Deleted';

  // SEARCH DATA
  $search = "";
  $sql = 'SELECT * FROM posts WHERE title LIKE ?';
  $stmt = $pdo->prepare($sql);
//   $stmt->execute([$search]);
  $posts = $stmt->fetchAll();

  foreach($posts as $post){
    // echo $post->title . '<br>';
  }

  */
?>
<?php include('includes/header.php'); ?>
 <div class="container">
 <h1 class="justify-content-center">Registe</h1>
 
<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<div class="col-sm-9">
	        		<?php echo $message; ?>
	        	</div>
        <div class="form-group">
            <label for="Title">User Name</label>
            <input type="text" id="Title" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="authot">Email</label>
            <input type="text" name="email" id="authot" class="form-control">
        </div>
        <div class="form-group">
            <label for="authot">Password</label>
            <input type="text" name="password" id="authot" class="form-control">
        </div>
        <div class="form-group">
            <label for="authot">Re-enter Your Password</label>
            <input type="text" name="repassword" id="authot" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </div>
      </form>
      
 </div>
 <?php include('includes/footer.php'); ?>
 

  