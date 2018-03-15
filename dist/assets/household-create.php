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
					<a class="nav-link" href="/smartbuilding/assets/reserve.php">公共設施預約</a>
				</li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="/smartbuilding/assets/household.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增住戶</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
							<div class="form-group row">
								<label for="community" class="text-right col-lg-6 col-md-3 col-form-label">所屬社區:</label>
								<div class="col-lg-6 col-md-9 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-area" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>所屬大樓:</label>
								<div class="col-lg-6 col-md-9">
									<select name="household-area" id="household-area" class="form-control">
										<option value="" selected>選擇大樓</option>
										<option value="AA">忠孝樓</option>
										<option value="BB">仁愛樓</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-use" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>房子用途:</label>
								<div class="col-lg-6 col-md-9">
									<select name="household-use" id="household-use" class="form-control">
										<option value="" selected>選擇用途</option>
										<option value="AA">出租</option>
										<option value="BB">自住</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-status" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>房子狀態:</label>
								<div class="col-lg-6 col-md-9">
									<select name="household-status" id="household-status" class="form-control">
										<option value="" selected>選擇用途</option>
										<option value="AA">出租</option>
										<option value="BB">自住</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-num" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>戶號:
								</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-num" id="household-num" placeholder="戶號..." value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-floor" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>樓層:
								</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-floor" id="household-floor" placeholder="樓層..." value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-own" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>區權人:
								</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-own" id="household-own" placeholder="區權人..." value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-name" class="text-right col-lg-4 offset-lg-2 col-md-3 col-form-label">
									<span class="important">*</span>住戶姓名:
								</label>
								<div class="col-lg-4 col-md-6">
									<input type="text" class="form-control" name="household-name" id="household-name" placeholder="住戶姓名..." value="">
								</div>
								<div class="col-lg-2 col-md-3 pl-0 ">
									<button class="btn btn-primary btn-same">同區權人</button>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-props" class="text-right col-lg-6 col-md-3 col-form-label">區權比例:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-props" id="household-props" placeholder="區權比例..." value="0">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-sqft" class="text-right col-lg-6 col-md-3 col-form-label">坪數:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-sqft" id="household-sqft" placeholder="坪數..." value="0">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-style" class="text-right col-lg-6 col-md-3 col-form-label">房型:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-style" id="household-style" placeholder="房型..." value="0">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-guard-amount" class="text-right col-lg-6 col-md-3 col-form-label">應收管理費金額:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-guard-amount" id="household-guard-amount" placeholder="應收管理費金額..." value="0">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-park-amount" class="text-right col-lg-6 col-md-3 col-form-label">應收停車費金額:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-park-amount" id="household-park-amount" placeholder="應收停車費金額..." value="0">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-buy-date" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>購置日期:
								</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control datepicker" name="assets-buy-date" id="assets-buy-date" placeholder="購置日期..." >
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-use-state" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>使用狀態:
								</label>
								<div class="col-lg-6 col-md-9">
									<select class="custom-select">
										<option selected>選取狀態</option>
										<option value="One">One</option>
										<option value="Two">Two</option>
										<option value="Three">Three</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-6 offset-md-3 col-md-9 offset-md-3">
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
<script>
$('.btn-same').on('click',function(e){
	var _val=$('#household-own').val()
	$('#household-name').val(_val)
	e.preventDefault()
})
</script>
<?php 
include(Document_root.'/Footer.php');
?>