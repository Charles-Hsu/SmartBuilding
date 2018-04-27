<?php session_start(); ?>
<?php
	include('./config.php');
	include('./Header.php');
	if (!$_SESSION['online']) {
		$url = "$urlName/login.php";
		header("Location: " . $url);
	}
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
	$_isAdmin = $_SESSION['admin'];
	// $contract_id = $_GET['contract_id'];
	// echo COUNT($_POST);
	// if (COUNT($_POST)) {
	// 	var_dump($_POST);
	// }
?>
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/announcement.php">公告</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/opinionlist.php">住戶意見</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/overduelist.php">欠繳費用</a>
                </li>
				<?php
					if ($_isAdmin) {
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/kpi.php">績效指標</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/space-management.php">空間變更</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/regulation.php">管理辦法</a>
				</li>
        <li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/evaluation.php">品質管理</a>
        </li>
				<?php
					}
				?>
			</ul>

			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="/smartbuilding/evaluation.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>個人績效</span>
				</div>


			<div class="row justify-content-center">
				<div class="col-lg-10">
					<form class="evaluation-form" action="" method="POST">

						<div class="form-group row">
							<label for="builds-license" class="text-right col-md-2 col-form-label">
								<span class="important">*</span>考核日期:
							</label>
							<div class="col-md-8">
								<input type="text" class="form-control datepicker" name="eval-date" id="eval-date">
							</div>
						</div>

						<!-- 第幾屆 -->
						<div class="form-group row">
							<label for="builds-name" class="text-right col-md-2 col-form-label">
							<span class="important">*</span>管委屆別
							</label>
							<div class="col-md-8">
								<select id="eval-session" class="form-control" name="eval-session"> <!--disabled>-->
									<?php
										$sql = "SELECT * FROM session";
										$data = $db->getRows($sql);
										$session=1;// 預設第一屆
										foreach($data as $var) {
									?>
									<option value="<?=$var['id'];?>"><?=$var['name'];?></option>
									<?php
										}
								?>
								</select>
							</div>
						</div>
						<!-- 第幾屆end -->

						<!-- 考核人 -->
						<div class="form-group row">
							<label for="builds-name" class="text-right col-md-2 col-form-label">
							<span class="important">*</span>考核人
							</label>
							<div class="col-md-8">
								<select id="eval-examinor" class="form-control" name="eval-examinor"> <!--disabled>-->
									<?php
										$sql = "SELECT * FROM eval_examinor";
										$data = $db->getRows($sql);
										foreach($data as $var) {
									?>
									<option value="<?=$var['id'];?>"><?=$var['name'];?></option>
									<?php
										}
									?>
								</select>
							</div>
						</div>
						<!-- 考核人 -->


						<!-- 受測人 -->
						<div class="form-group row">
							<label for="builds-name" class="text-right col-md-2 col-form-label">
							<span class="important">*</span>受測人
							</label>
							<div class="col-md-8">
								<select id="target-id" class="form-control" name="target-id"> <!--disabled>-->
									<?php
										$sql = "SELECT * FROM staff WHERE id != 0";
										$data = $db->getRows($sql);
										foreach($data as $var) {
									?>
									<option value="<?=$var['id'];?>"><?=$var['name'];?></option>
									<?php
										}
									?>
								</select>
							</div>
						</div>
						<!-- 受冊人 -->


						<!-- 評量方式 -->
						<div class="form-group row">
							<label for="builds-name" class="text-right col-md-2 col-form-label">
							<span class="important">*</span>評量方式
							</label>
							<div class="col-md-8">
								<select id="eval-method" class="form-control" name="eval-method"> <!--disabled>-->
									<?php
										$sql = "SELECT * FROM eval_type";
										$data = $db->getRows($sql);
										foreach($data as $var) {
									?>
									<option value="<?=$var['id'];?>"><?=$var['name'];?></option>
									<?php
										}
									?>
								</select>
							</div>
						</div>
						<!-- 評量方式 -->



						<!-- 標題 -->
						<div class="evaluation-wrap w-100"></div>
						<!-- 標題end -->

						<div class="form-group row mt-3">
							<div class="col-12">
								<button class="btn btn-primary evaluation-btn mr-3">確認</button>
								<div class="total-points d-inline font-weight-bold">總分: <span>0</span></div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="progress point-percent">
			<div class="progress-bar bg-info" role="progressbar" style="width: 00%"></div>
		</div>
	</div>
</div>

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
    $('#eval-date').attr("value", today);
});


</script>

