<section class="min-vh-100 mb-8">
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-12 text-center mx-auto" style="color:black">
              <h1 class="text-white mb-2 mt-5" style="font-size: 50px;"><b>Welcome</b></h1>
              <p class="text-lead text-white">Pseudocode Algorithm Learning Media</p>
            </div>
          </div>
        </div>
      </div>
</section>

        <!-- <div class="container" style="justify-content: center;">
		<div class="col-sm-7"><img src="<?= base_url('assets/dist/img/login.PNG') ?>" alt="" style="max-width:80%;
    /*width:100%;*/
    height: auto;"></div> -->
<div class="login-box pt-5" >
	<!-- /.login-logo style="filter: alpha(opacity=90);
	opacity: .7;" -->
	<div class="login-box-body" style="border-radius: 25px;">
	<!-- <center>
	<a href="https://blogbugabagi.blogspot.com" target="_blank" rel="noopener noreferrer">
	<img src="<?= base_url('assets/dist/img/b.png') ?>" width="30%" alt="" srcset="">
	</center>
	</a> -->
	<p class="login-box-msg">Masukkan email dan password yang telah terdaftar</p>
	<center><a href="course-single.html"><img src="assets/frontend/images/polinema.png" alt="Image" class="img-fluid" style="height:100px; width:100px;"></a></center>
	<br></br>
	<div id="infoMessage" class="text-center"><?php echo $message;?></div>

	<?= form_open("auth/cek_login", array('id'=>'login'));?>
		<div class="form-group has-feedback">
			<?= form_input($identity);?>
			<span class="fa fa-envelope form-control-feedback"></span>
			<span class="help-block"></span>
		</div>
		<div class="form-group has-feedback">
			<?= form_input($password);?>
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			<span class="help-block"></span>
		</div>
		<div class="row">
			<div class="col-xs-8">
			<!-- <div class="checkbox icheck">
				<label>
				<?= form_checkbox('remember', '', FALSE, 'id="remember"');?> Ingat saya
				</label>
			</div> -->
			</div>
			<!-- /.col -->
			<div class="col-xs-4">
			<?= form_submit('submit', lang('login_submit_btn'), array('id'=>'submit','class'=>'btn btn-primary btn-block btn-flat'));?>
			</div>
			<!-- /.col -->
		</div>
		<?= form_close(); ?>
		<br>
		<!-- <a href="<?=base_url()?>auth/forgot_password" class="text-center"><?= lang('login_forgot_password');?></a> -->

	</div>
</div>
</div>

<script type="text/javascript">
	let base_url = '<?=base_url();?>';
</script>
<script src="<?=base_url()?>assets/dist/js/app/auth/login.js"></script>