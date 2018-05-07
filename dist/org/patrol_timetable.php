<?php session_start(); ?>
<?php
	include('../config.php');
	include('../Header.php');
	if (!$_SESSION['online']) {
		$url = "$urlName/login.php";
		header("Location: " . $url);
	}
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
  $_isAdmin = $_SESSION['admin'];
  $staff_id = 0;
  $data = 0;

  if (count($_GET) > 0) {
      // var_dump($_GET);
      $staff_id = $_GET['id'];
      $sql = "SELECT a.id,a.name,b.dt0,b.dt1 FROM staff a, shift_table_record b WHERE a.id=b.staff_id AND a.id='$staff_id'";
      $data = $db->getRows($sql);
      // var_dump($data);

      $json_data = json_encode ($data);
      // echo $json_data;
  }

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">

<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org.php">人員</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/org/patrol.php">勤務管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
                </li>

                <!-- <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/transfer.php">移交紀錄</a>
                </li> -->
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/chart.php">管理委員會</a>
                </li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
  <section class="section">
    <div class="container" id="timetable">
      <div class="columns">
        <div class="column">
          姓名
        </div>
        <div class="column">
          員工編號
        </div>
      </div>
      <div class="columns">
        <div class="column">
          <?php
            echo $data[0]['name'];
            ?>
        </div>
        <div class="column">
          <?php
            echo $staff_id;
          ?>
        </div>
      </div>
      <div class="columns">
        <div class="column">
          日期
        </div>
        <div class="column">
          上班時間
        </div>
        <div class="column">
          下班時間
        </div>
      </div>
    </div>
  </section>
</div>

<script>

$(function() {
  var json_data = <?php echo $json_data; ?>;
  console.log(json_data);
  var html = `<div class="columns">`;
  html +=    `  <div class="column">`;
  html +=    `    日期`;
  html +=    `  </div>`;
  html +=    `  <div class="column">`;
  html +=    `    上班時間`;
  html +=    `  </div>`;
  html +=    `  <div class="column">`;
  html +=    `    下班時間`;
  html +=    `  </div>`;
  html +=    `</div>`;
  console.log(html);
  $('#timetable').append(html);
});



</script>
<?php include('../Footer.php'); ?>