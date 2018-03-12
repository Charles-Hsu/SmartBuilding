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
    <script src="./js/lib/jquery-3.1.1.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>

<?php
	require 'DBAccess.class.php';
	require 'config.admin.php';
	//$sql = 'SELECT * FROM assets';
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
    //$data = $db->getRows($sql);
    
//	var_dump($data);
?>

<body>
    <div id="app" class="login-wrapper container pt-8">
        <div class="row">
            <div class="col-sm-12 col-md-8 login-main offset-md-2">
                <h2 class="login-title text-center mb-4"><?=$conf['sysname']?></h2>
                <div class="d-flex login-sub-title justify-content-around mb-4">
                    <a href="login.html" class="active">登入系統</a>
                    <a href="sign.html">註冊會員</a>
                </div>
                <form action="checkuser.php" class="loign-form" method='POST'>
                    <div class="form-group row">
                        <div class="input-group mb-3 col-md-10 offset-md-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" name="username" placeholder="請輸入帳號...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3 col-md-10 offset-md-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="請輸入密碼...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <button class="btn login-btn btn-primary btn-block" type="submit">登入</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>