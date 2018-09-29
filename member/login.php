<?php 

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
  require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn_test.php';
?>
<html>
<head>
    <title>PHP Test</title>
</head>
    <body>
    <?php echo '<p>Hello World!!!</p>' . $_SERVER['DOCUMENT_ROOT'];

    // In the variables section below, replace user and password with your own MySQL credentials as created on your server
    $servername = "localhost";
    $username = "sql918033";
    $password = "ae0a9f56";
    $database = "sql918033";
    // Create MySQL connection
    //$conn = new mysqli($servername, $username, $password, $database);

    // Check connection - if it fails, output will include the error message
    /*if (!$conn) {
        die('<p>Connection failed: <p>' . $conn->connect_errno);
    }
    echo '<p>Connected successfully</p>';
*/
    /*$query = $conn->query("select * from `h_member` where h_userName = '15811302702'");
    echo '<p> after query </p>';
    while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
        echo '<p>' . $row['h_userName'] . '---' . $row['h_passWord'] . '</p>';
    }
    echo '<p> list users done </p>';*/
     ?>
</body>
</html>
