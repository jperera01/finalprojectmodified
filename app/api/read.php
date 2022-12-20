<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../class/employees.php';

$ch = curl_init();

$source = isset($_GET['sources']) ? $_GET['sources'] : 'cnn';
$category = isset($_GET['categories']) ? $_GET['categories'] : 'general';
curl_setopt($ch, CURLOPT_URL, 'https://api.mediastack.com/v1/news?access_key=e51b8819364d71188fbdfc28e7a9777a&countries=us&sources=' . $source . '&categories=' . $category);

// Set curl options to enable HTTPS and follow redirects
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

// Execute the curl request and check for errors
$result = curl_exec($ch);
if ($result === false) {
    $error = curl_error($ch);
    echo "An error occurred: $error\n";
    exit(1);
}

curl_close($ch);

echo $result;






/*
$database = new Database();
$db = $database->getConnection();
$items = new Employee($db);
$stmt = $items->getEmployees();
$itemCount = $stmt->rowCount();
echo json_encode($itemCount);
if($itemCount > 0){

$employeeArr = array();
$employeeArr["body"] = array();
$employeeArr["itemCount"] = $itemCount;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
extract($row);
$e = array(
"id" => $id,
"name" => $name,
"email" => $email,
"age" => $age,
"designation" => $designation,
"created" => $created
);
array_push($employeeArr["body"], $e);
}
echo json_encode($employeeArr);
}

else{
http_response_code(404);
echo json_encode(
array("message" => "No record found.")
);
}
*/
?>