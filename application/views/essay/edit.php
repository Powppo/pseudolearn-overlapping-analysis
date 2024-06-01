<html>
    <link rel="stylesheet" href="https://pyscript.net/alpha/pyscript.css" />
    <script defer src="https://pyscript.net/alpha/pyscript.js"></script>
</html>

<style>


:root {
  --header-bg: #201e46;
  --disable: #c3c2c6;
  --card-bg: #f8f8f8;
  --completed-status: #2aac16;
  --incompleted-status: #ffe3c5;
  --quiz-algorithm: #dff3f3;
  --header-answer: #314d63;
  --answer-item: #b55b71;
  --answer-heading: #f98082;
  --check: #f2be53;
  --submit: #37ab98;
}

body {
  position: relative;
  font-family: "Ebrima", Times, serif;
}

.header1 {
  background-color: var(--header-bg);
  display: flex;
  align-items: center;
  justify-content: end;
  padding: 0.5rem 0.75rem;
}

.header1__profile {
  background-color: var(--disable);
  width: 3rem;
  height: 3rem;
  border-radius: 50%;
}

.quiz {
    /* padding: 6rem; */
    display: flex;
    justify-content: space-between;
    /* width: 65%; */
    margin: 0 auto;
}

.quiz>*+* {
    margin-left: 4rem;
}

.quiz__description {
    width: 100%;
}

.quiz__description>*+* {
    margin-top: 2rem;
    text-align: justify;
    margin: 20px;
}

.description__question {
    font-weight: 600;
}

