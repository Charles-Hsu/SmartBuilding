<?php 
include('../config.php');
include('../Header.php'); 
?>
<?php 


if (count($_POST) > 0) {
	echo "hello world";
	var_dump($_POST);
}

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

<style>
	.disableClick {
		pointer-events: none;
	}
</style>


<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org.php">人員</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/patrol.php">勤務管理</a>
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
					<a class="nav-link active" href="<?= $urlName ?>/org/chart.php">管理委員會</a>
                </li>
			</ul>
			<div id="assets-tab">
				<a href="<?= $urlName ?>/org/chart-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增委員
				</a>
				<a href="<?= $urlName ?>/org/chart-edit.php" class="btn add-asset-btn mb-3">
					<span>+</span>委員會改選
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>屆別</th>
							<th>職稱</th>
							<th>戶號</th>
							<th>樓層</th>
							<th>姓名</th>
							<th>編輯</th>
						</tr>
					</thead>
					<tbody>
					<?php
	$sql = "SELECT c.name AS session, b.title, a.addr_no, a.floor, a.name FROM committee a, committee_role b, session c WHERE a.role_id = b.id AND a.session = c.id";

	$sql = "SELECT d.holder, d.addr_no, d.floor, c.name AS session_name, c.id AS session_id, b.title, b.id AS role_id FROM committee a, committee_role b, session c, household d WHERE a.role_id = b.id AND a.session = c.id AND d.id = a.holder_id";
	
	$data = $db->getRows($sql);
	foreach($data as $var) {
?>
						<tr>
							<td><span><input value="<?=$var['session_name'];?>" readonly></span></td>
							<td><span><input value="<?=$var['title'];?>" readonly></span></td>
							<td>
								<span>
									<select  class="form-control" name="addr_no" id="addr_no">
									<?php
									$sql = "SELECT distinct addr_no FROM `household`";
									$dd = $db->getRows($sql);
									$addr_no = $var['addr_no'];
									foreach ($dd as $t) {
									?>
										<option value="<? echo $t['addr_no'];?>" <?php echo !strcmp($t['addr_no'], $addr_no) ? "selected" : "";?>><? echo $t['addr_no'];?></option>
									<?php
									}
									?>
									</select>
								</span>
							</td>
							<td>
								<span>
								<select class="form-control" name="floor" id="floor">
									<?php
									$sql = "SELECT distinct floor FROM `household` ORDER BY floor*1";
									$dd = $db->getRows($sql);
									$floor = $var['floor'];
									foreach ($dd as $t) {
									?>
										<option value="<? echo $t['floor'];?>" <?php echo !strcmp($t['floor'], $floor) ? "selected" : "";?>><? echo $t['floor'];?></option>
									<?php
									}
									?>
									</select>
								</span>
							</td>
							<td><span><input value="<?=$var['holder'];?>" readonly></span></td>
							<td><span><a href="#" class="disableClick">確認</a></td>
						</tr>
<?php
	}
?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>


<script>
$('#addr_no').on('change',function(e){
	// var _val=$('#household-own').val()
	// $('#household-name').val(_val)
	// e.preventDefault()
	$("#addr_no").css("pointer-events", "auto");
})
</script>

<script>

$('.asset-table').DataTable({
	"language": {
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋資產...",
		"info": "從 _START_ 到 _END_ /共 _TOTAL_ 筆資料",
		"infoEmpty": "",
		"emptyTable": "目前沒有資料",
		"lengthMenu": "每頁顯示 _MENU_ 筆資料",
		"zeroRecords": "搜尋無此資料",
		"infoFiltered": " 搜尋結果 _MAX_ 筆資料",
		"paginate": {
			"previous": "上一頁",
			"next": "下一頁",
			"first": "第一頁",
			"last": "最後一頁"
		}
	},
	"deferRender": true,
	"processing": true
})
</script>
<?php include('../Footer.php'); ?>