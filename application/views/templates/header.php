<html>
<head>
<title>CI Blog</title>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">

<script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="<?php echo base_url();?>">CI Blog</a>

			<div class="collapse navbar-collapse" id="navbarColor02">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active"><a class="nav-link" href="<?php echo base_url();?>">Home<span class="sr-only">(current)</span></a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>about">About</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>posts">Blog</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>categories">Categories</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<?php if(!$this->session->userdata('logged_in')):?>
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>users/login">Login</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>users/register">Register</a></li>
					<?php endif; ?>
					<?php if($this->session->userdata('logged_in')):?>
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>posts/create">Create Post</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>categories/create">Create Category</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>users/logout">Logout</a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container"> 
		
		<!-- Flash Message -->
		<?php 
		if($this->session->flashdata('user_registered')): ?>
			<p class="alert alert-success" style="margin-top: 5px">
				<?php print_r($this->session->flashdata('user_registered'));?> 
			</p>  

		<?php endif; ?>

		<?php 
		if($this->session->flashdata('login_failed')): ?>
			
			<p class="alert alert-danger" style="margin-top: 5px">
				<?php print_r($this->session->flashdata('login_failed'));?> 
			</p>  

		<?php endif; ?>

		<?php 
		if($this->session->flashdata('user_loggedin')): ?>
			
			<p class="alert alert-success" style="margin-top: 5px">
				<?php print_r($this->session->flashdata('user_loggedin'));?> 
			</p> 

		<?php endif; ?>

		<?php 
		if($this->session->flashdata('user_loggedout')): ?>
			
			<p class="alert alert-success" style="margin-top: 5px">
				<?php print_r($this->session->flashdata('user_loggedout'));?> 
			</p> 

		<?php endif; ?>

		<?php 
		if($this->session->flashdata('category_delete')): ?>
			
			<p class="alert alert-success" style="margin-top: 5px">
				<?php print_r($this->session->flashdata('category_delete'));?> 
			</p> 

		<?php endif; ?>