<div class='popup_tit'>스케줄 등록</div>
<form method="post" action="work_ps.php" target="ifrmHidden" autocomplete="off">
	 <input type="hidden" name="mode" value="add">
	<dl>
		<dt>날짜</dt>
		<dd><input type="date" name="date"></dd>
  	</dl>
	<dl>
		<dt>일정</dt>
		<dd><input type="text" name="title"></dd>
	</dl>
	<dl>
		<dt>내용</dt>
		<dd>
			<textarea name="content"></textarea>
		</dd>
	</dl>
  <input type="submit" value="등록하기">
</form>