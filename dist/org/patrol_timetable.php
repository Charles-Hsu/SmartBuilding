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
<style>

 .grid-container { 
  grid-gap: 5px;
  background-color: #2196F3;
  padding: 10px;
  text-align: center;
  border: 5px solid black;
  }
.grid-container .columns {
  background-color: rgba(255, 255, 255, 0.8);
  text-align: center;
  padding:2px 0;
  font-size: 16px;
  border: 1px solid black;
}
.grid-container .columns {
  grid-column-end: span 4;
}


</style>
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
  <div class="assets-create-title mb-3 ">
    <a href="<?= $urlName ?>/org/patrol.php" class="assets-create-icon fas fa-chevron-left"></a>
    <span>打卡紀錄</span>
  </div>
  <section>
 <section class="section">
    <div class="grid-container" id="timetable">
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
        <!-- <div class="column">
          日期
        </div> -->
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

  function isNull(obj) {
    return !obj || obj === 'null' || obj === 'undefined';
  }

 

  json_data.forEach(row => {
    let totalHours = 0;
    var dt0 = row['dt0'];
    var dt1 = row['dt1'];
    var html = `<div class="columns">`;
    // html +=    `  <div class="column">`;
    // html +=    `    日期`;
    // html +=    `  </div>`;
    html +=    `  <div class="column">`;
    html +=    row['dt0'];
    html +=    `  </div>`;
    html +=    `  <div class="column">`;
    html +=    isNull(row['dt1'])?"":row['dt1'];
    html +=    `  </div>`;
    html +=    `</div>`;
    // let month = {}; // define month as a object
    // for (var i=0; i<shift_table.length; i++) {
    //   var d0 = parseInt(shift_table[i]['dt'].split('-')[2]);
    //   var d1 = month[d0-1];
    //   if(shift_table[i]['shift']=='1') {
    //     d1["class"].push("checktime_day_shift");
    //   } else {
    //     d1["class"].push("checktime_night_shift");
    //   }
    //   totalHours += parseInt(shift_table[i]['hours']);
    // }
    // staffTable[row.staff_id] = {id:row.staff_id, name:row.name, month:month, total:totalHours};
    $('#timetable').append(html);
  });

  // console.log(html);
});



</script>
</script>
<?php include('../Footer.php'); ?>