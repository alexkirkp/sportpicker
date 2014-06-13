<form action="" method="post">

<?php
    foreach ($sports_array[0]->all_arrays() as $key => $row)
    {
        echo "<div class='updateColumnHeader'>" . ucfirst($key) . "</div>";
    }

    // foreach ($sports_array[0]->sport_booleans as $key => $row)
    // {
    //     echo "<div class='updateColumn'>" . ucfirst($key) . "</div>";
    // }

    // foreach ($sports_array[0]->sport_enums as $key => $row)
    // {
    //     echo "<div class='updateColumn'>" . ucfirst($key) . "</div>";
    // }

    echo "<div class='clear'></div>";

    foreach ($sports_array as $sport)
    {

        echo "<form action='update.php' method='POST'>";

        $sport_all=$sport->all_editable();
        foreach ($sport_all as $key => $value)
        {
            if ($key === "id")
            {

            }
            else if ($key !== "name")
            {
                echo "<div class='updateColumn'>" . $value . "</div>";
            }
            else
            {
                echo "<div class='updateColumn'>" . "<a href='/sport?name=$key'>" . $value . "</a></div>";
            }
        }

    echo "<div class='updateColumn'><input type='hidden' value='" . $sport->id . "'><input type='submit' name='Update' value='Update'></form></div>";

    echo "<div class='clear'></div>";
    }
?>
</form>