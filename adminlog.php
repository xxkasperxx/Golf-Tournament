<?php
include('config.php');

if ((!isset($_POST['usernamepost']))&&(!isset($_POST['test2']))){
echo "<html>
<body>
	<p>
		<form action='' method='POST' id='centerlogin'>
			Username:<input type='text' name='username'><br>
			Password:<input type='password' name='password'><br>
			<input type='submit' name='usernamepost' value='Log In'>
		</form>
	</p>";

}


		if ($_POST)
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		if ($username&&$password)
		{
		 

			$query2 = mysql_query("SELECT * FROM admin WHERE username='$username'");



		 
			$numrows = mysql_numrows($query2); 
		 
			 if ($numrows!=0)	// code to login
			{
			
				while ($row = mysql_fetch_assoc($query2))
				{
				
					$dbusername = $row['username'];
					$dbpassword = $row['password'];
				
				}
				
				// check to see if the match!
				if($username==$dbusername&&$password==$dbpassword)
				{
				
					$_SESSION['loggedin'] = TRUE;
					$_SESSION['username'] = $username;
				
									// Start getting player information
					$sql = "SELECT * FROM players";	// Gets all information from the Players table who has their team number set as the one entered that was assigned to user name
					$result = mysql_query($sql);
	

					
					echo "<table  width='1100px'>
							<tr> <!-- Headers | Name | Phone # | Email | Arrial Date | Departure Date | Paid | Owed |  Going to need to be outsite the while loop -->
								<td>Name</td>
								<td>Ranking</td>
								<td>Club Name:</td>
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
						
						if ($row['check'] != "approve")
						{
							echo "<td><input type='submit' value='Approve'></td>";
						}
						
						
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
				
					
				
					
					?>
				

					<?php
				}else {
					echo "Username or password is incorrect!";
				}	
			}
		}
	}
	
	

?>