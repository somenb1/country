<!--
	@ Program to find some data (Capital, Currency Code, Country Code, Languages) about all the Country in the World in ONE PLACE.
	@ Demo : http://www.somenbanerjee/country.
	@ Author: Somen Banerjee(somen.banerjee0@gmail.com)
-->
<?php
	// function for search country from database
		function country(){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$db = "country_data";

			// Create connection
			@$conn = new mysqli($servername, $username, $password, $db);
			if (! $conn->connect_error) {

				if (isset($_POST['submit'])) {
					$countryName = $_POST['countryName'];
					$countryName = stripcslashes($countryName);
					$countryName = mysql_real_escape_string($countryName);

					$like = addcslashes(mysql_real_escape_string($countryName), "%_");
					//echo $countryName;
						
						$sql = "SELECT * FROM countries WHERE countryName LIKE '%{$like}%'";
						
						$result = $conn->query($sql) or die('Database Error '.mysql_error());

						if ($result->num_rows > 0) {

							// output data of each row
						    while($row = $result->fetch_assoc()) {
				
						       	$s[] = $row;
						    }
						    return $s;
						} else {

						    echo "<h4 class='error'>No  Result Found</h4>";
						}
				}
					
			}else{
				die("<font style=color:red><br><br>Connection failed</font>");
			}
		}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Country </title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript">

		

	</script>
</head>
<body>
<div class="big-wrapper">
	<div class="heading">
		<h1>Find Country Capital</h1>
		<div class="sub-heading">
			<p>By Somen Banerjee<!-- [somen][dot][banerjee][0][@][gmail][.][com] --></p>
		</div>
	</div>
	<div class="main-panel">
		<div class="input-panel">
			<form action="" method="post">
				<input type="text" name="countryName" placeholder="Enter Country Name">
				<button type="submit" name="submit">Find</button>
			</form>
		</div>

			<?php 
				$row = country(); // function calling
			?>
			<?php
				if (! empty($row)) {
			?>
			<div class="output-panel">
			<div class="panel-heading">
				<h1>Result</h1>
			</div>
			<?php
				foreach ($row as $key => $value) {
					//print_r($row);
			?>

			<div class="panel-body">
				<div class="col-name">
					<h2>
						<?php echo $row[$key]['countryName'];?>
					</h2>
				</div>
				<div class="col-info">

					<p><span>Capital</span> - <?php echo $row[$key]['capital'];?></p>
					<p><span>Currency Code</span> - <?php echo $row[$key]['currencyCode'];?></p>
					<p><span>Country Code</span> - <?php echo $row[$key]['countryCode'];?></p>
					<p><span>Languages</span> - <?php echo $row[$key]['languages'];?></p>

				</div>
			</div>
			<?php
				}
			}
			?>
			
		</div>
	</div>
</div>
</body>
</html>
