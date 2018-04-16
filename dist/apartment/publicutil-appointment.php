<?php 
include('../config.php');
include('../Header.php'); 
?>
<?php 

$sql = 'SELECT * FROM assets';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//	var_dump($data);


?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
            <ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment.php">基本資料</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/building.php">建築物</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/apartment/public-util.php">公設預約</a>
                </li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/settings.php">參數設定</a>
                </li>			
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/apartment/public-util.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>預約公共設施</span>
				</div>
                <form action="" method="POST" class="form-row">
                    <div class="col-12 d-flex align-items-center mb-3">
                        <div class="title mr-3">游泳池 - SPA池</div>
                        <div class="date">
                            <input type="text" name="appointment-date" class="datepicker form-control" placeholder="請輸入日期...">
                        </div>
                        <button type="submit" class="btn btn-outline-primary appointment-btn ml-auto">確認</button>
                    </div>
                    <div class="col-12">
                        <div class="appointment-list">
                            <input type="checkbox" name="0" id="appointment_0" checked disabled>
                            <label for="appointment_0" class="appointment-label">
                                <div class="time">08:00 - 09:00</div>
                                <div class="check-wrap">
                                    <span class="check"></span>
                                    <span>已預約</span>
                                </div>
                                <div class="who">215_251</div>
                            </label>
                        </div>
                        <div class="appointment-list">
                            <input type="checkbox" name="1" id="appointment_1">
                            <label for="appointment_1" class="appointment-label">
                                <div class="time">09:00 - 10:00</div>
                                <div class="check-wrap">
                                    <span class="check"></span>
                                    <span>已預約</span>
                                </div>
                                <div class="who"></div>
                            </label>
                        </div>
                        <div class="appointment-list">
                            <input type="checkbox" name="2" id="appointment_2">
                            <label for="appointment_2" class="appointment-label">
                                <div class="time">11:00 - 12:00</div>
                                <div class="check-wrap">
                                    <span class="check"></span>
                                    <span>已預約</span>
                                </div>
                                <div class="who"></div>
                            </label>
                        </div>
                        <div class="appointment-list">
                            <input type="checkbox" name="3" id="appointment_3">
                            <label for="appointment_3" class="appointment-label">
                                <div class="time">11:00 - 12:00</div>
                                <div class="check-wrap">
                                    <span class="check"></span>
                                    <span>已預約</span>
                                </div>
                                <div class="who"></div>
                            </label>
                        </div>
                        <div class="appointment-list">
                            <input type="checkbox" name="4" id="appointment_4">
                            <label for="appointment_4" class="appointment-label">
                                <div class="time">12:00 - 13:00</div>
                                <div class="check-wrap">
                                    <span class="check"></span>
                                    <span>已預約</span>
                                </div>
                                <div class="who"></div>
                            </label>
                        </div>
                        <div class="appointment-list">
                            <input type="checkbox" name="5" id="appointment_5">
                            <label for="appointment_5" class="appointment-label">
                                <div class="time">13:00 - 14:00</div>
                                <div class="check-wrap">
                                    <span class="check"></span>
                                    <span>已預約</span>
                                </div>
                                <div class="who"></div>
                            </label>
                        </div>
                        <div class="appointment-list">
                            <input type="checkbox" name="6" id="appointment_6">
                            <label for="appointment_6" class="appointment-label">
                                <div class="time">14:00 - 15:00</div>
                                <div class="check-wrap">
                                    <span class="check"></span>
                                    <span>已預約</span>
                                </div>
                                <div class="who"></div>
                            </label>
                        </div>
                        <div class="appointment-list">
                            <input type="checkbox" name="7" id="appointment_7">
                            <label for="appointment_7" class="appointment-label">
                                <div class="time">15:00 - 16:00</div>
                                <div class="check-wrap">
                                    <span class="check"></span>
                                    <span>已預約</span>
                                </div>
                                <div class="who"></div>
                            </label>
                        </div>
                        <div class="appointment-list">
                            <input type="checkbox" name="8" id="appointment_8">
                            <label for="appointment_8" class="appointment-label">
                                <div class="time">16:00 - 17:00</div>
                                <div class="check-wrap">
                                    <span class="check"></span>
                                    <span>已預約</span>
                                </div>
                                <div class="who"></div>
                            </label>
                        </div>
                        <div class="appointment-list">
                            <input type="checkbox" name="9" id="appointment_9">
                            <label for="appointment_9" class="appointment-label">
                                <div class="time">17:00 - 18:00</div>
                                <div class="check-wrap">
                                    <span class="check"></span>
                                    <span>已預約</span>
                                </div>
                                <div class="who"></div>
                            </label>
                        </div>
                        <div class="appointment-list">
                            <input type="checkbox" name="10" id="appointment_10">
                            <label for="appointment_10" class="appointment-label">
                                <div class="time">18:00 - 19:00</div>
                                <div class="check-wrap">
                                    <span class="check"></span>
                                    <span>已預約</span>
                                </div>
                                <div class="who"></div>
                            </label>
                        </div>
                        <div class="appointment-list">
                            <input type="checkbox" name="11" id="appointment_11">
                            <label for="appointment_11" class="appointment-label">
                                <div class="time">19:00 - 20:00</div>
                                <div class="check-wrap">
                                    <span class="check"></span>
                                    <span>已預約</span>
                                </div>
                                <div class="who"></div>
                            </label>
                        </div>
                        <div class="appointment-list">
                            <input type="checkbox" name="12" id="appointment_12">
                            <label for="appointment_12" class="appointment-label">
                                <div class="time">20:00 - 21:00</div>
                                <div class="check-wrap">
                                    <span class="check"></span>
                                    <span>已預約</span>
                                </div>
                                <div class="who"></div>
                            </label>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
<?php 
include(Document_root.'/Footer.php');
?>