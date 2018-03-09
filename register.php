<?php
session_start();
include("config.php");
?>
<html>
	<head>
		<link href="css/lbels.css" rel="stylesheet" type="text/css" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
	</head>
<body>

<p>
	<form name="reg" action="code_exec.php" method="post">
		<table width="320" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr>
			<td>
				<?php
					$query = mysql_query("SELECT * FROM users");
					$numrows = mysql_numrows($query);
					$teamnumber = $numrows+1;
				//	echo "Team Number: ".$teamnumber." ";
					
					$length = 6;
					$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
				//	echo $randomString;
					$_SESSION['teamname'] = $teamnumber;
					$_SESSION['password'] = $randomString;
				?>
			</td>
		</tr>
		  <tr>
			<td width="95"><div align="right">First Name:</div></td>
			<td width="171"><input type="text" name="fname" /></td>
		  </tr>
		  <tr>
			<td><div align="right">Last Name:</div></td>
			<td><input type="text" name="lname" /></td>
		  </tr>
		  <tr>
			<td width><div align="right">Rank:</div></td>
			<td>
				<select id="rank" name="rank" onChange="myFunction()">
					<option value="Amateur">Amateur</option>
					<option value="Pro">Pro</option>
				</select> 
			</td>
		  </tr>
		  <tr id="ssnum">
		  		<td><div align="right">Social Security Number:</div></td>
				<td><input type="text" name="ssnum" /></td>
		  </tr>
		  <tr>
			<td><div align="right">Address:</div></td>
			<td><input type="text" name="address" /></td>
		  </tr>
		  <tr>
			<td><div align="right">Contact No.:</div></td>
			<td><input type="text" name="contact" /></td>
		  </tr>
		  <tr>
			<td><div align="right">Country Club:</div></td>
			<td><input type="text" name="club" /></td>
		  </tr>
		 <tr>
			<td><div align="right">Email:</div></td>
			<td><input type="text" name="email" /></td>
		  </tr>
		  <tr>
			<td><div align="right">Arrival:</div></td>
			<td><input type="text" name="arrival" /></td>
		  </tr>
		  <tr>
			<td><div align="right">Departure:</div></td>
			<td><input type="text" name="departure" /></td>
		  </tr>
		  <tr>
			<td><div align="right">Airline:</div></td>
			<td><input type="text" name="airline" /></td>
		  </tr>
		  <tr>
			<td><div align="right">Flight Number:</div></td>
			<td><input type="text" name="fnum" /></td>
		  </tr>
		  <tr>
			<td><div align="right">Spouse: Additional Cost: + $495.00</div></td>
			<td>
				<input type="radio" name="spouse" id="yes" value="Yes" onClick="myFunction()" />Yes
				<input type="radio" name="spouse" id="no" value="No" onClick="myFunction()" checked />No
			</td>
		  </tr>
		  <tr id="div_name">
				<td><div align="right">Spouse's First Name</div></td>
				<td><input type="text" name="sfname" /></td>
		  </tr>
		  <tr id="div_name1">
				<td><div align="right">Spouse's Last Name</div></td>
				<td><input type="text" name="slname" /></td>
		  </tr>
		  <tr id="div_name2">
				<td><div align="right">Balance:</div></td>
				<td><input type="text" id="spay" name="spay" value="2025.00"></input></td>
		  </tr>
		  <tr>
			<td><div align="right"></div></td>
			<td><input name="submit" type="submit" value="Submit" /></td>
		  </tr>
		</table>
	</form>
	<p>
	
	</p>
	<script>
		$(document).ready(function(){
		$("#ssnum").hide(0);
		$("#div_name").hide(0);
		$("#div_name1").hide(0);
         $(":radio:eq(0)").click(function(){
             $("#div_name").show(0);
             $("#div_name1").show(0);
          });

          $(":radio:eq(1)").click(function(){
             $("#div_name").hide(0);
             $("#div_name1").hide(0);
          });
		  
		
		  
		  
		  $("#spay").change(function(){
    alert("The text has been changed.");
  });
	  
  });
function myFunction()
{
   var rank = $( "#rank option:selected" ).text();
   var totalPro = 0;
   var totalAmmy = 2025.00;
   var spPro = 395.00;
   var spAmmy = 495.00;
   
	if (rank == "Pro"){
		if ($('input[id=no]:checked').length > 0) {
			$("input#spay").val("00.00");
			//$('p').append("test no spouse");
			
		}
		if ($('input[id=yes]:checked').length > 0) {
			//$('p').append("pro yes");
			$("input#spay").val("395.00");
		}
		
		$("#ssnum").show(0);
}

 if (rank == "Amateur"){
				if ($('input[id=no]:checked').length > 0) {
			$("input#spay").val("2025.00");
		//	$('p').append("ammy no");
		}
		
		if ($('input[id=yes]:checked').length > 0) {
			$("input#spay").val("2520.00");
		//	$('p').append("ammy yes");
		}
		
		  $("#ssnum").hide(0);
	 }
	  		

}
</script>

</body>
</html>