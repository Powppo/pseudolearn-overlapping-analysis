<?php if( $this->ion_auth->is_admin() ) : ?>
<div class="row">
    <?php foreach($info_box as $info) : ?>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-<?=$info->box?>">
        <div class="inner">
            <h3><?=$info->total;?></h3>
            <p><?=$info->title;?></p>
        </div>
        <div class="icon">
            <i class="fa fa-<?=$info->icon?>"></i>
        </div>
        <a href="<?=base_url().strtolower($info->title);?>" class="small-box-footer">
            Lihat <i class="fa fa-arrow-circle-right"></i>
        </a>
        </div>
    </div>
    <?php endforeach; ?>
   <style type="text/css">
    .col-centered {
      display: inline-block;
      float : none;
      text-align: left;
      margin-right: -4px;
    }

    hr {
    width: 100%;
    height: 1px;
    background-color: black;
    margin-right: auto;
    margin-left: auto;
    margin-bottom: 1px;
    border-width: 2px;
    border-color: black;
    }
    </style>

    <div class="col-lg-12 col-xs-12">
        <center><b><h3 style="text-align: center; font-family: cursive;  background-color: #fff; padding-top:20px; padding-bottom:20px; margin-top: 50px;"> GRAFIK CONFIDENCE TAG </h3></b></center>
    </div>
    <br></br>
    <center> <div class="row row-centered">
        <div class="col-lg-5 col-xs-8 col-centered" style="background-color: #fff; margin-left: 30px;">
            <div class="card-body">
                <div id="echart_pie" style="height:300px; margin-top: 30px;"></div>
            </div>
        </div>
        <div class="col-lg-5 col-xs-8 col-centered" style="background-color: #fff; margin-left: 30px;">
            <div class="card-body">
                <div id="echart_pie2" style="height:300px; margin-top: 30px;"></div>
            </div>
        </div>
        <div class="col-lg-5 col-xs-8 col-centered" style="background-color: #fff; margin-left: 30px;">
            <div class="card-body">
                <div id="echart_pie3" style="height:300px; margin-top: 30px;"></div>
            </div>
        </div>
        <div class="col-lg-5 col-xs-8 col-centered" style="background-color: #fff; margin-left: 30px;">
            <div class="card-body">
                <div id="echart_pie4" style="height:300px; margin-top: 30px;"></div>
            </div>
        </div>
        <div class="col-lg-5 col-xs-8 col-centered" style="background-color: #fff; margin-left: 30px;">
            <div class="card-body">
                <div id="echart_pie5" style="height:300px; margin-top: 30px;"></div>
            </div>
        </div>
    </div>  <center>
