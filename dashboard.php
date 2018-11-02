<!--
Zeljko Bareta - IM Associate, Belgrade, Serbia
work e-mail:	BARETA@unhcr.org
private e-mail:	zbareta@gmail.com
mobile:			+38163 366 158
skype: 			zeljko.bareta
-->
<html lang="en">
	<head>
		<?php include("functions.php");?>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>BPM-IMS Search</title>
	</head>
	<body style="font-family:arial; font-size: 13; width:80%; margin:20 auto;" onload="myFunction()">
	<?php if (!isset($_POST['url'])){header('Location: index.php');exit;}?>

	<div>
		<img src="BPM_horizontal.png" alt="BPM Logo" style="max-width: 100%; height: auto;">
		</br></br>
		<form method="GET" action="index.php">
			<input type="hidden" name="action" value="Logged_out" ?>
			<input type="submit" value='Log Out'></form>

		<form method="POST" action="index.php">
			<input type="hidden" name="url" value=<?php echo $_POST['url'] ?>>
			<input type="hidden" name="username" value=<?php echo $_POST['username'] ?>>
			<input type="hidden" name="password" value=<?php echo $_POST['password'] ?>>
			<input type="submit" value='Search'></form>

<?php if ($_POST['url'] == "https://kobocat.unhcr.org/bpmser/forms/apwMFLxovHc7GwML7Udhyr/api"){?>

		<!-- Power BI dashboard embed code goes here -->
<?php } ?>

<?php if ($_POST['url'] == "https://kobocat.unhcr.org/kosbpm/forms/a2AhTCg5faiPxwuQjbmDM4/api"){?>

		<!-- Power BI dashboard embed code goes here -->
	
<?php } ?>

<?php if ($_POST['url'] == "https://kobocat.unhcr.org/espbpm/forms/an2dEZHPHRVeFdvzHNS5Tj/api"){?>

		<!-- Power BI dashboard embed code goes here -->
	
<?php } ?>

<?php if ($_POST['url'] == "https://kobocat.unhcr.org/bpmmkd/forms/apQ8Hjje8uUUqscK4Ypmb8/api"){?>

		<!-- Power BI dashboard embed code goes here -->
<?php } ?>

<?php if ($_POST['url'] == "https://kobocat.unhcr.org/bpmbih/forms/atVf4LismHSf6brUPHvXCb/api"){?>

		<!-- Power BI dashboard embed code goes here -->
<?php } ?>

<?php if ($_POST['url'] == "https://kobocat.unhcr.org/unhcrbgr/forms/aUyfBMz6sgTY32sSGKmqeu/api"){?>

	<!-- Power BI dashboard embed code goes here -->
		
	<?php } ?>

<?php if ($_POST['url'] == "https://kobocat.unhcr.org/mnebpm/forms/aY6QgqahCbuicbQVFumtbV/api"){?>

	<!-- Power BI dashboard embed code goes here -->
	
<?php } ?>

<?php if ($_POST['url'] == "https://kobocat.unhcr.org/ebbpm/forms/aaosGUEkojjVtGyJ7MXTvy/api"){?>

		<iframe width="100%" height="100%" src="https://app.powerbi.com/view?r=eyJrIjoiYzEwMzI0NGItNjQ5Mi00ZGI1LWEwZDctNWM2Mzg0ZWU3OWYzIiwidCI6IjUwMDA0YWMxLWIwYmQtNGY4MS05N2QzLTc5NGExNGU3Mjk2NyIsImMiOjh9" frameborder="0" allowFullScreen="true"></iframe><br><br>

		<iframe width="100%" height="100%" src="https://app.powerbi.com/view?r=eyJrIjoiOTZiODViMWItNDc0ZS00YzQ5LWFhZjYtMDI3OWUxMDM2MThkIiwidCI6IjUwMDA0YWMxLWIwYmQtNGY4MS05N2QzLTc5NGExNGU3Mjk2NyIsImMiOjh9" frameborder="0" allowFullScreen="true"></iframe><br><br>

		<iframe width="100%" height="100%" src="https://app.powerbi.com/view?r=eyJrIjoiM2ZjMTAxYTItMWZlMi00MTQ2LTkzNDEtMDI1MjU1MTM2YWFkIiwidCI6IjUwMDA0YWMxLWIwYmQtNGY4MS05N2QzLTc5NGExNGU3Mjk2NyIsImMiOjh9" frameborder="0" allowFullScreen="true"></iframe><br><br>

<?php } ?>

<?php if ($_POST['url'] == "https://kobocat.unhcr.org/grcbpm/forms/aZRkjF9ddM3zZViMBC82Ho/api"){?>

		<iframe width="100%" height="100%" src="https://app.powerbi.com/view?r=eyJrIjoiNjRkYTAwZjAtNmQ0Yy00NzY0LWFkZWMtZWUxNWVlMWE4NTgwIiwidCI6IjUwMDA0YWMxLWIwYmQtNGY4MS05N2QzLTc5NGExNGU3Mjk2NyIsImMiOjh9" frameborder="0" allowFullScreen="true"></iframe>

<?php } ?>


	</div>
		
	</body>
</html>
