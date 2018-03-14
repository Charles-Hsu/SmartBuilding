<?php 
include('../config.php');
include(Document_root.'/Header.php'); 
?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets.php">資產管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="/smartbuilding/assets/household.php">住戶管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/publicfacilities.php">公共設施預約</a>
				</li>
			</ul>
			<div id="assets-tab">
				<a href="/smartbuilding/assets/household-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增用戶
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>所屬大樓</th>
							<th>戶號 樓層</th>
							<th>住戶狀態</th>
							<th>區權人</th>
							<th>現任住戶</th>
							<th>編輯住戶</th>
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
							<td><span><?=$var[asset_no]?></span></td>
							<td><span><?=$var[asset_name]?></span></td>
							<td><span><?=$var[status]?></span></td>
							<td><span><?=$var[price]?></span></td>
							<td><a href="/smartbuilding/assets/edit-page.php" class="btn btn-outline-secondary">編輯</a></td>
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
<?php 
include(Document_root.'/Footer.php');
?>