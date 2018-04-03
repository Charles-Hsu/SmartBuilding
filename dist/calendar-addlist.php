<?php 
include('./config.php');
include('./Header.php');
?>
<?php 

$sql = 'SELECT * FROM assets';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//	var_dump($data);
/*
if (strlen($_SESSION['account']) == 0) {
	header('Location: ' . '/smartbuilding/login.php');
}
*/
$getDate = $_GET['year'].'-'.$_GET['month'].'-'.$_GET['day'];


if (count($_POST) > 0) {
	//var_dump($_POST);
	$day0 = strtotime($_POST['day0']); // integer of 'today'
	$day1 = strtotime($_POST['day1']); // integer of 'end day'

	echo $day0;
	echo '<br>';
	echo $day1;
	echo '<br>';
	echo $day1 - $day0;
	echo '<br>';


	$catid = $_POST['task-category'];
	$conid = $_POST['contract-id'];
	$desc  = $_POST['task-content'];
	$per   = intval($_POST['task-period']); // 0: 單次, 1: 每日, 2: 每月, 3: 每季, 4: 每年
	$interval = 0;

	echo $per;
	echo '<br>';

	for ($diff = $day1 - $day0; $diff >= 0; $diff = $day1 - $day0) {
		//echo date('Y-m-d', $day0) . '<br>';
		$dtstr = date('Y-m-d', $day0);
		echo $dtstr . '<br>';
		if ($per == 0) { // single task
			$day0 = strtotime("+10 year", $day0);
		} else if ($per == 1) { // every day
			$day0 = strtotime("+1 day", $day0);
		} else if ($per == 2) { // every month
			$day0 = strtotime("+1 month", $day0);
		} else if ($per == 3) { // every quarter
			$day0 = strtotime("+3 month", $day0);
		} else if ($per == 4) { // every year
			$day0 = strtotime("+1 year", $day0);
		}  
		$datestr = date('Y-m-d', day0);

		$sql = "INSERT INTO `tasks` (`id`, `dt`, `category_id`, `contract_id`, `descript`) VALUES (NULL, '" . $dtstr . "', " . $catid . ", " . $conid . ", '" . $desc . "')";
		echo $sql . '<br>';

		if ($db->insert($sql)) {
		//	//if ($db->insertRow($table, $data)) {
		//		$message="新增成功";
			echo "<script>location.replace('operation.php');</script>";
		}else{
;
		}


	}



//	$start_day = strtotime($day0);
//	$next_day = strtotime("+1 day", $start_day);
//	echo $start_day;

/*	
	$date1 = date_create('2013-03-15');
	$date2 = date_create('2013-12-12');
	$diff = date_diff($date1, $date2);
	echo $diff;
 	echo date ('Y-m-d', $diff);
*/
/*
	for ($next_day = strtotime("+1 day", $start_day); date_diff($next_day, $day1)->days > 0;  $next_day = $start_day) {
		echo date ('Y-m-d', $start_day);
	}
*/
/*
	$next_day = strtotime("+1 day", $start_day);

	echo $start_day;
	echo date ('Y-m-d', $start_day);
	echo date ('Y-m-d', $next_day);
*/	


/*
	$catid = $_POST['task-category'];
	$conid = $_POST['contract-id'];
	$desc = $_POST['task-content'];
	$sql = "INSERT INTO `tasks` (`id`, `dt`, `category_id`, `contract_id`, `descript`) VALUES (NULL, '" . $dt . "', " . $catid . ", " . $conid . ", '" . $desc . "')";
	//echo $sql;
	if ($db->insert($sql)) {
		//if ($db->insertRow($table, $data)) {
		$message="新增成功";
	}
*/	
}

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
            <ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/operation.php">例行作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/repairs-normal.php">維護作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/supplies.php">耗材管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/#">年度預算</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/operation.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增例行作業</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-xl-6 col-lg-8 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
                            <!-- 獲取點選日期 -->
                            	<input type="hidden" name="getDate" value="<?= $getDate; ?>">
							<div class="form-group row">
								<label for="innerswim-reply" class="text-right col-md-4 col-form-label">作業類別:</label>
								<div class="col-md-8">
									<select id="innerswim-reply" class="form-control" name="task-category">

<?php
$sql = "SELECT * FROM task_category";
$sql = "SELECT * FROM contract_item";
//echo $sql;
$data = $db->getRows($sql);
//var_dump($data);

foreach($data as $var) {
?>
										<option value="<?=$var['id'];?>"><?=$var['item'];?></option>
<?php
}
?>									
                                	</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="innerswim-reply" class="text-right col-md-4 col-form-label">承包廠商:</label>
								<div class="col-md-8">
									<select id="innerswim-reply" class="form-control" name="contract-id">

<?php
$sql = "SELECT * FROM contract";
//echo $sql;
$data = $db->getRows($sql);
//var_dump($data);

foreach($data as $var) {
?>
										<option value="<?=$var['id'];?>"><?=$var['name'];?></option>
<?php
}
?>									
                                    </select>
                                </div>
							</div>
							<div class="form-group row">
								<label for="household-title" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>作業內容:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="task-content" id="task-content">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-title" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>起始日期:</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="day0" value="<?=$getDate;?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-title" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>結束日期:</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker datepicker1" name="day1">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="text-right col-md-4 col-form-label">作業週期:</label>
								<div class="col-md-8">
									<select id="" class="form-control" name="task-period">
<?php
$sql = "SELECT * FROM task_repeat";
$data = $db->getRows($sql);
//var_dump($data);
foreach ($data as $var) {
?>									
										<option value="<?=$var['id'];?>"><?=$var['duration'];?></option>							
<?php
}
?>							
                                    </select>
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

	var now_date=new Date();
	var now_year=now_date.getFullYear();
	/*
	var now_month=now_date.getMonth()+1;
	var now_date=now_date.getDate();
	if(now_month<10){
		now_month='0'+now_month
	}
	if(now_date<10){
		now_date='0'+now_date
	}
	*/
	$('.datepicker1').val(`${now_year}-12-31`)

</script>


<?php 
include(Document_root.'/Footer.php');
?>