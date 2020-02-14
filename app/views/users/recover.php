<?php require APPROOT . '/views/inc/header.php'; ?>
<br>

<br><br>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<header class="card-header">
				
					 
					<h4 class="card-title mt-2">Recover Your Account</h4>
				</header>
				<article class="card-body">
					<div class="col-lg-3"></div>
					<div class="col-lg-6"></div>
					<form   method="post">
						<div class="form-row">
							<div class="col form-group">
								<label for="reset_password">Password </label>
            					<input type="password" name="reset_password" class="form-control form-control-lg <?php echo (!empty($data['reset_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['reset_password']; ?>">
            					<span class="invalid-feedback"><?php echo $data['reset_password_err']; ?></span>
							</div>
							<div class="col form-group">
								<label for="reset_confirm_password">Confirm password</label>
								<input type="password" name="reset_confirm_password" class="form-control form-control-lg <?php echo(!empty($data['reset_confirm_password_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['reset_confirm_password'];?>">
								<span class="invalid-feedback"><?php echo $data['reset_confirm_password_err'];?></span>
							</div>
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