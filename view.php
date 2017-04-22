<?php

$page_title = 'View the Current Users';


echo '<h1 id="mainhead">Registered Users</h1>';

require_once ('DB.php');

$query = "SELECT full_name, username, user_id
	FROM users;

$result = @mysqli_query ($query);
$num = mysqli_num_rows($result);

if ($num>0){

	echo "<p>There are currently $num registered users.</p>\n";
	
	echo '<table align="center" cellspacing="0" cellpadding="5" border="2">
		<tr>
		<td align="left"><b>User ID</b></td>
		<td align="left"><b>Full Name</b></td>
		<td align="left"><b>Username</b></td>
		</tr>';
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		echo '<tr>
		<td align = "left">'. $row['user_id'].'</td>
		<td align = "left">'. $row['full_name'].'</td>
		<td align = "left">'. $row['username'].'</td>
		 </tr>';
	}
	echo '</table>';
			
	mysqli_free_result ($result);
}else{
	echo  '<p class="error"> There are currently no registered users.</p>';
}
mysqli_close();

?>