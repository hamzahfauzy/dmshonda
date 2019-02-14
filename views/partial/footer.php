</body>
<script type="text/javascript">
var toggle_status = 0;
$(".btn-nav-toggle").click(function(){
	if(toggle_status == 0)
	{
		$(".sidebar").attr('style','display: block !important');
		$(".sidebar").css("z-index",1)
		toggle_status = 1
	}
	else
	{
		$(".sidebar").removeAttr("style")
		toggle_status = 0
	}
})
</script>
</html>