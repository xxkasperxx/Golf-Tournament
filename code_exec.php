<?php
session_start();
include('config.php');

	
$teamnumber = $_SESSION['teamname'];
$teamnumber = mysql_escape_string($teamnumber);
//echo $teamnumber;
$fname=$_POST['fname'];
$fname = mysql_escape_string($fname);
$lname=$_POST['lname'];
$lname = mysql_escape_string($lname);
$rank=$_POST['rank'];	// why wont you pass?
$rank = mysql_escape_string($rank);
$address=$_POST['address'];
$address = mysql_escape_string($address);
$city=$_POST['city'];
$city = mysql_escape_string($city);
$state=$_POST['state'];
$state = mysql_escape_string($state);
$zip=$_POST['zip'];
$zip = mysql_escape_string($zip);
$contact=$_POST['contact'];
$contact = mysql_escape_string($contact);
$email = $_POST['email'];
$email = mysql_escape_string($email);
$club=$_POST['club'];
$club = mysql_escape_string($club);
$balance=$_POST['spay'];
$balance = mysql_escape_string($balance);
$ccnum=$_POST['ccnum'];
$ccnum = mysql_escape_string($ccnum);
$expdate=$_POST['expdate'];
$expdate = mysql_escape_string($expdate);
$csv=$_POST['csv'];
$csv = mysql_escape_string($csv);
$ssnum = $_POST['ssnum'];
$ssnum = mysql_escape_string($ssnum);
$promotion = $_POST['promotion'];
$promotion = mysql_escape_string($promotion);
$wholename = $fname." ".$lname;
//echo $teamnumber;
	$query4 = mysql_query("SELECT * FROM players WHERE teamnum='$teamnumber'");		// Code to stop accepting after 5 people
			$numrows4 = mysql_numrows($query4); 
		if($numrows4!=5) {

		


$query = mysql_query("SELECT * FROM players");
					$numrows = mysql_numrows($query);
					$id = $numrows+2;
				//	echo "<Br />NUMROWS: ".$numrows;
				//	echo "<br />POLAYER ID: ".$id."<br />";
				//	echo $teamnumber;
					$query2 = mysql_query("SELECT * FROM users");
					$numrows2 = mysql_numrows($query2);
					$idsec = $numrows2+1;
				//	echo "<br /> ID: ".$idsec;
/*echo $fname;
echo $lname;
echo $rank;
echo $address;
echo $contact;
echo $club;
echo $balance;
echo $id;*/

mysql_query("INSERT INTO users 
(id, teamnum, login, password) VALUES('$idsec', '$teamnumber', '$lname', '$teamnumber' ) ") 
or die(mysql_error());  

mysql_query("INSERT INTO players (id, numteam, teamnum, name, rank, paid, club, phone, email, arrival, depart, airline, flightnum, spouse) VALUES( '$id', '$teamnumber', '$lname', '$wholename', '$rank', '$balance', '$club', '$contact', '$email', ' ', ' ', ' ', ' ', ' ') ") 
or die(mysql_error());  

$to = "info@internationalproam.com,levi@kasperwebdesigns.com,jdbill@sbcglobal.net";
	$subject = "New Team Register!";
	$message = "
		Team Number: ".$teamnumber."
		Full Name: ".$wholename."
		Player: ".$rank."
		Contact Number: ".$contact."
		Club: ".$club."
		Address: ".$address."
		City: ".$city."
		State: ".$state."
		Zip: ".$zip."
		Amount Payed: ".$balance."
		Credit Card Number: ".$ccnum."
		Experation Date: ".$expdate."
		Social Secuirty: ".$ssnum."
		CSV: ".$csv."
		Phone: ".$contact."
		Email: ".$email."
		Referral: ".$promotion."
	";
	$from = $email;
	$headers = "From: Online Regisration";
	mail($to,$subject,$message,$headers);
		$mailcopyfile = 'email_backup/register_backup.txt';
	$fp = fopen($mailcopyfile, "a"); 
fputs($fp, $to . $subject . $message . $headers );
fclose($fp);
	

$to = $email;
	$subject = "New Team Register!";
	$message = "
		Thank you reserving a Team for the 2013 Puerto Vallarta Pro Am.  Your deposit is fully refundable through October 1, 2013.

		You and your teammates can complete registration by visiting our website: www.puertovallartaproam.com.  Log in on the Registration page
		
		Team Log-In: ".$lname."
		Team Password: ".$teamnumber."
		
		Information can be edited in the future using the same access information.
	";
	$from = $email;
	$headers = "From: Golf Registration";
	mail($to,$subject,$message,$headers);
	
	header('Location: http://internationalproam.com/thank-you---reserve.html');
	
	}else {
		echo "Sorry, there have been 5 players already registered to this team.";
	}
?>