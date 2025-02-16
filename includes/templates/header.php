<?php 
$url="http://localhost/my%20try%20project/";
session_start();
// بحالة تضمين ملف الفنكشن قبل ملف الهدر اي هذا الملف , فهذا يعني انني استطيع استخدام الفنكشن هنا دون اية مشاكل او اضفات 
// include($_SERVER['DOCUMENT_ROOT']."/my try project/classes/functions.php");

if(isset($_POST["lang"])&&$_POST["lang"]=="ar"){
    $_SESSION["lang"]="ar";
    header("location:".$_SERVER['REQUEST_URI']);
    exit();
    }
    if(isset($_POST["lang"])&&$_POST["lang"]=="en"){
        $_SESSION["lang"]="en";
        header("location:".$_SERVER['REQUEST_URI']);
        exit();
    }

if(isset($_SESSION["lang"])&&$_SESSION["lang"]=="ar"){
    $ln="ar";} else{$ln="en";}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pageTitle?></title>
    <link rel="stylesheet" href="<?= $url?>includes/css/bootstrap.css">
    <link rel="stylesheet" href="<?= $url?>includes/css/main.css">
</head>
<body>
     <?php
      if ($pageTitle=="home"){ 
        echo "
<section style='background-image: url(" . $url . "includes/img/1.jpg);' class='firstSection'>
    <div class='container bg-dark col-12'>
        <ul class='row py-3 j-c-b'>
            <li class='col-3 text-center'><a class='td-n text-warning' href=''>logo</a></li>
            <li class='col-2 text-center'><a class='td-n text-warning' href=''>";trans($ln,"Home");echo"</a></li>
            <li class='col-2 text-center text-warning'><div>";trans($ln,"chose your favorat langueg");
            echo"</div>
            <form method='post' class='d-inline mx-2'>
            <input name='lang' value='ar' hidden>
            <input type='submit' value='";trans($ln,"ar");
            echo"' class='bg-non text-warning'>
            </form>
            <form method='post' class='d-inline mx-2'>
            <input name='lang' value='en' hidden>
            <input type='submit' value='";trans($ln,"en");
            echo"' class='bg-non text-warning'>
            </form>
            </li>
            <li class='col-2 text-center'><a class='td-n text-warning' href=''>";trans($ln,"contact us");echo"</a></li>
            <li class='col-3 text-center'>
                <a class='td-n text-warning me-1' href='?signUp'>";trans($ln,"sign up");echo"</a> 
                <p class='text-warning d-inline'>/</p>
                <a class='td-n text-warning mx-1' href='?signIn'>";trans($ln,"sign in");echo"</a>
            </li>
        </ul>
    </div>";}
    else if ($pageTitle=="profile"){
        echo "
<section style='background-image: url(" . $url . "includes/img/1.jpg);' class='firstSection'>
    <div class='container bg-dark col-12'>
        <ul class='row py-3 j-c-b'>
            <li class='col-1 text-center'><a class='td-n text-warning' href=''>logo</a></li>
            <li class='col-1 text-center'><a class='td-n text-warning' href=''>";trans($ln,"Home");echo"</a></li>
            <li class='col-1 text-center'><a class='td-n text-warning' href=''>";trans($ln,"contact us");echo"</a></li>

            <li class='col-1 text-center'>
                <a class='td-n text-warning me-1' href='$url?signIn'>";trans($ln,"log out");echo"</a> 
                
            </li>
        </ul>
    </div>";
}