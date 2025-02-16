<?php 
// لا اعرف لماذا لا يعمل يوما ما اريد ان اعرف 
// include("connection.php");


// if(isset($_POST["accepte-the-friend-request"])){
//     $stmt=$db->prepare("INSERT INTO freind (first_one_id,second_one_id,freindship_date) 
//     VALUE (:sender_id,:receiver_id, now() ) ");
//     $stmt->bindParam(":receiver_id", $user_id);
//     $stmt->bindParam(":sender_id" , $_POST["accepte-the-friend-request"]);
//     $stmt->execute();

//     $stmt2=$db->prepare("DELETE  FROM freindrequest
//      WHERE sender_id = :sender_id AND receiver_id = :receiver_id");
//     $stmt2->bindParam(":receiver_id", $user_id);
//     $stmt2->bindParam(":sender_id" , $_POST["accepte-the-friend-request"]);
//     $stmt2->execute();

// }

// if(isset($_POST["refuse-the-friend-request"])){
   

//     $stmt2=$db->prepare("DELETE  FROM freindrequest
//      WHERE sender_id = :sender_id AND receiver_id = :receiver_id");
//     $stmt2->bindParam(":receiver_id", $user_id);
//     $stmt2->bindParam(":sender_id" , $_POST["refuse-the-friend-request"]);
//     $stmt2->execute();

// }
############################################ add post ###################################
if(isset($_POST["thePost"])){
    $stmt=$db->prepare("INSERT into posts (post_text,publisher_id,post_date)
     value (:post_text,:publisher_id,now())");
     $stmt->bindParam(":post_text",$_POST["thePost"]);
     $stmt->bindParam(":publisher_id", $user_id);
     $stmt->execute();
     header("location:{$url}user.php?user_id=$user_id");
}
############################################ end add post ###################################





function returnfriends(){
    global $user_id;
    global $db;
    $stmt=$db->prepare("SELECT *
    FROM freind 
    INNER JOIN users 
    ON freind.first_one_id = users.id or freind.second_one_id = users.id 
    where  (freind.first_one_id = :user_id or freind.second_one_id = :user_id) and (users.id!=:user_id)");
    $stmt->bindParam(":user_id" , $user_id);
    $stmt->execute();
    $results = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $results;
}


function get_my_posts(){
    global $user_id;
    global $db;
    $frends_id = [];
    foreach (returnfriends() as  $value) {
    array_push($frends_id,$value["id"]);
    };
    array_push($frends_id,$user_id);
    $frendss_id = implode(',',$frends_id);
    $stmt=$db->prepare("SELECT * from posts
    inner join users on posts.publisher_id=users.id
    where publisher_id in ($frendss_id)");
    $stmt->execute();
    $results = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $results;
}

?>