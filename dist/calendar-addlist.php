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

if (strlen($_SESSION['account']) == 0) {
	header('Location: ' . '/smartbuilding/login.php');
}
$getDate=$_GET['year'].'-'.$_GET['month'].'-'.$_GET['day'];

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
								<label for="elevator-reply" class="text-right col-md-4 col-form-label">電梯:</label>
								<div class="col-md-8">
									<select id="elevator-reply" class="form-control" name="elevator-reply">
                                        <option value="" selected>選擇電梯項目</option>
                                        <option value="AA">AA</option>
                                        <option value="BB">BB</option>
                                    </select>
								</div>
                            </div>
                            
							<div class="form-group row">
								<label for="firesafety-reply" class="text-right col-md-4 col-form-label">消防:</label>
								<div class="col-md-8">
									<select id="firesafety-reply" class="form-control" name="firesafety-reply">
                                        <option value="" selected>選擇消防項目</option>
                                        <option value="AA">AA</option>
                                        <option value="BB">BB</option>
                                    </select>
								</div>
                            </div>
                            
                            <div class="form-group row">
								<label for="basestation-reply" class="text-right col-md-4 col-form-label">基地:</label>
								<div class="col-md-8">
									<select id="basestation-reply" class="form-control" name="basestation-reply">
                                        <option value="" selected>選擇基地項目</option>
                                        <option value="AA">AA</option>
                                        <option value="BB">BB</option>
                                    </select>
								</div>
                            </div>

                            <div class="form-group row">
								<label for="garden-reply" class="text-right col-md-4 col-form-label">花園:</label>
								<div class="col-md-8">
									<select id="garden-reply" class="form-control" name="garden-reply">
                                        <option value="" selected>選擇花園項目</option>
                                        <option value="AA">AA</option>
                                        <option value="BB">BB</option>
                                    </select>
								</div>
                            </div>

                            <div class="form-group row">
								<label for="gym-reply" class="text-right col-md-4 col-form-label">健身房:</label>
								<div class="col-md-8">
									<select id="gym-reply" class="form-control" name="gym-reply">
                                        <option value="" selected>選擇設備項目</option>
                                        <option value="AA">AA</option>
                                        <option value="BB">BB</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
								<label for="innerswim-reply" class="text-right col-md-4 col-form-label">游泳池:</label>
								<div class="col-md-8">
									<select id="innerswim-reply" class="form-control" name="innerswim-reply">
                                        <option value="" selected>選擇設備項目</option>
                                        <option value="AA">AA</option>
                                        <option value="BB">BB</option>
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
<?php 
include(Document_root.'/Footer.php');
?>