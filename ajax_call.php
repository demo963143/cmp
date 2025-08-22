<?php
if($_SERVER['HTTP_HOST']=="localhost"){
	$username = "root";
	$password = "";
    $database = 'cmpminkc_invoice_vendors';
} else {
	$username = "cmpminkc_invoice_vendor";
	$password = "6,b6KeqHu^c^";
	$database = "cmpminkc_invoice_vendors";
}
$conn = mysqli_connect("localhost",$username,$password,$database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $sql = 'SELECT * FROM connect where email="'.$_POST["email"].'" and userpass="'.md5($_POST["password"]).'"';
    //echo $sql; die;
	$userpass = $_POST["password"];
    $res = mysqli_query($conn, $sql);
    $id;
    $email;
    $user;
    $pass;
    $db;
    $token;
    $result;
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if (!empty($row['token'])) {
        $id = $row['id'];
        $email = $row['email'];
        $user= $row['dbuser'];
        $pass= $row['dbpass'];
        $db = $row['dbname'];
        $token = $row['token'];
        $result='success';
        } else {
            $result = 'failure'; 
        }
    }
    else{
    	$user='';
        $pass='';
        $db='';
        $result='failure';	
    }
/*      $_SESSION["dbid"] =$id;
    $_SESSION["user_name"] =$user;
    $_SESSION["dbpass"] =$pass;
    $_SESSION["dbname"] =$db;
    $_SESSION["user_email"] =$email;
    $_SESSION["user_id"] =$user_id;
    $_SESSION["user_company"] =$user_company;
    $_SESSION["user_language"] =$user_language; */
	
    setcookie("dbid",$id,0,'/');
    setcookie("userpass",$userpass,0,'/');
    setcookie("dbuser",$user,0,'/');
    setcookie("dbpass",$pass,0,'/');
    setcookie("dbname",$db,0,'/');
    setcookie("dbmail",$email,0,'/');
    setcookie("token",$token,0,'/');

//    $_COOKIE['dbid'] = $id;
//    echo "id=$id</br>";
//    print_r($_COOKIE);
//    die;
}
echo $result;
?>