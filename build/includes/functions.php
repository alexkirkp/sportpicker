<?php

	/**
	 * Creates an array of all of the sports as the Sport class and returns it.
	 * @param  Object $database_connection Mysqli connection to a database
	 * @return Array                      Array that contains all sports as objects
	 */
	function get_sports($database_connection)
	{
		$sports_get = $database_connection->query("SELECT id FROM sports");

		if ($sports_get)
		{
			$sports_array = array();
			while ($row = $sports_get->fetch_object())
			{
				$sports_array[] = new Sport($row->id, null, $database_connection);
			}
		}

		return $sports_array;
	}

	/**
	 * Checks if a checkbox was checked
	 * @param  $_POST checkbox value $checkbox
	 * @return Boolean
	 */
	function checkbox_checked($checkbox)
	{
		return (isset($_POST[$checkbox]) ? 1 : 0);
	}

	/**
	 * Converts a string to a camel cased class with no spaces
	 * @param  String $string
	 * @return String
	 */
	function to_class($string)
	{
		//Creates a class for each column in camelCase
		$first_char_class = strtolower(substr($string, 0, 1));
		$class = $first_char_class . preg_replace('/\s+/', '', substr($string, 1));

		return $class;
	}

	/**
	 * Creates a form with the sport restrictions in it
	 * @param  Sport $sport                            A sport of the class sport, used to pull out the proper variables to restrict on
	 * @param  Array of sports $sports_array           Array of current sports so that a comparison between the current number of sports and the new number of sports can be made
	 * @param  Array of sports $sports_array_all       Array of all sports
	 * @param  mysqli connection $database_connection
	 * @return String                                  HTML string to be output
	 */
	function create_restrictions($sport, $sports_array, $sports_array_all,  $database_connection)
	{
		$current_sport_count = count($sports_array);

		$return_string = "<form action='' method='GET'>";

		// The category option
		$categories_array = get_categories($database_connection);

		$return_string .= "<div class='sortSection'>";
		$return_string .= "<h4> Category </h4> ";
		$return_string .= "<div>";
		$return_string .= "<select name='categories' id='categories'>";
		$return_string .= "<option value='Any'>Any (" . test_constriction("categories","Any",$current_sport_count,$sports_array_all) . ")</option>";
		if(isset($_GET["categories"]))
		{
			$category = $_GET["categories"];
		}
		else
		{
			$category = null;
		}

		foreach ($categories_array as $key => $value) {
			$name = $value["name"];
			if($name === $category)
			{
				$return_string .= "<option value='$name' selected>$name (" . test_constriction("categories",$name,$current_sport_count,$sports_array_all) . ")</option>";
			}
			else
			{
				$return_string .= "<option value='$name'>$name (" . test_constriction("categories",$name,$current_sport_count,$sports_array_all) . ")</option>";
			}
		}

		$return_string .= "</select>";
		$return_string .= "<button class='toggle hidden' data-column='category'>Hide</button>";
		$return_string .= "</div></div>";

		// The booleans options
		foreach ($sport->booleans as $key => $value)
		{
			$return_string .= "<div class='sortSection'>";
			$return_string .= "<h4> $key </h4>";
			$return_string .= "<div>";

			if (isset($_GET[$key]) && $_GET[$key] === "1")
			{
				$return_string .= "<label><input type='radio' name='$key' value='1' checked='checked'>Yes (" . test_constriction($key,'1',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='0'>No (" . test_constriction($key,'0',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='Either'>Either (" . test_constriction($key,'Either',$current_sport_count,$sports_array_all) . ")</label><br>";
			}
			elseif (isset($_GET[$key]) && $_GET[$key] === "0")
			{
				$return_string .= "<label><input type='radio' name='$key' value='1'>Yes (" . test_constriction($key,'1',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='0' checked='checked'>No (" . test_constriction($key,'0',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='Either'>Either (" . test_constriction($key,'Either',$current_sport_count,$sports_array_all) . ")</label><br>";
			}
			else
			{
				$return_string .= "<label><input type='radio' name='$key' value='1'>Yes (" . test_constriction($key,'1',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='0'>No (" . test_constriction($key,'0',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='Either' checked='checked'>Either (" . test_constriction($key,'Either',$current_sport_count,$sports_array_all) . ")</label><br>";
			}

			$return_string .= "<button class='toggle hidden' data-column='" . to_class($key) . "'>Hide</button>";
			$return_string .= "</div></div>";

		}

		// The enum option
		foreach ($sport->enums as $key => $value)
		{
			$return_string .= "<div class='sortSection'>";
			$return_string .= "<h4> $key </h4>";
			$return_string .= "<div>";

			if (isset($_GET[$key]) && $_GET[$key] === "Low")
			{
				$return_string .= "<label><input type='radio' name='$key' value='Low' checked='checked'>Low (" . test_constriction($key,'Low',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='Medium'>Medium (" . test_constriction($key,'Medium',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='High'>Medium (" . test_constriction($key,'High',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='Any'>Any (" . test_constriction($key,'Any',$current_sport_count,$sports_array_all) . ")</label><br>";
			}
			elseif (isset($_GET[$key]) && $_GET[$key] === "Medium")
			{
				$return_string .= "<label><input type='radio' name='$key' value='Low'>Low (" . test_constriction($key,'Low',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='Medium' checked='checked'>Medium (" . test_constriction($key,'Medium',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='High'>High (" . test_constriction($key,'High',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='either'>Any (" . test_constriction($key,'Any',$current_sport_count,$sports_array_all) . ")</label><br>";
			}
			elseif (isset($_GET[$key]) && $_GET[$key] === "High")
			{
				$return_string .= "<label><input type='radio' name='$key' value='Low'>Low (" . test_constriction($key,'Low',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='Medium'>Medium (" . test_constriction($key,'Medium',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='High' checked='checked'>High (" . test_constriction($key,'High',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='either'>Any (" . test_constriction($key,'Any',$current_sport_count,$sports_array_all) . ")</label><br>";
			}
			else
			{
				$return_string .= "<label><input type='radio' name='$key' value='Low'>Low (" . test_constriction($key,'Low',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='Medium'>Medium (" . test_constriction($key,'Medium',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='High'>High (" . test_constriction($key,'High',$current_sport_count,$sports_array_all) . ")</label><br>";
				$return_string .= "<label><input type='radio' name='$key' value='Any' checked='checked'>Any (" . test_constriction($key,'Any',$current_sport_count,$sports_array_all) . ")</label><br>";
			}

			$return_string .= "<button class='toggle hidden' data-column='" . to_class($key) . "'>Hide</button>";
			$return_string .= "</div></div>";
		}

		$return_string .= "<input id='update' type='submit' value='Update' name='UpdateRestrictions'>";
		$return_string .= "</form>";

		return $return_string;
	}

	/**
	 * Sanitize the submitted values from GET
	 * No return because $_GET is global
	 */
	function sanitize_get()
	{
		foreach ($_GET as $key => $value) {
			$_GET[$key] = htmlspecialchars($value);
		}
	}

	/**
	 * Exclude sports based on restrictions
	 * @param  Array $sports_array The array of sports to look through and remove sports from
	 * @param  Array $constraints  Array with string keys and values
	 * @return Array               Array of sports that have not been excluded
	 */
	function exclude_sports($sports_array, $constraints)
	{
		$selected_sports = array();

		foreach ($sports_array as $sport)
		{
			$excluded = false;
			foreach ($constraints as $key => $value)
			{
				//echo "Looping on: Sport: " . $sport->info["Name"] . ", looking at: " . "$key.<br>";
				// Checks the boolean values
				if($value !== "Either" && array_key_exists($key, $sport->booleans))
				{
					if($value !== $sport->booleans[$key])
					{
						$excluded = true;
						break 1;
					}
				}

				// Checks the enum values
				if($value !== "Any" && array_key_exists($key, $sport->enums))
				{
					if($value !== $sport->enums[$key])
					{
						$excluded = true;
						break 1;
					}
				}

				// Checks the category value
				if(!$excluded && $key === "categories" && $value !== "Any")
				{
					//echo "Exclude: " . $sport->info["Name"] . " " . $sport->info["Category"] . "<br>";
					if($value !== $sport->info["Category"])
					{
						$excluded = true;
						break 1;
					}
				}
			}

			if(!$excluded)
			{
				$selected_sports[] = $sport;
			}
		}

		return $selected_sports;
	}

	/**
	 * Tests how many sports would be left after a filter is applied to the sports
	 * @param  String $key                 The variable the filter should be applied to
	 * @param  String $value               The value of the variable that will be tested
	 * @param  Int    $current_sport_count The current number of sports
	 * @param  Array  $sports_array_all    Array of sports containg all sports in the database
	 * @return Int                         The new number of sports if the filter is applied
	 */
	function test_constriction($key, $value, $current_sport_count, $sports_array_all)
	{
		$new_constriction = array();
		$new_constriction = $_GET;
		$new_constriction[$key] = $value;

		$new_sports = exclude_sports($sports_array_all, $new_constriction);

		return count($new_sports);
	}


	/**
	 *  Puts spaces in place of all underscores in the global variable $_GET keys
	 */
	function add_get_spaces()
	{
		foreach ($_GET as $key => $value) {
			$_GET[str_replace("_", " ", $key)] = $value;
		}
	}

	/**
	 * Get the list of valid categories from the database
	 * @param  mysqli connection $database_connection
	 * @return Array                      Array of strings with the categories
	 */
	function get_categories($database_connection)
	{
		$categories_get = $database_connection->query("SELECT name FROM categories");
		$categories_array = array();

		while($row = mysqli_fetch_array($categories_get, MYSQL_ASSOC)){
			$categories_array[] = $row;
		}

		return $categories_array;
	}
?>