$(function()
{
	$("#ui-alert").hide();
	$("#ui-alert").click(function()
			{
		$("#ui-alert").hide("blind",{},500);
			});
});
function alertMsg(msg)
{
	$("#msg").replaceWith('<span id="msg"></span>');
	$("#msg").append(msg);
	$("#ui-alert").show("blind",{},1000);
};