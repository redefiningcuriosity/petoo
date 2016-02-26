<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				
			</div>
		</form>
		<ul class="nav menu">
			<li <?php if($title == "Home") echo "class='active'" ?>><a href="<?php echo base_url()?>home"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
			<li <?php if($title == "Profile") echo "class='active'" ?>><a href="<?php echo base_url()?>profile"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
			<li role="presentation" class="divider"></li>
		</ul>
	</div><!--/.sidebar-->
