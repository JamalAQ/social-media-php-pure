<?php
$pageTitle="delete";
require("classes/functions.php"); ?>
<!-- change langueg-->

<?php 



?>
<!-- change langueg has finished -->
<?php
include("includes/templates/header.php");
include("classes/connection.php");
?>
<?php 
################ starting   Delete user  ######################
           if (isset($_POST["delete"])&&$_POST["delete"]=="true") {
            $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(':id', $_GET["user_id"]);
            $stmt->execute();
            // من جافا سكريبت مبدائيا  حتى نرى لها حل اخر لأنها لا تعمل هنا header
            // لا يوجد لها حل اخر كما يبدو والحل من جافا سكريبت امن حتى الان 
            // header("location:http://localhost/my%20try%20project/"); 
            // exit();
            // تم تجريب مكتبة بي اتش بي ميلر بعد طلب ال اي جاكس و نجح الامر 

          }