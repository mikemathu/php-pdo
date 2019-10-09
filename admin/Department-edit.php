<?php include('includes/config.php'); ?>
<?php include('includes/db.php');?>

<?php
    // Check for Submission
if(isset($_POST['update'])){
    // Get form data
    $id = $_POST['id'];
    $dptmntName = $_POST['dptmntname'];
    $dptmntShortName = $_POST['dptmntshortname'];
    $dptmntCode = $_POST['dptmntcode'];
    $dptmntlogo = $_POST['dptmntlogo'];
  
    $stmt = $cpdo->prepare("SELECT * FROM tbldepartments WHERE id=?");
    $stmt->execute([$id]);
    $department = $stmt->fetch();

    try{
        $sql = 'UPDATE tbldepartments SET DepartmentName = ?, DepartmentShortName = ?, DepartmentCode =?, logo = ? WHERE id = ?';
        $stmt = $pdo->prepare($sql);
      $stmt->execute([$dptmntName,$dptmntShortName,$dptmntCode,$dptmntlogo]);
    } catch (PDOExeption $e){
        echo $e->getMessage();
    }
  
  }
  
?>

<?php include('includes/header.php'); ?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Edit
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
      <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<div class="col-sm-9">
	        		<?php //echo $message; ?>
	        	</div>
        <div class="form-group">
            <label for="dpmntname">Department Name</label>
            <input type="text" id="dpmntname" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="dpmntshrtname">Department Short Name</label>
            <input type="text" name="email" id="dpmntshrtname" class="form-control">
        </div>
        <div class="form-group">
            <label for="dpmntcode">Department Code</label>
            <input type="text" name="password" id="dpmntcode" class="form-control">
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>