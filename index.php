<?php require 'header.php'?>
<?php require 'functions.php' ?>

<body>
    <main class="container">
        <h1>Login</h1>

        <form action="index.php" method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" class="btn" value="Login">
        </form>
        <a href="./adduser.php">Add User</a>
    </main>
</body>
</html>

<?php 

if(isset($_POST['username']) && isset($_POST['password'])) {

    $users = 'users.json';
    
    $addOrLog = 2;
    
    checkFileExisting($users, $addOrLog);
    
    $getUsers = file_get_contents($users);
    $login = json_decode($getUsers);
    $loginUsername = $_POST['username'];
    $loginPassword = $_POST['password'];

    foreach($login as $log) {
        $logNames[] = $log->user;
        $passwords[] = $log->password;
    }

    $addedUsers = json_encode($logNames);
    $addedUsersPasswords = json_encode($passwords);

    passwordVerify($logNames, $loginUsername, $loginPassword, $firstSalt, $secondSalt, $passwords);
}
?>