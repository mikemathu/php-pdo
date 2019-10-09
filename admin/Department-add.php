<?php include('includes/config.php'); ?>
<?php include('includes/db.php');?>
<?php
 $message = '';

// Check for Submission
if(isset($_POST['add'])){
    // Get form data
    $dptmntName = $_POST['dptmntname'];
    $dptmntShortName = $_POST['dptmntshortname'];
    $dptmntCode = $_POST['dptmntcode'];
    $dptmntlogo = $_POST['dptmntlogo'];
  
    if(empty($dptmntName) || empty($dptmntShortName) || empty($dptmntCode) ) {
      $message .= '
                      <div class="alert alert-danger">
                          <h4><i class="icon fa fa-warning"></i> Error!</h4>
                          All field are required
                      </div>
                      <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
                  ';
      } else {
          $sql = 'SELECT * FROM tbldepartments WHERE DepartmentName = ? OR DepartmentCode = ?';
          $stmt = $pdo->prepare($sql);
          $stmt->execute([$dptmntName,$dptmntCode]);
          $row = $stmt->fetchAll();
          $rowCount = $stmt->rowCount();
  
          if($rowCount > 0){
            $message .= '
                      <div class="alert alert-danger">
                          <h4><i class="icon fa fa-warning"></i> Error!</h4>
                          The department name or department code already exists!
                      </div>
                      <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
                  ';
        } else {
          try{
            $sql = 'INSERT INTO tbldepartments(DepartmentName, DpartmentShortName, DepartmentCode,logo) VALUES(:title, :body, :author)';
        $stmt = $pdo->prepare($sql);
         $stmt->execute([$dptmntName, $dptmntShortName, $dptmntCode]);
        
      
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
  


   
?>


<?php include('includes/header.php'); ?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  add 
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <h6>ADD Department</h6>
            <h1>".$row['id']."</h1>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>