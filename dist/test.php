
<?php

var_dump($_POST);

?>

<form id="post-create-form" action="" method="POST">
							<div class="form-group row">
								<label for="post-date" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>公告日期:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control datepicker" name="post-date" id="post-date" placeholder="公告日期..." >
								</div>
							</div>
                            <div class="form-group row">
								<label for="assets-no" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>公告內容:</label>
								<div class="col-md-9">
									<!-- <input type="text" class="form-control" name="assets-no" id="assets-no" value="<?=$data['asset_no'];?>" placeholder="資產編號..."> -->
                                
                                    <!-- <textarea rows="3" cols="48" name="post-content" form="post-create-form">輸入公告內容...</textarea> -->
                               </div>
                                 
                                

							</div>
							<div class="form-group row">
								<div class="col-md-9 offset-md-3">
									<button class="btn assets-btn assets-add-btn">確認</button>
									<button class="btn assets-btn assets-cancel-btn">取消</button>
								</div>
							</div>
                        </form>


                         <textarea rows="3" cols="48" name="post-content" form="post-create-form">輸入公告內容...</textarea> 