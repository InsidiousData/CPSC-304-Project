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
        <?php
        $pass = "root";
        $link = mysqli_connect("localhost", "root", $pass, "cpsc304");
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
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
        mysqli_close($link);
        ?>


        <hr />

        <h2>Update Name in BasketBall Player Table</h2>


        <form method="POST" action="test.php">
            <!--refresh page when submitted-->
            <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
            BasketPlayer ID: <input type="text" name="UpId"> <br /><br />
            New Name: <input type="text" name="NewName"> <br /><br />

            <input type="submit" value="Update" name="updateSubmit"></p>
        </form>

        <?php
        $link = mysqli_connect("localhost", "root", $pass, "cpsc304");
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
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
        mysqli_close($link);
        ?>

        <hr />

        <h2>Delete BasketBall Player Table from the Table</h2>


        <form method="POST" action="test.php">
            <input type="hidden" id="deleteQueryRequest" name="deleteQueryRequest">
            BasketPlayer ID: <input type="text" name="BadId"> <br /><br />

            <input type="submit" value="Delete" name="deleteSubmit"></p>
        </form>

        <?php
        $link = mysqli_connect("localhost", "root", $pass, "cpsc304");
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
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
        mysqli_close($link);
        ?>

        <hr />

        <h2>Find Players and Coach by Team</h2>
        <form method="POST" action="test.php">
            <input type="hidden" id="joinQueryRequest" name="joinQueryRequest">
            BasketBall Team: <input type="text" name="TeamName"><br /><br />
            <input type="submit" value="Join" name="joinSubmit"></p>
            <form>
                <?php
                $link = mysqli_connect("localhost", "root", $pass, "cpsc304");
                if ($link === false) {
                    die("ERROR: Could not connect. " . mysqli_connect_error());
                }
                if (isset($_POST['joinSubmit'])) {
                    $BT_Name = $_POST['TeamName'];
                    $sql = "SELECT b.BT_Name AS team, b.BT_Total_wins AS wins, p.BP_ID AS id, b.BT_Total_losses AS loss, p.name AS p_name, p.age AS age,
                     h.HC_Name AS head, h.HC_Start_Date AS start 
            FROM BasketballTeam b INNER JOIN BasketballPlayer_PlaysFor p ON p.BT_Name = b.BT_Name INNER JOIN HeadCoach h ON h.BT_Name = b.BT_Name
            WHERE b.BT_Name = '$BT_Name'";
                    $result = $link->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "Player Name: " . $row["p_name"] . "....Player Age: " . $row["age"] . "....Player ID: " . $row["id"] . "....Head Coach: " . $row["head"]
                                . "....Head Coach Start: " . $row["start"] . "....Team: " . $row["team"] .
                                "....Team Total Wins: " . $row["wins"] . "....Team Total Losses: "  . $row["loss"] . "<br>";
                        }
                    } else {
                        echo "0 results";
                    }
                }
                mysqli_close($link);
                ?>

                <hr />

                <h2>Project Referee Information</h2>
                <form method="POST" action="test.php">
                    <select name=ref_option>
                        <option value="R_ID">ID</option>}
                        <option value="R_Name">Name</option>
                        <option value="R_Age">Age</option>
                    </select>
                    <input type="hidden" id="projectionRequest" name="projectionRequest">
                    <input type="submit" value="project" name="projectSubmit"></p>
                    <form>

                        <?php
                        $link = mysqli_connect("localhost", "root", $pass, "cpsc304");
                        if ($link === false) {
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }
                        if (isset($_POST['projectSubmit'])) {
                            $sql = "SELECT " . $_POST["ref_option"] . " FROM Referee";
                            $result = $link->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo $row[$_POST["ref_option"]] . "<br>";
                                }
                            } else {
                                echo "0 results";
                            }
                        }
                        mysqli_close($link);

                        ?>
                        <hr />
                        <h2>Search Basketball Team with More Than x Wins</h2>

                        <form method="POST" action="test.php">
                            <input type="hidden" id="selectQueryRequest" name="selectQueryRequest">
                            Wins: <input type="text" name="Wins"> <br /><br />

                            <input type="submit" value="Search" name="selectSubmit"></p>
                        </form>

                        <?php
                        $link = mysqli_connect("localhost", "root", $pass, "cpsc304");
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
                        mysqli_close($link);
                        ?>

                        <hr />

                        <h2>Find the Number of BasketballPlayer in a Team </h2>

                        <form method="POST" action="test.php">
                            <input type="hidden" id="findNumberQueryRequest" name="findNumberQueryRequest">
                            BasketballTeam Name: <input type="text" name="BTName"> <br /><br />
                            <input type="submit" value="Find" name="findSubmit"></p>
                        </form>

                        <?php
                        $link = mysqli_connect("localhost", "root", $pass, "cpsc304");
                        if ($link === false) {
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }
                        if (isset($_POST['findSubmit'])) {
                            $BTName = $_POST['BTName'];
                            $sql = "SELECT COUNT(*) FROM BasketBallPlayer_playsfor WHERE  BT_Name = '$BTName'";
                            $result = $link->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "Number of players in " . $BTName . ": " . $row["COUNT(*)"] . "<br>";
                                }
                            } else {
                                echo "0 results";
                            }
                        }
                        mysqli_close($link);
                        ?>
                        <hr />


                        <h2>For every team, Find a player with higher (points/assist/rebounds) than the average (points/assist/rebounds) of Basketball Players</h2>

                        <form method="POST" action="test.php">
                            
                            <select name=bp_option>
                                <option value="points_per_game">points</option>}
                                <option value="assist_per_game">assist</option>
                                <option value="rebounds_per_game">rebounds</option>
                            </select>
                            <input type="hidden" id="HighNumberQueryRequest" name="HighNumberQueryRequest">
                            <input type="submit" value="Find" name="HighSubmit"></p>
                            
                        </form>

                        <?php
                        $link = mysqli_connect("localhost", "root", $pass, "cpsc304");
                        if ($link === false) {
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }
                        if (isset($_POST['HighSubmit'])) {
                            $bp = $_POST['bp_option'];
                            $sql = "SELECT $bp , BT_Name, name
                            FROM basketballplayer_playsfor 
                            WHERE $bp  > (SELECT AVG($bp) FROM basketballplayer_playsfor) 
                            GROUP BY BT_Name
                            ORDER BY $bp  DESC;";
                            $result = $link->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "Team: " . $row["BT_Name"] . ".........Player: " . $row["name"] . "......... " . $bp . ": " . $row[$bp] . "<br>";
                                }
                            } else {
                                echo "0 results";
                            }
                        }
                        mysqli_close($link);
                        ?>
                        <hr />

                        <h2>Check if BasketballTeam have played at every arena</h2>
                        <form method="POST" action="test.php">
                            <input type="hidden" id="DivisionQueryRequest" name="DivisionQueryRequest">
                            BasketballTeam Name: <input type="text" name="BTNamediv"> <br /><br />
                            <input type="submit" value="Find" name="divideSubmit"></p>
                        </form>

                        <?php
                        $link = mysqli_connect("localhost", "root", $pass, "cpsc304");

                        if ($link === false) {
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }

                        if (isset($_POST['divideSubmit'])) {
                            $BTNamediv = $_POST['BTNamediv'];
                            $sql = "SELECT c.BT_Name FROM BasketballTeam  c WHERE c.BT_Name = '$BTNamediv' AND c.BT_Name = (SELECT B.BT_Name FROM BasketballTeam B 
                            WHERE NOT EXISTS ((SELECT A.A_Name, A.A_Location FROM Arena A) EXCEPT (SELECT P.A_Name, P.A_Location FROM Played P WHERE P.BT_Name = B.BT_Name)))";

                            $result = $link->query($sql);
                            if (!empty($result) && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo $row["BT_Name"] . " has played in every arena.";
                                }
                            } else {
                                echo "Sorry, " . $BTNamediv . " has not played in every arena.";
                            }
                        }
                        mysqli_close($link);
                        ?>

                        <hr />


                        <h2>Current Basketball Teams Avaliable:</h2>

                        <?php
                        $link = mysqli_connect("localhost", "root", $pass, "cpsc304");

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
                        // Close connection
                        mysqli_close($link);
                        ?>
                        <h2>Current Contracts:</h2>

<?php
$link = mysqli_connect("localhost", "root", $pass, "cpsc304");

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "SELECT * FROM has_a_contract";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "BP_Id: " . $row["BP_Id"] . "......... Contract Amount: " . $row["Contract_Money"] ."<br>";
    }
} else {
    echo "0 results";
}
// Close connection
mysqli_close($link);
?>


    </body>

</html>