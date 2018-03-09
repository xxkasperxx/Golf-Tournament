<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
<script src="scripts/jquery.validate.js" type="text/javascript">
        </script>
        <script src="scripts/jquery.validation.functions.js" type="text/javascript">
        </script>
<script type="text/javascript">
            jQuery(function(){
                jQuery("#playerdrop").validate({
                     expression: "if (VAL != '0') return true; else return false;",
                    message: "Please make a selection"
                });
            });
</script>
</head>
<?php
session_start();
include("config2.php");
global $dropdown;
global $firstn;
global $lastn;
global $address;
global $ccnum;
global $expdate;
global $phone;
global $city;
global $state;
global $zip;
global $country;
global $topay;
if ((!isset($_POST['usernamepost']))&&(!isset($_POST['test2']))){
echo "<html>
<body>
	<p>
		<form action='' method='POST'>
			Username:<input type='text' name='username'><br>
			Password:<input type='password' name='password'><br>
			<input type='submit' name='usernamepost' value='Log In'>
		</form>
	</p>";

}


	if (isset($_POST['usernamepost']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		if ($username&&$password)
		{
		 
	
			$query = mysql_query("SELECT * FROM users WHERE teamnum='$username'");



		 
			$numrows = mysql_numrows($query); 
		 
			 if ($numrows!=0)	// code to login
			{
			
				while ($row = mysql_fetch_assoc($query))
				{
				
					$dbusername = $row['teamnum'];	// gets the username (teamnum) and password (password) to compare it to what is posted
					$dbpassword = $row['password'];
				
				}
				
				// check to see if the match!
				if($username==$dbusername&&$password==$dbpassword)
				{
				
					$_SESSION['loggedin'] = TRUE;
					$_SESSION['teamnum'] = $username;
					
					// Start getting player information
					$sql = "SELECT * FROM players WHERE teamnum='$username'";	// Gets all information from the Players table who has their team number set as the one entered that was assigned to user name
					$result = mysql_query($sql);

					
					echo "<table>
							<tr> <!-- Headers | Name | Phone # | Email | Arrial Date | Departure Date | Paid | Owed |  Going to need to be outsite the while loop -->
								<td>Name</td>
								<td>Ranking</td>
								<td>Country Club</td>
								<td>Phone Number</td>
								<td>Email</td>
								<td>Arrival Date</td>
								<td>Departure Date</td>
								<td>Airline</td>
								<td>Flight #</td>
								<td>Paid</td>
								<td>Balance</td>
							</tr>";
							
					// While a row of data exists, put that row in $row as an associative array	
					while ($row = mysql_fetch_assoc($result)) {
					
					echo '<tr> <!-- Row 2 Needs to echo out each set of data using php... Going to need to be inside the while loop -->';

						echo '<td>'.$row["name"].'</td>';	// Echos out the names
						echo '<td>'.$row["rank"].'</td>';	// Echos out the names
						echo "<td>".$row['club'].'</td>';  // Echos the club name
						echo "<td>".$row['phone'].'</td>';  // Echos the phone number
						echo "<td>".$row['email'].'</td>';  // Echos the email
						echo "<td>".$row['arrival'].'</td>';  // Echos the arrival date
						echo "<td>".$row['depart'].'</td>';  // Echos the departure date
						echo "<td>".$row['airline'].'</td>';  // Echos the departure date
						echo "<td>".$row['flightnum'].'</td>';  // Echos the departure date
						
						if ($row['paid'] == 0) // Start checks for paid and owed
						{
							echo '<td>'.'$'.$row['paid'].'</td>';
						}elseif ($row['paid'] > 0)
						{
							$paid = $row['paid']; // Assigns the information from the DB to $paid
							$owed = 4500 - $paid; // Subtracts 4500 from what they have paid (stored in DB as paid)
							echo '<td>'.'$'.$row['paid'].'</td>';  // Tells how much they have paid
							echo '<td>'.'$'.$owed.'</td>';  // Tells how much they owe using the $owed variable that does all the work
						}  // End paid/owed checks
						
						
						
						/*echo "Club Name:  ".$row['club'];  // Echos the club name
						echo "Phone Number:  ".$row['phone'];  // Echos the phone number
						echo "Email:  ".$row['email'];  // Echos the email
						echo "Arrival Date:  ".$row['arrival'];  // Echos the arrival date
						echo "Departure Date:   ".$row['depart'];  // Echos the departure date*/
					}
					echo "</tr></table>";
					// Start getting player information
					$sql2 = "SELECT * FROM players WHERE teamnum='$username'";	// Gets all information from the Players table who has their team number set as the one entered that was assigned to user name
					$result2 = mysql_query($sql2);
					echo '<form action="" method="POST">';
					echo "<select id='playersdrop' name='dropdown'>";
					echo "<option>None</option>";
					while ($row2 = mysql_fetch_assoc($result2)) {
						echo "<option>".$row2['name']."</option>";
					}
					echo "</select>";
					
					echo '
							<br>
							Address:<input type="text" name="address"><br>
							Amount to Pay:<input type="text" name="pay"><br>
							Credit Card Number:<input type="text" name="ccnum"><br>
							Exp Date:<input type="text" name="expdate"><br>
							Phone:<input type="text" name="phone"><br>
							City:<input type="text" name="city"><br>
							State:<input type="text" name="state"><br>
							Zip:<input type="text" name="zip"><br>
							Country:<input type="text" name="country"><br>
							<input type="submit" name="test2" value="Submit">
						</form>';
					
					if (isset($_POST['test2'])){
						//$dropdown = $_POST['dropdown'];
						$firstn = $_POST['firstn'];
						$lastn = $_POST['lastn'];
						$address = $_POST['address'];
						$ccnum = $_POST['ccnum'];
						$expdate = $_POST['expdate'];
						$phone = $_POST['phone'];
						$city = $_POST['city'];
						$state = $_POST['state'];
						$zip = $_POST['zip'];
						$country = $_POST['country'];
						$topay = $_POST['pay'];
					}
					?>
				
					<html>
					<body>
						<p>your logged in</p>
					</body>
					</html>
					<?php
				}else {
					echo "Username or password is incorrect!";
				}	
			}
		}
	}
	if (isset($_POST['test2']))
	{

		if(isset($_POST['dropdown'])=="None")
		{
	// SEND EMAIL TO PROCESS CARD..
			$dropdown = $_POST['dropdown'];
			//$firstn = $_POST['firstn'];
			//$lastn = $_POST['lastn'];
			$address = $_POST['address'];
			$ccnum = $_POST['ccnum'];
			$expdate = $_POST['expdate'];
			$phone = $_POST['phone'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$zip = $_POST['zip'];
			$country = $_POST['country'];
			$topay = $_POST['pay'];
			echo $dropdown."<br>";
			echo $firstn."<br>";
			echo $lastn."<br>";
			echo $address."<br>";
			echo $ccnum."<br>";
			echo $expdate."<br>";
			echo $phone."<br>";
			echo $city."<br>";
			echo $state."<br>";
			echo $country."<br>";
			echo $topay."<br>";
			
			$queryp=mysql_query("SELECT paid FROM players WHERE name='$dropdown'");
			$querypay=mysql_fetch_array($queryp);
			
			echo "querypay: ".$querypay['paid'];
			
			$updatepay = $topay + $querypay['paid'];
			
			
	$to = "levi@kasperwebdesigns.com";
	$subject = "Test mail";
	$message = "
		Address: ".$address."
		Amount Payed: ".$topay."
		Credit Card Number: ".$ccnum."
		Experation Date: ".$expdate."
		City: ".$city."
		State: ".$state."
		Zip: ".$zip."
		Country: ".$country."
		Phone: ".$phone."
	
	";
	$from = "someonelse@example.com";
	$headers = "From: Online Regisration";
	mail('levi@kasperwebdesigns.com',$subject,$message,$headers);
			
			$result = mysql_query("UPDATE players SET paid='$updatepay' WHERE name='$dropdown'");
	}else {
		echo "Please Choose a name";
	}
	}

?>
</body>
</html>
