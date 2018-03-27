<?php 
include('./config.php');
include('./Header.php'); 
?>
<?php 
//$sql = 'SELECT a.*, b.name FROM assets a, asset_status b WHERE a.status_no = b.id AND asset_no = "' . $asset_no . '"';
$sql = 'SELECT a.*, b.name AS status FROM assets a, asset_status b WHERE a.status_no = b.id';
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
    <a class="active" href="./announcement.php">公告</a>
    <a class="" href="./management.php">管理辦法</a>
    <a class="" href="./overduelist.php">欠繳清單</a>
    <a class="" href="./opinionlist.php">住戶意見處理</a>
</nav>
<div class="row">
<!--
    <div class="col-12 pt-4 pl-4">
        <div class="assets-create-title">
            <a href="<?= $urlName ?>/index.php" class="assets-create-icon fas fa-chevron-left"></a>
            <span>回首頁</span>
        </div>
    </div>
-->    
    <!--
	<div class="col-lg-8 col-md-12 col-12 p-4">
        <div class="announcement-list d-flex">
            <span class="announcement-title">纖維比地瓜多2倍、營養勝酪梨！這水果潤腸解便超有效</span>
            <span class="announcement-time">2018年03月23日</span>
        </div>
        <div class="announcement-list d-flex">
            <span class="announcement-title">「鯉魚」颱風最快下周生成 吳德榮：1至3月皆有颱風史上只有2次，「鯉魚」颱風最快下周生成 吳德榮：1至3月皆有颱風史上只有2，</span>
            <span class="announcement-time">2018年03月22日</span>
        </div>
        <div class="announcement-list d-flex">
            <span class="announcement-title">something that someone says officially, giving information about something</span>
            <span class="announcement-time">2018年03月19日</span>
        </div>
        <div class="announcement-list d-flex">
            <span class="announcement-title">something that someone says officially, giving information about something</span>
            <span class="announcement-time">2018年03月19日</span>
        </div>
        <div class="announcement-list d-flex">
            <span class="announcement-title">something that someone says officially, giving information about something</span>
            <span class="announcement-time">2018年03月19日</span>
        </div>
        <div class="announcement-list d-flex">
            <span class="announcement-title">something that someone says officially, giving information about something</span>
            <span class="announcement-time">2018年03月19日</span>
        </div>
        <div class="announcement-list d-flex">
            <span class="announcement-title">something that someone says officially, giving information about something</span>
            <span class="announcement-time">2018年03月19日</span>
        </div>
        <div class="announcement-list d-flex">
            <span class="announcement-title">something that someone says officially, giving information about something</span>
            <span class="announcement-time">2018年03月19日</span>
        </div>
    </div>
    -->
    <div class="col-lg-8 col-md-12 col-12 p-4">
    <table class="table asset-table">
					<thead class="thead-light">
						<tr>
                            <th>公告日期</th>
							<th>類別</th>
							<th>內容</th>
						</tr>
					</thead>
					<tbody>
<?php
	//foreach($data as $var) {
//		echo $var[asset_no];
//		echo $var[asset_name];
//		echo $var[status];
//		echo $var[price];
//		echo '<br>';
?>
						<tr>
							<td><span>2018/3/19</span></td>
							<td><span>管委會</span></td>
							<td><span><a href="#">敦聘吳謹斌為法律顧問</a></span></td>
						</tr>
						<tr>
							<td><span>2018/3/21</span></td>
							<td><span>電力公司</span></td>
							<td><span><a href='#'>預計2018/3/22 24:00~2018/3/23 3:00停電</a></span></td>
						</tr>
<?php
	//}
?>
					</tbody>
				</table>
        </div>
</div>

<?php include('./Footer.php'); ?>