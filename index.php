<?php
$pageTitle="home";
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
        // sign up 

    if(isset($_GET["signUp"] ) ){
    echo "<div class=' ma row j-c-c g-0'>
        <form action='' method='post' class='col-3 row j-c-c'>
           <input type=\"text\" name=\"email\" class=\"bg-warning border-0 \" placeholder=\"";trans($ln,"your email");echo"\">
           <input type=\"password\" name=\"password\" class=\" my-3 bg-warning border-0 \" placeholder=\"";trans($ln,"your password");echo"\">
           <input type=\"submit\" value=\"";trans($ln,"sign up");echo"\" class=\"btn btn-warning col-6 \">";
           if( isset($_POST["email"]) && isset($_POST["password"]) && !empty($_POST['email'] && !empty(sha1($_POST['password'] ) ) ) ) {
               $email = $_POST["email"];
               $password = $_POST["password"] ;
               $password_sha1 = sha1($_POST["password"]) ;
               $signup_errors=[];

               if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { array_push($signup_errors,"this email is not valid"); }
               if (!validatePassword($password)) { array_push($signup_errors,"this password shoud contain 1 letter small and 1 letter majscul and 1 number at laste"); }
               if (empty($signup_errors)){ 

                   $stmt = $db->prepare("INSERT INTO users (email,password,join_date) VALUES (:email,:password,now())");
                   $stmt->bindParam(':email',$email);
                   $stmt->bindParam(':password', $password_sha1);
               
                   // قم بتنفيذ الاستعلام
                   $stmt->execute();
                   header("location:${url}?signIn");
                   exit();

               } else {

                foreach ($signup_errors as $signup_error){
                    echo "<div class='bg-danger mt-3'>$signup_error</div>";
                }

               }


           
           
               }
    echo "</form>
    </div>";
  

    // sign in 

    } else {
        echo "<div class=' ma row j-c-c g-0'>
        <form action='' method='post' class='col-3 row j-c-c'>
           <input type=\"text\" name=\"email\" class=\"bg-warning border-0 \" placeholder=\"";trans($ln,"your email");echo"\">
           <input type=\"password\" name=\"password\" class=\" my-3 bg-warning border-0 \" placeholder=\"";trans($ln,"your password");echo"\">
           <input type=\"submit\" value=\"";trans($ln,"sign in");echo"\" class=\"btn btn-warning col-6 \">";
           if( isset($_POST["email"]) && isset($_POST["password"]) && !empty($_POST['email'] && !empty(sha1($_POST['password'] ) ) ) ) {
               $email = $_POST["email"];
               $password = sha1($_POST["password"]) ;
           
               $stmt = $db->prepare("SELECT * FROM users where email=:email && password=:password");
               $stmt->bindParam(':email', $email);
               $stmt->bindParam(':password', $password);
               $stmt->execute();
               $result = $stmt->fetchall(PDO::FETCH_ASSOC);
               
                
                if (count($result) == 1) {
                    $id=$result[0]["id"];
                    header("location:${url}user.php?user_id=${id}");
                    exit();
               } 
               else { echo "username or password is false";}
            }
    echo "</form>
    </div>";

    }?>
</section>




<?php include("includes/templates/footer.php") ?>

