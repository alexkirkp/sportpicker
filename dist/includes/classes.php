<?php

	class Sport
	{
		public $info = array();
		public $booleans = array();
		public $enums = array();
		public $pictures = array();
		public $id;
		public $description;
		protected $database_connection;

		public function __construct($id=null, $name=null, $database_connection)
		{

			$this->database_connection = $database_connection;

			if($id != null)
			{
				$sport_get = $this->database_connection->query("
												SELECT sports.*, categories.id AS category_id, categories.name AS category_name
												FROM sports LEFT JOIN categories ON sports.category_id = categories.id
												WHERE sports.id = $id
												");
			}
			else
			{
				$sport_get = $this->database_connection->query("
												SELECT sports.*, categories.id AS category_id, categories.name AS category_name
												FROM sports LEFT JOIN categories ON sports.category_id = categories.id
												WHERE sports.name = '$name'
												");
			}


			if($sport_get != false)
			{
				$sport_array = $sport_get->fetch_array(MYSQLI_ASSOC);

				//General variables
				$this->id               = $sport_array["id"];
				$this->description      = $sport_array["description"];
				$this->info["Name"]     = $sport_array["name"];
				$this->info["Category"] = $sport_array["category_name"];

				//Boolean variables
				$this->booleans["Competitive"]          = $sport_array["competitive"];
				$this->booleans["Team"]                 = $sport_array["team"];
				$this->booleans["Upper Body"]           = $sport_array["upper_body"];
				$this->booleans["Designated Areas"]     = $sport_array["designated_areas"];
				$this->booleans["Driving"]              = $sport_array["driving"];
				$this->booleans["Endurance"]            = $sport_array["endurance"];
				$this->booleans["Location Requirement"] = $sport_array["geo_req"];
				$this->booleans["High School"]          = $sport_array["high_school"];
				$this->booleans["Olympic Sport"]        = $sport_array["olympic_sport"];
				$this->booleans["Outdoor"]              = $sport_array["outdoor"];

				//Enum variables
				$this->enums["Popularity"]       = $sport_array["popularity"];
				$this->enums["Safety"]           = $sport_array["safety"];
				$this->enums["Time Requirement"] = $sport_array["time_req"];
				$this->enums["Cost-Once"]        = $sport_array["cost_once"];
				$this->enums["Cost-Frequent"]    = $sport_array["cost_frequent"];
				$this->enums["Difficulty"]       = $sport_array["difficulty"];

				//Photos array
				$photo_get = $this->database_connection->query("
					SELECT *
					FROM pictures
					WHERE sport_id = " . $this->id
				);

				while ($row = $photo_get->fetch_array()) {
					$this->pictures[] = new Photo($row["filename"], $row["credit"]);
				}
			}
		}

		/**
		 * Returns an array with the variables in the info array in html allowing them to be edited
		 * @return array Array containing html elements
		 */
		public function info_editable()
		{
			$return_array = array();

			$return_array["id"] = $this->id;
			$return_array["Name"] = "<input type='text' name='name' id='name' value='" . $this->info["Name"] . "'>";
			$return_array["Category"] = $this->category_select("category",$this->info["Category"]);

			return $return_array;
		}

		/**
		 * Returns an array with the variables in the booleans array in html allowing them to be edited
		 * @return array Array containing html elements
		 */
		public function booleans_editable()
		{

			$return_array = array();

			foreach ($this->booleans as $key => $val)
			{
				if ($val)
				{
					$return_array[] = "<input name='$key' id='$key' type='checkbox' checked>";
				}
				else
				{
					$return_array[] = "<input name='$key' id='$key' type='checkbox'>";
				}
			}

			return $return_array;
		}

		/**
		 * Returns an array with the variables in the enums array in html allowing them to be edited
		 * @return array Array containing html elements
		 */
		public function enums_editable()
		{
			$return_array = array();

			foreach ($this->enums as $key => $val)
			{
				$return_array[] = $this->low_to_high_select($key,$val);
			}

			return $return_array;
		}

		/**
		 * Returns an array combining all of the arrays from info_editable(), booleans_editable(), enums_editable()
		 * @return array Array containing html elements
		 */
		public function all_editable()
		{
			return array_merge($this->info_editable(),$this->booleans_editable(),$this->enums_editable());
		}

		/**
		 * Returns an array with all of the variables for the sport.
		 * @return Array
		 */
		public function all_arrays()
		{
			return array_merge($this->info,$this->booleans,$this->enums);
		}

		public function short_display()
		{
			return array_merge($this->info,$this->booleans,$this->enums);
		}

		/**
		 * Returns a string that has the html for a selection with the options "low", "medium" and "high"
		 * @param  String $name     Html name attribute
		 * @param  String $selected Optional. Either "low", "medium" or "high", this option will be pre selected.
		 * @return String           String of html with selection code.
		 */
		public function low_to_high_select($name, $selected = null)
		{
			$selection = "<select name='$name' id='$name'>";

			if ($selected === "low")
			{
				$selection .= "<option value='low' selected='selected'>low</option>";
			}
			else
			{
				$selection .= "<option value='low'>low</option>";
			}

			if ($selected === "medium")
			{
				$selection .= "<option value='medium' selected='selected'>medium</option>";
			}
			else
			{
				$selection .= "<option value='medium'>medium</option>";
			}

			if ($selected === "high")
			{
				$selection .= "<option value='high' selected='selected'>high</option>";
			}
			else
			{
				$selection .= "<option value='high'>high</option>";
			}

			$selection .= "</select>";

			return $selection;
		}

		/* Returns a string that has the html for a selection with the options of the categories table */
		/* If the one optional parameter is given then the default choice is set */
		/**
		 * Returns a string that has the html for a selection with the options of the categories table.
		 * @param  string $name     The name and id of the select object
		 * @param  string $selected Optional. If it is given it is used to select an option by default.
		 * @return string           HTML for the select statement.
		 */
		public function category_select($name, $selected = null)
		{
			$categories_get = $this->database_connection->query("SELECT * FROM categories");

			$selection = "<select name='$name' id='$name'>";

			// Loops through all categories
			while ($row = $categories_get->fetch_object())
			{
				if($row === $selected)
				{
					$selection .= "<option value='$row' selected='selected'>$row</option>";
				}
				else
				{
					$selection .= "<option value='$row->id'>$row->name</option>";
				}
			}

			$selection .= "</select>";

			return $selection;
		}
	}

	class Photo
	{
		public $location;
		public $credit;

		public function __construct($location, $credit)
		{
			$this->location = $location;
			$this->credit = $credit;
		}
	}

?>