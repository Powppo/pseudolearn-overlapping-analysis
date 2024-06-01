<style>
.quiz__answer {
    width: 100%;
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
    text-align: center;
    background-color: var(--incompleted-status);
}

.answer__content td>span {
    font-weight: bold;
}

</style>
<div class="box">
    <div class="box-header with-header">
        <h3 class="box-title">Detail Essay</h3>
        <div class="pull-right">
            <a href="<?=base_url()?>essay" class="btn btn-xs btn-flat btn-default">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            <a href="<?=base_url()?>essay/edit/<?=$this->uri->segment(3)?>" class="btn btn-xs btn-flat btn-warning">
                <i class="fa fa-edit"></i> Edit
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <hr class="my-4">
                <?php 
                $tabelsoal = $this->db->query('select * from tb_soal where id_soal = ?',$essay->id_soal)->result();
                ?>
                <?php foreach ($tabelsoal as $value) : ?>
                <h3 class="text-center">Jawaban Essay <?=$value->judul?></h3>
                <br>
                <?php endforeach; ?>
                <div class="quiz__answer answer">
                    <table class="answer__content">
                        <tbody>
                            <tr>
                                <td>
                                    <?php 
                                    $tabelsoal = $this->db->query('select * from tb_soal where id_soal = ?',$essay->id_soal)->result();
                                    ?>
                                    <?php foreach ($tabelsoal as $value) : ?>
                                        <?php
                                        $text = $value->judul;
                                        $hapusKata = array("program", "<p>", "</p>");
                                        $hasilKata = str_replace($hapusKata, "", $text);
                                        ?>
                                    <?php endforeach; ?>
                                            <?php  
                                            $angka = [1, 2, 3, 4, 5, 6, 7, 8];

                                            foreach ($angka as $ank) :
                                                $jwbAngka = 'jawaban_'.$ank;
                                            ?>
                                                <?=
                                                !empty($essay->$jwbAngka) ? '<pre style=" display:flex; text-indent: 8ch; font-weight: bold; color: blue;"><p>'.$essay->$jwbAngka.'</p></pre>' : '';
                                                ?>

                                            <?php endforeach;?>

                                            <?php 
                                            $abjad = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n','o'];
                                            
                                            
                                            foreach ($abjad as $abj) :
                                            
                                                $ABJ = strtoupper($abj);
                                                $jawaban = 'jawaban_'.$abj;
                                                $jwb = 'jawaban '.$abj.' - ';
                                            ?>
                                                <?=
                                                !empty($essay->$jawaban) ? '<pre style=" display:flex; text-indent: 8ch; font-weight: bold; color: blue;"><p>'.$essay->$jawaban.'</p></pre>' : '';
                                                ?>
                                            
                                            <?php endforeach;?>
                                </td>
                            </tr>
                        </tbody> 
                    </table>
                    <h3 class="text-center">Contoh Output Program</h3>
                    <table class="answer__content">
                        <tbody>
                            <tr>
                                <td style="text-align: left;">
                                    <p><?=$essay->output?></p>
                                </td>
                            </tr>
                        </tbody> 
                    </table>
                </div>                
                
                <hr class="my-4">
                <strong>Bobot : </strong> <?=$essay->bobot?>
                <br> 
                <strong>Dibuat pada :</strong> <?=strftime("%A, %d %B %Y", date($essay->created_on))?>
                <br>
                <strong>Terkahir diupdate :</strong> <?=strftime("%A, %d %B %Y", date($essay->updated_on))?>
            </div>
        </div>
    </div>
</div>