.description__algorithm,
.description__data-type {
    width: 90%;
    margin-top: 20px;
    border-radius: 13px;
    background-color: var(--quiz-algorithm);
    display: flex;
    border-style: solid;
    border-width: 4px 4px 4px 4px;
    border-color: #314d63;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.algorithm__title,
.data-type__title {
    background-color: var(--header-answer);
    width: 100%;
    color: #fff;
    padding: 0.25rem 0;
    text-align: center;
}

.algorithm__items,
.data-type__items {
    padding: 0.75rem 0;
    display: flex;
    gap: 0.75rem;
    flex-direction: column;
}

.algorithm__item>button {
    width: 100%;
    border: none;
    padding: 0.5rem 1rem;
    font-weight: bold;
    color: white;
    border-radius: 0.25rem;
    cursor: pointer;
    background-color: var(--answer-item);
    font-size: 16px;
}

.data-type__items {
    display: flex;
    justify-content: center;
    align-items: center;
}

.data-type__item>button {
    border: none;
    color: white;
    padding: 0.5rem;
    border-radius: 0.25rem;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    background-color: var(--answer-item);
}

.quiz__answer {
    width: 100%;
    margin-right: 50px;

}

.quiz__answer>*+* {
    margin-top: 2rem;
}

.answer__content {
    width: 100%;
    border-spacing: 0.5rem;
}

.answer__content th {
    font-weight: bold;
    width: 14rem;
    text-align: center;
    vertical-align: top;
}

.answer__content th>span {
    width: 100%;
    padding: 0.25rem 0.5rem;
    display: inline-block;
    background-color: var(--answer-heading);
}

.answer__content td {
    padding: 0.25rem 0.5rem;
    width: 16rem;
    display: flexbox;
    border-color: #52412d;
    border-width: 2px;
    border-style: solid;
    font-weight: bold;
    text-align: center;
    background-color: var(--incompleted-status);
}

.answer__content td>span {
    font-weight: bold;
}

.quiz1__answer {
    margin-top: -20px;
    margin-left: 20px;
    width: 100%;
}

.answer1__content {
    width: 90%;
    border-spacing: 0.5rem;
}

.answer1__content th {
    font-weight: bold;
    width: 100%;
    width: 200rem;
    text-align: center;
    vertical-align: top;
}

.answer1__content th>span {
    width: 100%;
    padding: 0.25rem 0.5rem;
    display: inline-block;
    background-color: var(--answer-heading);
}

.answer1__content td {
    padding: 0.25rem 7rem;
    width: 16rem;
    display: flexbox;
    border-color: #52412d;
    border-width: 2px;
    border-style: solid;
    font-weight: bold;
    text-align: center;
    background-color: var(--incompleted-status);
}

.answer1__content td>span {
    font-weight: bold;
}

.answer__item--user {
    color: white;
    width: 100%;
    font-size: 16px;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    background-color: var(--answer-item);
}

.answer__tools {
    width: 100%;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
}

.tools__button {
    border: none;
    padding: 0.5rem 1.5rem;
    font-size: 16px;
    font-weight: bold;
    color: white;
    cursor: pointer;
}

.tools__button--check {
    background-color: var(--check);
}

.tools__button--submit {
    background-color: var(--submit);
}

.draggable {
          background: #f08976;
          border-radius: 10px;
          border: 1px solid #eb7b6a;
          font-weight: bold;
          width: 200px;
          padding: 5px;
          margin: 3px;
          text-align:center;
      }

      .drop-zone {
          width: 300px;
          padding: 10px;
          margin: 10px;
          height: 20px;
          background: #eee;
          border: 2px solid #31364c;
          min-height: 36px;
      }

      /* Dragged source element style */
      .dragged {
          opacity: .6;
          border-style: dashed;
      }

      /* Drag feedback image style */
      .drag-feedback {
          background: lightskyblue;
          border: 1px solid dodgerblue;
      }

      /* drop zone highlights */
      .active-zone {
          background: #fffad6;
          border: 2px solid #aaa479;
      }

      .over-zone {
          background: #ffc6c6;
          border: 2px solid #931414;
      }

      /* Style for text drag test area */
      .drag-text-test {
          width: 300px;
          margin: 10px;
      }

      .drag-text-test textarea {
          width: 100%;
          padding: 10px;
          height: 36px;
      }

</style>
<div class="row">
    <div class="col-sm-12">
        <?php $a = $essay->id_essay ?>
        <?= form_open_multipart('/essay/save', array('id' => 'essay'), array('method' => 'edit', 'id_essay' => $essay->id_essay)) ?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $subjudul ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <?php 
                $tabelsoal = $this->db->query('select * from tb_soal where id_soal = ?',$essay->id_soal)->result();
                
                ?>
                <?php foreach ($tabelsoal as $value) : ?>
                    <?php
                    $kata = $value->soal;
                    $hapus = array("<p>", "</p>");
                    $hasil = str_replace($hapus, "", $kata);
                    $soalDigunakan = $hasil;
                    ?>
                <?php endforeach; ?>
                <div class="box-title2">
                    <?=$soalDigunakan?>
                </div>
            </div>
            <div class="box-body" style= "display: flex;">
            <div >
                            <!-- 
                                Membuat perulangan A-E 
                            -->
                            <div>
                                <div id="wrappertwo">
                                    <input type="hidden" name="id_soal" value="<?=$essay->id_soal?>">
                                    <input type="hidden" name="id_level" value="<?=$essay->id_level?>">
                                    <input type="hidden" name="status" value="1">
                                    <?php 
                                    $tabelsoal = $this->db->query('select * from tb_soal where id_soal = ?',$essay->id_soal)->result();

                                    ?>
                                    <!-- <?php foreach ($tabelsoal as $value) : ?>
                                        <?php
                                        $kata = $value->judul;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        ?>
                                        <?php echo '<p><strong>Judul = </strong>'.$hasilKata.'</p>'?>
                                    <?php endforeach; ?>  -->
                                    <?php
                                    $arr_jawaban = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o");
                                    $arr_opsi = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o");
                                    $arr_pseudo = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o");
                                    $var_jawaban = array(1, 2, 3, 4, 5, 6, 7, 8);
                                    $arr_clue = array(1,2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);
                                    $var_opsi = array(1, 2, 3, 4, 5, 6, 7, 8);
                                    $var_urut = array(1, 2, 3, 4, 5, 6, 7, 8);
                                    $jenis_opsi = array(1, 2, 3, 4, 5, 6, 7, 8);
                                    $jenis_opsi = array(1, 2, 3, 4, 5, 6, 7, 8);
                                    $var_count = 8;
                                    $variabel_count = 8;
                                    $jenis_count = 8;
                                    ?>
                                    <?php
                                    $no = 1;
                                    ?>
                                    <?php foreach ($tabelsoal as $soal) : ?>
                                    <div style="width: 100%">
                                            <table class="answer1__content">
                                                <tbody>
                                                    <tr>
                                                        <th><span>Judul</span></th>
                                                        <td><?= $soal->judul ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                   
                                    <div class="description__data-type data-type">
                                            <h4 class="data-type__title">Tipe Data</h4>
                                            <ul class="data-type__items">
                                    <?php
                                        for ($i=0; $i < $jenis_count; $i++) { 
                                            $jd = "jenis_data_v".$var_opsi[$i];
                                            $var = "variable_".$var_opsi[$i];
                                            if (!empty($soal->$var)) {
                                                echo '<li class="data-type__item draggable" id="opsi_jenis_'.$var_opsi[$i].'">'.$no .'. '.$soal->$var. " = " .$soal->$jd.'</li>';
                                                $no++;
                                            } else {
                                                echo '';
                                            }
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                    <?php endforeach; ?>
                                    <main class="quiz">
                                    <div class="quiz__description description">
                                    <?php foreach ($tabelsoal as $soal) : ?>
                                            <?php
                                            $arr_jawaban = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o");
                                            $arr_opsi = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o");
                                            $arr_pseudo = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o");
                                            $var_jawaban = array(1, 2, 3, 4, 5, 6, 7, 8);
                                            $arr_clue = array(1,2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);
                                            $var_opsi = array(1, 2, 3, 4, 5, 6, 7, 8);
                                            $var_urut = array(1, 2, 3, 4, 5, 6, 7, 8);
                                            $jenis_opsi = array(1, 2, 3, 4, 5, 6, 7, 8);
                                            $jenis_opsi = array(1, 2, 3, 4, 5, 6, 7, 8);
                                            $var_count = 8;
                                            $variabel_count = 8;
                                            $jenis_count = 8;
                                            ?>
                                        <div class="description__algorithm algorithm">
                                            <h4 class="algorithm__title">Urutan Pseudocode</h4>
                                            <ul class="algorithm__items">
                                                
                                    <?php
                                    if ($soal->urut_a) {
                                        $urut = "opsi_".$soal->urut_a;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }
                                    }
                                    if ($soal->urut_b) {
                                        $urut = "opsi_".$soal->urut_b;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_c) {
                                        $urut = "opsi_".$soal->urut_c;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_d) {
                                        $urut = "opsi_".$soal->urut_d;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_e) {
                                        $urut = "opsi_".$soal->urut_e;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_f) {
                                        $urut = "opsi_".$soal->urut_f;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_g) {
                                        $urut = "opsi_".$soal->urut_g;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }
                                    }
                                    if ($soal->urut_h) {
                                        $urut = "opsi_".$soal->urut_h;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_i) {
                                        $urut = "opsi_".$soal->urut_i;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_j) {
                                        $urut = "opsi_".$soal->urut_j;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_k) {
                                        $urut = "opsi_".$soal->urut_k;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_l) {
                                        $urut = "opsi_".$soal->urut_l;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_m) {
                                        $urut = "opsi_".$soal->urut_m;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_n) {
                                        $urut = "opsi_".$soal->urut_n;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_o) {
                                        $urut = "opsi_".$soal->urut_o;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_p) {
                                        $urut = "opsi_".$soal->urut_p;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_q) {
                                        $urut = "opsi_".$soal->urut_q;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_r) {
                                        $urut = "opsi_".$soal->urut_r;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_s) {
                                        $urut = "opsi_".$soal->urut_s;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_t) {
                                        $urut = "opsi_".$soal->urut_t;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_u) {
                                        $urut = "opsi_".$soal->urut_u;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_v) {
                                        $urut = "opsi_".$soal->urut_v;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_w) {
                                        $urut = "opsi_".$soal->urut_w;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_x) {
                                        $urut = "opsi_".$soal->urut_x;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_y) {
                                        $urut = "opsi_".$soal->urut_y;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    if ($soal->urut_z) {
                                        $urut = "opsi_".$soal->urut_z;
                                        $value = $soal->$urut;
                                        $kata = $soal->$urut;
                                        $hapusKata = array("<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $kata);
                                        if ($value == '<p>START</p>' || $value == '<p>END</p>') {
                                            echo '';
                                        } else {
                                            echo '<li class="algorithm__item draggable dsdsd">'.$no.'. '. $hasilKata .'</li>';
                                            $no++;
                                        }	
                                    }
                                    ?>
                                    </ul>
                                    <?php endforeach; ?>
                                    
                                    </div>
                                    
                    </main>
                </div>
                                </div>
                            </div>
			


                            </div>
                        <div>
                            <div class="quiz__answer answer" >
                                        <table class="answer__content" >
                                                <tbody>
                                                <tr>
                                                <th><span>Konversi Kode Program</span></th>
                                                </tr><tr><td>
                                        <?php
                                        ?>
                                        
                                        <?php foreach ($tabelsoal as $soal) : ?>
                                        <?php
                                            $kata = $soal->judul;
                                            $hapusKata = array("program", "<p>", "</p>");
                                            $hasilKata = str_replace($hapusKata, "", $kata);
                                            if ($soal->jenis_program == 0) {
                                            echo '';
                                                if ($soal->variable_1) {
                                                    if (!empty($soal->variable_1)) {
                                                        echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_1" name="urutan_nomor_1">'.$essay->urutan_nomor_1.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_1" name="jawaban_1">'.$essay->jawaban_1.'</textarea><input type="hidden" id="nilai_1" name="nilai_1" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->variable_2) {
                                                    if (!empty($soal->variable_2)) {
                                                        echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_2" name="urutan_nomor_2">'.$essay->urutan_nomor_2.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_2" name="jawaban_2">'.$essay->jawaban_2.'</textarea><input type="hidden" id="nilai_2" name="nilai_2" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->variable_3) {
                                                    if (!empty($soal->variable_3)) {
                                                        echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_3" name="urutan_nomor_3">'.$essay->urutan_nomor_3.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_3" name="jawaban_3">'.$essay->jawaban_3.'</textarea><input type="hidden" id="nilai_3" name="nilai_3" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->variable_4) {
                                                    if (!empty($soal->variable_4)) {
                                                        echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_4" name="urutan_nomor_4">'.$essay->urutan_nomor_4.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_4" name="jawaban_4">'.$essay->jawaban_4.'</textarea><input type="hidden" id="nilai_4" name="nilai_4" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->variable_5) {
                                                    if (!empty($soal->variable_5)) {
                                                        echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_5" name="urutan_nomor_5">'.$essay->urutan_nomor_5.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_5" name="jawaban_5">'.$essay->jawaban_5.'</textarea><input type="hidden" id="nilai_5" name="nilai_5" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->variable_6) {
                                                    if (!empty($soal->variable_6)) {
                                                        echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_6" name="urutan_nomor_6">'.$essay->urutan_nomor_6.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_6" name="jawaban_6">'.$essay->jawaban_6.'</textarea><input type="hidden" id="nilai_6" name="nilai_6" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->variable_7) {
                                                    if (!empty($soal->variable_7)) {
                                                        echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_7" name="urutan_nomor_7">'.$essay->urutan_nomor_7.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_7" name="jawaban_7">'.$essay->jawaban_7.'</textarea><input type="hidden" id="nilai_7" name="nilai_7" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->variable_8) {
                                                    if (!empty($soal->variable_8)) {
                                                        echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_8" name="urutan_nomor_8">'.$essay->urutan_nomor_8.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_8" name="jawaban_8">'.$essay->jawaban_8.'</textarea><input type="hidden" id="nilai_8" name="nilai_8" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->opsi_a) {
                                                    if ($soal->opsi_a == '<p>START</p>' || $soal->opsi_a == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_a)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_a" name="urutan_nomor_a">'.$essay->urutan_nomor_a.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_a" name="jawaban_a">'.$essay->jawaban_a.'</textarea><input type="hidden" id="nilai_a" name="nilai_a" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                    }
                                                }
                                                if ($soal->opsi_b) {
                                                    if ($soal->opsi_b == '<p>START</p>' || $soal->opsi_b == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_b)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_b" name="urutan_nomor_b">'.$essay->urutan_nomor_b.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_b" name="jawaban_b">'.$essay->jawaban_b.'</textarea><input type="hidden" id="nilai_b" name="nilai_b" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                    }
                                                }
                                                if ($soal->opsi_c) {
                                                    if ($soal->opsi_c == '<p>START</p>' || $soal->opsi_c == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_c)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_c" name="urutan_nomor_c">'.$essay->urutan_nomor_c.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_c" name="jawaban_c">'.$essay->jawaban_c.'</textarea><input type="hidden" id="nilai_c" name="nilai_c" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_d) {
                                                    if ($soal->opsi_d == '<p>START</p>' || $soal->opsi_d == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_d)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_d" name="urutan_nomor_d">'.$essay->urutan_nomor_d.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_d" name="jawaban_d">'.$essay->jawaban_d.'</textarea><input type="hidden" id="nilai_d" name="nilai_d" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_e) {
                                                    if ($soal->opsi_e == '<p>START</p>' || $soal->opsi_e == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_e)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_e" name="urutan_nomor_e">'.$essay->urutan_nomor_e.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_e" name="jawaban_e">'.$essay->jawaban_e.'</textarea><input type="hidden" id="nilai_e" name="nilai_e" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_f) {
                                                    if ($soal->opsi_f == '<p>START</p>' || $soal->opsi_f == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_f)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_f" name="urutan_nomor_f">'.$essay->urutan_nomor_f.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_f" name="jawaban_f">'.$essay->jawaban_f.'</textarea><input type="hidden" id="nilai_f" name="nilai_f" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_g) {
                                                    if ($soal->opsi_g == '<p>START</p>' || $soal->opsi_g == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_g)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_g" name="urutan_nomor_g">'.$essay->urutan_nomor_g.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_g" name="jawaban_g">'.$essay->jawaban_g.'</textarea><input type="hidden" id="nilai_g" name="nilai_g" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_h) {
                                                    if ($soal->opsi_h == '<p>START</p>' || $soal->opsi_h == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_h)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_h" name="urutan_nomor_h">'.$essay->urutan_nomor_h.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_h" name="jawaban_h">'.$essay->jawaban_h.'</textarea><input type="hidden" id="nilai_h" name="nilai_h" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_i) {
                                                    if ($soal->opsi_i == '<p>START</p>' || $soal->opsi_i == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_i)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_i" name="urutan_nomor_i">'.$essay->urutan_nomor_i.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_i" name="jawaban_i">'.$essay->jawaban_i.'</textarea><input type="hidden" id="nilai_i" name="nilai_i" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_j) {
                                                    if ($soal->opsi_j == '<p>START</p>' || $soal->opsi_j == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_j)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_j" name="urutan_nomor_j">'.$essay->urutan_nomor_j.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_j" name="jawaban_j">'.$essay->jawaban_j.'</textarea><input type="hidden" id="nilai_j" name="nilai_j" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_k) {
                                                    if ($soal->opsi_k == '<p>START</p>' || $soal->opsi_k == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_k)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_k" name="urutan_nomor_k">'.$essay->urutan_nomor_k.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_k" name="jawaban_k">'.$essay->jawaban_k.'</textarea><input type="hidden" id="nilai_k" name="nilai_k" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_l) {
                                                    if ($soal->opsi_l == '<p>START</p>' || $soal->opsi_l == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_l)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_l" name="urutan_nomor_l">'.$essay->urutan_nomor_l.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_l" name="jawaban_l">'.$essay->jawaban_l.'</textarea><input type="hidden" id="nilai_l" name="nilai_l" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_m) {
                                                    if ($soal->opsi_m == '<p>START</p>' || $soal->opsi_m == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_m)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_m" name="urutan_nomor_m">'.$essay->urutan_nomor_m.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_m" name="jawaban_m">'.$essay->jawaban_m.'</textarea><input type="hidden" id="nilai_m" name="nilai_m" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_n) {
                                                    if ($soal->opsi_n == '<p>START</p>' || $soal->opsi_n == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_n)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_n" name="urutan_nomor_n">'.$essay->urutan_nomor_n.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_n" name="jawaban_n">'.$essay->jawaban_n.'</textarea><input type="hidden" id="nilai_n" name="nilai_n" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_o) {
                                                    if ($soal->opsi_o == '<p>START</p>' || $soal->opsi_o == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_o)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_o" name="urutan_nomor_o">'.$essay->urutan_nomor_o.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_o" name="jawaban_o">'.$essay->jawaban_o.'</textarea><input type="hidden" id="nilai_o" name="nilai_o" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_p) {
                                                    if ($soal->opsi_p == '<p>START</p>' || $soal->opsi_p == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_p)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_p" name="urutan_nomor_p">'.$essay->urutan_nomor_p.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_p" name="jawaban_p">'.$essay->jawaban_p.'</textarea><input type="hidden" id="nilai_p" name="nilai_p" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_q) {
                                                    if ($soal->opsi_q == '<p>START</p>' || $soal->opsi_q == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_q)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_q" name="urutan_nomor_q">'.$essay->urutan_nomor_q.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_q" name="jawaban_q">'.$essay->jawaban_q.'</textarea><input type="hidden" id="nilai_q" name="nilai_q" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_r) {
                                                    if ($soal->opsi_r == '<p>START</p>' || $soal->opsi_r == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_r)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_r" name="urutan_nomor_r">'.$essay->urutan_nomor_r.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_r" name="jawaban_r">'.$essay->jawaban_r.'</textarea><input type="hidden" id="nilai_r" name="nilai_r" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_s) {
                                                    if ($soal->opsi_s == '<p>START</p>' || $soal->opsi_s == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_s)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_s" name="urutan_nomor_s">'.$essay->urutan_nomor_s.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_s" name="jawaban_s">'.$essay->jawaban_s.'</textarea><input type="hidden" id="nilai_s" name="nilai_s" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_t) {
                                                    if ($soal->opsi_t == '<p>START</p>' || $soal->opsi_t == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_t)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_t" name="urutan_nomor_t">'.$essay->urutan_nomor_t.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_t" name="jawaban_t">'.$essay->jawaban_t.'</textarea><input type="hidden" id="nilai_t" name="nilai_t" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_u) {
                                                    if ($soal->opsi_u == '<p>START</p>' || $soal->opsi_u == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_u)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_u" name="urutan_nomor_u">'.$essay->urutan_nomor_u.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_u" name="jawaban_u">'.$essay->jawaban_u.'</textarea><input type="hidden" id="nilai_u" name="nilai_u" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_v) {
                                                    if ($soal->opsi_v == '<p>START</p>' || $soal->opsi_v == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_v)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_v" name="urutan_nomor_v">'.$essay->urutan_nomor_v.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_v" name="jawaban_v">'.$essay->jawaban_v.'</textarea><input type="hidden" id="nilai_v" name="nilai_v" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_w) {
                                                    if ($soal->opsi_w == '<p>START</p>' || $soal->opsi_w == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_w)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_w" name="urutan_nomor_w">'.$essay->urutan_nomor_w.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_w" name="jawaban_w">'.$essay->jawaban_w.'</textarea><input type="hidden" id="nilai_w" name="nilai_w" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_x) {
                                                    if ($soal->opsi_x == '<p>START</p>' || $soal->opsi_x == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_x)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_x" name="urutan_nomor_x">'.$essay->urutan_nomor_x.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_x" name="jawaban_x">'.$essay->jawaban_x.'</textarea><input type="hidden" id="nilai_x" name="nilai_x" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_y) {
                                                    if ($soal->opsi_y == '<p>START</p>' || $soal->opsi_y == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_y)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_y" name="urutan_nomor_y">'.$essay->urutan_nomor_y.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_y" name="jawaban_y">'.$essay->jawaban_y.'</textarea><input type="hidden" id="nilai_y" name="nilai_y" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_z) {
                                                    if ($soal->opsi_z == '<p>START</p>' || $soal->opsi_z == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_z)) {
                                                            echo '<div style="margin: 10px; display: flex;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_z" name="urutan_nomor_z">'.$essay->urutan_nomor_z.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_z" name="jawaban_z">'.$essay->jawaban_z.'</textarea><input type="hidden" id="nilai_z" name="nilai_z" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                echo '';
                                            }
                                            if ($soal->jenis_program == 1) {
                                                echo '';
                                                if ($soal->variable_1) {
                                                    if (!empty($soal->variable_1)) {
                                                        echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_1" name="urutan_nomor_1">'.$essay->urutan_nomor_1.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_1" name="jawaban_1">'.$essay->jawaban_1.'</textarea><input type="hidden" id="nilai_1" name="nilai_1" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->variable_2) {
                                                    if (!empty($soal->variable_2)) {
                                                        echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_2" name="urutan_nomor_2">'.$essay->urutan_nomor_2.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_2" name="jawaban_2">'.$essay->jawaban_2.'</textarea><input type="hidden" id="nilai_2" name="nilai_2" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->variable_3) {
                                                    if (!empty($soal->variable_3)) {
                                                        echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_3" name="urutan_nomor_3">'.$essay->urutan_nomor_3.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_3" name="jawaban_3">'.$essay->jawaban_3.'</textarea><input type="hidden" id="nilai_3" name="nilai_3" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->variable_4) {
                                                    if (!empty($soal->variable_4)) {
                                                        echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_4" name="urutan_nomor_4">'.$essay->urutan_nomor_4.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_4" name="jawaban_4">'.$essay->jawaban_4.'</textarea><input type="hidden" id="nilai_4" name="nilai_4" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->variable_5) {
                                                    if (!empty($soal->variable_5)) {
                                                        echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_5" name="urutan_nomor_5">'.$essay->urutan_nomor_5.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_5" name="jawaban_5">'.$essay->jawaban_5.'</textarea><input type="hidden" id="nilai_5" name="nilai_5" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->variable_6) {
                                                    if (!empty($soal->variable_6)) {
                                                        echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_6" name="urutan_nomor_6">'.$essay->urutan_nomor_7.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_6" name="jawaban_6">'.$essay->jawaban_6.'</textarea><input type="hidden" id="nilai_6" name="nilai_6" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->variable_7) {
                                                    if (!empty($soal->variable_7)) {
                                                        echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_7" name="urutan_nomor_7">'.$essay->urutan_nomor_7.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_7" name="jawaban_7">'.$essay->jawaban_7.'</textarea><input type="hidden" id="nilai_7" name="nilai_7" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->variable_8) {
                                                    if (!empty($soal->variable_8)) {
                                                        echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_8" name="urutan_nomor_8">'.$essay->urutan_nomor_8.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_8" name="jawaban_8">'.$essay->jawaban_8.'</textarea><input type="hidden" id="nilai_8" name="nilai_8" value="5"></div>';
                                                        $no++;
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                if ($soal->opsi_a) {
                                                    if ($soal->opsi_a == '<p>START</p>' || $soal->opsi_a == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_a)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_a" name="urutan_nomor_a">'.$essay->urutan_nomor_a.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_a" name="jawaban_a">'.$essay->jawaban_a.'</textarea><input type="hidden" id="nilai_a" name="nilai_a" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                    }
                                                }
                                                if ($soal->opsi_b) {
                                                    if ($soal->opsi_b == '<p>START</p>' || $soal->opsi_b == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_b)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_b" name="urutan_nomor_b">'.$essay->urutan_nomor_b.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_b" name="jawaban_b">'.$essay->jawaban_b.'</textarea><input type="hidden" id="nilai_b" name="nilai_b" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                    }
                                                }
                                                if ($soal->opsi_c) {
                                                    if ($soal->opsi_c == '<p>START</p>' || $soal->opsi_c == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_c)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_c" name="urutan_nomor_c">'.$essay->urutan_nomor_c.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_c" name="jawaban_c">'.$essay->jawaban_c.'</textarea><input type="hidden" id="nilai_c" name="nilai_c" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_d) {
                                                    if ($soal->opsi_d == '<p>START</p>' || $soal->opsi_d == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_d)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_d" name="urutan_nomor_d">'.$essay->urutan_nomor_d.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_d" name="jawaban_d">'.$essay->jawaban_d.'</textarea><input type="hidden" id="nilai_d" name="nilai_d" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_e) {
                                                    if ($soal->opsi_e == '<p>START</p>' || $soal->opsi_e == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_e)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_e" name="urutan_nomor_e">'.$essay->urutan_nomor_e.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_e" name="jawaban_e">'.$essay->jawaban_e.'</textarea><input type="hidden" id="nilai_e" name="nilai_e" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_f) {
                                                    if ($soal->opsi_f == '<p>START</p>' || $soal->opsi_f == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_f)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_f" name="urutan_nomor_f">'.$essay->urutan_nomor_f.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_f" name="jawaban_f">'.$essay->jawaban_f.'</textarea><input type="hidden" id="nilai_f" name="nilai_f" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_g) {
                                                    if ($soal->opsi_g == '<p>START</p>' || $soal->opsi_g == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_g)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_g" name="urutan_nomor_g">'.$essay->urutan_nomor_g.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_g" name="jawaban_g">'.$essay->jawaban_g.'</textarea><input type="hidden" id="nilai_g" name="nilai_g" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_h) {
                                                    if ($soal->opsi_h == '<p>START</p>' || $soal->opsi_h == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_h)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_h" name="urutan_nomor_h">'.$essay->urutan_nomor_h.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_h" name="jawaban_h">'.$essay->jawaban_h.'</textarea><input type="hidden" id="nilai_h" name="nilai_h" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_i) {
                                                    if ($soal->opsi_i == '<p>START</p>' || $soal->opsi_i == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_i)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_i" name="urutan_nomor_i">'.$essay->urutan_nomor_i.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_i" name="jawaban_i">'.$essay->jawaban_i.'</textarea><input type="hidden" id="nilai_i" name="nilai_i" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_j) {
                                                    if ($soal->opsi_j == '<p>START</p>' || $soal->opsi_j == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_j)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_j" name="urutan_nomor_j">'.$essay->urutan_nomor_j.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_j" name="jawaban_j">'.$essay->jawaban_j.'</textarea><input type="hidden" id="nilai_j" name="nilai_j" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_k) {
                                                    if ($soal->opsi_k == '<p>START</p>' || $soal->opsi_k == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_k)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_k" name="urutan_nomor_k">'.$essay->urutan_nomor_k.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_k" name="jawaban_k">'.$essay->jawaban_k.'</textarea><input type="hidden" id="nilai_k" name="nilai_k" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_l) {
                                                    if ($soal->opsi_l == '<p>START</p>' || $soal->opsi_l == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_l)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_l" name="urutan_nomor_l">'.$essay->urutan_nomor_l.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_l" name="jawaban_l">'.$essay->jawaban_l.'</textarea><input type="hidden" id="nilai_l" name="nilai_l" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_m) {
                                                    if ($soal->opsi_m == '<p>START</p>' || $soal->opsi_m == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_m)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_m" name="urutan_nomor_m">'.$essay->urutan_nomor_m.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_m" name="jawaban_m">'.$essay->jawaban_m.'</textarea><input type="hidden" id="nilai_m" name="nilai_m" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_n) {
                                                    if ($soal->opsi_n == '<p>START</p>' || $soal->opsi_n == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_n)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_n" name="urutan_nomor_n">'.$essay->urutan_nomor_n.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_n" name="jawaban_n">'.$essay->jawaban_n.'</textarea><input type="hidden" id="nilai_n" name="nilai_n" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_o) {
                                                    if ($soal->opsi_o == '<p>START</p>' || $soal->opsi_o == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_o)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_o" name="urutan_nomor_o">'.$essay->urutan_nomor_o.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_o" name="jawaban_o">'.$essay->jawaban_o.'</textarea><input type="hidden" id="nilai_o" name="nilai_o" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_p) {
                                                    if ($soal->opsi_p == '<p>START</p>' || $soal->opsi_p == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_p)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_p" name="urutan_nomor_p">'.$essay->urutan_nomor_p.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_p" name="jawaban_p">'.$essay->jawaban_p.'</textarea><input type="hidden" id="nilai_p" name="nilai_p" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_q) {
                                                    if ($soal->opsi_q == '<p>START</p>' || $soal->opsi_q == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_q)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_q" name="urutan_nomor_q">'.$essay->urutan_nomor_q.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_q" name="jawaban_q">'.$essay->jawaban_q.'</textarea><input type="hidden" id="nilai_q" name="nilai_q" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_r) {
                                                    if ($soal->opsi_r == '<p>START</p>' || $soal->opsi_r == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_r)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_r" name="urutan_nomor_r">'.$essay->urutan_nomor_s.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_r" name="jawaban_r">'.$essay->jawaban_r.'</textarea><input type="hidden" id="nilai_r" name="nilai_r" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_s) {
                                                    if ($soal->opsi_s == '<p>START</p>' || $soal->opsi_s == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_s)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_s" name="urutan_nomor_s">'.$essay->urutan_nomor_s.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_s" name="jawaban_s">'.$essay->jawaban_s.'</textarea><input type="hidden" id="nilai_s" name="nilai_s" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_t) {
                                                    if ($soal->opsi_t == '<p>START</p>' || $soal->opsi_t == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_t)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_t" name="urutan_nomor_t">'.$essay->urutan_nomor_t.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_t" name="jawaban_t">'.$essay->jawaban_t.'</textarea><input type="hidden" id="nilai_t" name="nilai_t" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_u) {
                                                    if ($soal->opsi_u == '<p>START</p>' || $soal->opsi_u == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_u)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_u" name="urutan_nomor_u">'.$essay->urutan_nomor_u.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_u" name="jawaban_u">'.$essay->jawaban_u.'</textarea><input type="hidden" id="nilai_u" name="nilai_u" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_v) {
                                                    if ($soal->opsi_v == '<p>START</p>' || $soal->opsi_v == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_v)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_v" name="urutan_nomor_v">'.$essay->urutan_nomor_v.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_v" name="jawaban_v">'.$essay->jawaban_v.'</textarea><input type="hidden" id="nilai_v" name="nilai_v" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_w) {
                                                    if ($soal->opsi_w == '<p>START</p>' || $soal->opsi_w == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_w)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_w" name="urutan_nomor_w">'.$essay->urutan_nomor_w.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_w" name="jawaban_w">'.$essay->jawaban_w.'</textarea><input type="hidden" id="nilai_w" name="nilai_w" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_x) {
                                                    if ($soal->opsi_x == '<p>START</p>' || $soal->opsi_x == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_x)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_x" name="urutan_nomor_x">'.$essay->urutan_nomor_x.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_x" name="jawaban_x">'.$essay->jawaban_x.'</textarea><input type="hidden" id="nilai_x" name="nilai_x" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_y) {
                                                    if ($soal->opsi_y == '<p>START</p>' || $soal->opsi_y == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_y)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_y" name="urutan_nomor_y">'.$essay->urutan_nomor_y.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_y" name="jawaban_y">'.$essay->jawaban_y.'</textarea><input type="hidden" id="nilai_y" name="nilai_y" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                if ($soal->opsi_z) {
                                                    if ($soal->opsi_z == '<p>START</p>' || $soal->opsi_z == '<p>END</p>') {
                                                        echo '';
                                                    } else {
                                                        if (!empty($soal->opsi_z)) {
                                                            echo '<div style="margin: 10px;"><textarea style="width: 25px; margin-right: 10px; height: 25px;" type="text" id="urutan_nomor_z" name="urutan_nomor_z">'.$essay->urutan_nomor_z.'</textarea><textarea style="width: 300px; height: 25px;" type="text" id="jawaban_z" name="jawaban_z">'.$essay->jawaban_z.'</textarea><input type="hidden" id="nilai_z" name="nilai_z" value="5"></div>';
                                                            $no++;
                                                        } else {
                                                            echo '';
                                                        }
                                                        
                                                    }
                                                }
                                                echo '';
                                            }
                                            $otp = '<py-script>
                                            '. $essay->jawaban_1.'
                                            '. $essay->jawaban_2.'
                                            '. $essay->jawaban_3.'
                                            '. $essay->jawaban_4.'
                                            '. $essay->jawaban_5.'
                                            '. $essay->jawaban_6.'
                                            '. $essay->jawaban_7.'
                                            '. $essay->jawaban_8.'
                                            '. $essay->jawaban_a.'
                                            '. $essay->jawaban_b.'
                                            '. $essay->jawaban_c.'
                                            '. $essay->jawaban_d.'
                                            '. $essay->jawaban_e.'
                                            '. $essay->jawaban_f.'
                                            '. $essay->jawaban_g.'
                                            '. $essay->jawaban_h.'
                                            '. $essay->jawaban_i.'
                                            '. $essay->jawaban_j.'
                                            '. $essay->jawaban_k.'
                                            '. $essay->jawaban_l.'
                                            '. $essay->jawaban_m.'
                                            '. $essay->jawaban_n.'
                                            '. $essay->jawaban_o.'
                                            '. $essay->jawaban_p.'
                                            '. $essay->jawaban_q.'
                                            '. $essay->jawaban_r.'
                                            '. $essay->jawaban_s.'
                                            '. $essay->jawaban_t.'
                                            '. $essay->jawaban_u.'
                                            '. $essay->jawaban_v.'
                                            '. $essay->jawaban_w.'
                                            '. $essay->jawaban_x.'
                                            '. $essay->jawaban_y.'
                                            '. $essay->jawaban_z.'</py-script>';
                                        ?>
                                        <?php endforeach; ?>
                                        </td></tr></tbody>
                                            </table>
                                            </div>
                            </div> 
                        </div>
                    </div>
                            <div class="form-group col-sm-12 ">
                                <label for="jenis_program" class="control-label">Pilih Jenis Program</label>
                                <select required="required" name="jenis_program" class="select2 form-group" style="width:100% !important">
                                    <option value="" disabled selected>Pilih Jenis Program</option>
                                    <option value="0">Tanpa Inputan</option>
                                    <option value="1">Dengan Inputan</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="bobot" class="control-label">Bobot Nilai</label>
                                <input value="<?= $essay->bobot ?>" type="text" name="bobot" placeholder="Bobot Soal" id="bobot" class="form-control" readonly>
                            </div>
                            
                            <!-- <div class="form-group col-sm-12 ">
                                <label for="id_soal" class="control-label">Masukan Soal</label>
                                <select required="required" name="id_soal" class="select2 form-group" style="width:100% !important">
                                    <option value="" disabled selected>Pilih Level</option>
                                    <?php
                                    foreach ($tb_soal as $sl) : ?>
                                        <option <?= $essay->id_soal == $sl->id_soal ? "selected" : ""; ?> value="<?= $sl->id_soal ?>"><?= $sl->id_soal?> - <?= $sl->judul ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> -->
                            
                            <div class="form-group col-sm-12">
                                <label for="bobot" class="control-label">Output Program</label>
                                <? $otpx = ""?>
                                <h1 name="output" id="output"><?= $otp ?></h1>
                            </div>
                            
                                <div class="col-sm-12">
                                    <div class="form-group pull-right">
                                        <a href="<?= base_url('essay') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                                        <button class='check btn btn-success' type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan & Run</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                                    </div>
                                    </div>
        <?= form_close() ?>
    </div>
</div>

<!-- Pastikan untuk menambahkan script ini di bagian head atau sebelum tag </body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.3/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.3/dist/sweetalert2.min.css">
<script src="<?=base_url()?>assets/dist/js/app/essay/edit.js"></script> -->

<script>
    const addOption = (type) => {
        if (type == "vartipe") {
            const currentIndex = $("[id*='formvartipe_']").length + 1;
            if(currentIndex == 9) return;
            const elemt = `<div class="row" id="formvartipe_${currentIndex}">
                <div class="col-xs-6">
                    <label for="file">Variable ${currentIndex}</label>
                    <div class="form-group">
                        <input name="variable_${currentIndex}" id="variable_${currentIndex}" class="form-control" value="<?= set_value('variable_${currentIndex}') ?>">
                        <small class="help-block" style="color: #dc3545"><?= form_error('variable_${currentIndex}') ?></small>
                    </div>
                </div>
                <div class="col-xs-6">
                    <label for="file">Tipe Data ${currentIndex}</label>
                    <div class="form-group">
                        <input name="tipe_data_${currentIndex}" id="tipe_data_${currentIndex}" class="form-control" value="<?= set_value('tipe_data_${currentIndex}') ?>">
                        <small class="help-block" style="color: #dc3545"><?= form_error('tipe_data_${currentIndex}') ?></small>
                    </div>
                </div>
            </div>`;
            $("#wrapperone").append(elemt);
        }else if (type == 'answer') {
            const answerTemplate = ['b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n','o'];
            const currentIndex = $("[id*='formanswer_']").length - 1;

            if (answerTemplate.length == (currentIndex)) return;
            const answer = answerTemplate[currentIndex];
            
            const elmt = `<div class="" id="formanswer_${answer}">
                <label for="file">Jawaban ${answer}</label>
                <div class="form-group">
                    <textarea name="jawaban_${answer}" id="jawaban_${answer}" class="form-control"><?= set_value('jawaban_${answer}') ?></textarea>
                    <small class="help-block" style="color: #dc3545"><?= form_error('jawaban_${answer}') ?></small>
                </div>
            </div>`;
        
            $("#wrappertwo").append(elmt);

        } else if (type == 'keyanswer') {
            const answerKey = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
            const currentIndex = $("[id*='formkeyanswer_']").length - 1;
            if(answerKey.length == (currentIndex)) return;
            const key = answerKey[currentIndex];
            const elmt = `<div id="formkeyanswer_${key}">
                <div class="col-sm-3">
                    <label for="urutan" class="control-label">Pilih Clue No. ${key} :</label>
                    <div class="col">
                        <label for="urutan">${key} <input type="checkbox" name="chck_${key}" value="urut_${key}"></label>
                    </div>
                </div>
                <div class="col-sm-9">
                    <label for="urutan" class="control-label">Pilih Urutan Jawaban No. ${key} :</label>
                    <select name="urut_${key}" id="urut_${key}" class="form-control select2" style="width:100%!important">
                        <option value="" disabled selected>Pilih Jawaban Urutan Ke ${key}</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                        <option value="e">E</option>
                        <option value="f">F</option>
                        <option value="g">G</option>
                        <option value="h">H</option>
                        <option value="i">I</option>
                        <option value="j">J</option>
                        <option value="k">K</option>
                        <option value="l">L</option>
                        <option value="m">M</option>
                        <option value="n">N</option>
                        <option value="o">O</option>
                    </select>
                    <small class="help-block" style="color: #dc3545"><?= form_error('urut_${key}') ?></small>
                </div>
            </div>`;
            $("#wrapperthree").append(elmt);
        }
    }
    const removeOption = (type) => {
        if (type == 'vartipe') {
            const currentIndex = $("[id*='formvartipe_']").length;
            if(currentIndex == 1) return;
            $(`#formvartipe_${currentIndex}`).remove();
        }else if(type == 'answer'){
            const currentIndex = $("[id*='formanswer_']").length;
            if(currentIndex == 1) return;
            $(`#formanswer_${currentIndex}`).remove();
        }else if(type == 'keyanswer') {
            const currentIndex = $("[id*='formkeyanswer_']").length;
            if(currentIndex == 1) return;
            $(`#formkeyanswer_${currentIndex}`).remove();
        }
    }


</script>