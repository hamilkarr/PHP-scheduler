<?php 
include_once "_common.php";
$year = $_GET['year'] ?? date("Y");
$month = $_GET['month'] ?? date("m");
$calendar = Calendar::getInstance();
$data =  $calendar->get($year, $month);
$days = $data['days'];
$lastDay = $days[count($days) - 1];
$schedules = Scheduler::getInstance()->getList($days[0]['date'], $lastDay['date']);
$yoils = $calendar->getYoils();
include_once "_header.php";
?>
<div id='title'><i class='xi-calendar-list'></i>Simple Scheduler</div>
<button type="button" class="add_schedule">
	<i class='xi-plus-square-o'></i>스케줄 등록
</button>

<div class='year_month'>
	<a href='?year=<?=$data['prevYear']?>&month=<?=$data['prevMonth']?>'>
		<i class='xi-angle-left-min'></i>
		이전달
	</a>
		<span class='current'><?=$year?>.<?=$month?></span>
	<a href='?year=<?=$data['nextYear']?>&month=<?=$data['nextMonth']?>'>
		다음달
		<i class='xi-angle-right-min'></i>
	</a>
</div>

<div class="scheduler_container">
  <ul class='yoils'>
    <?php foreach ($yoils as $yoil) : ?>
		<li><?=$yoil?></li>
    <?php endforeach; ?>
  </ul>

  <!-- days -->
  <ul class='days'>
    <?php foreach ($days as $day) : ?>
    <li class='day' data-stamp="<?=$day['stamp']?>">
      <div class='no'><?=$day['day']?></div>

	<?php if (isset($schedules[$day['date']])) : ?>
	<i class='xi-check-circle-o view_schedule'></i>
	<?php endif; ?>
	
    </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php
include_once "_footer.php";