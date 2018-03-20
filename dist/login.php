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
    session_start();
    
    $message="";

	require 'lib/DBAccess.class.php';
    require 'config/config.admin.php';
    
	//$sql = 'SELECT * FROM assets';
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
    //$data = $db->getRows($sql);
    
    if(count($_POST)>0) {
        $_POST['username'];
        $_POST['password'];

        $sql =  "SELECT count(id) as count FROM users WHERE account='" . $_POST['username'] . "'";
        //echo $sql;

        $data = $db->getValue($sql);
        //echo $data;

        if ($data == 0) {
            $message = "使用者不存在";
        } else {
            $sql =  "SELECT count(id) as count FROM users WHERE account='" . $_POST['username'] . "' AND password='" . $_POST['password'] . "'";
            //echo $sql;
            $data = $db->getValue($sql);
            //echo $data;
            if ($data == 1) {
                $_SESSION['account'] = $_POST['username'];

                echo 
                '<script>
                    //document.onkeypress=function(e) {
                        //alert("You pressed a key inside the input field");
                        //document.getElementById("demo").innerHTML = 5 + 6;
                        //window.location.href = "http://stackoverflow.com";
                        window.location.href = "./index.php";
                    //}
                </script>';

            } else {
                $_SESSION['account'] = '';
                $message = "帳號密碼錯誤";
            }
        }
/*
        if( $_POST["user_name"] == "admin" and $_POST["password"] == "admin") {
            $_SESSION["user_id"] = 1001;
            $_SESSION["user_name"] = $_POST["user_name"];
            $_SESSION['loggedin_time'] = time();  
        } else {
            $message = "Invalid Username or Password!";
        }
*/        
    }

//	var_dump($data);
?>

<body style="background-color: #f9f9f9;">
    <div id="app" class="login-wrapper p-5">
        <div class="row">
            <div class="col-12 login-main">
                <h2 class="login-title text-center mb-4"><?=$conf['sysname']?></h2>
                <div class="d-flex login-sub-title justify-content-around mb-4">
                    <a href="javascript:;" class="active">登入系統</a>
                    <a href="kpi.php">KPI</a>
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
                        <div class="col-12"><a href="./sign.php" class="sign-btn">註冊會員</a></div>
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