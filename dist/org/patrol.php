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

if (strlen($_SESSION['account']) == 0) {
	header('Location: ' . '/smartbuilding/login.php');
}

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org.php">人員</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/org/patrol.php">勤務管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/opinions.php">住戶意見</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/works.php">工作日誌</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/mails.php">郵件紀錄</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/transfer.php">移交紀錄</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/chart.php">組織管理團</a>
                </li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
    <div class="col-12">
        <form action="" method="GET" class="table-responsive-lg table-responsive-xl row">
            <table class="punch-table table table-bordered ">
                <thead>
                    <tr>
                        <th class="text-center">姓名</th>
                        <th colspan=31 class="text-center">日期</th>
                        <th class="text-center">時數</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- 姓名 -->
                        <td class="name">陳慶陽</td>

                        <!-- 按鈕 -->
                        <td class="checktime"><input type="checkbox" id="name_1" name="name_1"><label for="name_1">1</label></td>
                        <td class="checktime"><input type="checkbox" id="name_2" name="name_2"><label for="name_2">2</label></td>
                        <td class="checktime"><input type="checkbox" id="name_3" name="name_3"><label for="name_3">3</label></td>
                        <td class="checktime"><input type="checkbox" id="name_4" name="name_4"><label for="name_4">4</label></td>
                        <td class="checktime"><input type="checkbox" id="name_5" name="name_5"><label for="name_5">5</label></td>
                        <td class="checktime"><input type="checkbox" id="name_6" name="name_6"><label for="name_6">6</label></td>
                        <td class="checktime"><input type="checkbox" id="name_7" name="name_7"><label for="name_7">7</label></td>
                        <td class="checktime"><input type="checkbox" id="name_8" name="name_8"><label for="name_8">8</label></td>
                        <td class="checktime"><input type="checkbox" id="name_9" name="name_9"><label for="name_9">9</label></td>
                        <td class="checktime"><input type="checkbox" id="name_10" name="name_10"><label for="name_10">10</label></td>
                        <td class="checktime"><input type="checkbox" id="name_11" name="name_11"><label for="name_11">11</label></td>
                        <td class="checktime"><input type="checkbox" id="name_12" name="name_12"><label for="name_12">12</label></td>
                        <td class="checktime"><input type="checkbox" id="name_13" name="name_13"><label for="name_13">13</label></td>
                        <td class="checktime"><input type="checkbox" id="name_14" name="name_14"><label for="name_14">14</label></td>
                        <td class="checktime"><input type="checkbox" id="name_15" name="name_15"><label for="name_15">15</label></td>
                        <td class="checktime"><input type="checkbox" id="name_16" name="name_16"><label for="name_16">16</label></td>
                        <td class="checktime"><input type="checkbox" id="name_17" name="name_17"><label for="name_17">17</label></td>
                        <td class="checktime"><input type="checkbox" id="name_18" name="name_18"><label for="name_18">18</label></td>
                        <td class="checktime"><input type="checkbox" id="name_19" name="name_19"><label for="name_19">19</label></td>
                        <td class="checktime"><input type="checkbox" id="name_20" name="name_20"><label for="name_20">20</label></td>
                        <td class="checktime"><input type="checkbox" id="name_21" name="name_21"><label for="name_21">21</label></td>
                        <td class="checktime"><input type="checkbox" id="name_22" name="name_22"><label for="name_22">22</label></td>
                        <td class="checktime"><input type="checkbox" id="name_23" name="name_23"><label for="name_23">23</label></td>
                        <td class="checktime"><input type="checkbox" id="name_24" name="name_24"><label for="name_24">24</label></td>
                        <td class="checktime"><input type="checkbox" id="name_25" name="name_25"><label for="name_25">25</label></td>
                        <td class="checktime"><input type="checkbox" id="name_26" name="name_26"><label for="name_26">26</label></td>
                        <td class="checktime"><input type="checkbox" id="name_27" name="name_27"><label for="name_27">27</label></td>
                        <td class="checktime"><input type="checkbox" id="name_28" name="name_28"><label for="name_28">28</label></td>
                        <td class="checktime"><input type="checkbox" id="name_29" name="name_29"><label for="name_29">29</label></td>
                        <td class="checktime"><input type="checkbox" id="name_30" name="name_30"><label for="name_30">30</label></td>
                        <td class="checktime"><input type="checkbox" id="name_31" name="name_31"><label for="name_31">31</label></td>

                        <!-- 時數 -->
                        <td class="totaltime">24</td>
                    </tr>
                    <tr>
                        <!-- 姓名 -->
                        <td class="name">陳慶陽</td>

                        <!-- 按鈕 -->
                        <td class="checktime"><input type="checkbox" id="bb_1" name="bb_1"><label for="bb_1">1</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_2" name="bb_2"><label for="bb_2">2</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_3" name="bb_3"><label for="bb_3">3</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_4" name="bb_4"><label for="bb_4">4</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_5" name="bb_5"><label for="bb_5">5</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_6" name="bb_6"><label for="bb_6">6</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_7" name="bb_7"><label for="bb_7">7</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_8" name="bb_8"><label for="bb_8">8</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_9" name="bb_9"><label for="bb_9">9</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_10" name="bb_10"><label for="bb_10">10</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_11" name="bb_11"><label for="bb_11">11</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_12" name="bb_12"><label for="bb_12">12</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_13" name="bb_13"><label for="bb_13">13</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_14" name="bb_14"><label for="bb_14">14</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_15" name="bb_15"><label for="bb_15">15</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_16" name="bb_16"><label for="bb_16">16</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_17" name="bb_17"><label for="bb_17">17</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_18" name="bb_18"><label for="bb_18">18</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_19" name="bb_19"><label for="bb_19">19</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_20" name="bb_20"><label for="bb_20">20</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_21" name="bb_21"><label for="bb_21">21</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_22" name="bb_22"><label for="bb_22">22</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_23" name="bb_23"><label for="bb_23">23</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_24" name="bb_24"><label for="bb_24">24</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_25" name="bb_25"><label for="bb_25">25</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_26" name="bb_26"><label for="bb_26">26</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_27" name="bb_27"><label for="bb_27">27</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_28" name="bb_28"><label for="bb_28">28</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_29" name="bb_29"><label for="bb_29">29</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_30" name="bb_30"><label for="bb_30">30</label></td>
                        <td class="checktime"><input type="checkbox" id="bb_31" name="bb_31"><label for="bb_31">31</label></td>
                        
                        <!-- 時數 -->
                        <td class="totaltime">24</td>
                    </tr>
                </tbody>
            </table>
            <div class="col-6 offset-md-3">
                <button class="btn btn-outline-primary btn-block" type="submit">送出</button>
            </div>
        </form>
    </div>
</div>
<script>
</script>
<?php include('../Footer.php'); ?>