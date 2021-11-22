<?php
include_once "_common.php";
$stamp = $_GET['stamp'];
$info = Scheduler::getInstance()->get($stamp);
if (!$info) {
	echo "<script>alert('등록된 스케줄이 없습니다.');location.reload();</script>";
	exit;
}
?>
<div class='popup_tit'><?=$info['date']?></div>
<dl>
	<dt>일정</dt>
	<dd><?=$info['title']?></dd>
</dl>
<dl>
	<dt>내용</dt>
	<dd><?=nl2br($info['content'])?></dd>
</dl>

<div class='btns'>
	<a class='btn btn1' href='work_ps.php?mode=delete&date=<?=$info['date']?>' target='ifrmHidden' onclick="return confirm('정말 삭제하시겠습니까?');">삭제</a>
	<span class='btn btn2' onclick="yh.layer.close();">닫기</span>
</div>
