<?php include('includes/config.php'); ?>
<?php include('includes/db.php');?>

<?php include('includes/header.php'); ?>


<!-- <div class="pull-right">
                <form class="form-inline">
                  <div class="form-group">
                    <label>Category: </label>
                    <select class="form-control input-sm" id="select_category">
                      <option value="0">ALL</option>
                      <?php

                    // $where = '';
                    // if(isset($_GET['department'])){
                    //   $catid = $_GET['department'];
                    //   $where = 'WHERE category_id ='.$catid;
                    // }

                    // $sql = 'SELECT * FROM tbldepartment';
                    // $stmt = $pdo->prepare($sql);
                    // $stmt->execute();
                    // $departments = $stmt->fetchAll();

                    //     foreach($stmt as $crow){
                    //       $selected = ($crow['id'] == $catid) ? 'selected' : ''; 
                    //       echo "
                    //         <option value='".$crow['id']."' ".$selected.">".$crow['name']."</option>
                    //       ";

                        
                    //     ;
                    //     }

            
                      ?>
                    </select>
                  </div>
                </form>
              </div> -->

<div class="container">
<table class="table table-striped">
  <thead>
    <tr>
    <th scope="col">username</th>
      <th scope="col">email</th>
      <!-- <th scope="col">Email</th> -->
      <th scope="col">photo</th>
      <th scope="col">Actions</th>

      <!-- <th scope="col">Action</th> -->
    </tr>
  </thead>
  <tbody>
 
 <label for="department">Department</label>
 <input type=" inputType" id="department" class="form-control">
  

  <?php
  if(isset($_GET['department'])){
    $dprtmntid = $_GET['department'];
    $where = 'WHERE department_id ='.$dprtmntid;
  }
try{
  $sql ='SELECT * FROM members WHERE department_id = ?';
  $stmt = $pdo->prepare($sql);  
  $stmt->execute();
  $members = $stmt->fetchAll();

  foreach($members as $member){
    $username = $member['username'];
    $email = $member['email'];
    $photo = (!empty($member['photo'])) ? $member['photo']: '';
    $status = ($member['status']) ? '<span class="label label-success">Block</span>' : '<span class="label label-danger">Unblock</span>';
    echo "
      <tr>
    
      
        <td>".$username."</td>
        <td>".$email."</td>
        <td>".$photo."</td>
        <td>
        
        <button class='btn btn-default border-secondary mx-2 data-id'".$member['id']."'>".$status."</button>
        <button class='btn btn-danger data-id='".$member['id']."'>Delete</button>
        </td>
        
       
      </tr>
    ";
  };
  

}catch (PDOException $e){
  // echo $e->getMessage();
}

  try{
    $sql = 'SELECT * FROM members';
    $stmt = $pdo->prepare($sql);   //Prepare
    $stmt->execute();  //Execute
    $members = $stmt->fetchAll();

    foreach($members as $member){
      $username = $member['username'];
      $email = $member['email'];
      $photo = (!empty($member['photo'])) ? $member['photo']: '';
      $status = ($member['status']) ? '<span class="label label-success">Block</span>' : '<span class="label label-danger">Unblock</span>';
      echo "
        <tr>
      
        
          <td>".$username."</td>
          <td>".$email."</td>
          <td>".$photo."</td>
          <td>
          
          <button class='btn btn-default border-secondary mx-2 data-id'".$member['id']."'>".$status."</button>
          <button class='btn btn-danger data-id='".$member['id']."'>Delete</button>
          </td>
          
         
        </tr>
      ";
    }

  }catch (PDOException $e){
    echo $e->etMessage();
  }
      
                  
                    
                  
                   
                  ?>
  


 

    <tr>

  </tbody>
</table>
</div>

<?php include('includes/footer.php'); ?>