<?php session_start(); ?>
<?php
	include('../config.php');
	include('../Header.php');
	if (!$_SESSION['online']) {
		$url = "$urlName/login.php";
		header("Location: " . $url);
	}
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
	$_isAdmin = $_SESSION['admin'];

	$message = "";

if(count($_POST)>0) {
	/*
	echo 'assets-no = ' . $_POST['assets-no'] . '<br>';
	echo 'assets-name = ' . $_POST['assets-name'] . '<br>';
	echo 'assets-sort = ' . $_POST['assets-sort'] . '<br>';
	echo 'assets-price = ' . $_POST['assets-price'] . '<br>';
	echo 'assets-amount = ' . $_POST['assets-amount'] . '<br>';
	echo 'assets-man = ' . $_POST['assets-man'] . '<br>';
	echo 'assets-buy-date = ' . $_POST['assets-buy-date'] . '<br>';
	echo 'assets-use-state = ' . $_POST['assets-use-state'] . '<br>';
	*/
	$sql =  "SELECT count(*) AS n FROM assets WHERE asset_no='" . $_POST['assets-no']. "'";
	$data = $db->getValue($sql);

	if ($data != 0) {
		$message="資產編號重複";
	} else {
		$sql =  "SELECT count(*) AS n FROM assets WHERE asset_name='" . $_POST['assets-name']. "'";
		$data = $db->getValue($sql);
		if ($data != 0) {
			$message="資產名稱重複";
		}
	}
	//echo " message = [" . $message . "]";
	if ($message == "") {
		if ($_POST['assets-no'] == "") {
			$message="資產編號不能空白";
		} else if ($_POST['assets-name'] == "") {
			$message="資產名稱不能空白";
		} else if ($_POST['assets-buy-date'] == "") {
			$message="請輸入購置日期";
		} else if ($_POST['assets-use-state'] == "") {
			$message="請選擇使用狀態";
		} else {
/*
			echo 'assets-no = ' . $_POST['assets-no'] . '<br>';
			echo 'assets-name = ' . $_POST['assets-name'] . '<br>';
			echo 'assets-sort = ' . $_POST['assets-sort'] . '<br>';
			echo 'assets-price = ' . $_POST['assets-price'] . '<br>';
			echo 'assets-amount = ' . $_POST['assets-amount'] . '<br>';
			echo 'assets-man = ' . $_POST['assets-man'] . '<br>';
			echo 'assets-buy-date = ' . $_POST['assets-buy-date'] . '<br>';
			echo 'assets-use-state = ' . $_POST['assets-use-state'] . '<br>';
*/
			$table = 'assets';
			$data = array();
			$data['asset_no'] = $_POST['assets-no'];
			$data['asset_name'] = $_POST['assets-name'];
			$data['asset_category'] = $_POST['assets-sort'];
			$data['price'] = $_POST['assets-price'];
			$data['amount'] = $_POST['assets-amount'];
			$data['order_by'] = $_POST['assets-man'];
			$data['order_date'] = $_POST['assets-buy-date'];
			$data['status_no'] = $_POST['assets-use-state'];

			$fields = "";
			$values = "";

			foreach ($data as $key => $value) {
//				echo $key;
//				echo $value;
				$fields = $fields . "`" . $key . "`,";
				$values = $values . "'" . $value . "',";
			}
/*
			echo "<br>";
			echo $fields;
			echo "<br>";
			echo $values;
			echo "<br>";
			echo strlen($fields)-1;
			echo "<br>";
			//echo substr($fields, 0, strlen($fields)-1);
*/
			$fields = substr($fields, 0, strlen($fields)-1);
/*
			echo $fields;
			echo "<br>";
			echo strlen($values)-1;
			echo "<br>";
			//echo substr($values, 0, strlen($values)-1);
*/
			$values = substr($values, 0, strlen($values)-1);
/*
			echo "<br>";
*/
			$sql = 'INSERT INTO ' . $table . ' (' . $fields . ') ' . ' VALUES (' . $values . ')';
/*
			echo $sql;
*/
			if ($db->insert($sql)) {
			//if ($db->insertRow($table, $data)) {
				$message="新增成功";
			}
		}
	}

}

/*
	public function insertRow($table, $data){
		$sql="insert into $table(";
		$values='';
		foreach($data as $key=>$val){
			if($values){
				$sql.=', ';
				$values.=', ';
			}
			$sql.="`$key`";
			$values.=":$key";
		}
		$sql.=") values($values)";

		return $this->insert($sql, $data);
	}
*/

$sql =  "SELECT asset_no,asset_name,asset_category FROM assets ORDER BY id DESC LIMIT 1";
$data = $db->getRows($sql);

$data = $data[0];
//var_dump($data);
//echo "...." . $data['asset_no'];
/*
foreach($data as $var) {
	echo $var['Name'];
	echo $var['id'];
}
var_dump($data);
*/
?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link active" href="/smartbuilding/assets.php">資產管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/household.php">產權管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/sellrent.php">租售管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/brokerman.php">帶看管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/hoa_fee.php">管理費</a>
				</li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="../assets.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>資產盤點</span> <!--回上一頁'資產管理'-->
				</div>

				<form method="POST action="">
					<table class="table asset-table">
						<thead class="thead-light">
							<tr>
								<th>日期</th>
								<th>資產編號</th>
								<th>資產名稱</th>
								<th>資產類別</th>
								<th>使用狀態</th>
								<!-- <th>價格</th> -->
								<th>數量</th>
								<th>編輯</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = 'SELECT a.*, b.name AS status, c.category AS cat FROM assets a, asset_status b, asset_category c WHERE a.status_no = b.id AND c.id=a.asset_category';
								$data = $db->getRows($sql);
								foreach($data as $var) {
							?>
							<tr>
								<td><span><?php echo date("Y-m-d");?></span></td>
								<td><span><?=$var[asset_no]?></span></td>
								<td><span><?=$var[asset_name]?></span></td>
								<td><span><?=$var[cat]?></span></td>
								<td><span><?=$var[status]?></span></td>
								<!-- <td><span><?=number_format($var[price])?></span></td> -->
								<td><span><?=$var[amount]?></span></td>
								<td><input type="checkbox" checked></td>
							</tr>
							<?php
								}
							?>
						</tbody>
					</table>
					<input type="submit" value="確認">
				</form>

				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
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
<?php
include(Document_root.'/Footer.php');
?>