<?php
    //Inisialisasi variable level 1
    $sub_soal_ys= "";
    $sub_soal_yb= "";
    $sub_soal_tys= "";
    $sub_soal_tyb= "";
    $jumlah_ys=null;
    $jumlah_yb=null;
    $jumlah_tys=null;
    $jumlah_tyb=null;
    foreach ($yakinsalah_satu as $ys1)
    {
        $title = "Yakin+Salah";
        $sub_soal_ys .= "'($title)' ". ", ";
        $jum_ys=$ys1->total_yakin_salah;
        $jumlah_ys .= "$jum_ys". ", ";
    }

    foreach ($yakinbenar_satu as $yb1)
    {
        $title = "Yakin+Benar";
        $sub_soal_yb .= "'($title)' ". ", ";
        $jum_yb=$yb1->total_yakin_benar;
        $jumlah_yb .= "$jum_yb". ", ";
    }

    foreach ($tidakyakinsalah_satu as $tys1)
    {
        $title = "Tidak Yakin+Salah";
        $sub_soal_tys .= "'($title)' ". ", ";
        $jum_tys=$tys1->total_tidakyakin_salah;
        $jumlah_tys .= "$jum_tys". ", ";
    }

    foreach ($tidakyakinbenar_satu as $tyb1)
    {
        $title = "Tidak Yakin+Benar";
        $sub_soal_tyb .= "'($title)' ". ", ";
        $jum_tyb=$tyb1->total_tidakyakin_benar;
        $jumlah_tyb .= "$jum_tyb". ", ";
    }

    //Inisialisasi variable level 2
    $sub_soal_ys2= "";
    $sub_soal_yb2= "";
    $sub_soal_tys2= "";
    $sub_soal_tyb2= "";
    $jumlah_ys2=null;
    $jumlah_yb2=null;
    $jumlah_tys2=null;
    $jumlah_tyb2=null;
    foreach ($yakinsalah_dua as $ys2)
    {
        $title = "Yakin+Salah";
        $sub_soal_ys2 .= "'($title)' ". ", ";
        $jum_ys2=$ys2->total_yakin_salah;
        $jumlah_ys2 .= "$jum_ys2". ", ";
    }

    foreach ($yakinbenar_dua as $yb2)
    {
        $title = "Yakin+Benar";
        $sub_soal_yb2 .= "'($title)' ". ", ";
        $jum_yb2=$yb2->total_yakin_benar;
        $jumlah_yb2 .= "$jum_yb2". ", ";
    }

    foreach ($tidakyakinsalah_dua as $tys2)
    {
        $title = "Tidak Yakin+Salah";
        $sub_soal_tys2 .= "'($title)' ". ", ";
        $jum_tys2=$tys2->total_tidakyakin_salah;
        $jumlah_tys2 .= "$jum_tys2". ", ";
    }

    foreach ($tidakyakinbenar_dua as $tyb2)
    {
        $title = "Tidak Yakin+Benar";
        $sub_soal_tyb2 .= "'($title)' ". ", ";
        $jum_tyb2=$tyb2->total_tidakyakin_benar;
        $jumlah_tyb2 .= "$jum_tyb2". ", ";
    }

    //Inisialisasi variable level 3
    $sub_soal_ys3= "";
    $sub_soal_yb3= "";
    $sub_soal_tys3= "";
    $sub_soal_tyb3= "";
    $jumlah_ys3=null;
    $jumlah_yb3=null;
    $jumlah_tys3=null;
    $jumlah_tyb3=null;
    foreach ($yakinsalah_tiga as $ys3)
    {
        $title = "Yakin+Salah";
        $sub_soal_ys3 .= "'($title)' ". ", ";
        $jum_ys3=$ys3->total_yakin_salah;
        $jumlah_ys3 .= "$jum_ys3". ", ";
    }
 
    foreach ($yakinbenar_tiga as $yb3)
    {
        $title = "Yakin+Benar";
        $sub_soal_yb3 .= "'($title)' ". ", ";
        $jum_yb3=$yb3->total_yakin_benar;
        $jumlah_yb3 .= "$jum_yb3". ", ";
    }
 
    foreach ($tidakyakinsalah_tiga as $tys3)
    {
        $title = "Tidak Yakin+Salah";
        $sub_soal_tys3 .= "'($title)' ". ", ";
        $jum_tys3=$tys3->total_tidakyakin_salah;
        $jumlah_tys3 .= "$jum_tys3". ", ";
    }
 
    foreach ($tidakyakinbenar_tiga as $tyb3)
    {
        $title = "Tidak Yakin+Benar";
        $sub_soal_tyb3 .= "'($title)' ". ", ";
        $jum_tyb3=$tyb3->total_tidakyakin_benar;
        $jumlah_tyb3 .= "$jum_tyb3". ", ";
    }

     //Inisialisasi variable level 4
     $sub_soal_ys4= "";
     $sub_soal_yb4= "";
     $sub_soal_tys4= "";
     $sub_soal_tyb4= "";
     $jumlah_ys4=null;
     $jumlah_yb4=null;
     $jumlah_tys4=null;
     $jumlah_tyb4=null;
     foreach ($yakinsalah_empat as $ys4)
     {
         $title = "Yakin+Salah";
         $sub_soal_ys4 .= "'($title)' ". ", ";
         $jum_ys4=$ys4->total_yakin_salah;
         $jumlah_ys4 .= "$jum_ys4". ", ";
     }
 
     foreach ($yakinbenar_empat as $yb4)
     {
         $title = "Yakin+Benar";
         $sub_soal_yb4 .= "'($title)' ". ", ";
         $jum_yb4=$yb4->total_yakin_benar;
         $jumlah_yb4 .= "$jum_yb4". ", ";
     }
 
     foreach ($tidakyakinsalah_empat as $tys4)
     {
         $title = "Tidak Yakin+Salah";
         $sub_soal_tys4 .= "'($title)' ". ", ";
         $jum_tys4=$tys4->total_tidakyakin_salah;
         $jumlah_tys4 .= "$jum_tys4". ", ";
     }
 
     foreach ($tidakyakinbenar_empat as $tyb4)
     {
         $title = "Tidak Yakin+Benar";
         $sub_soal_tyb4 .= "'($title)' ". ", ";
         $jum_tyb4=$tyb4->total_tidakyakin_benar;
         $jumlah_tyb4 .= "$jum_tyb4". ", ";
     }

      //Inisialisasi variable level 5
      $sub_soal_ys5= "";
      $sub_soal_yb5= "";
      $sub_soal_tys5= "";
      $sub_soal_tyb5= "";
      $jumlah_ys5=null;
      $jumlah_yb5=null;
      $jumlah_tys5=null;
      $jumlah_tyb5=null;
      foreach ($yakinsalah_lima as $ys5)
      {
          $title = "Yakin+Salah";
          $sub_soal_ys5 .= "'($title)' ". ", ";
          $jum_ys5=$ys5->total_yakin_salah;
          $jumlah_ys5 .= "$jum_ys5". ", ";
      }
   
      foreach ($yakinbenar_lima as $yb5)
      {
          $title = "Yakin+Benar";
          $sub_soal_yb5 .= "'($title)' ". ", ";
          $jum_yb5=$yb5->total_yakin_benar;
          $jumlah_yb5 .= "$jum_yb5". ", ";
      }
   
      foreach ($tidakyakinsalah_lima as $tys5)
      {
          $title = "Tidak Yakin+Salah";
          $sub_soal_tys5 .= "'($title)' ". ", ";
          $jum_tys5=$tys5->total_tidakyakin_salah;
          $jumlah_tys5 .= "$jum_tys5". ", ";
      }
   
      foreach ($tidakyakinbenar_lima as $tyb5)
      {
          $title = "Tidak Yakin+Benar";
          $sub_soal_tyb5 .= "'($title)' ". ", ";
          $jum_tyb5=$tyb5->total_tidakyakin_benar;
          $jumlah_tyb5 .= "$jum_tyb5". ", ";
      }
