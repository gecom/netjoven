<?php
	$dbr_country_data = Helpers::getCountryData();
	$country_name = ($dbr_country_data ? $dbr_country_data->country_name : 'Peru');
	$page_view = (Request::segment(1) ? Request::segment(1) : 'index');
?>

<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-6925229-1']);
	_gaq.push(['_trackPageview', '/{{$page_view}}']);
	_gaq.push(['_setCustomVar',1,'Pais','{{$country_name}}',1]);
	(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>