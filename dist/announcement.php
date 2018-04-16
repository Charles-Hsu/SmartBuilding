<?php session_start(); ?>
<?php 
include('./config.php');
include('./Header.php'); 
$_isAdmin = $_SESSION['admin'];
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

?>
<!-- 內容切換區 -->
<nav class="index-nav my-3">
<?php
if ($_isAdmin) {
?>
    <a class="" href="./kpi.php">績效指標</a>
    <a class="" href="./space-management.php">空間變更</a>
    <a class="" href="./management.php">管理辦法</a>
<?php
}
?>    
    <a class="active" href="./announcement.php">公告</a>
    <a class="" href="./opinionlist.php">住戶意見</a>
    <a class="" href="./overduelist.php">欠繳清單</a>
    <a class="" href="./resolutions.php">決議事項</a>
</nav>

<?php 

$sql = 'SELECT * FROM post';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
$data = $db->getRows($sql);

?>
<div id="assets-tab">
	<?php
		if ($_isAdmin) {
	?>
	<a href="<?= $urlName ?>/announcement-new.php" class="btn add-asset-btn mb-3">
		<span>+</span>新增公告
	</a>
	<?php
		}
	?>
    <table class="table asset-table">
        <thead class="thead-light">
            <tr>
                <th>公告日期</th>
                <th>公告內容</th>
				<?php
					if ($_isAdmin) {
				?>
				<th>修改</th>
				<th>刪除</th>
				<?php
					}
				?>
            </tr>
        </thead>
        <tbody class="opinionlist_tbody">
			<?php
				foreach($data as $var) {
			?>					
			<tr>
				<td><span><?=$var['date'];?></span></td>
				<td><span><?=$var['content'];?></span></td>
				<?php
					if ($_isAdmin) {
				?>
				<td><div><a href="#">編輯</a></div></td>
				<td><div><a href="#">刪除</a></div></td>				
				<?php
					}
				?>
			</tr>
			<?php
				}
			?>
		</tbody>
	</table>




<script>

$('.asset-table').DataTable({
	"language": {
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋...",
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
	"processing": true,
    "order": [[0, 'desc']],
    //"order": [[0, 'asc']],
})

</script>
<?php include('../Footer.php'); ?>