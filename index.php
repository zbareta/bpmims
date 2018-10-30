<!--
Zeljko Bareta - IM Associate, Belgrade, Serbia
work e-mail:	BARETA@unhcr.org
private e-mail:	zbareta@gmail.com
mobile:			+38163 366 158
skype: 			zeljko.bareta
-->
<?php ob_start(); ?>
<html lang="en">
	<head>
		<?php include("functions.php");?>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>BPM-IMS Search</title>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
		<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
		<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
		<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function() {
			    
			    $('#data').DataTable( {
			        dom: 'Bfrtip',
			        lengthMenu: [
			            [ 10, 50, 100, -1 ],
			            [ '10 rows', '50 rows', '100 rows', 'Show all' ]
			        ],
			        buttons: [
			            'pageLength', 'copy', 'excel'
			        ]
			    } );
		    // Setup - add a text input to each footer cell
		    $('#data tfoot th').each( function () {
		        var title = $(this).text();
		        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
		    } );
		 
		    // DataTable
		    var table = $('#data').DataTable();
		 
		    // Apply the search
		    table.columns().every( function () {
		        var that = this;
		 
		        $( 'input', this.footer() ).on( 'keyup change', function () {
		            if ( that.search() !== this.value ) {
		                that
		                    .search( this.value )
		                    .draw();
		            }
		        } );
		    } );
		} );

		</script>
		<style>
			tfoot {
			    display: table-header-group;
}
			tfoot input {
		      width: 100%;
		      padding: 3px;
		      box-sizing: border-box;
		    }
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
		
		if (!isset($_POST['username'])){?>
		<div align="center">
			<img src="BPM_vertical.png" alt="BPM Logo" style="max-width: 100%; height: auto; align">
			<form action="" method="post">
				Username:<br>
				<input style="width: 200px"  type="text" name="username"><br><br>
				Password:<br>
				<input style="width: 200px" type="password" name="password"><br><br>
				Country:<br>
				<select style="width: 200px" name="url">
					<option value="no">--Select Operation--</option>
				    <option value="https://kobocat.unhcr.org/bpmalb/forms/aYyHgtnMV9uY4FF37rShbR/api">Albania</option>
				    <option value="https://kobocat.unhcr.org/bpmbih/forms/atVf4LismHSf6brUPHvXCb/api">Bosnia & Herzegovina</option>
				    <option value="https://kobocat.unhcr.org/unhcrbgr/forms/aUyfBMz6sgTY32sSGKmqeu/api">Bulgaria</option>
				    <option value="https://kobocat.unhcr.org/grcbpm/forms/aZRkjF9ddM3zZViMBC82Ho/api">Greece</option>
				    <option value="https://kobocat.unhcr.org/kosbpm/forms/a2AhTCg5faiPxwuQjbmDM4/api">Kosovo</option>
				    <option value="https://kobocat.unhcr.org/bpmmkd/forms/apQ8Hjje8uUUqscK4Ypmb8/api">FYR Macedonia</option>
				    <option value="https://kobocat.unhcr.org/mnebpm/forms/aY6QgqahCbuicbQVFumtbV/api">Montenegro</option>
				    <option value="https://kobocat.unhcr.org/bpmser/forms/apwMFLxovHc7GwML7Udhyr/api">Serbia</option>
				    <option value="https://kobocat.unhcr.org/espbpm/forms/an2dEZHPHRVeFdvzHNS5Tj/api">Spain</option>
			 	</select><br><br>
				<input type="submit" value="login">
			</form>
		<p style="font-style: italic;">Please use the KoBo username and password associated with the selected country operation.</br>
		If you do not have the required credentials, please contact your UNHCR IM focal point.</br>
		In order to edit records through "KoBo Link", you need to be logged in to KoBo Toolbox sepparately.</p>
		</div>
		<div align="center" style="color: red">
		<?php if (isset($_POST["username"])){echo $error;}?>
		</div>
		<?php
		}else{
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
		curl_close($curl);?>
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
		<img src="BPM_horizontal.png" alt="BPM Logo" style="max-width: 100%; height: auto;">
		</br></br>
		<form method="GET" action="index.php">
			<input type="hidden" name="action" value="Logged_out" ?>
			<input type="submit" value='Log Out'></form>
		<div>
		<form method="POST" action="dashboard.php">
			<input type="hidden" name="url" value=<?php echo $_POST['url'] ?>>
			<input type="hidden" name="username" value=<?php echo $_POST['username'] ?>>
			<input type="hidden" name="password" value=<?php echo $_POST['password'] ?>>
			<input type="submit" value='View Dashboard'></form>
		<div>
			<table id="data" class="display" cellspacing="0" width="100%" style="font-family:arial; font-size: 13">
				<thead>
					<tr>
						<th>Quick Form (Link)</th>
						<th>KoBo Link</th>
						<th>ID</th>
						<th>Event Code</th>
						<th>Type of Event</th>
						<th>Pushback From</th>
						<th>Pushback - Violence</th>
						<th>Event Location</th>
						<th>Transit Country</th>
						<th>Group Information</th>
						<th>#Persons</th>
						<th>#UASC</th>
						<th>Reporting Date</th>
						<th>Reporting Organization / Person</th>
						<th>Displayed</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Open</th>
						<th>Link</th>
						<th>ID</th>
						<th>Code</th>
						<th>Event</th>
						<th>Pushback From</th>
						<th>Pushback - Violence</th>
						<th>Location</th>
						<th>Transit Country</th>
						<th>Group</th>
						<th>#Persons</th>
						<th>#UASC</th>
						<th>Date</th>
						<th>Org. / Person</th>
						<th>Displayed</th>
					</tr>
				</tfoot>
				<tbody>
				<?php
					$total_poc = 0;
					$total_uasc = 0;
					if (!is_array($forms)){
						ob_end_clean();
						header('Location: index.php');
						ob_end_flush();
						;
					}
					foreach($forms as $item){?>
					<tr>
						<td>
							<form method="POST" action="view.php?_id=<?php echo $item['_id']?>">
							<input type="hidden" name="url" value=<?php echo $_POST['url'] ?>>
							<input type="hidden" name="username" value=<?php echo $_POST['username'] ?>>
							<input type="hidden" name="password" value=<?php echo $_POST['password'] ?>>
							<input type="hidden" name="id" value=<?php echo $item['_id'] ?>>
							<input type="submit" value='Open'></form>
						<td width="7%"><a href=<?php echo substr($_POST['url'], 0, -4) . "/instance#/"?><?php echo $item['_id']?>>KoBo Link</a></td>
						<td><?php echo $item['_id'];?></td>
						<td><?php if(isset($item['ID/ID01-Code'])){ echo $item['ID/ID01-Code'];}else echo "No Data";?></td>
						<td><?php echo str_replace("OTHER_PROTECTI", "OTHER", str_replace("SMUGGLING_INCI", "SMUGGLING", str_replace("PUSHBACK_INCID", "PUSHBACK", str_replace("SPOTTED_ARRIVA", "ARRIVAL", str_replace(" ", ", ", strtoupper($item['M05-RepEvent']))))))?></td>
						<td><?php if(isset($item['PB/PB03-From'])){echo strtoupper($item['PB/PB03-From']);}else{ echo "N/A";}?></td>
						<td><?php if(isset($item['PB/PB06-Violence'])){echo str_replace("ARBITRARY ARREST", "ARBITRARY ARREST/DETENTION",str_replace("THEFT EXTORTION", "THEFT/EXTORTION",str_replace("DENIAL ASYLUM", "DENIAL OF ASYLUM", str_replace("_", " ", str_replace(" ", ", ", strtoupper($item['PB/PB06-Violence']))))));}else{ echo "No Data";}?></td>

						<td><?php if(isset($item['A/A04-Admin2Loc'])){echo str_replace("_", " ", strtoupper($item['A/A04-Admin2Loc'])) . ", " . str_replace("_", " ", strtoupper($item['A/A041-Municipality']));}?></td>
						<td><?php if(isset($item['A/A03-TransitCountry'])){echo str_replace("MACEDONIA", "FYR MACEDONIA", strtoupper($item['A/A03-TransitCountry']));}?></td>
						<td width="25%"; style ="font-size: 8"><?php if (isset($item['Poc/Poc_001'])){ foreach($item['Poc/Poc_001'] as $poc)
							{
								echo $poc['Poc/Poc_001/Poc04-Number'] . " " . strtoupper($poc['Poc/Poc_001/Poc02-Gender']) . " " . strtoupper($poc['Poc/Poc_001/Poc03-Age']) . " from " . str_replace("MACEDONIA", "FYR MACEDONIA",str_replace("_", " ", strtoupper($poc['Poc/Poc_001/Poc01-Nationality']))); if(isset($poc['Poc/Poc_001/PoC05-UAM'])){ echo ", #UASC: " .  strtoupper($poc['Poc/Poc_001/PoC05-UAM']) . "; <br>";}else echo ", #UASC: 0;<br>";
							}} else echo "No Data";?>
						</td>						
						<td>
							<?php if (isset($item['Poc/Poc_001'])){ foreach($item['Poc/Poc_001'] as $poc)
							{	
								$total_poc += $poc['Poc/Poc_001/Poc04-Number'];
							} echo $total_poc;} else echo "No Data";?>
								
						</td>
						<?php
						$total_poc = 0;
						$total_uasc = 0;
						?>
						<td>
							<?php if (isset($item['Poc/Poc_001'])){ foreach($item['Poc/Poc_001'] as $poc)
							{
								if(isset($poc['Poc/Poc_001/PoC05-UAM'])){ $total_uasc += $poc['Poc/Poc_001/PoC05-UAM'];};
							}echo $total_uasc;} else echo "No Data";?>
								
						</td>
						<td><?php if(isset($item['M/M04-RepDate'])){echo($item['M/M04-RepDate']);}?></td>
						<td><?php echo strtoupper($item['M/M02-RepOrg']);
						
						 if (isset($item['M/M03-RepIndv'])){echo " / " . $item['M/M03-RepIndv'];};
						
						?></td>
						<td><?php echo strtoupper($item['ID/ID02-Included'])?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<?php } ?>
	</body>
</html>