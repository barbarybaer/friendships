<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Friends</title>
	<style type="text/css">
		th, td{
			border: 1px solid black ;
			padding: 5px;
			border-collapse: collapse;
		}
		table{
			border: 1px solid black ;
			border-collapse: collapse;
		}
		
	</style>
</head>
<body>
	<a href='logoff'>Logout</a>
	<h1>Hello, <?=$this->session->userdata['currentUser']['alias']?>!</h1>
<?php
	 
	if (count($userFriends) > 0) {
?>
		<h2>Here is the list of your friends:</h2>
		<table>
			<tr>
				<th>Alias</th>
				<th>Action</th>
			</tr>
<?php   foreach($userFriends as $friend){
?>			<tr>
				<td><?=$friend['friend_alias']?></td>
				<td><a href="user/<?=$friend['friend_id']?>">View Profile</a>
					<a href="remove/<?=$friend['friend_id']?>">Remove as Friend</a></td>
			</tr>
<?php
		}
?>		
<?php
	}
	else {
?>
		<h2>You don't have friends yet.</h2>
<?php
	}
?>
		</table>
	<h2>Other Users not on your friends list: </h2>
	<table>
		<tr>
			<th>Alias</th>
			<th>Action</th>
		</tr>
<?php  foreach($otherFriends as $friend){
?>			
		<tr>
			<td><a href="user/<?=$friend['user_id']?>"><?=$friend['user_alias']?></a></td>
			<td><a href="add/<?=$friend['user_id']?>">Add as Friend</a></td>
		</tr>
<?php }
?>
	</table>
	
</body>
</html>