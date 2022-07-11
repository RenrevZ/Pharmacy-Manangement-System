<?php 
require_once '../../inc/session.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pims";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// define('HOST','localhost');
// define('USERNAME','root');
// define('PASSWORD','');
// define('DB_NAME','pos');

// $dsn = 'mysql:host='.HOST.';dbname='.DB_NAME;
// $pdo = new PDO($dsn,USERNAME,PASSWORD);
// $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

function insertDelivery(){
	global $conn;
	$pname = htmlentities($_POST["pname"]);
	$qty = htmlentities($_POST["qty"]);
	$total = htmlentities($_POST["total"]);
	$supplier = htmlentities($_POST['Supplier']);
	$ref = htmlentities($_POST['referrence']);
	$date = htmlentities($_POST['xpdate']);
	$staff = $_SESSION['first_name'];

	$insert = $conn->prepare("INSERT INTO deliveries(Supplier_name,Refference_No,product,quantity,Total_purchased,`Expiry_Date`,Receive_by) 
	VALUES ('$supplier','$ref','$pname','$qty','$total','$date','$staff')");
	$insert->execute();
}
    

$pro_code = $_POST["procode"];
$stmt = $conn->prepare("SELECT id, product_id, med_name, price FROM medicinelist WHERE product_id = ?");
$stmt->bind_param("s",$pro_code);
$stmt->bind_result($id,$product_code,$productname,$price);




if($stmt->execute()){
	while($stmt->fetch()){
		$output[] = array("id"=>$id,"product_code"=>$product_code,"productname"=>$productname,"price"=>$price);
	}
	echo json_encode($output);
}



