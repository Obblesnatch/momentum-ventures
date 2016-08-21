<h1>Welcome to Trip Builder</h1>

<?php if(isset($error)): ?>
<div class="col-md-12">
	<?php echo $errorMessage;?>
</div>
<?php endif; ?>

<?php if(isset($trip)):?>
	<div class="trip-info">
		Cost: <?php echo $trip['total'];?>
		<div class="trip-flights">
			<?php foreach($trip['flights'] as $flight): ?>
				<div class="flight-result">
					<span>Flight Number: <?php echo $flight->number;?></span>
					<span>Depart From: <?php echo $flight->depart_name.' ('.$flight->depart_code.')';?></span>
					<span>Depart At: <?php echo date('H:i', strtotime($flight->departure));?></span>
					<span>Arrive to: <?php echo $flight->arrival_name.' ('.$flight->arrival_code.')';?></span>
					<span>Arrive At: <?php echo date('H:i', strtotime($flight->departure.' +'.$flight->duration.' hours'));?></span>
					<form action="trip/delete" method="post">
						<input type="hidden" name="flight_id" value="<?php echo $flight->id;?>" />
						<input type="submit" value="Delete Flight" />
					</form>
				</div>
			<?php endforeach;?>
		</div>
		<div class="col-md-3">
			<form action="trip/delete" method="post">
				<input type="submit" class="btn btn-danger" value="Clear Trip" />
			</form>
		</div>
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
				<?php foreach($flights as $flight):?>
					<div class="flight-result">
						<span>Flight Number: <?php echo $flight->number;?></span>
						<span>Depart From: <?php echo $flight->depart_name.' ('.$flight->depart_code.')';?></span>
						<span>Depart At: <?php echo date('H:i', strtotime($flight->departure));?></span>
						<span>Arrive to: <?php echo $flight->arrival_name.' ('.$flight->arrival_code.')';?></span>
						<span>Arrive At: <?php echo date('H:i', strtotime($flight->departure.' +'.$flight->duration.' hours'));?></span>
						<form action="trip/post" method="post">
							<input type="hidden" name="id" value="<?php echo $flight->id;?>" />
							<input type="submit" value="Add Flight to Trip" />
						</form>
					</div>
				<?php endforeach;?>
			<?php else: ?>
			<h3>Please select departure airport and optional arrival airport</h3>
			<?php endif; ?>
		</div>
	</div>
</div>