?>

<?php else : ?>
<style>
.profile-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: start;
    padding: 20px;
}

.profile-card {
    background: white;
    width: 400px; /* Lebarkan card untuk menampung informasi profil */
    border: 1px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.profile-header {
    display: flex; /* Gunakan flexbox */
}

.profile-info {
    flex: 1; /* Bagian informasi profil akan memanjang sesuai dengan konten */
    padding: 20px;
}

.profile-picture {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin: 20px;
}
@media (max-width: 768px) {
    .profile-card {
        width: calc(100% - 0px); /* Lebar kartu 100% minus padding */
    }

    .profile-header {
        flex-direction: column; /* Tata letak menjadi satu kolom di bawah layar 768px */
        align-items: center; /* Pusatkan konten secara horizontal */
    }

    .profile-info {
        padding: 20px 0; /* Atur padding hanya atas dan bawah */
        text-align: center; /* Pusatkan teks */
    }

    .profile-picture {
      width: 100px;
      height: 100px;
      margin: 20px 0; /* Atur margin hanya atas dan bawah */
    }
}

.timeline,
.timeline-horizontal {
  list-style: none;
  padding: 20px;
  position: relative;
}
.timeline:before {
  top: 40px;
  bottom: 0;
  position: absolute;
  content: " ";
  width: 3px;
  background-color: #eeeeee;
  left: 50%;
  margin-left: -1.5px;
}
.timeline .timeline-item {
  margin-bottom: 20px;
  position: relative;
}
.timeline .timeline-item:before,
.timeline .timeline-item:after {
  content: "";
  display: table;
}
.timeline .timeline-item:after {
  clear: both;
}
.timeline .timeline-item .timeline-badge {
  color: #fff;
  width: 54px;
  height: 54px;
  line-height: 52px;
  font-size: 22px;
  text-align: center;
  position: absolute;
  top: 18px;
  left: 50%;
  margin-left: -25px;
  background-color: #7c7c7c;
  border: 3px solid #ffffff;
  z-index: 100;
  border-top-right-radius: 50%;
  border-top-left-radius: 50%;
  border-bottom-right-radius: 50%;
  border-bottom-left-radius: 50%;
}
.timeline .timeline-item .timeline-badge i,
.timeline .timeline-item .timeline-badge .fa,
.timeline .timeline-item .timeline-badge .glyphicon {
  top: 2px;
  left: 0px;
}
.timeline .timeline-item .timeline-badge.primary {
  background-color: #1f9eba;
}
.timeline .timeline-item .timeline-badge.info {
  background-color: #5bc0de;
}
.timeline .timeline-item .timeline-badge.success {
  background-color: #59ba1f;
}
.timeline .timeline-item .timeline-badge.warning {
  background-color: #d1bd10;
}
.timeline .timeline-item .timeline-badge.danger {
  background-color: #ba1f1f;
}
.timeline .timeline-item .timeline-panel {
  position: relative;
  width: 46%;
  float: left;
  right: 16px;
  border: 1px solid #c0c0c0;
  background: #ffffff;
  border-radius: 2px;
  padding: 20px;
  -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
  box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
}
.timeline .timeline-item .timeline-panel:before {
  position: absolute;
  top: 26px;
  right: -16px;
  display: inline-block;
  border-top: 16px solid transparent;
  border-left: 16px solid #c0c0c0;
  border-right: 0 solid #c0c0c0;
  border-bottom: 16px solid transparent;
  content: " ";
}
.timeline .timeline-item .timeline-panel .timeline-title {
  margin-top: 0;
  color: inherit;
}
.timeline .timeline-item .timeline-panel .timeline-body > p,
.timeline .timeline-item .timeline-panel .timeline-body > ul {
  margin-bottom: 0;
}
.timeline .timeline-item .timeline-panel .timeline-body > p + p {
  margin-top: 5px;
}
.timeline .timeline-item:last-child:nth-child(even) {
  float: right;
}
.timeline .timeline-item:nth-child(even) .timeline-panel {
  float: right;
  left: 16px;
}
.timeline .timeline-item:nth-child(even) .timeline-panel:before {
  border-left-width: 0;
  border-right-width: 14px;
  left: -14px;
  right: auto;
}
.timeline-horizontal {
  list-style: none;
  position: relative;
  padding: 20px 10px 20px 0px;
  display: inline-block;
}
.timeline-horizontal:before {
  height: 3px;
  top: auto;
  bottom: 26px;
  left: 56px;
  right: 0;
  width: 100%;
  margin-bottom: 20px;
}
.timeline-horizontal .timeline-item {
  display: table-cell;
  height: 280px;
  width: 20%;
  min-width: 320px;
  float: none !important;
  padding-left: 0px;
  padding-right: 20px;
  margin: 0 auto;
  vertical-align: bottom;
}
.timeline-horizontal .timeline-item .timeline-panel {
  top: auto;
  bottom: 64px;
  display: inline-block;
  float: none !important;
  left: 0 !important;
  right: 0 !important;
  width: 100%;
  margin-bottom: 20px;
}
.timeline-horizontal .timeline-item .timeline-panel:before {
  top: auto;
  bottom: -16px;
  left: 28px !important;
  right: auto;
  border-right: 16px solid transparent !important;
  border-top: 16px solid #c0c0c0 !important;
  border-bottom: 0 solid #c0c0c0 !important;
  border-left: 16px solid transparent !important;
}
.timeline-horizontal .timeline-item:before,
.timeline-horizontal .timeline-item:after {
  display: none;
}
.timeline-horizontal .timeline-item .timeline-badge {
  top: auto;
  bottom: 0px;
  left: 43px;
}
</style>

<div class="row">
    <div class="col-sm-12 col-xs-12 mb-4">
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-info">
                <h2 class="profile-name">
                    <?=$mahasiswa->nama?>
                    <img src="<?= base_url('assets/dist/img/verified.png') ?>" alt="Blue Tick" class="blue-tick-icon" style="width: 25px; height: 25px;">
                </h2>
                    <p class="profile-title"><?=$mahasiswa->nim?></p>
                    <p><strong>Email :</strong> <?=$mahasiswa->email?></p>
                    <p><strong>Jenis Kelamin :</strong><?=$mahasiswa->jenis_kelamin === 'L' ? "Laki-laki" : "Perempuan" ;?></p> 
                </div>
                <!-- <img src="https://buffer.com/library/content/images/2023/10/free-images.jpg" alt="Profile Picture" class="profile-picture"> -->
            </div>
        </div>
        <!-- Tambahkan profil card lainnya sesuai kebutuhan -->
    </div>
    </div>
    <div class="col-lg-12">
        <!-- <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Informasi Akun</h3>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>NIM</th>
                    <td><?=$mahasiswa->nim?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?=$mahasiswa->nama?></td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td><?=$mahasiswa->jenis_kelamin === 'L' ? "Laki-laki" : "Perempuan" ;?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?=$mahasiswa->email?></td>
                </tr>
            </table>
        </div> -->
        <div style="padding: 20px;">
        <div class="row">
        <div class="col-md-12">
          <div style="display:inline-block;width:100%;overflow-y:auto; background: white; padding: 15px;">
            <ul class="timeline timeline-horizontal">
              <li class="timeline-item">
              <div style="margin-bottom: 100px;">
                <h1>Tutorial Mengerjakan 🧐</h1>
              </div>
              <!-- <div class="timeline-badge success"><i class="glyphicon glyphicon-check"></i></div> -->
              <div class="timeline-panel" style="background: #C0D6E8;">
                <div class="timeline-heading">
                  <h4 class="timeline-title">1</h4>
                  <p><small class="text-muted">Latihan Soal</small></p>
                </div>
                <div class="timeline-body">
                  <p>Buka menu latihan soal pada sidebar disamping.</p>
                </div>
              </div>
            </li>
            <li class="timeline-item">
              <!-- <div class="timeline-badge warning"><i class="glyphicon glyphicon-check"></i></div> -->
              <div class="timeline-panel" style="background: #C0D6E8;">
                <div class="timeline-heading">
                  <h4 class="timeline-title">2</h4>
                  <p><small class="text-muted">Level Soal</small></p>
                </div>
                <div class="timeline-body">
                  <p>Pilih level tersedia yang sesuai dengan arahan dosen kamu.</p>
                </div>
              </div>
            </li>
            <li class="timeline-item">
              <!-- <div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i></div> -->
              <div class="timeline-panel" style="background: #C0D6E8;">
                <div class="timeline-heading">
                  <h4 class="timeline-title">3</h4>
                  <p><small class="text-muted">List Soal</small></p>
                </div>
                <div class="timeline-body">
                  <p>Silahkan pilih list soal yang ingin kamu kerjakan.</p>
                </div>
              </div>
            </li>
            <li class="timeline-item">
              <!-- <div class="timeline-badge warning"><i class="glyphicon glyphicon-check"></i></div> -->
              <div class="timeline-panel" style="background: #C0D6E8;">
                <div class="timeline-heading">
                  <h4 class="timeline-title">4</h4>
                  <p><small class="text-muted">Soal Ujian</small></p>
                </div>
                <div class="timeline-body">
                  <p>Baca soal ujian dengan teliti, soal ujian memiliki tingkatan masing-masing.</p>
                </div>
              </div>
            </li>
            <li class="timeline-item">
              <!-- <div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i></div> -->
              <div class="timeline-panel" style="background: #C0D6E8;">
                <div class="timeline-heading">
                  <h4 class="timeline-title">5</h4>
                  <p><small class="text-muted">Waktu Pengerjaan</small></p>
                </div>
                <div class="timeline-body">
                  <p>Setiap soal memiliki waktu pengerjaan, selesaikan soal sebelum waktu habis.</p>
                </div>
              </div>
            </li>
          </ul>
        </div>
        </div>
      </div>
    </div>
    </div> 

    
 
</div>


<?php endif; ?>


<script>
     
</script>

<script>
      //Inisialisasi judul 
      $level2_title = "Level 2 : Kondisi";
      var echartPie2 = echarts.init(document.getElementById('echart_pie2'));
      var colorPalette = ['#c23531', '#2f4554', '#d48265', '#61a0a8']
      echartPie2.setOption({
        title: {
        text: 'Confidence Tag',
        subtext:  $level2_title,
        x: 'center'
        },
        tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          x: 'center',           y: 'bottom',
          data: [<?php echo $sub_soal_ys2; echo $sub_soal_yb2; echo $sub_soal_tys2; echo $sub_soal_tyb2; ?>]
        },
        toolbox: {
          show: true,
          feature: {
            magicType: {
              show: true,
              type: ['pie', 'funnel'],
              option: {
                funnel: {
                  x: '25%',
                  width: '50%',
                  funnelAlign: 'left',
                  max: 1548
                }
              }
            },
            restore: {
              show: true,
              title: "Restore"
            },
            saveAsImage: {
              show: true,
              title: "Save Image"
            }
          }
        },
        calculable: true,
        series: [{
          name : "Confidence Tag",
          type: 'pie',
          radius: '55%',
          center: ['50%', '48%'],
          color: colorPalette,
          data:
          [{
            value: [<?php echo $jumlah_ys2;?>],
            name: 'Yakin + Salah'
          }, {
            value: [<?php echo $jumlah_yb2;?>],
            name: 'Yakin + Benar'
          }, {
            value: [<?php echo $jumlah_tys2;?>],
            name: 'Tidak Yakin + Salah'
          }, {
            value: [<?php echo $jumlah_tyb2;?>],
            name: 'Tidak Yakin + Benar'
          }]
        }]
      });

      var dataStyle = {
        normal: {
          label: {
            show: false
          },
          labelLine: {
            show: false
          }
        }       };
    </script>

