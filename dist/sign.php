<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SmartBuilding</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link href="./css/fontawesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.standalone.min.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="./js/lib/jquery-3.1.1.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.zh-TW.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>

<body>
    <div id="app" class="login-wrapper container pt-8">
        <div class="row">
            <div class="col-sm-12 col-md-8 login-main offset-md-2">
                <h2 class="login-title text-center mb-4">易入門智慧建築系統</h2>
                <div class="d-flex login-sub-title justify-content-around mb-4">
                    <a href="login.html">登入系統</a>
                    <a href="sign.html" class="active">註冊會員</a>
                </div>
                <form action="" class="sign-form">
                    <div class="form-group row">
                        <label for="username" class="text-right col-md-3 col-form-label">
                            <span class="important">*</span>使用者帳號:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="username" id="username" placeholder="使用者帳號...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="text-right col-md-3 col-form-label">
                            <span class="important">*</span>電子信箱:</label>
                        <div class="col-md-8">
                            <input type="email" class="form-control" name="email" id="email" placeholder="電子信箱...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="text-right col-md-3 col-form-label">
                            <span class="important">*</span>密碼:</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" name="password" id="password" placeholder="密碼...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="chkpwd" class="text-right col-md-3 col-form-label">
                            <span class="important">*</span>確認密碼:</label>
                        <div class="col-md-8">
                            <input type="chkpwd" class="form-control" name="chkpwd" id="chkpwd" placeholder="確認密碼...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="text-right col-md-3 col-form-label">
                            <span class="important">*</span>手機號碼:</label>
                        <div class="col-md-8">
                            <input type="phone" class="form-control" name="phone" id="phone" placeholder="手機號碼...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="userid" class="text-right col-md-3 col-form-label">
                            <span class="important">*</span>身分證字號:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="userid" id="userid" placeholder="身分證字號...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="birthdate" class="text-right col-md-3 col-form-label">
                            <span class="important">*</span>出生日期:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control datepicker" name="birthdate" id="birthdate" placeholder="出生日期...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="componey" class="text-right col-md-3 col-form-label">
                            <span class="important">*</span>所屬物業公司:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="componey" id="componey" placeholder="所屬物業公司...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-9 offset-md-3">
                            <button class="btn assets-btn assets-add-btn">註冊帳號</button>
                            <button class="btn assets-btn assets-cancel-btn">取消</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>