<script>
var evaluationTitle=[
	'8.品德',
	'9.工作能力',
	'10.工作表現',
	'11.工作成績',
]
var evaluationText=[
	[
		{sub_title:'8-1 忠於公司維護大樓利益',radio_name:'101'},
		{sub_title:'8-2 團結友愛、和睦相處且互助',radio_name:'102'},
		{sub_title:'8-3 待人坦誠、謙虛有禮且可靠',radio_name:'103'},
		{sub_title:'8-4 奉獻精神',radio_name:'104'},
	],
	[
		{sub_title:'9-1 責任感',radio_name:'105'},
		{sub_title:'9-2 理解能力',radio_name:'106'},
		{sub_title:'9-3 判斷能力',radio_name:'107'},
		{sub_title:'9-4 計畫性',radio_name:'108'},
		// {sub_title:'知識面',radio_name:'109'},
		// {sub_title:'公關能力',radio_name:'110'},
		{sub_title:'9-5 表達能力',radio_name:'109'},
		{sub_title:'9-6 處理問題',radio_name:'110'},
		{sub_title:'9-7 組織能力',radio_name:'111'},
		{sub_title:'9-8 協調溝通能力',radio_name:'112'},
	],
	[
		{sub_title:'10-1 服從性',radio_name:'113'},
		{sub_title:'10-2 原則性',radio_name:'114'},
		{sub_title:'10-3 積極性',radio_name:'115'},
		{sub_title:'10-4 團隊合作',radio_name:'116'},
		{sub_title:'10-5 規章制度',radio_name:'117'},
	],
	[
		{sub_title:'11-1 工作效率',radio_name:'118'},
		{sub_title:'11-2 工作品質',radio_name:'119'},
		{sub_title:'11-3 工作目標完成量',radio_name:'120'},
	],
]
var strTitles='';
var strs='';
var strAll='';
var strTitle=`
<div class="form-group evaluation-title row my-3">
	<h5 class="text-center col-12 font-weight-bold">{{item_title}}</h5>
</div>
`;

var str=`
<div class="evaluation-item d-flex flex-wrap">
	<div class="evaluation-item-group evaluation-item-title  d-flex w-100">
		<div class="title w-25">服務項目</div>
		<div class="point w-25">分數</div>
		<div class="rules w-25">配分原則</div>
		<div class="check w-25">考核</div>
	</div>
	<div class="evaluation-item-group d-flex w-100">
		<div class="title w-25">{{sub_title}}</div>
		<div class="point w-25">0</div>
		<div class="rules w-25">
			<div>5分:很好</div>
			<div>4分:較好</div>
			<div>3分:一般</div>
			<div>2分:較差</div>
		</div>
		<div class="check w-25">
			<div class="form-check form-check-inline">
				<input class="form-check-input point-check" type="radio" name="{{radio_name}}" id="{{radio_name}}-5" value="5">
				<label class="form-check-label" for="{{radio_name}}-5">
					5分
				</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input point-check" type="radio" name="{{radio_name}}" id="{{radio_name}}-4" value="4">
				<label class="form-check-label" for="{{radio_name}}-4">
					4分
				</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input point-check" type="radio" name="{{radio_name}}" id="{{radio_name}}-3" value="3">
				<label class="form-check-label" for="{{radio_name}}-3">
					3分
				</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input point-check" type="radio" name="{{radio_name}}" id="{{radio_name}}-2" value="2">
				<label class="form-check-label" for="{{radio_name}}-2">
					2分
				</label>
			</div>
		</div>
	</div>
</div>
`;

var total_points=[];
for(var i=0;i<evaluationTitle.length;i++){
	strTitles='';
	strs='';
	strAll='';
	strTitles+=strTitle.replace('{{item_title}}',evaluationTitle[i])
	for(var j=0;j<evaluationText[i].length;j++){
		strs+=str
		.replace('{{sub_title}}',evaluationText[i][j].sub_title)
		.replace(/{{radio_name}}/g,evaluationText[i][j].radio_name)
		total_points[evaluationText[i][j].radio_name]=[];
	}
	strAll+=strTitles+strs;
	$('.evaluation-wrap').append(strAll);
}
var total_point=0;
$('.evaluation-wrap').on('click','.point-check',function(){
	var _val=$(this).val();
	total_point=0;
	var check_totals=0;
	var check_total=$('.point-check').length / 3;
	var check_name;
	$(this).closest('.evaluation-item-group').find('.point').text(_val)
	$('.point-check').each(function(i,item){
		if($(this).prop('checked')){
			total_point+=parseInt($(this).val());
			check_totals+=1;
		}
	})
	$('.total-points > span').text(total_point)
	$('.point-percent .progress-bar').css('width',parseInt((check_totals / check_total)*100)+'%');
	$('.point-percent .progress-bar').text(parseInt((check_totals / check_total)*100)+'%');
})
var arrObj={};
$('.evaluation-btn').on('click',function(e){
	e.preventDefault();
	$('.point-check').each(function(i,item){
		if($(this).prop('checked')){
			check_name=$(this).attr('name')
			arrObj[check_name]=parseInt($(this).val());
			if(total_points[check_name]){
				total_points[check_name].push(parseInt($(this).val()))
			}
		}
	})
	// console.log(arrObj)
	var arrObjJson=JSON.stringify(arrObj);
	$.ajax({
		url:'./data/evaluationData.php',
		method:'POST',
		dataType:'json',
		data:{
			evaluation_points:JSON.stringify(arrObj),
			evaluation_total:total_point,
			eval_date:$('#eval-date').val(),
			eval_session:$('#eval-session').val(),
			eval_examinor:$('#eval-examinor').val(),
			eval_method:$('#eval-method').val(),
			target_id:$('#target-id').val(),
		},
		success:function(data){
			try{
				var _data=JSON.stringify(data);
				console.log(_data)
			}catch(error){
				alert(data)
			}
		},
		error:function(data){
			alert(data.responseText)
		}
	})
})

$('.asset-table').DataTable({
	"language": {
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋資產...",
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
	"processing": true
})
</script>
<?php include(Document_root.'/Footer.php'); ?>