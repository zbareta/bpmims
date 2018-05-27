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
		<title>BPM-IMS Quick Report</title>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
		<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" class="init">
		$(document).ready(function() {
		$('#data').DataTable();
		} );
		</script>
		<style>
			#loader {
			  position: absolute;
			  left: 50%;
			  top: 50%;
			  z-index: 1;
			  width: 150px;
			  height: 150px;
			  margin: -75px 0 0 -75px;
			  border: 16px solid #00AE9A;
			  border-radius: 50%;
			  border-top: 16px solid #000000;
			  width: 120px;
			  height: 120px;
			  -webkit-animation: spin 2s linear infinite;
			  animation: spin 2s linear infinite;
			}
			@-webkit-keyframes spin {
			  0% { -webkit-transform: rotate(0deg); }
			  100% { -webkit-transform: rotate(360deg); }
			}

			@keyframes spin {
			  0% { transform: rotate(0deg); }
			  100% { transform: rotate(360deg); }
			}

			/* Add animation to "page content" */
			.animate-bottom {
			  position: relative;
			  -webkit-animation-name: animatebottom;
			  -webkit-animation-duration: 1s;
			  animation-name: animatebottom;
			  animation-duration: 1s
			}
			@-webkit-keyframes animatebottom {
			  from { bottom:-100px; opacity:0 } 
			  to { bottom:0px; opacity:1 }
			}
			@keyframes animatebottom { 
			  from{ bottom:-100px; opacity:0 } 
			  to{ bottom:0; opacity:1 }
			}
			#myDiv {
			  display: none;
			  text-align: center;
			}
		</style>
		<?php
		if (!isset($_POST['username'])){header('Location: index.php');}
		$grouprows = 0;
		$username = test_input($_POST['username']);
		$password = test_input($_POST['password']);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_URL, test_input($_POST['url']));
		curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		$resp = curl_exec($curl);
		$forms = json_decode($resp,true);
		if($errno = curl_errno($curl)) {
			$error_message = curl_strerror($errno);
			echo "Error: Could not connect to KoBo database. Please try again later.";
		}

		curl_close($curl);
		$item_id = $_POST['id'];
		$field = '_id';
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			function getRow($forms, $field, $item_id)
				{
				   foreach($forms as $key => $form)
				   {
				      if ( $form[$field] == $item_id )
				         return $key;
				   }
				   return false;
				}}
		$formId = getRow($forms, $field, $item_id);

		?>

	</head>
	<body style="font-family:arial; font-size: 13; width:80%; margin:20 auto;" onload="myFunction()">
		<div id="loader"></div>
		<div style="display:none;" id="myDiv" class="animate-bottom"></div>
		<script>
			var myVar;
			function myFunction() {
			    myVar = setTimeout(showPage, 1000);
			}
			function showPage() {
			  document.getElementById("loader").style.display = "none";
			  document.getElementById("myDiv").style.display = "block";
			}
		</script>
		<div align="center">
			<img src="BPM_horizontal.png" alt="BPM Logo" style="max-width: 100%; height: auto;">
			</br></br>
		<div align="left">
		<form method="GET" action="index.php">
			<input type="hidden" name="action" value="Logged_out" ?>
			<input type="submit" value='Log Out'></form>

		<form method="POST" action="index.php">
			<input type="hidden" name="url" value=<?php echo $_POST['url'] ?>>
			<input type="hidden" name="username" value=<?php echo $_POST['username'] ?>>
			<input type="hidden" name="password" value=<?php echo $_POST['password'] ?>>
			<input type="submit" value='Search'></form>
		
		<form method="POST" action="dashboard.php">
			<input type="hidden" name="url" value=<?php echo $_POST['url'] ?>>
			<input type="hidden" name="username" value=<?php echo $_POST['username'] ?>>
			<input type="hidden" name="password" value=<?php echo $_POST['password'] ?>>
			<input type="submit" value='View Dashboard'></form>
		</div>
		<div>
			<table style="width:100%; font-size: 13">
				<tr height="20px">
					<td colspan="4" height="20px">
					</td>
				</tr>
				<tr>
					<td colspan="4", bgcolor="#00AE9A", align="center" style="color: white; font-size: 15">
						<strong>QUICK FORM - METADATA</strong>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Reporting Country:</strong>
					</td>
					<td>
						<?php echo str_replace("MACEDONIA", "FYR MACEDONIA", strtoupper($forms[$formId]['M/M01-RepCountry']))?>
					</td>
					<td>
						<strong>Reporting Organization:</strong>
					</td>
					<td>
						<?php echo strtoupper($forms[$formId]['M/M02-RepOrg']);?>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Reported Event(s):</strong>
					</td>
					<td>
						<?php echo str_replace("OTHER_PROTECTI", "OTHER", str_replace("SMUGGLING_INCI", "SMUGGLING", str_replace("PUSHBACK_INCID", "PUSHBACK", str_replace("SPOTTED_ARRIVA", "ARRIVAL", str_replace(" ", ", ", strtoupper($forms[$formId]['M05-RepEvent']))))))?>
					</td>
					<td>
						<strong>Reporting Person:</strong>
					</td>
					<td>
						<?php  if (!isset($forms[$formId]['M/M03-RepIndv'])){ echo "NO DATA";} else echo $forms[$formId]['M/M03-RepIndv'];?>
					</td>
					<tr height="20px">
					<td>
						<strong>Reporting Date:</strong>
					</td>
					<td>
						<?php  if (!isset($forms[$formId]['M/M04-RepDate'])){ echo "NO DATA";} else echo $forms[$formId]['M/M04-RepDate'];?>
					</td>					
				</tr>
				</tr>
				<tr height="20px">
					<tr height="20px">
					<td colspan="4" height="20px">
					</td>
				</tr>
				<tr>
					<td colspan="4", bgcolor="#00AE9A", align="center" style="color: white; font-size: 15">
						<strong>SOURCE OF INFORMATION</strong>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Information Source:</strong>
					</td>
					<td>
						<?php echo str_replace("NGO CIVIL SOCIETY", "NGO / CIVIL SOCIETY", str_replace("REFUGEE MIGRANT", "REFUGEE / MIGRANT", str_replace("_", " ", strtoupper($forms[$formId]['SI/SI01-Source']))))?>
					</td>
					<td>
						<strong>Link to Source:</strong>
					</td>
					<td>
						<?php  if (!isset($forms[$formId]['SI/SI02-Link'])){ echo "NO DATA";} else echo $forms[$formId]['SI/SI02-Link'];?>
					</td>
				</tr>
				<tr height="20px">
					<tr height="20px">
					<td colspan="4" height="20px">
					</td>
				</tr>
				<tr>
					<td colspan="4", bgcolor="#00AE9A", align="center" style="color: white; font-size: 15">
						<strong>EVENT IDENTIFICATION</strong>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Event Code:</strong>
					</td>
					<td>
						<?php if (!isset($forms[$formId]['ID/ID01-Code'])){ echo "NO DATA";}else echo $forms[$formId]['ID/ID01-Code'];?>
					</td>
					<td>
						<strong>Included in Dashboard:</strong>
					</td>
					<td>
						<?php if(isset($forms[$formId]['ID/ID02-Included'])){ echo strtoupper($forms[$formId]['ID/ID02-Included']);}else echo "No Data";?>
					</td>
					<tr height="20px">
					<tr height="20px">
					<td colspan="4" height="20px">
					</td>
				</tr>
				
						<?php if (!isset($forms[$formId]['A/A01-Date'])){?>
				<tr height="20px">
					<td colspan="4", bgcolor="#545454", align="center" style="color: white; font-size: 15">
						<strong>NO ARRIVAL RECORD</strong>
					</td>
				</tr>
				<tr height="20px">
					<tr height="20px">
					<td colspan="4" height="20px">
					</td>
				</tr>
			<?php }else{?>
				<tr height="20px">
					<td colspan="4" height="20px">
					</td>
				</tr>
				<tr>
					<td colspan="4", bgcolor="#00AE9A", align="center" style="color: white; font-size: 15">
						<strong>ARRIVAL INFORMATION</strong>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Arrival Date:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['A/A01-Date'])){ echo "NO DATA";}else echo $forms[$formId]['A/A01-Date'];?>
					</td>
					<td>
						<strong>Date Type:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['A/A02-DateType'])){ echo "NO DATA";}else echo strtoupper(($forms[$formId]['A/A02-DateType']));?>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Location - Region:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['A/A04-Admin2Loc'])){ echo "NO DATA";}else echo str_replace("_", " ", strtoupper(($forms[$formId]['A/A04-Admin2Loc'])));?>
					<td>
						<strong>Location - Municipality:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['A/A041-Municipality'])){ echo "NO DATA";}else echo str_replace("_", " ", strtoupper(($forms[$formId]['A/A041-Municipality'])));?>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Location - Details:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['A/A042-Location'])){ echo "NO DATA";}else echo str_replace("_", " ", strtoupper(($forms[$formId]['A/A042-Location'])));?>
					</td>
					<td></td>
					<td></td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Arrival Type:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['A/A05-ArrivalType'])){ echo "NO DATA";}else echo str_replace("_", " ", strtoupper(($forms[$formId]['A/A05-ArrivalType'])));?>
					</td>
					<td>
						<strong>Sea Arrival - Specify:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['A/A06-SeaArrival'])){ echo "NO DATA";}else echo str_replace("_", " ", strtoupper(($forms[$formId]['A/A06-SeaArrival'])));?>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Comments:</strong>
					</td>
					<td colspan="3">
						<?php if(!isset($forms[$formId]['A/A07-Comments'])){ echo "NO DATA";}else echo($forms[$formId]['A/A07-Comments']);?>
					</td>
				</tr>
				<?php }?>
				<tr height="20px">
					<tr height="20px">
					<td colspan="4" height="20px">
					</td>
				</tr>

						<?php if (!isset($forms[$formId]['PB/PB04-To'])){?>
				<tr height="20px">
					<td colspan="4", bgcolor="#545454", align="center" style="color: white; font-size: 15">
						<strong>NO PUSHBACK RECORD</strong>
					</td>
				</tr>
				<tr height="20px">
					<tr height="20px">
					<td colspan="4" height="20px">
					</td>
				</tr>
			<?php }else{?>
				<tr height="20px">
					<td colspan="4" height="20px">
					</td>
				</tr>
				<tr>
					<td colspan="4", bgcolor="#00AE9A", align="center" style="color: white; font-size: 15">
						<strong>PUSHBACK INFORMATION</strong>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Incident Date:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['PB/PB01-Date'])){ echo "NO DATA";}else echo $forms[$formId]['PB/PB01-Date'];?>
					</td>
					<td>
						<strong>Date Type:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['PB/PB02-DateType'])){ echo "NO DATA";}else echo strtoupper(($forms[$formId]['PB/PB02-DateType']));?>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Pushback From:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['PB/PB03-From'])){ echo "NO DATA";}else echo str_replace("_", " ", strtoupper(($forms[$formId]['PB/PB03-From'])));?>
					</td>
					<td>
						<strong>Entered Country From:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['PB/PB05-ArrivedFrom'])){ echo "NO DATA";}else echo str_replace("_", " ", strtoupper(($forms[$formId]['PB/PB05-ArrivedFrom'])));?>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Pushback To:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['PB/PB04-To'])){ echo "NO DATA";}else echo str_replace("_", " ", strtoupper(($forms[$formId]['PB/PB04-To'])));?>
					</td>
					<td>
						<strong>Requested Vol. Irreg. Return:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['PB/PB07-Voluntary'])){ echo "NO DATA";}else echo strtoupper($forms[$formId]['PB/PB07-Voluntary']);?>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Violence Used:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['PB/PB06-Violence'])){ echo "NO DATA";}else echo  str_replace("ARBITRARY ARREST", "ARBITRARY ARREST/DETENTION",str_replace("THEFT EXTORTION", "THEFT/EXTORTION",str_replace("DENIAL ASYLUM", "DENIAL OF ASYLUM", str_replace("_", " ", str_replace(" ", ", ", strtoupper($forms[$formId]['PB/PB06-Violence']))))));?>
					</td>
					<td>
					</td>
					<td>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Comments:</strong>
					</td>
					<td colspan="3">
						<?php if(!isset($forms[$formId]['PB/PB08-Comments'])){ echo "NO DATA";}else echo($forms[$formId]['PB/PB08-Comments']);?>
					</td>
				</tr>
				<?php }?>
						<?php if (!isset($forms[$formId]['SM/SM04-To'])){?>
				<tr height="20px">
					<td colspan="4", bgcolor="#545454", align="center" style="color: white; font-size: 15">
						<strong>NO SMUGGLING RECORD</strong>
					</td>
				</tr>
				<tr height="20px">
					<tr height="20px">
					<td colspan="4" height="20px">
					</td>
				</tr>
			<?php }else{?>
				<tr height="20px">
					<td colspan="4" height="20px">
					</td>
				</tr>
				<tr>
					<td colspan="4", bgcolor="#00AE9A", align="center" style="color: white; font-size: 15">
						<strong>SMUGGLING INFORMATION</strong>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Incident Date:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['SM/SM01-Date'])){ echo "NO DATA";}else echo $forms[$formId]['SM/SM01-Date'];?>
					</td>
					<td>
						<strong>Date Type:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['SM/SM02-DateType'])){ echo "NO DATA";}else echo strtoupper(($forms[$formId]['SM/SM02-DateType']));?>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Smuggled From:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['SM/SM03-From'])){ echo "NO DATA";}else echo str_replace("_", " ", strtoupper(($forms[$formId]['SM/SM03-From'])));?>
					<td>
						<strong>Smuggling Fees:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['SM/SM05-Fees'])){ echo "NO DATA";}else echo str_replace("_", " ", strtoupper(($forms[$formId]['SM/SM05-Fees']))) . " euro";?>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Smuggled To:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['SM/SM04-To'])){ echo "NO DATA";}else echo str_replace("_", " ", strtoupper(($forms[$formId]['SM/SM04-To'])));?>
					</td>
					<td></td>
					<td></td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Violence Used:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['SM/SM06-Violence'])){ echo "NO DATA";}else echo  str_replace("RESTRICT MOVE", "RESTRICTION OF MOVEMENT",str_replace("ARBITRARY ARREST", "ARBITRARY ARREST/DETENTION",str_replace("THEFT EXTORTION", "THEFT/EXTORTION",str_replace("DENIAL ASYLUM", "DENIAL OF ASYLUM", str_replace("_", " ", str_replace(" ", ", ", strtoupper($forms[$formId]['SM/SM06-Violence'])))))));?>
					</td>
					<td>
					</td>
					<td>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Comments:</strong>
					</td>
					<td colspan="3">
						<?php if(!isset($forms[$formId]['SM/SM07-Comments'])){ echo "NO DATA";}else echo($forms[$formId]['SM/SM07-Comments']);?>
					</td>
				</tr>
				<tr height="20px">
					<tr height="20px">
					<td colspan="4" height="20px">
					</td>
				</tr>
				<?php }?>
				</tr>
				<?php if (!isset($forms[$formId]['PR/PR01-Date'])){?>
				<tr height="20px">
					<td colspan="4", bgcolor="#545454", align="center" style="color: white; font-size: 15">
						<strong>NO OTHER PROTECTION / SECURITY RECORD</strong>
					</td>
				</tr>
				<tr height="20px">
					<tr height="20px">
					<td colspan="4" height="20px">
					</td>
				</tr>
			<?php }else{?>
				<tr>
					<td colspan="4", bgcolor="#00AE9A", align="center" style="color: white; font-size: 15">
						<strong>OTHER PROTECTION / SECURITY INFORMATION</strong>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Incident Date:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['PR/PR01-Date'])){ echo "NO DATA";}else echo $forms[$formId]['PR/PR01-Date'];?>
					</td>
					<td>
						<strong>Date Type:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['PR/PR02-DateType'])){ echo "NO DATA";}else echo strtoupper(($forms[$formId]['PR/PR02-DateType']));?>
					</td>
				</tr>
				
				<tr height="20px">
					<td>
						<strong>Violence Used:</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['PB/PB06-Violence'])){ echo "NO DATA";}else echo  str_replace("ARBITRARY ARREST", "ARBITRARY ARREST/DETENTION",str_replace("THEFT EXTORTION", "THEFT/EXTORTION",str_replace("DENIAL ASYLUM", "DENIAL OF ASYLUM", str_replace("_", " ", str_replace(" ", ", ", strtoupper($forms[$formId]['PB/PB06-Violence']))))));?>
					</td>
					<td>
						<strong>Alleged Perpetrator(s):</strong>
					</td>
					<td>
						<?php if(!isset($forms[$formId]['PR/PR04-Perpetrator'])){ echo "NO DATA";}else echo str_replace("UN NGO STAFF VOLUNTEER", "UN / NGO - STAFF / VOLUNTEER",str_replace("OTHER MIGRANT REFUGEE", "OTHER MIGRANT / REFUGEE",str_replace("_", " ",strtoupper($forms[$formId]['PR/PR04-Perpetrator']))));?>
					</td>
				</tr>
				<tr height="20px">
					<td>
						<strong>Comments:</strong>
					</td>
					<td colspan="3">
						<?php if(!isset($forms[$formId]['PR/PR05-Comments'])){ echo "NO DATA";}else echo($forms[$formId]['PR/PR05-Comments']);?>
					</td>
				</tr>
				<tr height="20px">
					<tr height="20px">
					<td colspan="4" height="20px">
					</td>
				</tr>
				<?php }?>
			</table>
			<table style="width:100%;">
				<tr height="20px">
					<td  bgcolor="#00AE9A", align="center" style="color: white; font-size: 15">
						<strong>GROUP INFORMATION</strong>
					</td>
				</tr>



			</table>
			<table id="data" class="display" style="width:100%; font-size: 13;">
				
					<?php if (isset($forms[$formId]['Poc/Poc_001'])){ $grouprows += 1;?>
						<tr align="center">
							<th><strong>Nationality</strong></th>
							<th><strong>Gender</strong></th>
							<th><strong>Age</strong></th>
							<th><strong>#Persons</strong></th>
							<th><strong>#UASC</strong></th>
						</tr>
						<?php foreach($forms[$formId]['Poc/Poc_001'] as $poc)
							{
								?>
								<tr>
									<td align="center"><?php if(!isset($poc['Poc/Poc_001/Poc01-Nationality'])){ echo "NO DATA";}else echo str_replace("_", " ", strtoupper(($poc['Poc/Poc_001/Poc01-Nationality'])));?></td>
									<td align="center"><?php if(!isset($poc['Poc/Poc_001/Poc02-Gender'])){ echo "NO DATA";}else echo str_replace("UNKNOW", "UNKNOWN", strtoupper(($poc['Poc/Poc_001/Poc02-Gender'])));?></td>
									<td align="center"><?php if(!isset($poc['Poc/Poc_001/Poc03-Age'])){ echo "NO DATA";}else echo str_replace("UNKNOW", "UNKNOWN", strtoupper(($poc['Poc/Poc_001/Poc03-Age'])));?></td>
									<td align="center"><?php if(!isset($poc['Poc/Poc_001/Poc04-Number'])){ echo "NO DATA";}else echo($poc['Poc/Poc_001/Poc04-Number']);?></td>
									<td align="center"><?php if(!isset($poc['Poc/Poc_001/PoC05-UAM'])){ echo "NO DATA";}else echo($poc['Poc/Poc_001/PoC05-UAM']);?></td>
								</tr><?php }}
									if ($grouprows == 0){?><tr><td colspan="5" align="center"><?php echo "NO GROUP INFORMATION RECORDED";?> </td></tr><?php }
									if ($grouprows != 0){?><tr><td colspan="5"><br><strong>Transit Country: </strong><?php if (!isset($forms[$formId])){echo "No Data";}else echo str_replace("MACEDONIA", "FYR MACEDONIA", strtoupper($forms[$formId]['A/A03-TransitCountry']))?> <br>
										<br><strong>#Persons that applied for asylum: </strong><?php if (!isset($forms[$formId]['Poc/Poc06-AsylumApplication'])){echo "No Data";}else echo($forms[$formId]['Poc/Poc06-AsylumApplication']);?><br>
										<br><strong>Comments related to group: </strong><?php if (!isset($forms[$formId]['Poc/Poc07-Comments'])){echo "No Data";}else echo($forms[$formId]['Poc/Poc07-Comments']);?>
										</td></tr><?php }?>
			</table>
		</div>
	</body>
</html>