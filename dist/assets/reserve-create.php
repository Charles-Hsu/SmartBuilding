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
					<a class="nav-link" href="/smartbuilding/assets/household.php">住戶管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="/smartbuilding/assets/reserve.php">公共設施預約</a>
				</li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="/smartbuilding/assets/reserve.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增公設預約</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
							<div class="form-group row">
								<label for="community" class="text-right col-md-3 col-form-label">所屬社區:</label>
								<div class="col-md-9 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div>
							<div class="form-group row">
								<label for="want-reserve" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>欲預約之公共設施:</label>
								<div class="col-md-9">
									<select name="want-reserve" id="want-reserve">
										<option value="ONE">ONE</option>
										<option value="TWO">TWO</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="reserve-date" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>預約日期:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control datepicker" name="reserve-date" id="reserve-date" placeholder="購置日期..." >
								</div>
							</div>
							<div class="form-group row">
								<label for="reserve-start-time" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>起始時間:
								</label>
								<div class="col-md-9">
									<input id="reserve-start-time" class="form-control" type="time" name="reserve-start-time">
								</div>
							</div>
							<div class="form-group row">
								<label for="reserve-end-time" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>結束時間:
								</label>
								<div class="col-md-9">
									<input id="reserve-end-time" class="form-control" type="time" name="reserve-end-time">
								</div>
							</div>
							<div class="form-group row">
								<label for="reserve-amount" class="text-right col-md-3 col-form-label">金額:</label>
								<div class="col-md-9">
									<input type="number" class="form-control" name="reserve-amount" id="reserve-amount" placeholder="金額..." value="0">
								</div>
							</div>
							<div class="form-group row">
								<label for="reserve-person" class="text-right col-md-3 col-form-label"><span class="important">*</span>登記人:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="reserve-person" id="reserve-person" placeholder="登記人...">
								</div>
							</div>
							<div class="form-group row">
								<label for="reserve-note" class="text-right col-md-3 col-form-label">備註:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="reserve-note" id="reserve-note" placeholder="備註...">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-9 offset-md-3">
									<button class="btn assets-btn assets-add-btn">新增</button>
									<button class="btn assets-btn assets-cancel-btn">取消</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
include(Document_root.'/Footer.php');
?>