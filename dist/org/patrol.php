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

  if (count($_POST) > 0) {
      //var_dump($_POST);
  }

  $sql = 'SELECT a.staff_id,a.dt,b.name FROM `staff_work_time` a, staff b WHERE b.id = a.staff_id';
  $data = $db->getRows($sql);

?>
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
    <div class="col-12">
        <div class="table-responsive-lg table-responsive-xl row">
            <table class="punch-table table table-bordered" id="time-table">
                <thead>
                    <tr>
                        <th class="text-center" width="60">姓名</th>
                        <th colspan=31 class="text-center">日期</th>
                        <th class="text-center" width="60">時數</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <div class="col-6 offset-md-3 text-center">
                <div class="btn-group">
                    <button id="onwork" class="btn btn-primary" type="submit">上班</button>
                    <button id="offwork" class="btn btn-outline-primary"disabled type="submit">下班</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <a id="load-ajax-data" class="button">
  Button
</a> -->

<script>

function getDaysInMonth(year, month){
  month = parseInt(month, 10) + 1;
  var d = new Date(year, month, 0);
  return d.getDate();
}

// $("#load-ajax-data").on('click',function(){

$(function() {

  function staff (staffMap, row) {
    let id = row && row.staff_id, staff;
    staffMap[id] = staff = staffMap[id]||{};
    staff[row.dt] = row;
  }
  function getRows(resp) {
    try{
      let str = resp['data'], rows = JSON.parse(str);
      return rows;
    }catch(e){
    }
  }
  function countProperties(obj) {
    var count = 0;
    for(var prop in obj) {
        if(obj.hasOwnProperty(prop))
            ++count;
    }
    return count;
  }
  function getProperties(obj, i) {
    var count = 0;
    for(var prop in obj) {
      if(obj.hasOwnProperty(prop)) {
        if(i==count) {
          console.log(prop[i]);
          return prop;
        }
        ++count;
      }
    }
  }
  function isSet(candidate) {
    return candidate instanceof Set;
  }
  function isMap(candidate) {
    return candidate instanceof Map;
  }
  function buildMap(obj) {
    let map = new Map();
    console.log(typeof map);
    Object.keys(obj).forEach(key => {
        map.set(key, obj[key]);
    });
    return map;
  }

  $.ajax({
        url:'../data/patrolData.php',
        method: 'GET',
        dataType:'JSON',
        success:function(obj) {
          // let rows = getRows(obj);
          let rows = obj['data'];

          var _date  = new Date();
          var _year  = _date.getFullYear();
          var _month = _date.getMonth();
          var _daysInMonth = getDaysInMonth(_year, _month);

          let staffTable = {};
          // create vdom
          rows.forEach(row => {
            let totalHours = 0;
            var shift_table = row['shift_table'];
            let month = {}; // define month as a object
            for (let i = 0; i < _daysInMonth; i++) {
              month[i] = {"class":["checktime"], "id":i};
            }
            for (var i=0; i<shift_table.length; i++) {
              var d0 = parseInt(shift_table[i]['dt'].split('-')[2]);
              var d1 = month[d0-1];
              if(shift_table[i]['shift']=='1') {
                d1["class"].push("checktime_day_shift");
              } else {
                d1["class"].push("checktime_night_shift");
              }
              totalHours += parseInt(shift_table[i]['hours']);
            }
            staffTable[row.staff_id] = {id:row.staff_id, name:row.name, month:month, total:totalHours};
          });

          let innerHtml = "";

          function logMapElements(value, key, map) {
            console.log(`m[${key}] = ${value}`);
          }

          for (var key in staffTable) {
            // console.log(key, staffTable[key]);
            var row = staffTable[key];
            innerHtml += `<tr>`;
            innerHtml += `  <td><a href="patrol_timetable.php?id=` + row.id + `">` + row["name"] + `</a></td>`;
            innerHtml += `  <td id = "checktime-td" class = "checktime-td" colspan="31">`;
            innerHtml += `    <div class="checktime-box d-flex justify-content-around">`;

            month = row["month"];
            console.log(month);

            for (var key in month) {
              if (month.hasOwnProperty(key)) {
                let day = parseInt(key);
                let value = month[key];
                let hasClass = value["class"];
                day++;
                innerHtml += `      <div class="`;
                hasClass.forEach(function(element) {
                  innerHtml += (element + ' ');
                });
                innerHtml += `">` + day + `</div>`;
                console.log(key, month[key]);
              }
            }

            innerHtml += `    </div>`;
            innerHtml += `  </td>`;
            innerHtml += `  <td>` + row["total"] + `</td>`;
            innerHtml += `</tr>`;
          }

          $('#time-table').find('tbody').append(innerHtml);

        },
        error:function(err){
          console.error(err);
        }
    })

});


$(function() {

  var month_olympic = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    var month_normal = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    var my_date  = new Date();
    var my_year  = my_date.getFullYear();
    var my_month = my_date.getMonth();
    var my_day   = my_date.getDate();

  function genMemberRow(data){

    console.log("my_day", my_day);
    console.log("my_month", my_month);

    var daysMonth;
    var str = '';
    if (my_year % 4){
        daysMonth = month_olympic[my_month];
    } else {
        daysMonth = month_normal[my_month];
    }

  }

  // genMemberRow({});

    // 初始化區
    // $.ajax({
    //     url:'../data/patrolData.php',
    //     method: 'GET',
    //     dataType:'JSON',
    //     success:function(data){
    //         console.log(data)
    //     }
    // })

    $('#onwork').on('click',function(){
        var new_date = new Date();
        var new_hour = new_date.getHours();
        var new_Min  = new_date.getMinutes()
        var new_Sec  = new_date.getSeconds();
        var time = `${new_hour}:${new_Min}:${new_Sec}`;
        $.ajax({
            url: '../data/patrolData.php',
            method:'POST',
            data: {
                year:  my_year,
                month: my_month,
                day:   my_day,
                time:  time,
                type:  'onwork'
            },
            success: function(data) {
              console.log ("[", data, "]");
                try {
                    var _data = JSON.parse(data);
                    var rows = _data && _data.data && JSON.parse(_data.data);
                    genMemberRow(rows);
                    if (_data.success) {
                        $('.checktime').eq(my_day-1).addClass('onwork');
                        $('#onwork').removeClass('btn-primary').addClass("btn-outline-primary").prop('disabled',true)
                        $('#offwork').addClass('btn-primary').removeClass("btn-outline-primary").prop('disabled',false)
                    }
                } catch (error) {
                  console.log("catch error");
                  console.log("---", data, "---");
                }
            }
        })
    })
    $('#offwork').on('click',function(){
        var new_date=new Date();
        var new_hour=new_date.getHours();
        var new_Min=new_date.getMinutes()
        var new_Sec=new_date.getSeconds();
        var time=`${new_hour}:${new_Min}:${new_Sec}`;
        $.ajax({
            url:'../data/patrolData.php',
            method:'POST',
            data:{
                year:my_year,
                month:my_month,
                day:my_day,
                time:time,
                type:'offwork'
            },
            success:function(data) {
                try{
                    var _data = JSON.parse(data);
                    if (_data.success) {
                        $('.checktime').eq(my_day-1).addClass('offwork');
                        $('#offwork').addClass('btn-primary').removeClass("btn-outline-primary").prop('disabled',true)
                    }
                } catch(error) {
                    console.log(data)
                }
            }
        })
    })
})

</script>
<?php include('../Footer.php'); ?>