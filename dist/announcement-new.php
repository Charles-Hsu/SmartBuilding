<?php 
include('./config.php');
include('./Header.php'); 
?>
<?php 

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

if (count($_POST) > 0) {

    $date = $_POST['post-date'];
    $content = $_POST['post-content'];
    $post_by = '管委會';

    $sql = "INSERT INTO post (`id`, `date`, `post_by`, `content`) VALUES (NULL, '$date', '$post_by', '$content')";
    echo $sql;

    // if ($n = $db->insert($sql)) {
    if ($db->insert($sql)) {
        // echo "hello";
        // echo $n;
        $message="新增成功";
    }
}

// $data = $db->getRows($sql);
// var_dump($data);

session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);

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
    <a class="" href="./kpi.php">數據管理</a>
    <a class="" href="./space-management.php">空間變更</a>
    <a class="active" href="./announcement.php">公告</a>
    <a class="" href="./management.php">管理辦法</a>
    <a class="" href="./overduelist.php">欠繳清單</a>
    <a class="" href="./opinionlist.php">住戶意見</a>
</nav>


			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="./announcement.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增公告</span> <!--回上一頁'資產管理'-->
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">


						<form class="post-create-form" id="post-create-form" action="" method="POST">
                        <!-- <form action="" method="POST"> -->
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
                                <!--  -->
                                    <textarea rows="3" cols="48" name="post-content" form="post-create-form" placeholder="輸入公告內容..."></textarea>
                                </div>
                                
                                

							</div>
							<div class="form-group row">
								<div class="col-md-9 offset-md-3">
									<button class="btn assets-btn assets-add-btn">確認</button>
									<button class="btn assets-btn assets-cancel-btn">取消</button>
								</div>
							</div>
                        </form>
                        
                        <!-- <textarea rows="3" cols="48" name="post-content" form="post-create-form">輸入公告內容...</textarea> -->





<script>

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!

var yyyy = today.getFullYear();
if(dd < 10){
    dd = '0' + dd;
} 
if(mm < 10){
    mm = '0' + mm;
} 
var today = yyyy + '-' + mm + '-' + dd;

$(document).ready(function() {
    $('#post-date').attr("value", today);
});



</script>
<?php 
include(Document_root.'/Footer.php');
?>