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
					<a class="nav-link" href="<?= $urlName ?>/org/#">勤務管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/household.php">住戶意見</a>
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
			<div id="assets-tab" class="row mr-0 ml-0">
				<div class="col-7">
					<div class="assets-create-title mb-3">
						<a href="<?= $urlName ?>/org/contracts.php" class="assets-create-icon fas fa-chevron-left"></a>
						<span>新增承包廠商</span>
					</div>
					<div class="row justify-content-center">
						<div class="col-12">
							<form class="assets-create-form" action="" method="POST">
<!--							
								<span class="edit-title mb-3">資產資料</span>
								<div class="form-group row">
									<label for="community" class="text-right col-md-4 col-form-label">所屬社區:</label>
									<div class="col-md-8 d-flex align-items-center">
										<span>XXXXXX</span>
									</div>
								</div>
-->								
							
								<div class="form-group row">
									<label for="contracts-name" class="text-right col-md-4 col-form-label">
										<span class="important">*</span>廠商名稱:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="contracts-name" id="contracts-name">
									</div>
								</div>

							<div class="form-group row">
								<label for="orgstaff-company" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>合約類別:
								</label>
								<div class="col-md-8">
									
								<select name="household-area" id="household-area" class="form-control">
<!--								
									<option value="0">自聘</option>
-->									
<?php
	$sql = 'SELECT * FROM contract_item';
	$data = $db->getRows($sql);
?>								
<?php
foreach($data as $var) {
	//	echo $var['Name'];
	//echo $var['id'];
?>
										<option value="<?=$var['id'];?>"><?=$var['item'];?></option>
<?php
}
?>

									</select>


								</div>
							</div>


<!--								
								<div class="form-group row">
									<label for="contracts-engname" class="text-right col-md-4 col-form-label">
										廠商英文名稱:
									</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="contracts-engname" id="contracts-engname">
									</div>
								</div>
								<div class="form-group row">
									<label for="contracts-phone" class="text-right col-md-4 col-form-label">
										<span class="important">*</span>廠商電話:
									</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="contracts-phone" id="contracts-phone">
									</div>
								</div>
								<div class="form-group row">
									<label for="contract-createdate" class="text-right col-md-4 col-form-label">
										廠商建立日期:
									</label>
									<div class="col-md-8">
										<input type="text" class="form-control datepicker" name="contract-createdate" id="contract-createdate">
									</div>
								</div>
-->								
								<div class="form-group row">
									<label for="contract-email" class="text-right col-md-4 col-form-label">
										Email:
									</label>
									<div class="col-md-8">
										<input type="email" class="form-control" name="contract-email" id="contract-email">
									</div>
								</div>
								<div class="form-group row">
									<label for="contract-fax" class="text-right col-md-4 col-form-label">
										傳真號碼:
									</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="contract-fax" id="contract-fax">
									</div>
								</div>
								<div class="form-group row">
									<label for="contract-owner" class="text-right col-md-4 col-form-label">
										負責人:
									</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="contract-owner" id="contract-owner">
									</div>
								</div>
								<div class="form-group row">
									<label for="contract-web" class="text-right col-md-4 col-form-label">
										公司網址:
									</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="contract-web" id="contract-web">
									</div>
								</div>
<!--								
								<span class="edit-title mb-3">聯絡方式</span>
-->								
								<div class="form-group row">
									<label for="contract-person" class="text-right col-md-4 col-form-label">
										<span class="important">*</span>聯絡人:
									</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="contract-person" id="contract-person">
									</div>
								</div>
								<div class="form-group row">
									<label for="contract-personphone" class="text-right col-md-4 col-form-label">
										<span class="important">*</span>聯絡電話:
									</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="contract-personphone" id="contract-personphone">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-8 offset-md-4">
										<button class="btn btn-outline-secondary">新增</button>
										<button class="btn btn-outline-secondary">取消</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<!--				
				<div class="col-5">
					<a href="<?= $urlName ?>/org/contracts-addpaper.php" class="btn btn-primary mb-3">新增廠商合約</a>
					<dvi class="card contracts-paper">
						<div class="card-header p-2 d-flex align-items-center">
							<span>水管維修合約</span>
							<a href="contracts-editpaper.php" class="ml-auto btn btn-download-edit">編輯合約</a>
						</div>
						<div class="card-body">
							<div class="paper-wrapper">
								<div class="paper-box d-flex flex-column">
									<div class="btn-download-title">招標文件</div>
									<div class="d-flex align-items-center">
										<i class="far fa-file"></i>
										<span class="btn-download-name mx-2">招標文件招標文件</span>
										<a href="#" class="btn btn-download">下載檔案</a>
									</div>
								</div>
								<div class="paper-box d-flex flex-column">
									<div class="btn-download-title">招標文件</div>
									<div class="d-flex align-items-center">
										<i class="far fa-file"></i>
										<span class="btn-download-name mx-2">招標文件招標文件</span>
										<a href="#" class="btn btn-download">下載檔案</a>
									</div>
								</div>
							</div>
						</div>
					</dvi>
				</div>
-->				
			</div>
		</div>
	</div>
</div>

<script>
$('.contracts-paper .card-header').on('click',function(){
	var _height=$(this).closest('.contracts-paper').find('.paper-wrapper').outerHeight(true);
	$(this).closest('.contracts-paper').toggleClass('show')
	if($(this).closest('.contracts-paper').hasClass('show')){
		$(this).closest('.contracts-paper').find('.card-body').css('height',_height+'px')
	}else{
		$(this).closest('.contracts-paper').find('.card-body').css('height','0px')
	}
})
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