<script>
      //Inisialisasi judul 
      $level3_title = "Level 3 : Perulangan";
      var echartPie3 = echarts.init(document.getElementById('echart_pie3'));
      var colorPalette = ['#c23531', '#2f4554', '#d48265', '#61a0a8']
      echartPie3.setOption({
        title: {
        text: 'Confidence Tag',
        subtext:  $level3_title,
        x: 'center'
        },
        tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          x: 'center',           y: 'bottom',
          data: [<?php echo $sub_soal_ys3; echo $sub_soal_yb3; echo $sub_soal_tys3; echo $sub_soal_tyb3; ?>]
        },
        toolbox: {
          show: true,
          feature: {
            magicType: {
              show: true,
              type: ['pie', 'funnel'],
              option: {
                funnel: {
                  x: '25%',
                  width: '50%',
                  funnelAlign: 'left',
                  max: 1548
                }
              }
            },
            restore: {
              show: true,
              title: "Restore"
            },
            saveAsImage: {
              show: true,
              title: "Save Image"
            }
          }
        },
        calculable: true,
        series: [{
          name : "Confidence Tag",
          type: 'pie',
          radius: '55%',
          center: ['50%', '48%'],
          color: colorPalette,
          data:
          [{
            value: [<?php echo $jumlah_ys3;?>],
            name: 'Yakin + Salah'
          }, {
            value: [<?php echo $jumlah_yb3;?>],
            name: 'Yakin + Benar'
          }, {
            value: [<?php echo $jumlah_tys3;?>],
            name: 'Tidak Yakin + Salah'
          }, {
            value: [<?php echo $jumlah_tyb3;?>],
            name: 'Tidak Yakin + Benar'
          }]
        }]
      });

      var dataStyle = {
        normal: {
          label: {
            show: false
          },
          labelLine: {
            show: false
          }
        }       };
    </script>

