$(function () {
  $('.add_schedule').click(function () {
    yh.layer.popup('add_work.php', 400, 400);
  });
  
  $(".view_schedule").click(function() {
	const stamp = $(this).closest(".day").data("stamp");
	const url = "view_work.php?stamp=" + stamp;
	yh.layer.popup(url, 400, 400);
  });
});
