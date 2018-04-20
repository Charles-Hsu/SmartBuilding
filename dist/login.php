<?php session_start(); ?>
<!DOCTYPE html>
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

<?php

$message="";
$_isAdmin = FALSE;
$_isMan = FALSE;

require 'lib/DBAccess.class.php';
require 'config/config.admin.php';
require 'lib/utils.php';

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

if(count($_POST)) {
    $message = "";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $ip = "192.168.1.201";

    $data = explode("-", $username);
    // echo "<script>alert(" . COUNT($data) .");</script>";
    // var_dump($data);

    // echo COUNT($data);

    if (COUNT($data) > 1) {
        // $_SESSION['addr_no'] = $data[0];
        $n = COUNT($data) - 1;
        $floor = $data[$n];
        // $_SESSION['floor'] = $floor;
        $addr_no = str_replace("-".$floor, "", $username);
        // echo "addr_no = $addr_no";
        // echo "floor = $floor ";
        $_SESSION['addr_no'] = $addr_no;
        $_SESSION['floor'] = $floor;
        // echo "<script>alert(addr_no" . $addr_no .");</script>";
        // echo "<script>alert(floor" . $floor .");</script>";
    }

    $sql =  "SELECT role_id FROM users WHERE account='$username'";
    $data = $db->getRow($sql);
    if (!$data) {
        $message = "使用者不存在";
    }
    else {
        $sql = "SELECT role_id FROM users WHERE account='$username' AND password='$password'";
        $data = $db->getRow($sql);
        if (!$data) {
            $message = "密碼錯誤";
        }
        else {
            $_SESSION['online'] = TRUE;
            $role_id = intval($data['role_id']);
            // echo "<script>alert($role_id);</script>";
            if ($role_id == 1) {
                $_SESSION['admin'] = 1;
            } else if ($role_id == 2) {
                $_SESSION['staff'] = 1;
            }
            $url = "./announcement.php";
            if ($_isAdmin) {
                $url = "./kpi.php";
            }
            $username = $_POST['username'];
            $_SESSION['username'] = $username;
            $_SESSION['ip'] = $ip;
            my_log($db, $ip, $username, "使用者登入");
            header("Location: " . $url);
        }
    }
}

?>

<body style="background-color: #f9f9f9;">
    <div id="app" class="login-wrapper p-5">
        <div class="row">
            <div class="col-12 login-main">
                <h2 class="login-title text-center mb-4"><?=$conf['sysname']?></h2>
                <div class="d-flex login-sub-title justify-content-around mb-4">
                    <a href="javascript:;" class="active">登入系統</a>
                    <a href="./sign.php">註冊會員</a>
                </div>
                <!--<form action="checkuser.php" class="loign-form" method='POST'>-->
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
                    <div class="form-group row">
                        <div class="col-12">
                            <button class="btn login-btn btn-primary btn-block" type="submit">登入</button>
                        </div>
                    </div>


                    <?php if($message!="") { ?>
                    <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <div class="alert alert-danger text-center" role="alert"><?php echo $message; ?></div>
                        </div>
                    </div>
                    <?php } ?>


                </form>
            </div>
        </div>
    </div>
</body>

</html>