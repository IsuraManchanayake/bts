<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<?php include('includes/queries.php'); ?>	 
	<style type="text/css">
		.vcenter {
			display: inline-block;
			vertical-align: middle;
			float: none;
		}
	</style>
</head>
<body>

	<div id="container">
		<div class="row">
			<div id="filter-panel">
				<div class="panel panel-default" >
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-2">
								<div class="row">
									<div class="col-sm-3 vcenter">
										<label class="filter-col" for="pref-perpage" style="text-align: center;">From</label>
									</div><!--
									--><div class="col-sm-9 vcenter">
										<select id="from" class="form-control">
											<option selected style="color: silver">select</option>
											<?php
											$rows = get_all_location_names($mysqli);
											while($row = $rows->fetch_assoc()) {
												echo "<option>" . $row['townname'] . "</option>";
											}
											?> 
										</select>
									</div>
								</div>
							</div>

							<div class="col-sm-2">
								<div class="row">
									<div class="col-sm-3 vcenter">
										<label class="filter-col" for="pref-perpage" style="text-align: center;">To</label>
									</div><!--
									--><div class="col-sm-9 vcenter">
										<select id="to" class="form-control">
											<option selected style="color: silver">select</option>
											<?php
											$rows = get_all_location_names($mysqli);
											while($row = $rows->fetch_assoc()) {
												echo "<option>" . $row['townname'] . "</option>";
											}
											?>                   
										</select>
									</div>
								</div>  
							</div>

							<div class="col-sm-2">
								<div class="row">
									<div class="col-sm-3 vcenter">
										<label class="filter-col" style="text-align: center;">Date</label>
									</div><!--
									--><div class="col-sm-9 vcenter">
										<input id="date" type="date" value="<?php echo date("Y-m-d");?>" class="form-control input" id="pref-perpage">
									</div>
								</div>
							</div>

							<div class="col-sm-2">
								<div class="row">
									<div class="col-sm-3 vcenter">
										<label class="filter-col" style="text-align: center;">Time</label>
									</div><!--
									--><div class="col-sm-9 vcenter">
										<input id="at" type="time" class="form-control input" id="pref-perpage">
									</div>
								</div>
							</div>

							<div class="col-sm-2">
								<div class="row">
									<div class="col-sm-3 vcenter">
										<label class="filter-col" style="text-align: center; font-size: 11px">Bus Type</label>
									</div><!--
									--><div class="col-sm-9 vcenter">
										<select id="type" class="form-control">
											<option>Normal</option>
											<option>Semi-Luxury</option>
											<option>Luxury</option>
											<option>Super-Luxury</option>
										</select> 
									</div>
								</div>               
							</div>


							<div class="col-sm-2" >    
								<button class="btn btn-primary" style="width: 100%;" onclick="search()">
									<span>
										<i class="glyphicon glyphicon-search"></i>
									</span> Search
								</button>  
							</div>
						</div>
					</div>
				</div>
			</div>    
		</div>
	</div>

</body>
</html>