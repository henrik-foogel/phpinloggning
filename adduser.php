<?php require 'header.php' ?>
<?php require 'functions.php' ?>

<body>
  <main class="container">
    <h1>Create user</h1>
    <form action="adduser.php" method="post">
        <input type="text" name="createUsername" placeholder="Username">
        <input type="password" name="createPassword" placeholder="Password">
        <input type="submit" class="btn" value="Register">
    </form>
    <span class="register">
        <a href="index.php">Back to login.</a>
    </span>
  </main>
</body>

<?php 

    if (isset($_POST["createUsername"]) && isset($_POST["createPassword"])) {

        $loginJsonUrl = 'users.json';

        $addOrLog = 1;

        if(!file_exists($loginJsonUrl)) {
          checkFileExisting($loginJsonUrl, $addOrLog); 
        }

        $loginData = file_get_contents($loginJsonUrl);
        $login = json_decode($loginData);
        $cUsername = $_POST["createUsername"];
        $cPassword = $_POST["createPassword"];

        if($login != '') {
       
          foreach($login as $log){
              $userNames[] = $log->user;
          }
          
          $existingUsers = json_encode($userNames);
        
          if (strpos($existingUsers, $cUsername) == false) {

            createUser($cUsername, $cPassword, $firstSalt, $secondSalt);

          } else if (strpos($existingUsers, $cUsername) !== false) {
              echo '<p style="text-align: center;">Your chosen username is already taken</p>';
          } 
        } else {
          createUser($cUsername, $cPassword, $firstSalt, $secondSalt);
        }
    }
    
?>