<?php
	$info_column = 0;
	$max_info_column = 3;

	foreach ($sport->short_display() as $key => $value)
	{
		
		//If the current key is not name then it is added to the table
		if ($key !== "Name")
		{
			//Start of a new row
			// if ($info_column === 0)
			// {
			// 	echo "<div class='sportInfoRow'>";
			// }
			
			echo "<div class='sportInfoCell'>";
			
			//If the value was stored as a boolean
			if (is_numeric($value))
			{	
				if ($value === "1")
				{
					echo $key . ": <span class='sportInfoValue'>Yes</span>";
				}
				elseif ($value === "0")
				{
					echo $key . ": <span class='sportInfoValue'>No</span>";
				}
			}
			//If the value was text
			else
			{
				echo $key . ": <span class='sportInfoValue'>" . $value . "</span>";
			}
			
			echo "</div>";
			
			//Ending a row
			// if ($info_column === $max_info_column)
			// {
			// 	//echo "</div><div class='clear'>";
			// 	$info_column = -1;
			// }
			$info_column++;
		}
		// The name is displayed at the top of the page, name must be the first object in the array!
		else
		{
			echo "<h1>" .  $value . "</h1>";
			echo "<div id='SportInfo' class='clearfix'>";
		}
	}

	// if ($info_column != $max_info_column)
	// {
	// 	while ($info_column < ($max_info_column + 1))
	// 	{ 
	// 		echo "<div class='sportInfoCell'></div>";
	// 		$info_column++;
	// 	}
	// 	echo "</div><div class='clear'></div>";
	// }
?>
</div>
<?php
	$photo_column = 0;
	$max_photo_column = 1;

	echo "<div id='SportDescription' class='clearfix'>";

	echo "<div id='SportPhotos'>";
	foreach ($sport->pictures as $value)
	{
		echo "<a href='images/sport_photos/" . $value->location . "' title='" . $value->credit . "' class='image-link'><img src='images/sport_photos/" . $value->location . "' height='150' width='150'></a>";

		if ($photo_column === $max_photo_column)
		{
			echo "<div class='clear'></div>";
		}

		$photo_column++;
	}
	echo "</div>";

	echo $sport->description;

	
?>
</div>
