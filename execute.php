<?php
session_start();
include('config.php');
	if (isset($_POST['test2'])){			// REGISTER NEW PLAYER
		//$dropdown = $_POST['dropdown'];
		$query = mysql_query("SELECT * FROM players");
		$numrows = mysql_numrows($query);
		$id = $numrows+2;
		//echo $id+1;
		$dropdown = $_POST['rank'];
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
		$firstn = $_POST['fname'];
		$lastn = $_POST['lname'];
		$wholename = $firstn." ".$lastn;
		$address = $_POST['address'];
		$ccnum = $_POST['ccnum'];	// NO DB
		$expdate = $_POST['expdate'];	// NO DB
		$csv = $_POST['csv'];
		$contact = $_POST['phone'];
		$email =$_POST['email'];
		$city = $_POST['city'];		//NO DB
		$state = $_POST['state'];	// NO DB
		$zip = $_POST['zip'];		// NO DB
		$country = $_POST['country']; // COUNTRY CLUB
		$arrival = $_POST['arrival'];
		$departure = $_POST['departure'];
		$airline = $_POST['airline'];
		$flightnumber = $_POST['fnum'];
		$spouse = $_POST['spouse'];
		$topay = $_POST['spay'];
		$sfname = $_POST['sfname'];
		$slname = $_POST['slname'];
		$room = $_POST['rooms'];
		
		
		
		
		//echo "orgional airline".$airline;
		$to = "info@internationalproam.com,levi@kasperwebdesigns.com,jdbill@sbcglobal.net";
		$subject = "'$wholename' has been added to a team!";
		$message = "
		Team Number: ".$password."
		Name: ".$wholename."
		Address: ".$address."
		Amount Payed: ".$topay."
		Credit Card Number: ".$ccnum."
		Experation Date: ".$expdate."
		CSV: ".$csv."
		City: ".$city."
		State: ".$state."
		Zip: ".$zip."
		Country: ".$country."
		Phone: ".$contact."
		Room: ".$room."
		Spouse/Companion: ".$spouse."
		Spouse/Companion First Name: ".$sfname."
		Spouse/Companion Last Name: ".$slname."
		
	";
	$from = "Info@kasperwebdesigns.com";
	$headers = "From: Online Regisration";
	mail($to,$subject,$message,$headers);
		
		mysql_query("INSERT INTO players (id, numteam, teamnum, name, rank, paid, club, phone, email, arrival, depart, airline, flightnum, spouse) VALUES( '$id', '$password', '$username', '$wholename', '$dropdown', '$topay', '$country', '$contact', '$email', '$arrival', '$departure', '$airline', '$flightnumber', '$spouse') ") 
		or die(mysql_error());  
		
		header('Location: http://internationalproam.com/thank-you---registered.html');
		
	}
	if (isset($_POST['test3']))		// Pay/Change info
	{
	
	
	// SEND EMAIL TO PROCESS CARD..
			$username = $_SESSION['username'];
			$password = $_SESSION['password'];
			
$query = mysql_query("SELECT * FROM players");
					$numrows = mysql_numrows($query);
		
			//$id = $numrows+1;
			$dropdown = $_POST['dropdown'];
			$address = $_POST['address'];
			$ccnum = $_POST['ccnum'];
			$expdate = $_POST['expdate'];
			$contact = $_POST['phone'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$zip = $_POST['zip'];
			$country =$_POST['country'];
			//$clubname = $_POST['clubname'];
			$topay = $_POST['pay']; 
			$email = $_POST['email'];
			$csv = $_POST['csv'];
			$spouse = $_POST['spouse'];
						$arrival = $_POST['arrival'];
						$departure = $_POST['departure'];
						$airline = $_POST['airline'];
						$flightnum = $_POST['fnum'];
		//	echo "drop".$dropdown."<br>";
			//echo "address".$address."<br>";
			//echo "cc#".$ccnum."<br>";
			//echo "exp".$expdate."<br>";
			//echo "phone#".$contact."<br>";
			//echo "city".$city."<br>";
			//echo "state".$state."<br>";
			//echo "csv".$csv."<br>";
			//echo "spouse".$spouse."<br>";
//echo $country."<br>";
	//		echo $topay."<br>";
	
	$testid = mysql_query("SELECT * FROM players WHERE name='$dropdown'");
$id_row=mysql_fetch_array($testid);
	
	
			//$sql48=mysql_query("SELECT airline FROM players WHERE name='$dropdown'");
			//$id = mysql_query($sql48);
		//	$id = mysql_fetch_array($sql48);
			$id = $id_row['id'];
		//	$id = $id+1;
			//echo "<Br> ID: ".$id."<Br>";
		//	echo "<Br> sql: ".$testid."<Br>";
			$queryp=mysql_query("SELECT paid FROM players WHERE name='$dropdown'");
			$querypay=mysql_fetch_array($queryp);
			
			//echo "querypay: ".$querypay['paid'];
			
			$updatepay = $topay + $querypay['paid'];
			
	//echo "airline: ".$airline;
		if (empty($airline))
		{
			$sql2 = "SELECT airline FROM players WHERE name='$dropdown'";	// Gets all information from the Players table who has their team number set as the one entered that was assigned to user name
			$result2 = mysql_query($sql2);
		//	echo "Inside airline function<br>";
			
			while ($row2 = mysql_fetch_assoc($result2)) {
				$airline = $row2['airline'];
			}
			//	echo "airline: ".$airline;
		}
		
		// GET RANK AND KEEP IT THE SAME
			$sql3 = "SELECT rank FROM players WHERE name='$dropdown'";	// Gets all information from the Players table who has their team number set as the one entered that was assigned to user name
			$result3 = mysql_query($sql3);
			
			while ($row3 = mysql_fetch_assoc($result3)) {
				$rank = $row3['rank'];
			}
			
			// GET CLUB AND KEEP IT THE SAME
			$sql4 = "SELECT club FROM players WHERE name='$dropdown'";	// Gets all information from the Players table who has their team number set as the one entered that was assigned to user name
			$result4 = mysql_query($sql4);
			
			while ($row4 = mysql_fetch_assoc($result4)) {
				$clubname = $row4['club'];
			}
	
	
	if (empty($contact))		// KEEP PHNE THE SAME
		{
			$sql5 = "SELECT phone FROM players WHERE name='$dropdown'";	// Gets all information from the Players table who has their team number set as the one entered that was assigned to user name
			$result5 = mysql_query($sql5);
		//	echo "Inside phone function<br>";
			
			while ($row5 = mysql_fetch_assoc($result5)) {
				$contact = $row5['phone'];
			}
		}
		
		
		if (empty($email))		// KEEP EMAIL THE SAME
		{
			$sql6 = "SELECT email FROM players WHERE name='$dropdown'";	// Gets all information from the Players table who has their team number set as the one entered that was assigned to user name
			$result6 = mysql_query($sql6);
			//echo "Inside EMAIL function<br>";
			
			while ($row6 = mysql_fetch_assoc($result6)) {
				$email = $row6['email'];
			}
		}
		
		
		if (empty($arrival))		// KEEP arrival THE SAME
		{
			$sql7 = "SELECT arrival FROM players WHERE name='$dropdown'";	// Gets all information from the Players table who has their team number set as the one entered that was assigned to user name
			$result7 = mysql_query($sql7);
			//echo "Inside airlinez function<br>";
			
			while ($row7 = mysql_fetch_assoc($result7)) {
				$arrival = $row7['arrival'];
			}
		}
		
		if (empty($departure))		// KEEP depart THE SAME
		{
			$sql8 = "SELECT depart FROM players WHERE name='$dropdown'";	// Gets all information from the Players table who has their team number set as the one entered that was assigned to user name
			$result8 = mysql_query($sql8);
			//echo "Inside airline function<br>";
			
			while ($row8 = mysql_fetch_assoc($result8)) {
				$departure = $row8['depart'];
			}
		}
		
		if (empty($flightnum))		// KEEP flightnum THE SAME
		{
			$sql9 = "SELECT flightnum FROM players WHERE name='$dropdown'";	// Gets all information from the Players table who has their team number set as the one entered that was assigned to user name
			$result9 = mysql_query($sql9);
			//echo "Inside airline function<br>";
			
			while ($row9 = mysql_fetch_assoc($result9)) {
				$flightnum = $row9['flightnum'];
			}
		}
		
		if (empty($spouse))		// KEEP spouse THE SAME
		{
			$sql10 = "SELECT spouse FROM players WHERE name='$dropdown'";	// Gets all information from the Players table who has their team number set as the one entered that was assigned to user name
			$result10 = mysql_query($sql10);
			//echo "Inside airline function<br>";
			
			while ($row10 = mysql_fetch_assoc($result10)) {
				$spouse = $row10['spouse'];
			}
		}
		

		
	
	
			
	//$to = "info@internationalproam.com ,levi@kasperwebdesigns.com";
	$to = "info@internationalproam.com,levi@kasperwebdesigns.com,jdbill@sbcglobal.net";
	$subject = "Player has Changed Information!";
	$message = "
		Team Number: ".$password."
		Name: ".$dropdown."
		Address: ".$address."
		Amount Payed: ".$topay."
		Credit Card Number: ".$ccnum."
		Experation Date: ".$expdate."
		CSV: ".$csv."
		City: ".$city."
		State: ".$state."
		Zip: ".$zip."
		Country: ".$country."
		Phone: ".$contact."
		Email :".$email."
		Arrival :".$arrival."
		Departure :".$departure."
		Airline :".$airline."
		Flight Number :".$flightnum.""
		
	;
	$from = 'Info@kasperwebdesigns.com';
	$headers = "From: Online Regisration";
	$mailcopyfile = 'email_backup/email_backup.txt';
	$fp = fopen($mailcopyfile, "a"); 
fputs($fp, $to . $subject . $message . $headers );
fclose($fp);
	
	mail($to,$subject,$message,$headers);
			
			//echo $dropdown;
			//$result = mysql_query("UPDATE players SET paid='$updatepay' WHERE name='$dropdown'");
			$insertinto = mysql_query("UPDATE players SET id='$id', numteam ='$password', teamnum='$username', name='$dropdown', rank='$rank', paid='$updatepay', club='$clubname', phone='$contact', email='$email', arrival='$arrival', depart='$departure', airline='$airline', flightnum='$flightnum', spouse='$spouse' WHERE name='$dropdown'") 
			or die(mysql_error()); 
			header('Location: http://internationalproam.com/thank-you---registered.html');
	}else {
		echo "Please contact us, there has been 5 people registered for this team.";
	}

	

	
?>