<body class="hold-transition login-page blogbugabagi">
<!-- <section class="min-vh-100 mb-8">
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
 
<div class="login-box pt-5" >
 
	<div class="login-box-body" style="border-radius: 25px;">
	 
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
			</div> 
			<div class="col-xs-4">
			<?= form_submit('submit', lang('login_submit_btn'), array('id'=>'submit','class'=>'btn btn-primary btn-block btn-flat'));?>
			</div> 
		</div>
		<?= form_close(); ?>
		<br> 

	</div>
</div>  -->
<div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('<?= base_url('assets/frontend/images/loginBg3.jpeg') ?>');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center p-4">
          <div class="col-md-7">
            <h3>Selamat Datang di <br> <strong>Pseudocode Algorithm <br> Learning Media</strong></h3>
            <p class="mb-4 text-info">Silahkan login terlebih dahulu untuk masuk ke sistem pembelajaran.</p>
			<div id="infoMessage" class="text-center"><?php echo $message;?></div>
            <?= form_open("auth/cek_login", array('id'=>'login'));?>
              <div class="form-group first has-feedback">
                <label for="username">Email</label>
                <!-- <input type="text" class="form-control" placeholder="Inputkan E-mail" id="username"> -->
				        <?= form_input($identity);?>
              </div>
              <div class="form-group last mb-3 has-feedback">
                <label for="password">Password</label>
                <!-- <input type="password" class="form-control" placeholder="Inputkan Password" id="password"> -->
				        <?= form_input($password);?>
              </div>
              
              <div class="d-flex mb-5 align-items-center"> 
                <span class="ml-auto"><a href="<?=base_url()?>/" class="forgot-pass">Kembali Halaman Home.</a></span> 
              </div>

              <!-- <input type="submit" value="Log In" class="btn btn-block btn-secondary"> -->
			  <?= form_submit('submit', lang('login_submit_btn'), array('id'=>'submit','class'=>'btn btn-block btn-secondary'));?>
			<?= form_close(); ?>
          </div>
        </div>
      </div>
    </div>

    
  </div>
<script type="text/javascript">
	let base_url = '<?=base_url();?>';
</script>
<script src="<?=base_url()?>assets/dist/js/app/auth/login.js"></script> 