<script>
      //Inisialisasi judul 
      $level4_title = "Level 4 : Array";
      var echartPie4 = echarts.init(document.getElementById('echart_pie4'));
      var colorPalette = ['#c23531', '#2f4554', '#d48265', '#61a0a8']
      echartPie4.setOption({
        title: {
        text: 'Confidence Tag',
        subtext:  $level4_title,
        x: 'center'
        },
        tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          x: 'center',           y: 'bottom',
          data: [<?php echo $sub_soal_ys4; echo $sub_soal_yb4; echo $sub_soal_tys4; echo $sub_soal_tyb4; ?>]
        },
        toolbox: {
          show: true,
          feature: {
            magicType: {
              show: true,
              type: ['pie', 'funnel'],
              option: {
                funnel: {
                  x: '25%',
                  width: '50%',
                  funnelAlign: 'left',
                  max: 1548
                }
              }
            },
            restore: {
              show: true,
              title: "Restore"
            },
            saveAsImage: {
              show: true,
              title: "Save Image"
            }
          }
        },
        calculable: true,
        series: [{
          name : "Confidence Tag",
          type: 'pie',
          radius: '55%',
          center: ['50%', '48%'],
          color: colorPalette,
          data:
          [{
            value: [<?php echo $jumlah_ys4;?>],
            name: 'Yakin + Salah'
          }, {
            value: [<?php echo $jumlah_yb4;?>],
            name: 'Yakin + Benar'
          }, {
            value: [<?php echo $jumlah_tys4;?>],
            name: 'Tidak Yakin + Salah'
          }, {
            value: [<?php echo $jumlah_tyb4;?>],
            name: 'Tidak Yakin + Benar'
          }]
        }]
      });

      var dataStyle = {
        normal: {
          label: {
            show: false
          },
          labelLine: {
            show: false
          }
        }       };
    </script>

