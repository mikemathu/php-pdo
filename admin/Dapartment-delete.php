<?php include('includes/config.php'); ?>
<?php include('includes/db.php');?>
<?php

if(isset($_POST['delete'])){
    try{
        $sql = 'DELETE FROM tdldepartments WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

    } catch(PDOExeption $e) {

        echo $e->getMessage();

    }
   
}


   
?>


<?php include('includes/header.php'); ?>




<?php include('includes/footer.php'); ?>
<?php include('includes/department-modal.php'); ?>