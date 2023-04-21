<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?= base_url() ?>assets/dist/img/user1.PNG" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?= $user->username ?></p>
				<small><?= $user->email ?></small>
			</div>
		</div>

		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN MENU</li>
			<!-- Optionally, you can add icons to the links -->
			<?php
			$page = $this->uri->segment(1);
			$master = ["jurusan", "kelas", "matkul", "dosen", "mahasiswa"];
			$relasi = ["kelasdosen", "jurusanmatkul"];
			$users = ["users"];
			?>
			<li class="<?= $page === 'dashboard' ? "active" : "" ?>"><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
			<!-- <?php if ($this->ion_auth->is_admin()) : ?>
				<li class="treeview <?= in_array($page, $master)  ? "active menu-open" : ""  ?>">
					<a href="#"><i class="fa fa-folder"></i> <span>Data Master</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						
						<li class="<?= $page === 'mahasiswa' ? "active" : "" ?>">
							<a href="<?= base_url('mahasiswa') ?>">
								<i class="fa fa-circle-o"></i>
								Master Mahasiswa
							</a>
						</li>
					</ul>
				</li>
				<?php endif; ?> -->
			<?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('dosen')) : ?>
				<li class="<?= $page === 'mahasiswa' ? "active" : "" ?>">
							<a href="<?= base_url('mahasiswa') ?>">
							<i class="fa fa-address-card"></i> <span>Data Mahasiswa</span>
							</a>
						</li>
			<?php endif; ?>	
			
			<?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('dosen')) : ?>
				<li class="<?= $page === 'soal' ? "active" : "" ?>">
					<a href="<?= base_url('soal') ?>" rel="noopener noreferrer">
						<i class="fa fa-file-text-o"></i> <span>Bank Soal</span>
					</a>
				</li>
			<?php endif; ?>
			<?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('dosen')) : ?>
				<li class="<?= $page === 'level' ? "active" : "" ?>">
					<a href="<?= base_url('level') ?>" rel="noopener noreferrer">
						<i class="fa fa-graduation-cap"></i> <span>Kategori Soal</span>
					</a>
				</li>
			<?php endif; ?>
			<?php if ($this->ion_auth->in_group('dosen')) : ?>
				<li class="<?= $page === 'ujian' ? "active" : "" ?>">
					<a href="<?= base_url('ujian/master') ?>" rel="noopener noreferrer">
						<i class="fa fa-chrome"></i> <span>Ujian</span>
					</a>
				</li>
			<?php endif; ?>
			<?php if ($this->ion_auth->in_group('mahasiswa')) : ?>
				<li class="<?= $page === 'ujian' ? "active" : "" ?>">
					<a href="<?= base_url('ujian/list_level') ?>" rel="noopener noreferrer">
						<i class="fa fa-chrome"></i> <span>Latihan Soal</span>
					</a>
				</li>
			<?php endif; ?>
			<?php if (!$this->ion_auth->in_group('mahasiswa')) : ?>
				<!-- <li class="header">REPORTS</li>
				<li class="<?= $page === 'hasilujian' ? "active" : "" ?>">
					<a href="<?= base_url('hasilujian') ?>" rel="noopener noreferrer">
						<i class="fa fa-file"></i> <span>Hasil Ujian</span>
					</a>
				</li> -->
			<?php endif; ?>
			<?php if ($this->ion_auth->is_admin()) : ?>
				<li class="header">ADMINISTRATOR</li>
				<li class="<?= $page === 'users' ? "active" : "" ?>">
					<a href="<?= base_url('users') ?>" rel="noopener noreferrer">
						<i class="fa fa-users"></i> <span>Manajemen Pengguna</span>
					</a>
				</li>
				<?php endif; ?>
				<?php if ($this->ion_auth->is_admin()) : ?>
				<li class="<?= $page === 'hasilujian' ? "active" : "" ?>">
					<a href="<?= base_url('hasilujian') ?>" rel="noopener noreferrer">
						<i class="fa fa-tasks"></i> <span>Log Aktivitas Mahasiswa</span>
					</a>
				</li>
			<?php endif; ?>
			<?php if ($this->ion_auth->is_admin()) : ?>
				<li class="<?= $page === 'detailhistory' ? "active" : "" ?>">
					<a href="<?= base_url('detailhistory') ?>" rel="noopener noreferrer">
						<i class="fa fa-history"></i> <span>History Confidence Tag</span>
					</a>
				</li>
			<?php endif; ?>
			<?php if ($this->ion_auth->is_admin()) : ?>
				<li class="<?= $page === 'manajemenhistory' ? "active" : "" ?>">
					<a href="<?= base_url('manajemenhistory') ?>" rel="noopener noreferrer">
						<i class="fa fa-database"></i> <span>Manajemen History Ujian</span>
					</a>
				</li>
			<?php endif; ?>
			<!-- <?php if ($this->ion_auth->is_admin()) : ?>
				<li class="<?= $page === 'feedback' ? "active" : "" ?>">
					<a href="<?= base_url('feedback') ?>" rel="noopener noreferrer">
						<i class="fa fa-comments"></i> <span>Feedback</span>
					</a>
				</li>
			<?php endif; ?> -->
		</ul>

	</section>
	<!-- /.sidebar -->
</aside>