<!DOCTYPE html>
<html>

<body>

    </head>
    <title>CPSC 304 BasketBall Project</title>

    </head>

    <body>
        <hr />
        <h1>Basketball Repository</h1>

        <h2>Insert Values into BasketBall Player Table</h2>
        <form method="POST" action="test.php">
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            BasketballPlayer ID: <input type="text" name="insNo"> <br /><br />
            Name: <input type="text" name="insName"> <br /><br />
            Height: <input type="text" name="insHeight"> <br /><br />
            Weight: <input type="text" name="insWeight"> <br /><br />
            Age: <input type="text" name="insAge"> <br /><br />
            Years played: <input type="text" name="insYears"> <br /><br />
            Value over Replacement: <input type="text" name="insReplacement"> <br /><br />
            Player Efficiency Rating: <input type="text" name="insEfficency"> <br /><br />
            Box plus/minus: <input type="text" name="insbox"> <br /><br />
            Points per game: <input type="text" name="insPPG"> <br /><br />
            Assist per game: <input type="text" name="insAPG"> <br /><br />
            Steals per game: <input type="text" name="insSPG"> <br /><br />
            Rebounds per game: <input type="text" name="insRPG"> <br /><br />
            Three point attempt Rate: <input type="text" name="insThree"> <br /><br />
            Win shares: <input type="text" name="insWinshares"> <br /><br />
            Field goal percentage: <input type="text" name="insField"> <br /><br />
            BasketballTeam Name: <input type="text" name="insBTName"> <br /><br />

            <input type="submit" value="Insert" name="insertSubmit"></p>
        </form>

        <hr />

        <h2>Update Name in BasketBall Player Table</h2>


        <form method="POST" action="test.php">
            <!--refresh page when submitted-->
            <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
            BasketPlayer ID: <input type="text" name="UpId"> <br /><br />
            New Name: <input type="text" name="NewName"> <br /><br />

            <input type="submit" value="Update" name="updateSubmit"></p>
        </form>

        <hr />

        <h2>Delete BasketBall Player Table from the Table</h2>


        <form method="POST" action="test.php">
            <input type="hidden" id="deleteQueryRequest" name="deleteQueryRequest">
            BasketPlayer ID: <input type="text" name="BadId"> <br /><br />

            <input type="submit" value="Delete" name="deleteSubmit"></p>
        </form>

        <h2>Search Basketball Team with More Than x Wins</h2>

        <form method="POST" action="test.php">
            <input type="hidden" id="selectQueryRequest" name="selectQueryRequest">
            Wins: <input type="text" name="Wins"> <br /><br />

            <input type="submit" value="Search" name="selectSubmit"></p>
        </form>

        <?php
        $link = mysqli_connect("localhost", "root", "root", "cpsc304");
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        if (isset($_POST['selectSubmit'])) {
            $Wins = $_POST['Wins'];
            $sql = "SELECT BT_Name FROM BasketballTeam WHERE BT_Total_wins >= '$Wins'";
            $result = $link->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "NAME: " . $row["BT_Name"] . "<br>";
                }
            } else {
                echo "0 results";
            }
        }

        ?>

        <h2>Current Basketball Teams Avaliable:</h2>

        <?php
        $link = mysqli_connect("localhost", "root", "root", "cpsc304");

        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        $sql = "SELECT BT_Name FROM BasketballTeam";
        $result = $link->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "NAME: " . $row["BT_Name"] . "<br>";
            }
        } else {
            echo "0 results";
        }
        if (isset($_POST['insertSubmit'])) {
            $ID = $_POST['insNo'];
            $Name = $_POST['insName'];
            $Height = $_POST['insHeight'];
            $Weight = $_POST['insWeight'];
            $Age = $_POST['insAge'];
            $Years = $_POST['insYears'];
            $Replace = $_POST['insReplacement'];
            $Efficence = $_POST['insEfficency'];
            $box = $_POST['insbox'];
            $PPG = $_POST['insPPG'];
            $APG = $_POST['insAPG'];
            $SPG = $_POST['insSPG'];
            $RPG = $_POST['insRPG'];
            $Three = $_POST['insThree'];
            $wins = $_POST['insWinshares'];
            $Field = $_POST['insField'];
            $BTName = $_POST['insBTName'];

            $sql = "INSERT into BasketballPlayer_playsfor(BP_Id, age, value_over_replacement_player, player_efficiency_rating, box_plus_minus, points_per_game, assist_per_game, steals_per_game, rebounds_per_game, three_point_attempt_rate, weight, field_goal_percentage, height, win_shares, years_played, name, BT_Name)
        VALUES ('$ID', '$Age', '$Replace','$Efficence', '$box','$PPG', '$APG', '$SPG', '$RPG', '$Three', '$Weight', '$Field', '$Height', '$wins', '$Years', '$Name', '$BTName')";

            if (mysqli_query($link, $sql)) {
                echo "Player added successfully.";
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }

        if (isset($_POST['updateSubmit'])) {
            $ID = $_POST['UpId'];
            $NewName = $_POST['NewName'];
            $sql = "UPDATE BasketballPlayer_playsfor SET name = '$NewName' WHERE BP_ID = '$ID'";

            if (mysqli_query($link, $sql)) {
                echo "Player name updated successfully.";
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }

        if (isset($_POST['deleteSubmit'])) {
            $BadId = $_POST['BadId'];
            $sql = "DELETE FROM BasketballPlayer_playsfor WHERE BP_Id = '$BadId'";

            if (mysqli_query($link, $sql)) {
                echo "Player deleted successfully.";
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }



        // Close connection
        mysqli_close($link);
        ?>
    </body>

</html>