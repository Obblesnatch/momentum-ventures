<h1>Welcome to Trip Builder</h1>

<?php if(isset($error)): ?>
<div class="col-md-12">
	<?php echo $errorMessage;?>
</div>
<?php endif; ?>

<?php if(isset($trip)):?>
	<div class="trip-info">
		Total Cost: <?php echo $trip['total'];?>
		<div class="trip-flights">
			<?php foreach($trip['flights'] as $flight): ?>
				<div class="row">
					<div class="col-md-12">
						<div class="flight-result">
							<div class="col-md-3">
								<span>Flight Number: <?php echo $flight->number;?></span>
							</div>
							<div class="col-md-3">
								<span>Depart From: <?php echo $flight->depart_name.' ('.$flight->depart_code.')';?></span><br/>
								<span>Depart At: <?php echo date('H:i', strtotime($flight->departure));?></span>
							</div>
							<div class="col-md-3">
								<span>Arrive to: <?php echo $flight->arrival_name.' ('.$flight->arrival_code.')';?></span><br/>
								<span>Arrive At: <?php echo date('H:i', strtotime($flight->departure.' +'.$flight->duration.' hours'));?></span>
							</div>
							<div class="col-md-3">
								<span>Cost: <?php echo $flight->cost;?></span>
								<form action="trip/delete" method="post">
									<input type="hidden" name="flight_id" value="<?php echo $flight->id;?>" />
									<input type="submit" value="Delete Flight" />
								</form>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach;?>
		</div>
		<div class="col-md-3">
			<form action="trip/delete" method="post">
				<input type="submit" class="btn btn-danger" value="Clear Trip" />
			</form>
		</div>
	</div>
<?php else: ?>
	<div class="col-md-12">
		<h3>You have nothing in your trip</h3>
	</div>
<?php endif; ?>

<div class="col-md-12">
	<div class="form">
		<form action="/" method="get" id="search">
			<div class="form-group">
				<label for="departure_airport_select">Departure Airport</label>
				<select id="departure_airport_select" class="form-control" form="search" name="depart_from" data-component="select">
					<?php foreach($airports as $airport):?>
						<option value="<?php echo $airport->id;?>" <?php if(isset($request) && $request->depart_from == $airport->id):?> selected="selected" <?php endif;?>><?php echo $airport->name.' ('.$airport->code.')';?></option>
					<?php endforeach;?>
				</select>
			</div>
			<div class="form-group">
				<label for="arrival_airport_select">Destination</label>
				<select id="arrival_airport_select" class="form-control" form="search" name="destination" data-component="select">
					<option value="-1">Select Destination Airport</option>
					<?php foreach($airports as $airport):?>
						<option value="<?php echo $airport->id;?>" <?php if(isset($request) && $request->destination == $airport->id):?> selected="selected" <?php endif;?>><?php echo $airport->name.' ('.$airport->code.')';?></option>
					<?php endforeach;?>
				</select>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-success" value="Search.." />
			</div>
		</form>
		<!-- Where we would stick filters for departure date -->
	</div>
	<div class="grid">
		<div class="grid-result" data-component="flight-results">
			<?php if(isset($flights)): ?>
				<?php $i = 0;?>
				<?php foreach($flights as $flight):?>
					<div class="row">
						<div class="col-md-12">
							<div class="flight-result">
								<div class="col-md-3">
									<span>Flight Number: <?php echo $flight->number;?></span>
								</div>
								<div class="col-md-3">
									<span>Depart From: <?php echo $flight->depart_name.' ('.$flight->depart_code.')';?></span><br/>
									<span>Depart At: <?php echo date('H:i', strtotime($flight->departure));?></span>
								</div>
								<div class="col-md-3">
									<span>Arrive to: <?php echo $flight->arrival_name.' ('.$flight->arrival_code.')';?></span><br/>
									<span>Arrive At: <?php echo date('H:i', strtotime($flight->departure.' +'.$flight->duration.' hours'));?></span>
								</div>
								<div class="col-md-3">
									<span>Cost: $<?php echo $flight->cost;?></span><br/>
									<form action="trip/post" method="post">
										<input type="hidden" name="id" value="<?php echo $flight->id;?>" />
										<input type="submit" class="btn btn-primary" value="Add Flight to Trip" />
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php $i++;?>
				<?php endforeach;?>
				<?php if($i === 0): ?>
					<h3>There were no results for this selection</h3>
				<?php endif;?>
			<?php else: ?>
			<h3>Please select departure airport and optional arrival airport</h3>
			<?php endif; ?>
		</div>
	</div>
</div>