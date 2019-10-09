<?php include('includes/config.php'); ?>
<?php include('includes/db.php');?>

<?php include('includes/header.php'); ?>

<div class="container">
<table class="table table-striped">
  <thead>
    <tr>
    <th scope="col">Department Name</th>
      <th scope="col">DpmntShort Name</th>
      <!-- <th scope="col">Email</th> -->
      <th scope="col">Dpmnt code</th>
      <th scope="col">Dpmnt logo</th>
      <th scope="col">Actions</th>

      <!-- <th scope="col">Action</th> -->
    </tr>
  </thead>
  <tbody>
 
  

  <?php

  try{
    $sql = 'SELECT * FROM tbldepartments';
    $stmt = $pdo->prepare($sql);   //Prepare
    $stmt->execute();  //Execute
    $departments = $stmt->fetchAll();

    foreach($departments as $department){
        $dptmntName = $department['DepartmentName'];
        $dptmntShortName = $department['DepartmentShortName'];
        $dptmntCode = (!empty($department['DepartmentCode']));
        $dptmntlogo = (!empty($department['logo'])) ? $department['logo']: '';
        echo "
          <tr>
        
          
            <td>".$dptmntName."</td>
            <td>".$dptmntShortName."</td>
            <td>".$dptmntCode."</td>
            <td>".$dptmntlogo."</td>
            
            <td>
            <a href='includes/department-modal.php' ><button class='btn btn-default border-secondary data-id'".$department['id']."'>Edit</button></a>
            <button class='btn btn-danger data-id='".$department['id']."'>Delete</button>
            
            <button class='btn btn-default border-secondary data-id'".$department['id']."'>View Members</button>
            </td>
           
          </tr>
        ";
      }

  } catch (PDOExeption $e){
      echo $e->getMessage();
  }
      
                  
                  
                  
                   
                  ?>
  


 

    <tr>

  </tbody>
</table>
</div>


<?php include('includes/footer.php'); ?>