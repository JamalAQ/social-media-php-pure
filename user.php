<?php 
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$pageTitle="profile";
require("classes/functions.php");
include("includes/templates/header.php");
include("classes/connection.php");
$user_id = $_GET["user_id"];
include("classes/query_test.php");
?>

<?php
$stmt = $db->prepare("SELECT * FROM users where id=:user_id");
$stmt->bindParam(':user_id', $_GET["user_id"]);
$stmt->execute();
$results = $stmt->fetchall(PDO::FETCH_ASSOC);
foreach($results as $result){
    $id=$result["id"];
    $email=$result["email"];
    $username=$result["username"];
    $password=hash("sha1",$result["password"]);
    $join_date=$result["join_date"];
    $status=$result["group_id"];
    $valid=$result["validate"];
    if($status=="1"){$status_r="Admin";}else{$status_r="normal user";}
    if($valid=="1"){$valid_r="valide";}else{$valid_r="non valide";}
}

############################################# start od pdf file with out payment ################################


if(isset($_POST["makePDF"])&& $_POST["makePDF"]=="true"){
    
// Include the main TCPDF library (search for installation path).
require_once("TCPDF-main/tcpdf.php");
// original code 

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// to stop the header and footer
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Our Code World');
$pdf->SetTitle('Example Write Html');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// add a page
$pdf->AddPage();

// يمكنك هنا تعريف متغيرات ب دالة شرطية عن الذكر والانثى واضافتهم داخل البيانات 
// في حالة انك نسيت السبان ضع اي و غير خصائصها  هي هي هي <span> OR <a>

$html = '
<table>
    <tr>
        <td>
            Hello '.$username.' here u can found your information
        </td>
    </tr><br><br>
    <tr>
    <td>
        your id is : '.$id.'.
    </td>
    </tr><br><br>
    <tr>
    <td>
        your email is : '.$email.'.
    </td>
    </tr><br><br>
    <tr>
    <td>
        your join date is : '.$join_date.'.
    </td>
    </tr><br><br>
    <tr>
    <td>
        yout status in this website is : <span style="background-color: red;">'.$status_r.'</span> .
    </td>
    </tr><br><br>
    <tr>
    <td>
        your valudate status in this wesite is : <span style="background-color: red;">'.$valid_r.'</span> .
    </td>
    </tr>
</table>';
 
$pdf->writeHTML($html, true, false, true, false, 'C');

// reset pointer to the last page
$pdf->lastPage();

// code do not work with this line (it is in php return to it later)
ob_end_clean();

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');



}



############################################## end of pdf file without payment ##############################

?>

