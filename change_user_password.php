<?php
if($_SERVER['HTTP_HOST']=="localhost"){
	$username = "root";
	$password = "";
	$database = "blngmnkf_invoice_vendors";
} else {
	$username = "billingm_invoice_vendors";
	$password = "6+xgDQfi]oEY";
	$database = "billingm_invoice_vendors";
}
$conn = mysqli_connect("localhost",$username,$password,$database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $sql = 'UPDATE connect set userpass="'.md5($_POST["userpass"]).'" where id="'.$_COOKIE["dbid"].'"';
    //echo $sql; die;
	
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

}
?>