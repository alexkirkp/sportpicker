<?php
/* This header page is meant to be included on every page.  Variables can be set before the page is included to change what is in the <head> */

	if (strpos(strtok($_SERVER["REQUEST_URI"],'?'),"admin") > 0)
	{
		$is_admin_page = true;
	}
	else
	{
		$is_admin_page = false;
	}

?>

<!doctype HTML>
<html>
	<head>
		<?php
			/*  Any special html to go at the start of the header */
			if (isset($header_start))
			{
				echo $header_start;
			}

			if ($is_admin_page)
			{
				echo "<title>$page_title | Admin | Sport Picker</title>\n";
			}
			else
			{
				echo "<title>$page_title | Sport Picker</title>\n";
			}

			/* Includes all of the style sheets */
			if (isset($css_files))
			{
				foreach ($css_files as $file)
				{
					echo "<link rel='stylesheet' href='/sportpicker/includes/" . $file . "' type='text/css' media='all'>\n";
				}
			}

			/* Includes all of the javascript files */
			if (isset($js_files))
			{
				foreach ($js_files as $file)
				{
					echo "<script src='/sportpicker/includes/" . $file . "'></script>\n";
				}
			}

			/*  Any special html to go at the end of the header */
			if (isset($header_end))
			{
				echo $header_end;
			}
		?>

	</head>
<body>

	<div id="Content">
		<div id="Header" class="clearfix">
			<h2 id="Logo"><a href="/sportpicker/">Sport Picker</a></h2>
			<nav>
				<ul>
					<li>Home</li>
					<li>About</li>
					<li>Forum</li>
				</ul>
			</nav>
		</div>