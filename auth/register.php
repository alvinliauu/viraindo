<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/function.php';
// require_once '/../function.php';

require __DIR__ . '/classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

function msg($success, $status, $message, $extra = [])
{
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ], $extra);
}

// DATA FORM REQUEST
$key = "viraindo jaya";
$data = json_decode(file_get_contents("php://input"));
$returnData = [];

if ($_SERVER["REQUEST_METHOD"] != "POST") :

    $returnData = msg(0, 404, 'Page Not Found!');

elseif (
    !isset($data->name)
    || !isset($data->email)
    || !isset($data->password)
    || !isset($data->role)
    || empty(trim($data->name))
    || empty(trim($data->email))
    || empty(trim($data->password))
    || empty(trim($data->role))
) :

    $fields = ['fields' => ['name', 'email', 'password', 'role']];
    $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);

    

// IF THERE ARE NO EMPTY FIELDS THEN-
else :

    $name = trim($data->name);
    $email = trim($data->email);
    $password = trim($data->password);
    $role = trim($data->role);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
        $returnData = msg(0, 422, 'Invalid Email Address!');

    elseif (strlen($password) < 8) :
        $returnData = msg(0, 422, 'Your password must be at least 8 characters long!');

    elseif (strlen($name) < 3) :
        $returnData = msg(0, 422, 'Your name must be at least 3 characters long!');

    else :
        try {

            $datetime = date("Y-m-d h:i:s");

            $check_email = "SELECT `user_email` FROM `tbl_viraindo_user` WHERE `user_email`=:email";
            $check_email_stmt = $conn->prepare($check_email);
            $check_email_stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $check_email_stmt->execute();

            if ($check_email_stmt->rowCount()) {
                $returnData = msg(0, 422, 'This E-mail already in use!');
            }
            else{
                $insert_query = "INSERT INTO tbl_viraindo_user (user_name, user_email, user_password, user_role, isActive, updatedOn, updatedBy, updatedCount, insertedOn, insertedBy) 
                VALUES(:name, :email, :password, :role, 1, :updatedon, null, 1, :insertedon, null)";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                $insert_stmt->bindValue(':name', htmlspecialchars(strip_tags($name)), PDO::PARAM_STR);
                $insert_stmt->bindValue(':email', $email, PDO::PARAM_STR);
                $insert_stmt->bindValue(':password', encrypt($key, $password), PDO::PARAM_STR);
                $insert_stmt->bindValue(':role', $role, PDO::PARAM_STR);
                $insert_stmt->bindValue(':updatedon', $datetime, PDO::PARAM_STR);
                $insert_stmt->bindValue(':insertedon', $datetime, PDO::PARAM_STR);

                $insert_stmt->execute();

                $returnData = msg(1, 201, 'You have successfully registered.');

            }
        } catch (PDOException $e) {
            $returnData = msg(0, 500, $e->getMessage());
        }
    endif;
endif;

echo json_encode($returnData);