<?php

//DEFINE INSTALL DEBUG
## SHOULD DISABLE ONCE INSTALL DEVELOPMENT IS DONE
define("OMEGA_INSTALL_DEBUG", true);
//

?>

<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $usernameErr = $passwordErr = $hostErr = "";
$name = $username = $password = $host = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  echo '<div class="install-section">';


  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
  }
  
  if (empty($_POST["username"])) {
    $usernameErr = "username is required";
  } else {
    $username = test_input($_POST["username"]);
  }
  
  if (empty($_POST["password"])) {
    $passwordErr = "password is required";
  } else {
    $password = test_input($_POST["password"]);
  }
  
  if (empty($_POST["host"])) {
    $hostErr = "host is required";
  } else {
    $host = test_input($_POST["host"]);
  }

  echo '<h2 class="sectionTitle">Config generate/delete</h2> '; 
  $configSampleFile = "config-sample.php";
  if(file_exists($configSampleFile)){
    $myFileLink = fopen($configSampleFile, 'r');
    $configSample = fread($myFileLink, filesize($configSampleFile));
    fclose($myFileLink);
    $configSample = replaceValues($configSample, $name, $username, $password, $host);
    $configFile = fopen("../included_files/config/database.php", "w") or die("Unable to open file!");
    fwrite($configFile, $configSample);
    fclose($configFile);
    echo "<div class='install-message success'>Create ../included_files/config/database.php file</div>";
  }else{
    echo "<div class='install-message error'>Missing config-sample.php file</div>";
  }

    
  if (defined("OMEGA_INSTALL_DEBUG") == true){
    if(file_exists($configSampleFile)){
      rename($configSampleFile,".".$configSampleFile);
      rename(".".$configSampleFile,$configSampleFile);
      echo "<div class='install-message success'>config-sample.php deleted</div>";
    }else{
      echo "<div class='install-message error'>config-sample.php not found</div>";
    }
  } else {
    if(file_exists($configSampleFile)){
      unlink($configSampleFile);
      echo "<div class='install-message success'>config-sample.php deleted</div>";
    }else{
      echo "<div class='install-message error'>config-sample.php not found</div>";
    }
  }



  if(file_exists('../included_files/config/database.php')){
    include_once '../included_files/config/database.php';
    echo "<div class='install-message success'>Found & Loaded config/database.php </div>";
  } else {
    echo "<div class='install-message error'>Missing config/database.php</div>";
  };

  echo '<h2 class="sectionTitle">Modules installation</h2>';
  $modules = [ 'users', ];

  foreach ($modules as $moduleName){
    echo "<h3 class='sectionTitle'>Module [ ".$moduleName." ] install status:</h3>";
    if (file_exists('../'.$moduleName.'/install.php')){
      echo "<div class='install-message success'>Found ../".$moduleName."/install.php</div>";
      $helperVar = include_once '../'.$moduleName.'/install.php';
      if (isset(json_decode($helperVar)->errorData)){
        echo "<div class='install-message error'>".$helperVar."</div>";
      } else {
        echo "<div class='install-message success'>".$moduleName." installed successfully.</div>";
      }
      if (defined("OMEGA_INSTALL_DEBUG") == true){
        rename('../'.$moduleName.'/install.php', '../'.$moduleName.'/.install.php');
        rename('../'.$moduleName.'/.install.php', '../'.$moduleName.'/install.php');
        echo "<div class='install-message success'>../".$moduleName."/install.php deleted</div>";
      } else {
        unlink('../'.$moduleName.'/install.php');
        echo "<div class='install-message success'>../".$moduleName."/install.php deleted</div>";
      }
    } else {
      echo "<div class='install-message error'>Missing <strong>../".$moduleName."/install.php</strong>module install file!</div>";
    }
  }
  
  
  if (defined("OMEGA_INSTALL_DEBUG") == true) {
    echo "<h2>Database config results:</h2> ";
    echo "Name: ".$name;
    echo "<br>";
    echo "Username: ".$username;
    echo "<br>";
    echo "Password: ".$password;
    echo "<br>";
    echo "Host: ".$host;
    echo "<br>";
  }
  echo '</div>';

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {
  
?>

<div class="install-section">
  <h2>Omega Install</h2>
  <p><span class="error">* required field</span></p>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="input-sec">  
      Name: <div><input type="text" name="name" value="<?php echo $name;?>">
      <span class="error">* <?php echo $nameErr;?></span></div>
    </div>
    <div class="input-sec">  
      Username: <div><input type="text" name="username" value="<?php echo $username;?>">
      <span class="error">* <?php echo $usernameErr;?></span></div>
    </div>
    <div class="input-sec">  
      Password: <div><input type="text" name="password" value="<?php echo $password;?>">
      <span class="error">* <?php echo $passwordErr;?></span></div>
    </div>
    <div class="input-sec">  
      Host: <div><input type="text" name="host" value="<?php echo $host;?>">
      <span class="error">* <?php echo $hostErr;?></span></div>
    </div>
    <input type="submit" name="submit" value="Submit">  
  </form>
</div>
<?php

}


?>







<?php 
/////////////helper functions

function replaceValues($configSample, $name, $username, $password, $host) {
  $configSample = str_replace("[>DB_NAME<]",$name, $configSample);
  $configSample = str_replace("[>DB_USER<]",$username, $configSample);
  $configSample = str_replace("[>DB_PASS<]",$password, $configSample);
  $configSample = str_replace("[>DB_HOST<]",$host, $configSample);
  return $configSample;
}


















?>

<style>
  body{
    background: #555555;
    color: whitesmoke;
    font-family: monospace;
  }
  .install-section{
    max-width: 800px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    padding: 20px 30px;
    background: #272727;
  }
  .install-message  {
    padding: 5px 10px;
    font-size: 20px;
    font-weight: 400;
    margin: 5px 0px;
  }
  .success {
    background: green;
    border-left: 5px solid darkgreen;
    color: white;
  }
  .error {
    background: red;
    border-left: 5px solid darkred;
    color: white;
  }
  form {
    display: flex;
    flex-direction: column;
    font-size: 20px;
  }

  .input-sec {
    display: flex;
    flex-direction: row;
    place-content: space-between;
    margin: 5px 0;
  }
  .input-sec > div {
    min-width: 50%;
    display: flex;
    flex-direction: row;
  }

  input[type="text"] {
    width: 100%;
    padding: 5px 10px;
    background: black;
    border: none;
    border-bottom: 2px solid green;
    font-size: 18px;
    font-weight: 400; 
  }

  .input-sec .error {
    background: none;
    border: none;
    color: red;
    margin-left: -15px;
  }
  form input[type=submit] {
    background: green;
    border: none;
    padding: 10px 20px;
    width: fit-content;
    color: white;
    font-size: 20px;
    letter-spacing: 1px;
    margin: 0 auto;
    margin-top: 20px;
  }
</style>
</body>
</html>