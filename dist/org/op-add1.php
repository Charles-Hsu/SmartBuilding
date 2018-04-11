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
					<a class="nav-link" href="<?= $urlName ?>/org/patrol.php">勤務管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/org/opinions.php">住戶意見</a>
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
					<a class="nav-link" href="<?= $urlName ?>/org/chart.php">管理委員會</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/org/opinions.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增住戶意見 (住戶)</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
<!--

							<div class="form-group row">
								<label for="community" class="text-right col-md-4 col-form-label">所屬社區:</label>
								<div class="col-md-8 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
                            </div>
-->                            
<!--
							<div class="form-group row">
								<label for="household-title" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>標題:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-title" id="household-title">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-content" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>意見內容:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-content" id="household-content">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-reply" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>反應住戶:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-reply" id="household-reply">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-status" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>案件狀態:</label>
								<div class="col-md-8">
									<select class="form-control" name="household-status" id="household-status">
										<option value="" selected>選取狀態</option>
										<option value="unsucess">未結案</option>
										<option value="sucess">已結案</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-date" class="text-right col-md-4 col-form-label">
									結案日期:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="household-date" id="household-date">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-8 offset-md-4">
									<button class="btn btn-primary">儲存更新</button>
									<button class="btn btn-outline-secondary">取消更新</button>
									<button class="btn btn-outline-danger">刪除該人員</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
-->

<?php 

$sql = 'SELECT a.*, b.name AS status FROM assets a, asset_status b WHERE a.status_no = b.id';
/*
							<td><span><?=$var[building]?></span></td>
							<td><span><?=$var[addr_no]?></span></td>
							<td><span><?=$var[floor]?></span></td>
							<td><span><?=$var[status]?></span></td>
							<td><span><?=$var[holder]?></span></td>
							<td><span><?=$var[resident]?></span></td>
*/

$sql = 'SELECT a.id AS id,building,addr_no,floor,unpaid_total,b.name AS status,holder,resident,sellrent FROM household a, household_status b WHERE a.status = b.id';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);
session_start();

//var_dump($data);
?>


<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
            <!--
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets.php">資產管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="/smartbuilding/assets/household.php">產權管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/sellrent.php">租售管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/brokerman.php">帶看管理</a>
				</li>
            </ul>
-->
			<div id="assets-tab">
<!--
				<a href="/smartbuilding/assets/household-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增產權
                </a>
-->
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>大樓</th>
							<th>戶號</th>
                            <th>樓層</th>
<!--
                            <th>住戶狀態</th>
-->
							<th>區權人</th>
                            <th>現住戶</th>
<!--                            
							<th>欠繳</th>
							<th>明細</th>
                            <th>產權</th>
-->                            
                            <th>意見</th>

						</tr>
					</thead>
					<tbody>


<?php
	foreach($data as $var) {
//		echo $var[asset_no];
//		echo $var[asset_name];
//		echo $var[status];
//		echo $var[price];
//		echo '<br>';
?>

						<tr>
							<td><span><?=$var[building];?></span></td>
							<td><span><?=$var[addr_no];?></span></td>
							<td><span><?=$var[floor];?></span></td>

							<td><span><?=$var[holder];?></span></td>
							<td><span><?=$var[resident];?></span></td>

<!--
							<td><a href="#" id="show-detailss" data-id="<?= $var[id] ?>" class="btn btn-outline-secondary">顯示</a></td>
-->


							<td><a href="/smartbuilding/org/op-add2.php?id=<?=$var[id];?>" class="btn btn-outline-secondary">新增</a></td>




						</tr>
<?php
	}
?>


<?php
	// foreach($data as $var) {
//		echo $var[asset_no];
//		echo $var[asset_name];
//		echo $var[status];
//		echo $var[price];
//		echo '<br>';
?>
<!--
						<tr>
							<td><span>忠孝棟</span></td>
							<td><span>AX0001 1F樓</span></td>
							<td><span>已入住</span></td>
							<td><span>測試人員</span></td>
							<td><span>測試人員</span></td>
							<td><a href="/smartbuilding/assets/edit-page.php" class="btn btn-outline-secondary">修改</a></td>
						</tr>
						<tr>
							<td><span>仁愛棟</span></td>
							<td><span>19號 1F樓</span></td>
							<td><span>出售中</span></td>
							<td><span>測試人員</span></td>
							<td><span>測試人員</span></td>
							<td><a href="/smartbuilding/assets/edit-page.php" class="btn btn-outline-secondary">修改</a></td>
						</tr>
-->						
<?php
	// }
?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
$('.asset-table').DataTable({
	"language": {
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋住戶...",
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

<?php 
include(Document_root.'/Footer.php');
?>