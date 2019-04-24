<?php

$firstSalt = "qrst1234";
$secondSalt = "uvxy5678";

function createUser($cUsername, $cPassword, $firstSalt, $secondSalt) {
            
    $retrieveUsers = file_get_contents('users.json');
    $currentUsers = json_decode($retrieveUsers, true);
            
    $hashPassword = password_hash($firstSalt . $cPassword . $secondSalt, PASSWORD_BCRYPT);

    $arrJson = array("user"=>$cUsername, "password"=>$hashPassword);
    $currentUsers[] = $arrJson;
    $users = json_encode($currentUsers);
            
    file_put_contents('users.json', $users);

    echo '<p style="text-align: center;">You have been registered. Please go back to first page to log in.</p>';
}

function checkFileExisting($users, $check) {
    if (file_exists($users) && $check == 2) {
        if(filesize($users) == 0) {
            echo '<p style="text-align: center;">Username or password was incorrect.</p>';
            die();
        }
    } else {
        $fp = fopen('users.json', 'w');
        fclose($fp);

        if($check == 2) {
            echo '<p style="text-align: center;">Username or password was incorrect.</p>';
            die();
        }
    }
}

function passwordVerify($logNames, $loginUsername, $loginPassword, $firstSalt, $secondSalt, $passwords) {
    $count = count($logNames)-1;

    for ($i = 0; $i < count($logNames); $i++) {
        if($logNames[$i] == $loginUsername && password_verify($firstSalt . $loginPassword . $secondSalt, $passwords[$i])) {
            echo '<p style="text-align: center;">Success! You have logged in.</p>';
            $loginTrueFalse = true;
            break;
        } else if($count === $i){
            echo '<p style="text-align: center;">Username or password was incorrect.</p><br>';
        }
    }

    }

?>