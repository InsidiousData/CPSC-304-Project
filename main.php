<!DOCTYPE html>
<html>
<body>
<h1>Basketball Repository</h1>
<?php
include 'connect.php';
$conn = OpenCon();
echo "Connected Successfully". "<br>";
$sql = "SELECT BT_Name, BT_Total_wins, BT_Total_losses, BT_Total_games_played FROM BasketballTeam";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "Name: " . $row["BT_Name"]. "<br>";
	}
} else {
	echo "0 results";
}
CloseCon($conn);
?>
</body>
</html>