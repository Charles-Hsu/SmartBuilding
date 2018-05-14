<?php session_start();?>
<?php

require 'lib/DBAccess.class.php';
require 'config/config.admin.php';
require 'lib/utils.php';

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

if (count($_POST)) {

  $username = $_POST['username'];
  $password = $_POST['password'];
  $data = explode("-", $username);

    if (COUNT($data) > 1) {
        $n = COUNT($data) - 1;
        $floor = $data[$n];
        $addr_no = str_replace("-" . $floor, "", $username);
        $_SESSION['addr_no'] = $addr_no;
        $_SESSION['floor'] = $floor;
    }

    $sql = "SELECT role_id FROM users WHERE account='$username'";
    $data = $db->getRow($sql);

    if (!$data) {
        $message = "使用者不存在";
    } else {
        $sql = "SELECT role_id FROM users WHERE account='$username' AND password='$password'";
        $data = $db->getRow($sql);
        if (!$data) {
            $message = "密碼錯誤";
        } else {
            $_SESSION['online'] = true;
            $role_id = intval($data['role_id']);
            if ($role_id == 1) {
                $_SESSION['admin'] = 1;
            } else if ($role_id == 2) {
                $_SESSION['staff'] = 1;
            }

            $_SESSION['username'] = $_POST['username'];
            $_SESSION['local-ip'] = $_POST['local-ip'];

            my_log($db, $_POST['local-ip'], $_POST['username'], "使用者登入");

            $url = "./announcement.php"; /* login 後, 固定轉到 announcement.php */
            header("Location: " . $url);
        }
    }
}

?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>SmartBuilding</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link href="./css/fontawesome.css" rel="stylesheet">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/reset.css">
  <script src="./js/lib/jquery-3.1.1.min.js"></script>
  <script src="./js/popper.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
</head>

<body style="background-color: #f9f9f9;">
  <div id="app" class="login-wrapper p-5">
    <div class="row">
      <div class="col-12 login-main">
        <h2 class="login-title text-center mb-4"><?=$conf['sysname']?></h2>
        <div class="d-flex login-sub-title justify-content-around mb-4">
          <a href="javascript:;" class="active">登入系統</a>
          <a href="./sign.php">註冊會員</a>
        </div>
        <form action="" class="loign-form" method='POST'>
          <div class="form-group row mb-3">
            <div class="col-12 input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
              </div>
              <input type="text" class="form-control" name="username" placeholder="請輸入帳號...">
            </div>
          </div>
          <div class="form-group row mb-3">
            <div class="col-12 input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
              </div>
              <input type="password" class="form-control" name="password" placeholder="請輸入密碼...">
            </div>
          </div>
          <div class="form-group row mb-3">
            <div class="col-12 input-group">
              <input type="text" class="form-control" id="local-ip" name="local-ip" hidden>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-12">
              <button class="btn login-btn btn-primary btn-block" type="submit">登入</button>
            </div>
          </div>

          <div class="form-group row" style="height:0px;">
            <div class="col-md-10 offset-md-1">
              <div id="alert-message" class="alert alert-danger text-center" role="alert" >xxx</div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

<script src="./js/utils.js"></script>
<script>

$(function() {

  findLocalIP((ip)=>{
    console.log("ip:"+ip);
    // localStorage.setItem("local_ip", ip);
    $('#local-ip').val(ip);
  });

  // var msg = '<?php echo $message; ?>';
  // console.log(msg.length);
  // console.log(msg);
  // if (msg.length) {
  //   $("#alert-message").html(msg);
  // }


});



</script>


</body>
</html>