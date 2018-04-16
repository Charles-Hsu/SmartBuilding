<?php 
include('../config.php');
include('../Header.php'); 

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

session_start();

if (count($_POST)) {
	var_dump($_POST);
	$dd = $_POST['meeting-date'];
	$tp = $_POST['meeting-type'];
	$ss = $_POST['session'];
	$rd = $_POST['round'];
	$sql = "INSERT INTO meetings (`id`, `date`, `meeting_type`, `session`, `round`) VALUES (NULL, '$dd', $tp, $ss, $rd)";
	echo $sql;
}
$sql2 = "SELECT * FROM `meetings`";
$data= $db->getRows($sql2);
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
					<a class="nav-link" href="<?= $urlName ?>/apartment/public-util.php">公設預約</a>
				</li>

				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/apartment/meeting-man.php">會議管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/settings.php">參數設定</a>
                </li>														

			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/apartment/meeting-man.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增會議</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
							<div class="form-group row">
								<label for="builds-license-num" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>
								</label>
								<div class="col-md-8">
									<select id="innerswim-reply" class="form-control" name="meeting-type">
										<option value="" selected>請選擇會議類型</option>
									<?php
									$sql = "SELECT * FROM meeting_type";
									$data = $db->getRows($sql);
									foreach($data as $var) {
									?>
										<option value="<?=$var['id'];?>"><?=$var['name'];?></option>
									<?php
									}
									?>
	                                </select>
								</div>
							</div>
							<!-- 第幾屆 -->
							<div class="form-group row">
								<label for="builds-name" class="text-right col-md-4 col-form-label">
									<span class="important">*</span></label>
								<div class="col-md-8">
									<select id="innerswim-session" class="form-control" name="session" disabled>
									<?php
										$sql = "SELECT * FROM session";
										$data = $db->getRows($sql);
										$session=1;// 預設第一屆
										foreach($data as $var) {
											if($var['id'] == $session) {
									?>
											<option value="<?=$var['id'];?>" selected><?=$var['name'];?></option>
										<?php } else { ?>
											<option value="<?=$var['id'];?>" disabled><?=$var['name'];?></option>
										<?php
											}
										}
									?>
									</select>
								</div>
							</div>
							<!-- 第幾屆end -->

							<!-- 第幾次 -->
							<div class="form-group row">
								<label for="builds-address" class="text-right col-md-4 col-form-label">
									<span class="important">*</span></label>
								<div class="col-md-8">
									<select id="innerswim-round" class="form-control" name="round" disabled>
									<?php
										$sql = "SELECT * FROM round";
										$data = $db->getRows($sql);
										foreach($data as $var) {
											// 預設第一次
											if($var['id'] == 1) {
									?>
										<option value="<?php echo $var['id'];?>" selected><?php echo $var['name'];?></option>
									<?php } else { ?>
										<option value="<?php echo $var['id'];?>"><?php echo $var['name'];?></option>
									<?php
											}
										}
									?>
									</select>
								</div>
							</div>
							<!-- 第幾屆 end -->
							<div class="form-group row">
								<label for="meeting-date" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>開會日期:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="meeting-date" id="meeting-date" placeholder="開會日期..." >
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
		</div>
	</div>
</div>
<script>
	$(function() {
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();
		if (dd < 10) {
			dd = '0' + dd;
		}
		if (mm < 10) {
			mm = '0' + mm;
		}
		var today = yyyy + '-' + mm + '-' + dd;
		$('#meeting-date').attr("value", today);

		$('#innerswim-reply').on('change',function(){
			var meeting_type=$(this).val();
			$.ajax({
				url:'../data/meeting-manData.php',
				method:'POST',
				data:{
					meeting_type
				},
				success:function(data){
					try{
						let _data=JSON.parse(data);
						let session='';
						let round='';
						if(_data.success){
							round=_data.data[0].round;
							if(_data.data[0].meeting_type == 1){
								if(!_data.data[0].round){
									$('#innerswim-round option').eq(0).prop('selected',true);
									$('#innerswim-round option').not($('#innerswim-round option').eq(0)).prop('disabled',true)
								}else{
									$('#innerswim-round option').eq(0).prop('selected',true);
									$('#innerswim-round option').not($('#innerswim-round option').eq(0)).prop('disabled',true)
								}
							}
							if(_data.data[0].meeting_type != 1){
								if(!_data.data[0].round){
									$('#innerswim-round option').eq(0).prop('selected',true);
									$('#innerswim-round option').not($('#innerswim-round option').eq(0)).prop('disabled',true)
								}else{
									if(round > $('#innerswim-round option').length){
										console.log('請添加!!')
									}else{
										$('#innerswim-round option').each(function(index,item){
											if($(item).val() == round){
												$('#innerswim-round option').eq(index+1).prop('selected',true)
												$('#innerswim-round option').not($('#innerswim-round option').eq(index+1)).prop('disabled',true)
											}
										})
									}
								}
							}
						}else{
							alert('請重新操作')
						}
					}catch(error){
						alert(data)
					}
				},
				error:function(error){
					console.log(error);
				}
			})
		})
	})
</script>
<?php
include(Document_root.'/Footer.php');
?>