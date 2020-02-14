<?php require APPROOT . '/views/inc/header.php'; ?>
<br>

<br><br>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<header class="card-header">
					<?php flash('forgot_success');?>
					<h4 class="card-title mt-2">Recover Your Account</h4>
				</header>
				<article class="card-body">
					<div class="col-lg-3"></div>
					<div class="col-lg-6"></div>
					<form  action="<?php echo URLROOT;?>/users/forgot_password" method="post">

						<div class="form-group">
								<label for="username">Username</label>
								<input type="text" name="username" class="form-control form-control-lg <?php echo(!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['username'];?>">
								<span class="invalid-feedback"><?php echo $data['username_err'];?></span>
						</div>
						
							
						<br>
						<input type="submit" name="submit" value="Verify" class="btn btn-primary btn-block">
					</form>
				</article>		
			</div>
		</div>
	</div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>