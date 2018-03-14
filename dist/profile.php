<?php 
include('./config.php');
include(Document_root.'/Header.php'); 
?>
<?php

session_start();

//echo $_SESSION['account'] . '<br>';

//$_SESSION['account'] = 'charles'; // for test only

$sql = 'SELECT * FROM users WHERE account = "' . $_SESSION['account'] . '"';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
/*
echo $_SESSION['account'] . '<br>';
echo $sql . '<br>';
*/
$data = $db->getRow($sql);
/*
var_dump($data);
*/
?>
<!-- 內容切換區 -->
<div class="row">
    <div class="col-12 p-4">
        <div class="profile-wrapper">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-8 col-xs-12 col-12">
                    <form class="assets-create-form" action="" method="POST">
                        <div class="form-group row">
                            <label for="community" class="text-right col-md-3 col-form-label">使用者帳號:</label>
                            <div class="col-md-9 d-flex align-items-center">
                                <span><?=$data['account'];?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="community" class="text-right col-md-3 col-form-label">姓名:</label>
                            <div class="col-md-9 d-flex align-items-center">
                                <span><?=$data['name'];?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="assets-no" class="text-right col-md-3 col-form-label">身份證字號:</label>
                            <div class="col-md-9 d-flex align-items-center">
                                <span><?=$data['identity'];?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birthdate" class="text-right col-md-3 col-form-label">
                                <span class="important"></span>生日日期:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control datepicker" name="birthdate" id="birthdate" placeholder="生日日期..." value="<?=$data['birthday'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="text-right col-md-3 col-form-label">E-mail:</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="email" id="email" placeholder="E-mail..." value="<?=$data['email'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="text-right col-md-3 col-form-label">手機號碼:</label>
                            <div class="col-md-9">
                                <input type="phone" class="form-control" name="phone" id="phone" placeholder="手機號碼..." value="<?=$data['mobile'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="assets-amount" class="text-right col-md-3 col-form-label">所屬公司:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="assets-amount" id="assets-amount" placeholder="所屬公司..." value="<?=$data['company'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="text-right col-md-3 col-form-label">密碼:</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password" id="password" value="<?=$data['password'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3">
                                <button class="btn assets-btn assets-add-btn">更新</button>
                                <button class="btn assets-btn assets-cancel-btn">取消</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include(Document_root.'/Footer.php');
?>