<div class=' ma row j-c-c g-0'>
        <div id='try11' class='col-3 row j-c-c'><form action='' method='post' class='col-12 row j-c-c'>
           <div class='bg-warning  text-center '><?php trans($ln,"Your id is :");echo $id ?> </div>
           <div class='bg-warning my-3 text-center '><?php trans($ln,"Your join date is :");echo  $join_date?> </div>
           <input value="<?=$email?>" type="text" name="email" class="bg-warning border-0" placeholder="<?php trans($ln,"write here your new email") ?>">
           <input value='<?=$username?>' type="text" name="username" class="bg-warning border-0 mt-3" placeholder="<?php trans($ln,"write here your username") ?>">
           <input type="password" name="password" class=" mt-3 bg-warning border-0 " placeholder="<?php trans($ln,"write here your new password") ?>">
           <select name='status' class='mt-3 bg-warning'>
                <option value='normal user' <?php if ($status== 0) {echo "selected";} ?>><?php trans($ln,"normal user")?></option>
                <option value='admin'<?php if ($status== 1) {echo "selected";}?> ><?php trans($ln,"admin")?></option>
            </select>
            <select name='validate'class='my-3 bg-warning'>
                <option value='non valid'<?php if ($valid== 0) {echo "selected";}?> ><?php trans($ln,"non valid")?></option>
                <option value='valid'<?php if ($valid== 1) {echo "selected";}?> ><?php trans($ln,"valid")?></option>
            </select>
            <div class='col-12 row j-c-b'>
            <input type="submit" value="<?php trans($ln,"edit")?>" class="btn btn-warning col-5">
            <div id='oo' class='btn btn-danger  col-5 '><?php trans($ln,"Delete my Account")?></div>
            </div></form>
            <div class='col-12'><form method='post' class='col-12 mt-3 text-center'><input name='makePDF' value='true' hidden><input type='submit' value='<?php trans($ln,"make my PDF profile")?>'class='bg-warning nob-nol px-2 py-1'></form></div>
            
            
          <div class='col-12 row j-c-c'><div class='col-3 mt-3 text-center'><div id='pay' class='bg-warning nob-nol px-2 py-1'><?php trans($ln,"pay") ?> </div></div></div>
            
          </div>
          
          
          <?php
          
          #############################starting websocekt , sending freind reauest ####################################
          ?>
          
          <!-- INNER JOIN freindrequest ON users.id = freindrequest.receiver_id
            INNER JOIN freind ON users.id = freind.first_one_id or users.id = freind.second_one_id -->
          
          
         <div id='try22' class=' cc col-3 row '>
              <?php 

            $stmt1 = $db->prepare("SELECT * FROM users ");

            $stmt1->execute();
            $results1 = $stmt1->fetchall(PDO::FETCH_ASSOC);


            $stmt2 = $db->prepare("SELECT * FROM freindrequest WHERE sender_id = :user_id");
            $stmt2->bindParam(":user_id", $user_id);
            $stmt2->execute();
            $results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);


            // print_r($results1);

            // print_r($results2);

            foreach($results1 as $result1){
                $username=$result1["username"];
                $id=$result1["id"];
                foreach($results2 as $result2){
                    $recever_id=$result2["receiver_id"];
                    if ($id == $recever_id){$status = "added";}else{$status = "not added";}
                    if ($status == "added"){ break ;}
                }
                ?>
                <div  class=' bg-warning h-f-c al-i-c mx-5 mb-5 members row '>
                    <div class=" col-6 member-name"><?php echo"$id : $username";?></div>
                <?php if ($status=="added") {echo'<span class=" check-mark col-1 remove-freind-request-class"></span>';}
                    else {echo'<span class=" add-icon col-1 send-freind-request-class"></span>';}
                ?>
                       
                    </div>
                <?php
            }

                if(isset($_POST["potintial_friend_id"])){
                    $stmt=$db->prepare("INSERT INTO freindrequest (sender_id,receiver_id,sending_date) VALUES (:sender_id,:receiver_id,now())");

                     $stmt->bindParam(':sender_id', $_GET["user_id"]);

                     $stmt->bindParam(':receiver_id', $_POST["potintial_friend_id"]);

                     $stmt->execute();



                }


                if(isset($_POST["remove_friend_id"])){
                    $stmt=$db->prepare("DELETE FROM freindrequest WHERE receiver_id = :receiver_id ");

                     $stmt->bindParam(':receiver_id', $_POST["remove_friend_id"]);

                     $stmt->execute();



                }

            ?>

           



            </div></div>
            <?php


            #############################ending websocekt , sending freind reauest####################################



            ############################## stating payment getway #####################################

            echo "<div id='card_info' class='payment-div ma row j-c-c bg-dark py-4 hidden'>
            <form class='row w-25 payment-form ' method='post'>
            <div class='col-12 bg-warning nob-nol mb-3' > ";trans($ln,"put your card information");echo"</div>
            <input type='text' name='card number' class='col-12 bg-warning nob-nol' placeholder='card number'>
            <input type='text' name='card exp' class='my-3 col-12 bg-warning nob-nol' placeholder='card exp'>
            <input type='text' name='cvc' class='col-12 bg-warning nob-nol' placeholder='cvc'>
            <input type='submit' value='pay' class=' col-12 bg-warning nob-nol mt-3'>
            <div id='cancel_payment' class='col-12 bg-warning nob-nol mt-3 text-center s' > ";trans($ln,"cancel payment");echo"</div>
            </form>
            </div>";

            ##### backend in payment getway #####

            if(isset($_POST["card number"])&& !empty($_POST["card number"]) && isset($_POST["CVC"])&& !empty($_POST["CVC"])&& isset($_POST["card exp"]) && !empty($_POST["card exp"])){
                include('stripe/autoload.php')

            ;}


            ############################## end payment getway #################################

             ################################## php mailer  ###################################

            //                             هذا الكود يعمل بشكل جيد 
            //                هذا الكود يعمل حتى مع عدم تواجد الملفات الاخرى مع المكتبة 
                
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\SMTP;
                use PHPMailer\PHPMailer\Exception;

                // لو اردت ارسال الرسالة عند وجود بوست معين
                //  فستضع ما قبل هذا الكومنت قبل البوست وما بعده بعد البوست حتى لا تواجه مشاكل كلمة يوز 

             require("phpmailer/autoload.php");

             $mail = new PHPMailer(true);

            try {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                 //Enable verbose debug output
                $mail->isSMTP();                                         //Send using SMTP

                // راجع لماذا القيمة الحالية ل المتغير القادم حصرا  وماذا تعني 
                // $mail->Host 

                $mail->Host       = 'smtp.gmail.com';                   //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                              //Enable SMTP authentication
                $mail->Username   = 'jam96al2011@gmail.com';          //SMTP username
                $mail->Password   = 'gxiotyzcforoolpw';              //SMTP password

            // in 'tls' value for $mail->SMTPSecure it did not work 
            // but in 'ssl' it worked

                $mail->SMTPSecure = 'ssl';                      //Enable implicit TLS encryption
                $mail->Port       = 465;    
                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                // السطر القادم لوضع اسم المرسل كمعامل ثاني
                $mail->setFrom('jam96al2011@gmail.com', 'jamal sender');
                // المعامل الثاني بالسطر القادم لوضع اسم المرسل اليه 
                $mail->addAddress('jam96al2016@hotmail.com', 'jamal recever');     //Add a recipient
            // كل القادم غير ضروري لارسال رسالة ل ايميل واحد بذاته
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                // $mail->send();
                // echo 'Message has been sent';
            } catch (Exception $e) {
                echo "<div class='bg-warning'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
            }


             ##############################  end php mailer ####################################


            ################ starting   Delete user  ######################
           
            

           if (isset($_POST["delete"])&&$_POST["delete"]=="true") {
            $stmt = $db->prepare("DELETE  FROM users WHERE id = :id");
            $stmt->bindParam(':id', $_GET["user_id"]);
            $stmt->execute();
            // من جافا سكريبت مبدائيا  حتى نرى لها حل اخر لأنها لا تعمل هنا header
            // لا يوجد لها حل اخر كما يبدو والحل من جافا سكريبت امن حتى الان 
            // header("location:http://localhost/my%20try%20project/"); 
            // exit();
            // تم تجريب مكتبة بي اتش بي ميلر بعد طلب ال اي جاكس و نجح الامر 

          }

                      ################  ending Delete user  ######################


                      
             

    echo"</section>";
    
    #####################################edit user info ####################################3
    $newemail=isset($_POST["email"])?$_POST["email"]:"";
    $newusername=isset($_POST["username"])?$_POST["username"]:"";
    $newpassword=isset($_POST["password"])?sha1($_POST["password"]):"";

    $newstatus= "" ;
    if(isset($_POST["status"])){
        if($_POST["status"]=="normal user"){$newstatus="0";}
        elseif($_POST["status"]=="admin"){$newstatus="1";}
    ;}
       
    $newvalidate=  "" ;
    if(isset($_POST["validate"])){
        if($_POST["validate"]=="non valid"){$newvalidate="0";}
        elseif($_POST["validate"]=="valid"){$newvalidate="1";}
    ;}

    if(isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"])&& isset($_POST["status"])&& !empty($_POST["status"])&& isset($_POST["validate"])&& !empty($_POST["validate"])){
        $stmt=$db->prepare("UPDATE users SET email=:newemail , username=:newusername , password=:newpassword , group_id=:newstatus , validate=:newvalidate WHERE id =:id");
        $stmt->bindParam(':newemail', $newemail);
        $stmt->bindParam(':newusername', $newusername);
        $stmt->bindParam(':newpassword', $newpassword);
        $stmt->bindParam(':newstatus', $newstatus);
        $stmt->bindParam(':newvalidate', $newvalidate);
        $stmt->bindParam(':id', $_GET["user_id"]);
        $stmt->execute();
        header("location:${url}user.php?user_id=$user_id");
        exit();
    } 

    
    ?>
        
    <section> 
        <br><hr class="bg-warning border border-1 border-warning w-75 "><br>
        <div class="container">
            <div class="row j-c-b">
                <div class="freind-requests-for-u col-3 row j-c-c h-f-c border border-warning border-2">
                    <?php   ################ recived fredind request ##############################
                        $stmt=$db->prepare("SELECT * from freindrequest inner join users 
                        on  freindrequest.sender_id=users.id 
                        where receiver_id=:receiver_id");
                        $stmt->bindParam(":receiver_id" , $user_id );
                        $stmt->execute();
                        $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                     ?>
                    <div class="bg-warning col-12 text-center mb-3 px-0 h-f-c mt-2">freindrequest</div>
                    <?php 
                    foreach($results as $result) {
                    ?> 
                    <div class="col-12 bg-warning  mb-2 py-1 px-2 h-f-c">
                        <span class="d-inline"><?= $result["sender_id"] ?>:<?=$result["username"]?></span>
                        <span id="accepte-the-request" class="accepte-the-request d-inline border border-1 border-dark text-center  f-r px-2"> accepte </span>
                        <span id="refuse-the-request" class="refuse-the-request d-inline border border-1 border-dark text-center me-2 f-r px-2"> refuse </span>
                    </div>
                    <?php 
                    }
                    ########################## ending recived fredind request ########################
                    ?>
            </div>
            <!-- ################### posts and publish ##################################### -->
            <div class="border border-warning border-2 col-6 mb-2 row j-c-c">
                <!-- ######################### publish ###################################### -->
                <div class="col-12 px-3 row my-3 j-c-c g-0">
                    <form action="" method="post" class="col-12 row j-c-c h-f-c ">
                        <textarea  type="text" placeholder="write what do u thing" name="thePost" class="col-12 border border-1 border-warning postplace nob-nol px-3 py-2"></textarea>
                        <input type="submit" value="post it" class="col-2 text-center p-0 mt-1 bg-warning nob-nol" id="publishPost">
                    </form>
                </div>
                <hr class="w-75 bg-warning m-0">
                <!-- ############################### posts ####################################### -->
                <div class="col-12 px-3 row my-3 j-c-c g-0 border border-1 border-warning row ">
                    <div class="col-8 bg-warning text-center mt-2">the posts for you</div>
                    <?php foreach(get_my_posts() as $post){ ?>
                    <div class="col-12 border border-1 border-warning my-2 px-3 pt-3">
                        <p class="ml-3 mb-0 post_publisher"><?= $post["username"] ?></p>
                        <p class="post_date text-warning mt-0 mb-0 border border-1 border-dark px-2"><?=$post["post_date"]?></p>
                        <p class="post_text mt-1"><?=$post["post_text"]?></p>
                    </div>
                        
                    <?php } ?>
                </div>
                <!-- ####################### end of posts and publish ############################# -->
            </div>
            <!-- ###################################### lists of freinds ################################## -->
            <div class="border border-warning border-2 col-3 mb-2 row j-c-c h-f-c">
                <div class="bg-warning col-12 h-f-c my-2 text-center">your freinds</div>
                <?php
                foreach(returnfriends() as $result) {
                    // if($result["id"]!=$user_id){ 
                        ?>
                
                <div class="col-10 bg-warning px-2 mb-2 h-f-c"><?=$result["id"]?> : <?=$result["username"]?></div>
                    <?php
                }
            // }
                ?>
            </div>

        </div>
        <br>
    </section>
<?php
################################ accept or refuse the freind request ###########################################

if(isset($_POST["accepte-the-friend-request"])){

    $stmt=$db->prepare("INSERT INTO freind (first_one_id,second_one_id,freindship_date) 
    VALUE (:sender_id,:receiver_id, now() ) ");
    $stmt->bindParam(":receiver_id", $user_id);
    $stmt->bindParam(":sender_id" , $_POST["accepte-the-friend-request"]);
    $stmt->execute();

    $stmt2=$db->prepare("DELETE  FROM freindrequest
     WHERE sender_id = :sender_id AND receiver_id = :receiver_id");
    $stmt2->bindParam(":receiver_id", $user_id);
    $stmt2->bindParam(":sender_id" , $_POST["accepte-the-friend-request"]);
    $stmt2->execute();

}

if(isset($_POST["refuse-the-friend-request"])){
    
    $stmt2=$db->prepare("DELETE  FROM freindrequest
     WHERE sender_id = :sender_id AND receiver_id = :receiver_id");
    $stmt2->bindParam(":receiver_id", $user_id);
    $stmt2->bindParam(":sender_id" , $_POST["refuse-the-friend-request"]);
    $stmt2->execute();

}

?>

<?php

// returnfriends();
// if(isset($results10)){
    // print_r($results10);
// }
// returnfriends();
    // مثال لاستخدام sleep لا يتجاوب بشكل مناسب مع ال ajax request
//     echo "wake up<br>";
// if (ob_get_length()) {
//     ob_end_flush();
//     flush();
// }
// sleep(3);
// echo "hello world<br>";
// if (ob_get_length()) {
//     ob_end_flush();
//     flush();
// }



// لإظهار الأرقام باللغة العربية في حالة الطلب 
// $date = '2023-05-26 23:40:05';

// $arabicNumbers = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
// $englishNumbers = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

// $arabicDate = str_replace($englishNumbers, $arabicNumbers, $date);

// echo $arabicDate;

// echo "<pre>";
// print_r(get_my_posts());
// echo "</pre>"
?>

<!-- مشكلة في التعدييييل   -->
<!-- المشكلة فقط مع القمية المسماة 0  -->
<!-- تم حلها مسبقا  -->
<!-- <select name='status' class='mt-3 bg-warning' >
                <option value='0' " ; if ($status== 0) {echo "selected";}; echo ">normal user</option>
                <option value='1' "; if ($status== 1) {echo "selected";}; echo ">admin</option>
            </select>
            <select name='validate' class='my-3 bg-warning' >
                <option value='0'" ; if ($valid== 0) {echo "selected";}; echo ">non valid</option>
                <option value='1' " ; if ($valid== 1) {echo "selected";}; echo ">valid</option>
            </select> -->

<?php include("includes/templates/footer.php"); 

