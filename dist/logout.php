<script>
  // Save data to sessionStorage
  // sessionStorage.setItem('key', 'value');

  // Get saved data from sessionStorage
  // var data = sessionStorage.getItem('key');

  // console.log("data:" + data);

  // // Remove saved data from sessionStorage
  // sessionStorage.removeItem('key');

  //"data:" + data/ // Remove all saved data from sessionStorage
  // sessionStorage.clear();
</script>

<script src="./js/utils.js"></script>
<script>
  eraseCookie('local_ip');
</script>

<?php session_start();
    require 'lib/DBAccess.class.php';
    require 'config/config.admin.php';
    require 'lib/utils.php';


    var_dump($_COOKIE);

    $username = $_SESSION['username'];
    // $ip = $_SESSION['ip'];

    $local_ip = $_COOKIE['local_ip'];

    echo "local_ip = " . $local_ip;

    $db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

    echo "<script>console.log('['+sessionStorage.getItem('ip')+']');</script>";

    my_log($db, $local_ip, $username, "使用者登出");

    $url = "login.php";
    session_destroy();
    header("Location:$url");
?>


