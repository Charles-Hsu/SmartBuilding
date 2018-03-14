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
					<a class="nav-link active" href="/smartbuilding/assets.php">資產管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/household.php">住戶管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/publicfacilities.php">公共設施預約</a>
				</li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="/smartbuilding/assets.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>編輯資產</span>
				</div>
				<div class="row justify-content-center">
					<div class="col-lg-8 col-md-10 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
							<span class="edit-title mb-3">資產資料</span>
							<div class="form-group row">
								<label for="community" class="text-right col-md-3 col-form-label">所屬社區:</label>
								<div class="col-md-9 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-no" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>資產編號:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-no" id="assets-no" placeholder="資產編號...">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-name" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>資產名稱:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-name" id="assets-name" placeholder="資產名稱...">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-sort" class="text-right col-md-3 col-form-label">分類:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-sort" id="assets-sort" placeholder="分類...">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-price" class="text-right col-md-3 col-form-label">價格:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-price" id="assets-price" placeholder="價格..." value="0">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-amount" class="text-right col-md-3 col-form-label">數量:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-amount" id="assets-amount" placeholder="數量..." value="0">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-man" class="text-right col-md-3 col-form-label">購置人:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-man" id="assets-man" placeholder="購置人...">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-buy-date" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>購置日期:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control datepicker" name="assets-buy-date" id="assets-buy-date" placeholder="購置日期..." >
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-use-state" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>使用狀態:
								</label>
								<div class="col-md-9">
									<select class="custom-select" name="assets-use-status">
										<option selected>選取狀態</option>
										<option value="One">One</option>
										<option value="Two">Two</option>
										<option value="Three">Three</option>
									</select>
								</div>
							</div>
							<span class="edit-title mb-3">資產移交</span>
							<div class="form-group row">
								<label for="assets-watch" class="text-right col-md-3 col-form-label">監交人:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-watch" id="assets-watch" placeholder="監交人...">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-watch" class="text-right col-md-3 col-form-label">移交人:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-watch" id="assets-watch" placeholder="移交人...">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-use-state" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>使用狀態:
								</label>
								<div class="col-md-9">
									<select class="custom-select" name="assets-use-status">
										<option selected>選取狀態</option>
										<option value="One">One</option>
										<option value="Two">Two</option>
										<option value="Three">Three</option>
									</select>
								</div>
							</div>
							<span class="edit-title mb-3">資產報廢</span>
							<div class="form-group row">
								<label for="assets-scrap-date" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>報廢日期:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control datepicker" name="assets-scrap-date" id="assets-scrap-date" placeholder="報廢日期..." >
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-9 offset-md-3">
									<button class="btn btn-primary">儲存更新</button>
									<button class="btn btn-outline-secondary">取消更新</button>
									<button class="btn btn-outline-danger">刪除該資產</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<?php 
include(Document_root.'/Footer.php');
?>