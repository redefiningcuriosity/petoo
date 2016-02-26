<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-6">
				<h1 class="page-header">Current Outlets</h1>
			</div>
			<div class="col-lg-6" style=" text-align: right">
				<h1><a class="btn btn-primary" href="<?php echo base_url().'home/add'?>">Add Outlet</a></h1>
			</div>
		</div><!--/.row-->

		<div class="row">
		<?php $count=0; ?>
		<?php foreach($query->result() as $row): ?>
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<a href="<?php echo base_url().'home/view/'.$row->id ?>" style="color: #FFFFFF" title="View Outlet"><b><?php echo $row->name ?></b></a>
					<a href="<?php echo base_url().'home/delete/'.$row->id ?>" class="pull-right" onclick="return confirm('Do you want to proceed to delete this outlet?')" ><span style="color: #FFFFFF" class="glyphicon glyphicon-remove" title="Delete Outlet"></span></a><a href="<?php echo base_url().'home/edit/'.$row->id ?>" class="pull-right" onclick="return confirm('Do you want to proceed to edit this outlet?')"><span style="color: #FFFFFF" class="glyphicon glyphicon-pencil" title="Edit Outlet"></span></a><a href="<?php echo base_url().'home/convert/'.$row->id ?>" class="pull-right" onclick="return confirm('Do you want to download this outlet details as PDF?')"><span style="color: #FFFFFF" class="glyphicon glyphicon-check" title="Download PDF"></span></a>
					</div>
					<div class="panel-body">
						<p><i>Manager name: </i> <b><?php echo $row->mgr_name ?></b></p>
						<p><i>Manager phone: </i> <b><?php echo $row->mgr_phno ?></b></p>
						<p><i>Latitude: </i> <b><?php echo $row->lat ?></b></p>
						<p><i>Longitude: </i> <b><?php echo $row->lon ?></b></p>
						<p><i>Area Covered: </i> <b><?php echo $row->area_covered ?></b></p>
					</div>
				</div>
			</div>
		<?php $count = $count+1;
			if($count%2==0) echo "</div> \n <div class=\"row\">";  endforeach; ?>
		</div>

</div>
