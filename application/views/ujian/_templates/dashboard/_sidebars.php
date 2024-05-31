<div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="assets/backend/html/dist/assets/img/admin-avatar.png" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong"><?= $user->username ?></div><small><?= $user->email ?></small></div>
                </div>    
                <?php
                    $page = $this->uri->segment(1);
                    $master = ["jurusan", "kelas", "matkul", "dosen", "mahasiswa"];
                    $relasi = ["kelasdosen", "jurusanmatkul"];
                    $users = ["users"];
                    ?>
                <ul class="side-menu metismenu">
                    <li class="<?= $page === 'dashboard' ? "active" : "" ?>">
                        <a class="active" href="<?= base_url('dashboard') ?>" style="text-decoration: none;"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="heading">MENU UTAMA</li>
                    <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('dosen')) : ?>
                        <li class="<?= $page === 'mahasiswa' ? "active" : "" ?>">
							<a href="<?= base_url('mahasiswa') ?>" style="text-decoration: none;">
							<i class="fa fa-address-card"></i> <span>Data Mahasiswa</span>
							</a>
						</li>
                    <?php endif; ?>	
                    <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('dosen')) : ?>
                        <li class="<?= $page === 'soal' ? "active" : "" ?>">
                            <a href="<?= base_url('soal') ?>" rel="noopener noreferrer" style="text-decoration: none;">
                                <i class="fa fa-file-text-o"></i> <span>Bank Soal</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('dosen')) : ?>
                        <li class="<?= $page === 'level' ? "active" : "" ?>">
                            <a href="<?= base_url('level') ?>" rel="noopener noreferrer" style="text-decoration: none;">
                                <i class="fa fa-graduation-cap"></i> <span>Kategori Soal</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <!-- <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-bar-chart"></i>
                            <span class="nav-label">Charts</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="charts_flot.html">Flot Charts</a>
                            </li>
                            <li>
                                <a href="charts_morris.html">Morris Charts</a>
                            </li>
                            <li>
                                <a href="chartjs.html">Chart.js</a>
                            </li>
                            <li>
                                <a href="charts_sparkline.html">Sparkline Charts</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-map"></i>
                            <span class="nav-label">Maps</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="maps_vector.html">Vector maps</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="icons.html"><i class="sidebar-item-icon fa fa-smile-o"></i>
                            <span class="nav-label">Icons</span>
                        </a>
                    </li> -->
                    <li class="heading">Manajemen Data</li>
                    <?php if ($this->ion_auth->is_admin()) : ?>
                        <li class="header">ADMINISTRATOR</li>
                        <li class="<?= $page === 'users' ? "active" : "" ?>">
                            <a href="<?= base_url('users') ?>" rel="noopener noreferrer" style="text-decoration: none;">
                                <i class="fa fa-users"></i> <span>Manajemen Data Pengguna</span>
                            </a>
                        </li>
                    <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </div>