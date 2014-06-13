<?php
	require_once "../includes/classes.php";
	require_once "../includes/config.php";
	require_once "../includes/functions.php";

	// If a sport has been updated
	if (isset($_POST['id']))
	{
		echo "UPDATE sports
										SET name = '$_POST[name]',
											competitive      = " . checkbox_checked('competitive') . ",
											team             = " .  checkbox_checked('team') . ",
											category_id      =  $_POST[category],
											cost_once        = '$_POST[cost_once]',
											cost_frequent    = '$_POST[cost_frequent]',
											designated_areas = " .  checkbox_checked('designated_areas') . ",
											difficulty       = '$_POST[difficulty]',
											driving          = " .  checkbox_checked('driving') . ",
											endurance        = " .  checkbox_checked('endurance') . ",
											geo_req          = " .  checkbox_checked('geo_req') . ",
											high_school      = " .  checkbox_checked('high_school') . ",
											olympic_sport    = " .  checkbox_checked('olympic_sport') . ",
											outdoor          = " .  checkbox_checked('outdoor') . ",
											popularity       = '$_POST[popularity]',
											safety           = '$_POST[safety]',
											time_req         = '$_POST[time_req]',
											upper_body       = " .  checkbox_checked('team') . "
										WHERE id = $_POST[id]
			";
		$database_connection->query("	UPDATE sports
										SET name = '$_POST[name]',
											competitive      = " . checkbox_checked('competitive') . ",
											team             = " .  checkbox_checked('team') . ",
											category_id      =  $_POST[category],
											cost_once        = '$_POST[cost_once]',
											cost_frequent    = '$_POST[cost_frequent]',
											designated_areas = " .  checkbox_checked('designated_areas') . ",
											difficulty       = '$_POST[difficulty]',
											driving          = " .  checkbox_checked('driving') . ",
											endurance        = " .  checkbox_checked('endurance') . ",
											geo_req          = " .  checkbox_checked('geo_req') . ",
											high_school      = " .  checkbox_checked('high_school') . ",
											olympic_sport    = " .  checkbox_checked('olympic_sport') . ",
											outdoor          = " .  checkbox_checked('outdoor') . ",
											popularity       = '$_POST[popularity]',
											safety           = '$_POST[safety]',
											time_req         = '$_POST[time_req]',
											upper_body       = " .  checkbox_checked('team') . "
										WHERE id = $_POST[id]
			");
	}

	$sports_array_all = get_sports($database_connection);
	$sports_array = exclude_sports($sports_array_all, $_GET);

	/* Variables for the page header */
	$css_files = array("normalize.css","styles.css", "admin.css");
	$js_files = array("test.js");
	$page_title = "Update";
	require_once "../includes/header.php";

	require_once "templates/update.tmpl.php";

	require_once "../includes/footer.php";

	// UPDATE sports
	// SET name = 'Basketball',
	// competitive = 1,
	// team = 1,
	// category_id = '1',
	// cost_once = 'low',
	// cost_frequent = 'low',
	// designated_areas = 0,
	// difficulty = 'low',
	// driving = 0,
	// endurance = 0,
	// geo_req = 0,
	// high_school = 0,
	// olympic_sport = 0,
	// outdoor = 0,
	// popularity = 'low',
	// safety = 'low',
	// time_req = 'Array',
	// upper_body = 1
	// WHERE id = Array[id]
?>

