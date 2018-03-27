<?php 
include('./config.php');
include('./Header.php'); 
?>
<?php 
//$sql = 'SELECT a.*, b.name FROM assets a, asset_status b WHERE a.status_no = b.id AND asset_no = "' . $asset_no . '"';
$sql = 'SELECT a.id AS id,building,addr_no,floor,unpaid_total,b.name AS status,holder,resident,sellrent FROM household a, household_status b WHERE a.status = b.id AND a.unpaid_total != 0';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//var_dump($data);

if (strlen($_SESSION['account']) == 0) {
	echo 
	'<script>
		//document.onkeypress=function(e) {
			//alert("You pressed a key inside the input field");
			//document.getElementById("demo").innerHTML = 5 + 6;
			//window.location.href = "http://stackoverflow.com";



			//window.location.href = "./login.php";


		//}
	</script>';
}

?>
<!-- 內容切換區 -->
<nav class="index-nav my-3">
    <a class="" href="./index.php">KPI</a>
    <a class="" href="./space-management.php">空間變更申請</a>
    <a class="" href="./announcement.php">公告</a>
    <a class="" href="./management.php">管理辦法</a>
    <a class="" href="./overduelist.php">欠繳清單</a>
    <a class="active" href="./opinionlist.php">住戶意見處理</a>
</nav>

<p>呈現總幹事的效率</p>
<p>本月已處理件數:<span>32</span></p>
<p>本月待處理件數:<span>1</span></p>
<p>平均處理天數:<span>3.5</span></p>

			<div id="assets-tab">
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>反應日期</th>
							<th>標題</th>
							<th>內容</th>
							<th>案件狀態</th>
                            <th>結案日</th>
                            <th>處理天數</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><span>2018-03-02</span></td>
							<td><span>測試</span></td>
							<td><span>測試</span></td>
							<td><b class="btn btn-success">已結案</b></td>
                            <td><span>2018-03-02</span></td>
                            <td><span>1</span></td>
						</tr>
						<tr>
							<td><span>2018-03-02</span></td>
							<td><span>測試</span></td>
							<td><span>測試</span></td>
							<td><b class="btn btn-unsucess">未結案</b></td>
                            <td><span></span></td>
                            <td><span></span></td>
						</tr>
					</tbody>
				</table>
			</div>
