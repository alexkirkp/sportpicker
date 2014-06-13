
<?php if(count($sports_array)>0) : ?>
<table>
	<tr>
		<td id="TableControls">
			 <h3>Restrictions</h3><br>
				<?php echo create_restrictions($sports_array[0], $sports_array, $sports_array_all, $database_connection) ?>
			 <br>
		</td>
		<td id="ComparisonSpace"></td>
		<td id="ComparisonContainer">
			<table id="Comparison" class="tablesorter">
				<thead>
					<tr>
						<?php
							foreach ($sports_array[0]->all_arrays() as $key => $row)
				   			{
				   				echo "<th class='" . to_class($key) . "'>" . ucfirst($key) . "</th>";
				   			}

						?>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($sports_array as $sport) : ?>
							<?php
								echo "<tr id='". to_class($sport->info["Name"]) . "'>";
								foreach ($sport->all_arrays() as $key => $value)
								{
									echo "<td class='" . to_class($key) . "'>";
									if (is_numeric($value))
									{
										if ($value === "1")
										{
											echo "Yes";
										}
										elseif ($value === "0")
										{
											echo "No";
										}
									}
									elseif ($key === "Name")
									{
										echo "<a href='sport.php?name=" . $value . "'>" . $value . "</a>";
									}
									else
									{
										echo $value;
									}

								}
								echo "</td>";
							?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</td>
	</tr>
</table>
<?php else : ?>
	No sports found, please go back and try again.
<?php endif; ?>
