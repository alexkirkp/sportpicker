<?php
	require_once "includes/classes.php";
	require_once "includes/config.php";
	require_once "includes/functions.php";

	$sport_name = $_GET["name"];

	$sport = new Sport(null, $sport_name, $database_connection);

	/* Variables for the page header */
	$css_files = array("normalize.css", "styles.css", "magnific-popup.css");
	$js_files = array("jquery.js", "jquery.magnific-popup.js");
	if (file_exists("/includes/style.css"))
	{
		$css_files=array("style.css");
	}
	else
	{
		$css_files = array("css/normalize.css", "css/styles.css", "css/magnific-popup.css");
	}

	if(file_exists("/includes/javascript.js"))
	{
		$js_files = array("javascript.js");
	}
	else
	{
		$js_files = array("js/jquery.js", "js/tablesorter/jquery.tablesorter.js", "js/collapse.jquery.js", "js/jquery.magnific-popup.js");
	}
	$page_title = $_GET["name"];
	$header_end = "	<script>
						$(document).ready(function() {
						  $('#SportPhotos').magnificPopup({
							  type: 'image',
							  delegate: 'a',

							  image: {
									titleSrc: function(item) {
										return item.el.attr('title');
									}
								},
							  gallery:{enabled:true},
							  callbacks: {

							    buildControls: function() {
							      // re-appends controls inside the main container
							      this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
							    }

							  }
							});
						});
					</script>";
	require_once "/includes/header.php";

	require_once "/templates/sport.tmpl.php";

	require_once "/includes/footer.php";
?>