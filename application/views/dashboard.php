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

    <div class="col-lg-12 col-centered">
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
        $title = "Yakin + Salah";
        $sub_soal_ys .= "'($title)' ". ", ";
        $jum_ys=$ys1->total_yakin_salah;
        $jumlah_ys .= "$jum_ys". ", ";
    }

    foreach ($yakinbenar_satu as $yb1)
    {
        $title = "Yakin + Benar";
        $sub_soal_yb .= "'($title)' ". ", ";
        $jum_yb=$yb1->total_yakin_benar;
        $jumlah_yb .= "$jum_yb". ", ";
    }

    foreach ($tidakyakinsalah_satu as $tys1)
    {
        $title = "Tidak Yakin + Salah";
        $sub_soal_tys .= "'($title)' ". ", ";
        $jum_tys=$tys1->total_tidakyakin_salah;
        $jumlah_tys .= "$jum_tys". ", ";
    }

    foreach ($tidakyakinbenar_satu as $tyb1)
    {
        $title = "Tidak Yakin + Benar";
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
        $title = "Yakin + Salah";
        $sub_soal_ys2 .= "'($title)' ". ", ";
        $jum_ys2=$ys2->total_yakin_salah;
        $jumlah_ys2 .= "$jum_ys2". ", ";
    }

    foreach ($yakinbenar_dua as $yb2)
    {
        $title = "Yakin + Benar";
        $sub_soal_yb2 .= "'($title)' ". ", ";
        $jum_yb2=$yb2->total_yakin_benar;
        $jumlah_yb2 .= "$jum_yb2". ", ";
    }

    foreach ($tidakyakinsalah_dua as $tys2)
    {
        $title = "Tidak Yakin + Salah";
        $sub_soal_tys2 .= "'($title)' ". ", ";
        $jum_tys2=$tys2->total_tidakyakin_salah;
        $jumlah_tys2 .= "$jum_tys2". ", ";
    }

    foreach ($tidakyakinbenar_dua as $tyb2)
    {
        $title = "Tidak Yakin + Benar";
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
        $title = "Yakin + Salah";
        $sub_soal_ys3 .= "'($title)' ". ", ";
        $jum_ys3=$ys3->total_yakin_salah;
        $jumlah_ys3 .= "$jum_ys3". ", ";
    }
 
    foreach ($yakinbenar_tiga as $yb3)
    {
        $title = "Yakin + Benar";
        $sub_soal_yb3 .= "'($title)' ". ", ";
        $jum_yb3=$yb3->total_yakin_benar;
        $jumlah_yb3 .= "$jum_yb3". ", ";
    }
 
    foreach ($tidakyakinsalah_tiga as $tys3)
    {
        $title = "Tidak Yakin + Salah";
        $sub_soal_tys3 .= "'($title)' ". ", ";
        $jum_tys3=$tys3->total_tidakyakin_salah;
        $jumlah_tys3 .= "$jum_tys3". ", ";
    }
 
    foreach ($tidakyakinbenar_tiga as $tyb3)
    {
        $title = "Tidak Yakin + Benar";
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
         $title = "Yakin + Salah";
         $sub_soal_ys4 .= "'($title)' ". ", ";
         $jum_ys4=$ys4->total_yakin_salah;
         $jumlah_ys4 .= "$jum_ys4". ", ";
     }
 
     foreach ($yakinbenar_empat as $yb4)
     {
         $title = "Yakin + Benar";
         $sub_soal_yb4 .= "'($title)' ". ", ";
         $jum_yb4=$yb4->total_yakin_benar;
         $jumlah_yb4 .= "$jum_yb4". ", ";
     }
 
     foreach ($tidakyakinsalah_empat as $tys4)
     {
         $title = "Tidak Yakin + Salah";
         $sub_soal_tys4 .= "'($title)' ". ", ";
         $jum_tys4=$tys4->total_tidakyakin_salah;
         $jumlah_tys4 .= "$jum_tys4". ", ";
     }
 
     foreach ($tidakyakinbenar_empat as $tyb4)
     {
         $title = "Tidak Yakin + Benar";
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
          $title = "Yakin + Salah";
          $sub_soal_ys5 .= "'($title)' ". ", ";
          $jum_ys5=$ys5->total_yakin_salah;
          $jumlah_ys5 .= "$jum_ys5". ", ";
      }
   
      foreach ($yakinbenar_lima as $yb5)
      {
          $title = "Yakin + Benar";
          $sub_soal_yb5 .= "'($title)' ". ", ";
          $jum_yb5=$yb5->total_yakin_benar;
          $jumlah_yb5 .= "$jum_yb5". ", ";
      }
   
      foreach ($tidakyakinsalah_lima as $tys5)
      {
          $title = "Tidak Yakin + Salah";
          $sub_soal_tys5 .= "'($title)' ". ", ";
          $jum_tys5=$tys5->total_tidakyakin_salah;
          $jumlah_tys5 .= "$jum_tys5". ", ";
      }
   
      foreach ($tidakyakinbenar_lima as $tyb5)
      {
          $title = "Tidak Yakin + Benar";
          $sub_soal_tyb5 .= "'($title)' ". ", ";
          $jum_tyb5=$tyb5->total_tidakyakin_benar;
          $jumlah_tyb5 .= "$jum_tyb5". ", ";
      }
?>

<?php else : ?>

<div class="row">
    <div class="col-sm-4">
        <div class="box box-default">
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
        </div>
    </div>

    <!-- <div class="col-sm-4">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Informasi Nilai Kategori</h3>
            </div>
            <table class="table table-hover">
            <?php
            foreach ($tb_level as $pg) {
            ?>
                <tr>
                    <th>NIM</th>
                    <td><?=$tb_level->bts_nilai?></td>
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
                <?php } ?>
            </table>
        </div>
    </div> -->
</div>


<?php endif; ?>


<script>
      //Inisialisasi judul 
      $level1_title = "Level 1 : Tipe Data";
      var echartPie = echarts.init(document.getElementById('echart_pie'));
      var colorPalette = ['#c23531', '#2f4554', '#d48265', '#61a0a8']
      echartPie.setOption({
        title: {
        text: 'Confidence Tag',
        subtext:  $level1_title,
        x: 'center'
        },
        tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          x: 'center',           y: 'bottom',
          data: [<?php echo $sub_soal_ys; echo $sub_soal_yb; echo $sub_soal_tys; echo $sub_soal_tyb; ?>]
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
            value: [<?php echo $jumlah_ys;?>],
            name: 'Yakin + Salah'
          }, {
            value: [<?php echo $jumlah_yb;?>],
            name: 'Yakin + Benar'
          }, {
            value: [<?php echo $jumlah_tys;?>],
            name: 'Tidak Yakin + Salah'
          }, {
            value: [<?php echo $jumlah_tyb;?>],
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









