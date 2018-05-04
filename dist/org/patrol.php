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
            <table class="punch-table table table-bordered ">
                <thead>
                    <tr>
                        <th class="text-center" width="60">姓名</th>
                        <th colspan=31 class="text-center">日期</th>
                        <th class="text-center" width="60">時數</th>
                    </tr>
                </thead>
                <tbody id="checktime-tbody">
                </tbody>
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

<a id="load-ajax-data" class="button">
  Button
</a>

<a class="button is-primary">
  Primary button
</a>

<a class="button is-large">
  Large button
</a>

<a class="button is-loading">
  Loading button
</a>
<script>


$("#load-ajax-data").html("AJAX testing");
$("#load-ajax-data").on('click',function(){
    // $(this).addClass("is-large");


  // var xhttp = new XMLHttpRequest();
  // xhttp.onreadystatechange = function() {
  //   if (this.readyState == 4 && this.status == 200) {
  //     document.getElementById("demo").innerHTML = this.responseText;
  //   }
  // };
  // // xhttp.open("GET", "../data/patrolData.php'", true);
  // xhttp.open("GET", "http://localhost/smartbuilding/org/patrolData.php'", true);
  // xhttp.send();
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




    // for (var i = 1; i <= daysMonth; i++){
    //   // if(i < my_day) {
    //     // str += `<div class=".checktime.oldtime">${i}</div>`;
    //   // } else {
    //     str += `<div class="checktime" id="${i}">${i}</div>`;
    //   // }
    // }
    // $('.checktime-box').html(str);


    // var i = 1;
    // // var id_no =
    // for (var i = 1; i < daysMonth; i++) {
    //   let d = new Date(my_year, my_month, i);
    //   if (d.getDay() == 0 || d.getDay() == 6) {
    //     // $("#" + i).css("background-color","gray");
    //   }
    //   else {
    //     $("#" + i).addClass('checktime_day_shift');
    //   }
    // }

    // <tr>
    //   <?php
    //     // $sql = "SELECT SUM(hours) FROM shift_table WHERE staff_id=" . $var['staff_id'];
    //     // $total = $db->getValue($sql);
    //   ?>
    //     <!-- 姓名 -->
    //     <td class="name">
    //       <!-- <?php echo $var['name']; ?> -->
    //     </td>
    //     <!-- 日期 -->
    //     <td id = "checktime-td" class = "checktime-td" colspan="31">
    //         <div class = "checktime-box d-flex justify-content-around"></div>
    //     </td>
    //     <!-- 時數 -->
    //     <td class="totaltime">
    //       <!-- <?php echo $total; ?> -->
    //     </td>
    // </tr>


  $.ajax({
        url:'../data/patrolData.php',
        method: 'GET',
        dataType:'JSON',
        success:function(obj) {
          // let rows = getRows(obj);
          let rows = obj['data'];


          var month_olympic = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
          var month_normal = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
          var my_date  = new Date();
          var my_year  = my_date.getFullYear();
          var my_month = my_date.getMonth();
          var my_day   = my_date.getDate();

          var daysMonth;
          var timeShiftTbodyStr = '';
          var checkTimeBoxTemplate = '';
          if (my_year % 4){
              daysMonth = month_olympic[my_month];
          } else {
              daysMonth = month_normal[my_month];
          }
          for (var i = 1; i <= daysMonth; i++){
            checkTimeBoxTemplate += `<div class="checktime" id="${i}">${i}</div>`;
          }
          // $('.checktime-box').html(str);
          let totalHours = 0;
          rows.forEach(row => {
            // console.log(row['name']);
            // console.log(row['staff_id']);
            $shift_table = row['shift_table'];
            let rowStr = "<tr>";
            rowStr += `<td class="name">${row['name']}</td>`;
            rowStr += `<td id = "checktime-td" class = "checktime-td" colspan="31">`;
            rowStr += `<div class = "checktime-box d-flex justify-content-around">`;
            // let i = 0;

            rowStr += checkTimeBoxTemplate;

            $shift_table.forEach(item => {
              // console.log(item['dt']);
              // console.log(item['dt'].split('-')[2]);
              // console.log(item['shift']);
              // console.log(item['hours']);
              // let dt = item['dt'].split('-')[2];
              // let shift = item['shift'];
              let hours = item['hours'];
              totalHours += hours;
              console.log('hours = ' + item['hours']);

              // rowStr += `<div class="checktime" id="${i}">${i}</div>`;
              // if (d.getDay() == 0 || d.getDay() == 6) {
                // $("#" + i).css("background-color","gray");
              // }
              // else {
              // $("#" + dt).addClass('checktime_day_shift');
              // }
              // i++;
            });
            rowStr += `</div>`;
            // rowStr += timeShiftTableStr;
            rowStr += "</td>";
            rowStr += `<td class="totaltime">${totalHours}</td>`;
            rowStr += "</tr>"

            console.log(rowStr);
            $('.checktime-tbody').html(rowStr);

          });


          // let staffMap = {};
          // rows.forEach (row => staff(staffMap, row));
          // console.log(staffMap);
          // let map = buildMap(staffMap);
          // console.log(isMap(map));
          // console.log(isSet(map));

          // if (isMap(map)) {
          //   map.forEach((value, key) => {
          //     console.log(key);
          //     console.log(value);
          //     let obj = value;
          //     Object.keys(obj).forEach((key,value) => {
          //       console.log(key);
          //       console.log(value['staff_id']);
          //       console.log(value['name']);
          //     });
          //   });
          // }


          // staffMap.map(element, index) => {
          //   console.log("current iteration is: " + index);
          //   console.log("current element is: " + element);
          // });

          // let n = countProperties(staffMap)
          // console.log(n);
          // for (let i=0; i<n; i++) {
          //   console.log(getProperties(staffMap,i));
          // }
          // console.log(data.length);
          // var myObject = JSON.parse(data);
          // var result = Object.keys(obj).map(function(key) {
          //   return [Number(key), obj[key]];
          // });
          // console.log(data.length);
          // for (let i = 0; i < data.length; i++) {
          //   console.log(i, data[i]);
          // }
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
    // for (var i = 1; i <= daysMonth; i++){
    //   // if(i < my_day) {
    //     // str += `<div class=".checktime.oldtime">${i}</div>`;
    //   // } else {
    //     str += `<div class="checktime" id="${i}">${i}</div>`;
    //   // }
    // }
    // $('.checktime-box').html(str);

    // var i = 1;
    // // var id_no =
    // for (var i = 1; i < daysMonth; i++) {
    //   let d = new Date(my_year, my_month, i);
    //   if (d.getDay() == 0 || d.getDay() == 6) {
    //     // $("#" + i).css("background-color","gray");
    //   }
    //   else {
    //     $("#" + i).addClass('checktime_day_shift');
    //   }
    // }

  }

  genMemberRow({});

    // 初始化區
    $.ajax({
        url:'../data/patrolData.php',
        method: 'GET',
        dataType:'JSON',
        success:function(data){
            console.log(data)
        }
    })

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

                    // var _data = data;
                    console.log ("-- _data.success---");
                    console.log (_data.success);
                    console.log ("-- _data.success---");
                    console.log (_data);
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