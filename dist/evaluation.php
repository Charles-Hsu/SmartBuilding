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
	$contract_id = $_GET['contract_id'];

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
					<a class="nav-link" href="<?= $urlName ?>/management.php">管理辦法</a>
				</li>
				<?php
					}
				?>
                <li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/evaluation.php">品質管理</a>
                </li>
			</ul>

			<div class="row justify-content-center">
				<div class="col-lg-10">
					<form class="evaluation-form" action="" method="POST">

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
var evaluationTitle=[
	'1.公寓大廈一般事務管理服務類',
	'2.建築物及基地之維護修繕',
	'3.建築物附屬設備之檢查及修護',
	'4.公寓大廈環境衛生類',
	'5.公寓大廈安全防災管理維護類',
	'6.財務管理類',
	'7.生活服務與商業支援類',
]
var evaluationText=[
	[
		{sub_title:'1-1區分所有權人會議作業流程',radio_name:'1_1'},
		{sub_title:'1-2管理委員會會議作業流程',radio_name:'1_2'},
		{sub_title:'1-3管理服務人委任管理流程',radio_name:'1_3'},
		{sub_title:'1-4管理服務人員訓練流程',radio_name:'1_4'},
		{sub_title:'1-5公寓大廈管理組織申請報備流程',radio_name:'1_5'},
		{sub_title:'1-6室內裝修管理',radio_name:'1_6'},
		{sub_title:'1-7公文管理流程',radio_name:'1_7'},
		{sub_title:'1-8共用鑰匙管理流程',radio_name:'1_8'},
		{sub_title:'1-9掛號信件處理流程',radio_name:'1_9'},
		{sub_title:'1-10住戶管理費催繳作業流程',radio_name:'1_10'},
		{sub_title:'1-11住戶滿意度作業流程',radio_name:'1_11'},
		{sub_title:'1-12住戶搬入遷出作業流程',radio_name:'1_12'},
		{sub_title:'1-13住戶反映事項作業流程',radio_name:'1_13'},
		{sub_title:'1-14社區財產作業流程',radio_name:'1_14'},
	],
	[
		{sub_title:'2-1住戶違規處理作業流程',radio_name:'2_1'},
		{sub_title:'2-2建築物及基地管理維護修繕作業流程',radio_name:'2_2'},
	],
	[
		{sub_title:'3-1公寓大廈停車場管理作業流程',radio_name:'3_1'},
		{sub_title:'3-2共用設施保養維護作業流程',radio_name:'3_2'},
	],
	[
		{sub_title:'4-1公寓大廈環境清潔作業流程',radio_name:'4_1'},
		{sub_title:'4-2公寓大廈環境綠化美化作業流程',radio_name:'4_2'},
		{sub_title:'4-3公寓大廈資源回收作業流程',radio_name:'4_3'},
		{sub_title:'4-4公寓大廈病媒防治作業流程',radio_name:'4_4'},
	],
	[
		{sub_title:'5-1公寓大廈安全管理作業流程',radio_name:'5_1'},
		{sub_title:'5-2公寓大廈安全防災作業流程',radio_name:'5_2'},
		{sub_title:'5-3公寓大廈安全維護作業流程',radio_name:'5_3'},
		{sub_title:'5-4公寓大廈緊急事做處理作業流程',radio_name:'5_4'},
	],
	[
		{sub_title:'6-1財務計畫作業流程',radio_name:'6_1'},
		{sub_title:'6-2零用金支出請款流程',radio_name:'6_2'},
		{sub_title:'6-3管理費繳交流程',radio_name:'6_3'},
		{sub_title:'6-4請款支出流程',radio_name:'6_4'},
		{sub_title:'6-5裝潢保證金作業流程',radio_name:'6_5'},
		{sub_title:'6-6遙控器、感應卡作業流程',radio_name:'6_6'},
		{sub_title:'6-7管理費作業流程',radio_name:'6_7'},
		{sub_title:'6-8公共基金管理作業流程',radio_name:'6_8'},
	],
	[
		{sub_title:'7-1社區社團作業流程',radio_name:'7_1'},
		{sub_title:'7-2社區櫃台作業流程:訪客接待',radio_name:'7_2'},
		{sub_title:'7-3社區櫃台作業流程:衣物送洗',radio_name:'7_3'},
		{sub_title:'7-4社區櫃台作業流程:代叫計程車',radio_name:'7_4'},
		{sub_title:'7-5社區櫃台作業流程:代辦事項',radio_name:'7_5'},
	]
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
		<div class="point w-25">1</div>
		<div class="rules w-25">
			<div>1分:重大疏漏</div>
			<div>2分:部分疏失</div>
			<div>3分:完全符合</div>
		</div>
		<div class="check w-25">
			<div class="form-check form-check-inline">
				<input class="form-check-input point-check" type="radio" name="{{radio_name}}" id="{{radio_name}}-1" value="1">
				<label class="form-check-label" for="{{radio_name}}-1">
					1分
				</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input point-check" type="radio" name="{{radio_name}}" id="{{radio_name}}-2" value="2">
				<label class="form-check-label" for="{{radio_name}}-2">
					2分
				</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input point-check" type="radio" name="{{radio_name}}" id="{{radio_name}}-3" value="3">
				<label class="form-check-label" for="{{radio_name}}-3">
					3分
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
			evaluation_total:total_point
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