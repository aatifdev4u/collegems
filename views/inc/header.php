<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>college management system</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>"/>
	<script src="<?php echo base_url('assets/js/jquery-3.1.0.js');?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
	<style>
		.buttons{
			padding: 4px 10px;
			background-color: white;
			color: grey;
			border: 1px solid grey;
			border-radius: 19%;
		}
	</style>
</head>
<body>

	<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand" href="#">COLLEGE MANAGEMENT SYSTEM</a>
	</nav> -->
	<nav class="navbar navbar-inverse" style="background-color: #2780e3;">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#" style="color: #fff;">COLLEGE MANAGEMENT SYSTEM</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<?php $role_id = $this->session->userdata('role_id'); ?>
				<?php if($role_id == '1'): ?>
				<li><?php echo anchor("admin/dashboard", "Dashboard", ['class' => 'btn btn-success']); ?></li>
				<li><?php echo anchor("admin/coadmins", "Views CoAdmins", ['class' => 'btn btn-default']); ?></li>
				<li><?php echo anchor("welcome/logout", "Logout",  ['class' => 'btn btn-info']); ?></li>
				<?php else: ?>
				<li><?php echo anchor("welcome/logout", "Logout",  ['class' => 'btn btn-info']); ?></li>
				<?php endif ?>
			</ul>
			<!-- <div class="col-lg-2" style="margin-top: 15px;" id="bs-example-navbar-collapse-2">
				<div class="btn-group">
					<a href="#" class="btn btn-default">Settings</a>
					<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li></li>
						<li><?php echo anchor("welcome/logout", "Logout"); ?></li>
					</ul>
				</div>
			</div> -->
		</div>
	</nav>
</body>