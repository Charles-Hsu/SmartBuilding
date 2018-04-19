<?php session_start(); ?>
<?php
$_isAdmin = $_SESSION['admin'];
?>
<body class="d-flex">
    <div class="sidemenu">
        <div class="sidemenu-wrapper">
            <div class="sidemenu-title my-4">
                <i class="fab fa-optin-monster"></i>
                <span><?=$conf['sysname']?></span>
            </div>
            <ul class="sidemenu-nav">
                <?php
                    $dest = "announcement.php";
                ?>
                <li>
                    <a href="<?php echo $urlName;?>/<?php echo $dest;?>" class="d-flex sidemenu-link align-items-center" title="效能管理" data-type="kpi">
                        <i class="far fa-chart-bar"></i>
                        <span>效能管理</span>
                    </a>
                </li>
                <?php
                    if ($_isAdmin) {
                ?>
                <li>
                    <a href="<?= $urlName ?>/assets.php" class="d-flex sidemenu-link align-items-center" title="資產管理" data-type="assets">
                        <i class="fas fa-book"></i>
                        <span>資產管理</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $urlName ?>/org.php" class="d-flex sidemenu-link align-items-center" title="組織管理" data-type="org">
                        <i class="fas fa-users"></i>
                        <span>組織管理</span>
                    </a>
                </li>
                <?php
                    }
                ?>
                <li>
                    <a href="<?= $urlName ?>/operation/energy.php" class="d-flex sidemenu-link align-items-center" title="維運管理" data-type="operation">
                        <i class="far fa-address-book"></i>
                        <span>維運管理</span>
                    </a>
                </li>
                <?php
                    if ($_isAdmin) {
                ?>
                <li>
                    <a href="<?= $urlName ?>/longTerm-repairs/budget.php" class="d-flex sidemenu-link align-items-center" title="長期維護" data-type="longTerm-repairs">
                        <i class="far fa-address-book"></i>
                        <span>長期修繕</span>
                    </a>
                </li>
                <?php
                    }
                ?>
                <li>
                    <a href="<?= $urlName ?>/apartment/mails.php" class="d-flex sidemenu-link align-items-center" title="社區管理" data-type="apartment">
                        <i class="fas fa-home"></i>
                        <span>社區管理</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $urlName ?>/questionaire.php" class="d-flex sidemenu-link align-items-center" title="社區資料" data-type="questionaire">
                        <i class="fas fa-home"></i>
                        <span>問卷調查</span>
                    </a>
                </li>
                <?php
                     if ($_isAdmin) {
                ?>
                <li>
                    <a href="<?= $urlName ?>/files.php" class="d-flex sidemenu-link align-items-center" title="社區檔案" data-type="files">
                        <i class="far fa-folder"></i>
                        <span>社區檔案</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="<?= $urlName ?>/profile.php" class="d-flex sidemenu-link align-items-center" title="個人資料" data-type="profile">
                        <i class="far fa-smile"></i>
                        <span>個人資料</span>
                    </a>
                </li> -->
                <li>
                    <a href="<?= $urlName ?>/system.php" class="d-flex sidemenu-link align-items-center" title="個人資料" data-type="system">
                        <i class="fas fa-cog"></i>
                        <span>資安管理</span>
                    </a>
                </li>
                <?php
                    }
                ?>
                <li>
                    <a href="<?= $urlName ?>/logout.php" class="d-flex sidemenu-link align-items-center" title="登出">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>登出</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="content-main container-fluid">
        <div class="row p-2">
            <div class="col-12">
                <div class="content-header">
                    <i class="slide-toggle-btn fas fa-outdent"></i>
                </div>
            </div>
        </div>
        <div class="row p-3 content-wrapper">
            <div class="col-12 content-wrapper-col">