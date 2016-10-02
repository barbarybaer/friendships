<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Profile</title>
	<style type="text/css">
		td{
			padding: 5px;
		}
	</style>
</head>
<body>
	<a href='/friends'>Home</a>
	<a href='/logoff'>Logout</a>
	<h2><?=$profile['alias']?>'s Profile</h2>
	<table>
		<tr>
			<td>Name: </td>
			<td><?=$profile['name']?></td>
		</tr>
		<tr>
			<td>Email Address: </td>
			<td><?=$profile['email']?></td>
		</tr>
	</table>
</body>
</html>