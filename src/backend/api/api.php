<?php
include_once('db.php');


$res= array('error'=>false);
$action='';

if(isset($_GET['action'])){
    $action=$_GET['action'];
}

if($action=='login'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql= $db -> query("select * from users where email='$username' and upassword='$password'");
    $res['teste']=mysqli_num_rows($sql) ;

    if($res>0){
        $rs=mysqli_fetch_assoc($sql);
        $user= array(
            "name" => $rs['name'],
            "email" => $rs['email'],
            "img" => $rs['email'],
        );

        $res['user']= $user;
    }
   
    // if($sql && mysqli_num_rows($sql) > 0){
    //     $rs = mysqli_fetch_assoc($sql);
    //     $user = array(
    //         "name" => $rs['name'],
    //         "email" => $rs['email'],
    //         "photo" => $rs['photo'],
    //     );

    //     $res['dataUser'] = $user;
    //     $res['status'] = true;
    //     $res['error'] = false;
    // } else {
    //     $res['error'] = true;
    //     $res['message'] = "Usuário ou senha incorretos.";
    // }

}


$db->close();
header("Content-type: application/json");
echo json_encode($res);
die();
?>