<script>
      //Inisialisasi judul 
      $level5_title = "Level 5 : Fungsi";
      var echartPie5 = echarts.init(document.getElementById('echart_pie5'));
      var colorPalette = ['#c23531', '#2f4554', '#d48265', '#61a0a8']
      echartPie5.setOption({
        title: {
        text: 'Confidence Tag',
        subtext:  $level5_title,
        x: 'center'
        },
        tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          x: 'center',           y: 'bottom',
          data: [<?php echo $sub_soal_ys5; echo $sub_soal_yb5; echo $sub_soal_tys5; echo $sub_soal_tyb5; ?>]
        },
        toolbox: {
          show: true,
          feature: {
            magicType: {
              show: true,
              type: ['pie', 'funnel'],
              option: {
                funnel: {
                  x: '25%',
                  width: '50%',
                  funnelAlign: 'left',
                  max: 1548
                }
              }
            },
            restore: {
              show: true,
              title: "Restore"
            },
            saveAsImage: {
              show: true,
              title: "Save Image"
            }
          }
        },
        calculable: true,
        series: [{
          name : "Confidence Tag",
          type: 'pie',
          radius: '55%',
          center: ['50%', '48%'],
          color: colorPalette,
          data:
          [{
            value: [<?php echo $jumlah_ys5;?>],
            name: 'Yakin + Salah'
          }, {
            value: [<?php echo $jumlah_yb5;?>],
            name: 'Yakin + Benar'
          }, {
            value: [<?php echo $jumlah_tys5;?>],
            name: 'Tidak Yakin + Salah'
          }, {
            value: [<?php echo $jumlah_tyb5;?>],
            name: 'Tidak Yakin + Benar'
          }]
        }]
      });

      var dataStyle = {
        normal: {
          label: {
            show: false
          },
          labelLine: {
            show: false
          }
        }       };
    </script>









