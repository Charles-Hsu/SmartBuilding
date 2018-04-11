<?php
$meeting_id = $_GET['id'];
$meeting_type = $_GET['type'];

$sql = "SELECT COUNT(*) as c FROM meeting_att WHERE meeting_id = $meeting_id";
$var = $db->getRow($sql);
$total = $var[c];
echo $total;

$sql = "SELECT COUNT(*) as c FROM meeting_att WHERE meeting_id = $meeting_id AND dt IS NOT NULL";
echo $sql;
$var = $db->getRow($sql);
$att = $var[c];
echo $att;
$att_rate = number_format($att/$total*100, 1);

echo '出席率' . att_rate . ' %';

$sql = "UPDATE meetings SET att_rate = $att_rate WHERE id = $meeting_id";
$db->update($sql);

$sql = "SELECT a.id AS meeting_id, a.att_rate, a.date,b.name AS type, c.name AS session ,d.name AS round  FROM meetings a, meeting_type b, session c, round d WHERE a.meeting_type = b.id AND a.round = d.id AND a.session = c.id AND a.id = $meeting_id";

$var = $db->getRow($sql);

function timeFromString($str) {
	return date("H:i", strtotime($str));
}


?>
<div><?=$var[date];?></div>
<div>
	<span>
		<?php echo $var[session];?>
		<?php echo $var[round];?>
		<?php echo $var[type];?>
	</span>,
	<span>目前出席率: <?php echo $var[att_rate];?> %</span>
</div>
<div>出席人員名單</div>
<table class="table asset-table">
	<thead class="thead-light">
		<tr>
			<th>戶號</th>
			<th>樓層</th>
            <th>姓名</th>
            <th>簽到</th>
		</tr>
	</thead>
	<tbody>
<?php
$sql = "SELECT * FROM household";
$sql = "SELECT a.id, a.att_id, b.addr_no, b.floor, b.holder, a.dt FROM meeting_att a, household b WHERE a.meeting_id = $meeting_id AND a.att_id = b.id";
$data = $db->getRows($sql);
foreach($data as $var) {
?>
		<tr>
			<td><span><?php echo $var[addr_no];?></span></td>
			<td><span><?php echo $var[floor];?></span></td>
			<td><span><?php echo $var[holder];?></span></td>
<?php
	if ($var[dt]) {
?>			
			<td><?php echo timeFromString($var[dt]);?></td>
<?php
	} else {
?>
			<td><input type="checkbox" class="meeting-holder" id="<?php echo $var[id];?>" att-id="<?php echo $var[att_id];?>" meeting-id="<?php echo $meeting_id;?>"></td>
<?php
	}
?>

		</tr>
<?php
	}
?>
	</tbody>
</table>
