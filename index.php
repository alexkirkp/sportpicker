<?php
	require_once "includes/classes.php";
	require_once "includes/config.php";
	require_once "includes/functions.php";



	add_get_spaces();
	$sports_array_all = get_sports($database_connection);
	$sports_array = exclude_sports($sports_array_all, $_GET);

	/* Variables for the page header */
	if (file_exists("/includes/style.css"))
	{
		$css_files=array("style.css");
	}
	else
	{
		$css_files = array("css/normalize.css","css/styles.css");
	}

	if(file_exists("/includes/javascript.js"))
	{
		$js_files = array("javascript.js");
	}
	else
	{
		$js_files = array("js/jquery.js", "js/tablesorter/jquery.tablesorter.js", "js/collapse.jquery.js");
	}

	$page_title = "Home";
	$header_end = "<script type='text/javascript'>
					$(function() {
						$('#Comparison').tablesorter({sortList:[[0,0]], widgets: ['zebra']});
					});
				  </script>";

	require_once "/includes/header.php";

	require_once "/templates/index.tmpl.php";

	require_once "/includes/footer.php";
?>