<?php include('includes/header.php'); ?>

<?php include('includes/config.php');?>
<?php include('includes/db.php');?>

<div class="container d-flex py-4">
<div class="col-sm-3">
<div class="jumbotron">
  <!-- <h3 class="glyphicon glyphicon-user">23</h3> -->
  <?php
    //count mebers
$stmt = $pdo->prepare('SELECT * FROM members');
$stmt->execute();
$membersCount = $stmt->rowCount();

echo "<h3 class='glyphicon glyphicon-user'>".$membersCount."</h3>";
  ?>
  <h6>Regd Members</h6>
</div>
</div>

<div class="col-sm-3">
<div class="jumbotron">
  <?php
    //Count Depeartments
$stmt = $pdo->prepare('SELECT * FROM tbldepartments');
$stmt->execute();
$departmentsCount = $stmt->rowCount();

echo "<h3 class='glyphicon glyphicon-user'>".$departmentsCount."</h3>";
  ?>
  <h6>Departments Listed</h6>
</div>
</div>



</div>



<?php include('includes/footer.php'); ?>