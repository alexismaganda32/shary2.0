$(document).on('click', '#getAll', function(e) {
	e.preventDefault();
	$("#formSearch input:text[name='name']").val('');
	$("#formSearch").submit();
});