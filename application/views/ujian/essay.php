<html>
    <link rel="stylesheet" href="https://pyscript.net/alpha/pyscript.css" />
    <script defer src="https://pyscript.net/alpha/pyscript.js"></script>
</html>
<?php
// if (time() >= $soal->waktu_habis) {
//     //redirect('ujian/list', 'location', 301);
// }
?>
<link rel="stylesheet" href="<?=base_url()?>template/css/base.css" />
<link rel="stylesheet" href="<?=base_url()?>template/css/quizessay.css" />
<link rel="stylesheet" href="<?=base_url()?>template/css/alert.css" />
<style>
      .draggable {
          background: #f08976;
          border-radius: 10px;
          border: 1px solid #eb7b6a;
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
    <div class="col-sm-3">
        
        <!-- <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Navigasi Soal</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body text-center" id="tampil_jawaban">
            </div>
        </div> -->
    </div>
    <div class="col-sm-12">
        <?= form_open_multipart('ujianessay/simpan_nilai', array('id' => 'ujianessay')); ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <!-- <h3 class="box-title"><span class="badge bg-blue">Soal #<span id="soalke"></span> </span></h3> -->
                <div class="box-tools pull-right">
                    <!-- <span class="badge bg-red">Sisa Waktu <span class="sisawaktu" data-time="<?= $soal->tgl_selesai ?>"></span></span> -->
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
            <label for="">Waktu Pengerjaan</label>
            <label id="my_timer">00:00:00</label>
                <div class="box-title1">
                    <br>
                    <h1 style="font-size: 20px;"><?=$soalDigunakan?></h1>
                </div>
                <input type="hidden" class="form-check-input" id="waktu" name="waktu" style="margin-left: 15px;"><h8 style="font-family: cursive;">
            </div>
            <div class="box-body">
                <?= $html ?>
            </div>
            <div class="box-footer text-center">
                    <!-- <ul>
                        <li id="demo1"></li>
                        <li id="demo2"></li>
                        <li id="demo3"></li>
                        <li id="demo4"></li>
                        <li id="demo5"></li>
                        <li id="demo6"></li>
                        <li id="demo7"></li>
                        <li id="demo8"></li>
                        <li id="demoa"></li>
                        <li id="demob"></li>
                        <li id="democ"></li>
                        <li id="demod"></li>
                        <li id="demoe"></li>
                        <li id="demof"></li>
                        <li id="demog"></li>
                        <li id="demoh"></li>
                        <li id="demoi"></li>
                    </ul> -->

                <a class="check btn btn-success" rel="1" onclick="return check_jawaban();">Check</a>
                <a class="check btn btn-danger" rel="1" onclick="return refresh();">Reload</a>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<script>


    function normalize(input) {
            return input.toLowerCase().replace(/[^a-zA-Z0-9()%\*&|<>%!:=+\-_,;"]/g, '');
    }
    function normalize2(input2) {
            return input.toLowerCase().replace(/[^a-zA-Z0-9()%\*&|<>%!:=+\-_,;"]/g, '');
    }

    function nGram(input, n) {
        let ngrams = [];
        let length = input.length;
        
        for (let i = 0; i < length; i++) {
            if (i >= (n - 1)) {
                let ng = '';
                for (let j = n - 1; j >= 0; j--) {
                    ng += input[i - j];
                }
                ngrams.push(ng);
            }
        }
        
        return ngrams;
    }

    function rollingHash(text, primeNumber) {
        const length = text.length;
        let result = 0;

        for (let i = 0; i < length; i++) {
            result += text.charCodeAt(i) * Math.pow(primeNumber, length - i) / 2;
        }

        return result;
    }

    function calculateRollingHash(ngram, primeNumber) {
        const rollingHash = [];
        for (let ng of ngram) {
            rollingHash.push(this.rollingHash(ng, primeNumber));
        }
        return rollingHash;
    }

    function calculateWindow(rollingHash, nWindowValue) {
        const windowTable = [];
        const length = rollingHash.length;
        
        for (let i = 0; i < length; i++) {
            if (i > (nWindowValue - 2)) {
                const window = [];
                for (let j = nWindowValue - 1; j >= 0; j--) {
                    window.push(rollingHash[i - j]);
                }
                windowTable.push(window);
            }
        }
        return windowTable;
    }

    function calculateFingerprints(windowTable, nWindowValue) {
        const fingerprints = [];
        for (let window of windowTable) {
            let min = window[0];
            for (let j = 1; j < nWindowValue; j++) {
                if (min > window[j]) {
                    min = window[j];
                }
            }
            fingerprints.push(min);
        }
        return fingerprints;
    }

    function jaccardCoefficient(fingerprint1, fingerprint2) {
        // Find intersection of two arrays
        const intersection = fingerprint1.intersection(fingerprint2);
        const union = fingerprint1.union(fingerprint2);
        // const intersection = fingerprint1.filter(value => fingerprint2.includes(value));

        // Combine arrays to find union (using a Set to handle unique values)
        // const unionSet = new Set([...fingerprint1, ...fingerprint2]);
        const intersection2 = Array.from(intersection);
        const union2 = Array.from(union);

        let intersectionCount = intersection2.length;
        let unionCount = union2.length;

        const coefficient = intersectionCount / unionCount;

        return coefficient;
    }


    // function boyerMooreMatch(needle, haystack) {
    //     var n = needle.length;
    //     var m = haystack.length;
    //     if (n > m) {
    //         return false;
    //     }
    //     if (n < m) {
    //         return false;
    //     }
        
    //     var badChar = new Array(256).fill(n);
    //     for (var i = 0; i < n - 1; i++) {
    //         badChar[needle.charCodeAt(i)] = n - i - 1;
    //     }
        
    //     var i = n - 1;
    //     while (i < m) {
    //         var j = n - 1;
    //         while (haystack[i] === needle[j]) {
    //         if (j === 0) {
    //             return i - n + 1;
    //         }
    //         i--;
    //         j--;
    //         }
    //         i += Math.max(badChar[haystack.charCodeAt(i)], n - j);
    //     }
        
    //     return false;
    // }
    
    function check_jawaban() {
        var err = 0;
        if ($('#jwb_1').length > 0) {
            var pattern = $('#jawaban_1').val(); // Pola yang ingin dicek
            var answer = $('#jwb_1').val();
            // var result = boyerMooreMatch(answer, pattern);

            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            
            
            if (coefficient == 1) {
                console.log(coefficient)
                $('#nilai_1').val('5')
                $('#jwb_1').css('background', '#66ff00')
                $('#jwb_1').css('color', '#000000')
            } else {
                console.log(coefficient)
                err = 1
                $('#nilai_1').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_1').css('background', '#FF0000')
                $('#jwb_1').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_2').length > 0) {
            var pattern = $('#jawaban_2').val(); // Pola yang ingin dicek
            var answer = $('#jwb_2').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                console.log(test)
                $('#nilai_2').val('5')
                $('#jwb_2').css('background', '#66ff00')
                $('#jwb_2').css('color', '#000000')
            } else {
                console.log(coefficient)
                err = 1
                $('#nilai_2').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_2').css('background', '#FF0000')
                $('#jwb_2').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_3').length > 0) {
            var pattern = $('#jawaban_3').val(); // Pola yang ingin dicek
            var answer = $('#jwb_3').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_3').val('5')
                $('#jwb_3').css('background', '#66ff00')
                $('#jwb_3').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_3').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_3').css('background', '#FF0000')
                $('#jwb_3').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_4').length > 0) {
            var pattern = $('#jawaban_4').val(); // Pola yang ingin dicek
            var answer = $('#jwb_4').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_4').val('5')
                $('#jwb_4').css('background', '#66ff00')
                $('#jwb_4').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_4').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_4').css('background', '#FF0000')
                $('#jwb_4').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_5').length > 0) {
            var pattern = $('#jawaban_5').val(); // Pola yang ingin dicek
            var answer = $('#jwb_5').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_5').val('5')
                $('#jwb_5').css('background', '#66ff00')
                $('#jwb_5').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_5').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_5').css('background', '#FF0000')
                $('#jwb_5').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_6').length > 0) {
            var pattern = $('#jawaban_6').val(); // Pola yang ingin dicek
            var answer = $('#jwb_6').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_6').val('5')
                $('#jwb_6').css('background', '#66ff00')
                $('#jwb_6').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_6').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_6').css('background', '#FF0000')
                $('#jwb_6').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_7').length > 0) {
            var pattern = $('#jawaban_7').val(); // Pola yang ingin dicek
            var answer = $('#jwb_7').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_7').val('5')
                $('#jwb_7').css('background', '#66ff00')
                $('#jwb_7').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_7').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_7').css('background', '#FF0000')
                $('#jwb_7').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_8').length > 0) {
            var pattern = $('#jawaban_8').val(); // Pola yang ingin dicek
            var answer = $('#jwb_8').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_8').val('5')
                $('#jwb_8').css('background', '#66ff00')
                $('#jwb_8').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_8').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_8').css('background', '#FF0000')
                $('#jwb_8').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_a').length > 0) {
            var pattern = $('#jawaban_a').val(); // Pola yang ingin dicek
            var answer = $('#jwb_a').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);

            var setengahPanjang = Math.floor(answer.length / 2);
            var setengahJawaban = answer.substring(0, setengahPanjang);
            if (coefficient == 1) {
                $('#nilai_a').val('5');
                $('#jwb_a').css('background', '#66ff00');
                $('#jwb_a').css('color', '#000000');
                
            }  else {
                err = 1
                $("#nilai_a").val('0');
                // alert('Urutan Pertama salah')
                $('#jwb_a').css('background', '#FF0000');
                $('#jwb_a').css('color', '#FFFFFF');
                
            }
        }

        if ($('#jwb_b').length > 0) {
            var pattern = $('#jawaban_b').val(); // Pola yang ingin dicek
            var answer = $('#jwb_b').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);

            var setengahPanjang = Math.floor(answer.length / 2);
            var setengahJawaban = answer.substring(0, setengahPanjang);

            if (coefficient == 1) {
                $('#nilai_b').val('5');
                $('#jwb_b').css('background', '#66ff00');
                $('#jwb_b').css('color', '#000000');
                
            }  else {
                err = 1
                $('#nilai_b').val('0');
                // alert('Urutan Pertama salah')
                $('#jwb_b').css('background', '#FF0000');
                $('#jwb_b').css('color', '#FFFFFF');
                
            }
        }

        if ($('#jwb_c').length > 0) {
            var pattern = $('#jawaban_c').val(); // Pola yang ingin dicek
            var answer = $('#jwb_c').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_c').val('5')
                $('#jwb_c').css('background', '#66ff00')
                $('#jwb_c').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_c').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_c').css('background', '#FF0000')
                $('#jwb_c').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_d').length > 0) {
            var pattern = $('#jawaban_d').val(); // Pola yang ingin dicek
            var answer = $('#jwb_d').val();
            var result = boyerMooreMatch(answer, pattern);
            if (coefficient == 1) {
                $('#nilai_d').val('5')
                $('#jwb_d').css('background', '#66ff00')
                $('#jwb_d').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_d').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_d').css('background', '#FF0000')
                $('#jwb_d').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_e').length > 0) {
            var pattern = $('#jawaban_e').val(); // Pola yang ingin dicek
            var answer = $('#jwb_e').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_e').val('5')
                $('#jwb_e').css('background', '#66ff00')
                $('#jwb_e').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_e').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_e').css('background', '#FF0000')
                $('#jwb_e').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_f').length > 0) {
            var pattern = $('#jawaban_f').val(); // Pola yang ingin dicek
            var answer = $('#jwb_f').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_f').val('5')
                $('#jwb_f').css('background', '#66ff00')
                $('#jwb_f').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_f').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_f').css('background', '#FF0000')
                $('#jwb_f').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_g').length > 0) {
            var pattern = $('#jawaban_g').val(); // Pola yang ingin dicek
            var answer = $('#jwb_g').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_g').val('5')
                $('#jwb_g').css('background', '#66ff00')
                $('#jwb_g').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_g').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_g').css('background', '#FF0000')
                $('#jwb_g').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_h').length > 0) {
            var pattern = $('#jawaban_h').val(); // Pola yang ingin dicek
            var answer = $('#jwb_h').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_h').val('5')
                $('#jwb_h').css('background', '#66ff00')
                $('#jwb_h').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_h').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_h').css('background', '#FF0000')
                $('#jwb_h').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_i').length > 0) {
            var pattern = $('#jawaban_i').val(); // Pola yang ingin dicek
            var answer = $('#jwb_i').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_i').val('5')
                $('#jwb_i').css('background', '#66ff00')
                $('#jwb_i').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_i').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_i').css('background', '#FF0000')
                $('#jwb_i').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_j').length > 0) {
            var pattern = $('#jawaban_j').val(); // Pola yang ingin dicek
            var answer = $('#jwb_j').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_j').val('5')
                $('#jwb_j').css('background', '#66ff00')
                $('#jwb_j').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_j').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_j').css('background', '#FF0000')
                $('#jwb_j').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_k').length > 0) {
            var pattern = $('#jawaban_k').val(); // Pola yang ingin dicek
            var answer = $('#jwb_k').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_k').val('5')
                $('#jwb_k').css('background', '#66ff00')
                $('#jwb_k').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_k').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_k').css('background', '#FF0000')
                $('#jwb_k').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_l').length > 0) {
            var pattern = $('#jawaban_l').val(); // Pola yang ingin dicek
            var answer = $('#jwb_l').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_l').val('5')
                $('#jwb_l').css('background', '#66ff00')
                $('#jwb_l').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_l').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_l').css('background', '#FF0000')
                $('#jwb_l').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_m').length > 0) {
            var pattern = $('#jawaban_m').val(); // Pola yang ingin dicek
            var answer = $('#jwb_m').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_m').val('5')
                $('#jwb_m').css('background', '#66ff00')
                $('#jwb_m').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_m').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_m').css('background', '#FF0000')
                $('#jwb_m').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_n').length > 0) {
            var pattern = $('#jawaban_n').val(); // Pola yang ingin dicek
            var answer = $('#jwb_n').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_n').val('5')
                $('#jwb_n').css('background', '#66ff00')
                $('#jwb_n').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_n').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_n').css('background', '#FF0000')
                $('#jwb_n').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_o').length > 0) {
            var pattern = $('#jawaban_o').val(); // Pola yang ingin dicek
            var answer = $('#jwb_o').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_o').val('5')
                $('#jwb_o').css('background', '#66ff00')
                $('#jwb_o').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_o').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_o').css('background', '#FF0000')
                $('#jwb_o').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_p').length > 0) {
            var pattern = $('#jawaban_p').val(); // Pola yang ingin dicek
            var answer = $('#jwb_p').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_p').val('5')
                $('#jwb_p').css('background', '#66ff00')
                $('#jwb_p').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_p').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_p').css('background', '#FF0000')
                $('#jwb_p').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_q').length > 0) {
            var pattern = $('#jawaban_q').val(); // Pola yang ingin dicek
            var answer = $('#jwb_q').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_q').val('5')
                $('#jwb_q').css('background', '#66ff00')
                $('#jwb_q').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_q').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_q').css('background', '#FF0000')
                $('#jwb_q').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_r').length > 0) {
            var pattern = $('#jawaban_r').val(); // Pola yang ingin dicek
            var answer = $('#jwb_r').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_r').val('5')
                $('#jwb_r').css('background', '#66ff00')
                $('#jwb_r').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_r').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_r').css('background', '#FF0000')
                $('#jwb_r').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_s').length > 0) {
            var pattern = $('#jawaban_s').val(); // Pola yang ingin dicek
            var answer = $('#jwb_s').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_s').val('5')
                $('#jwb_s').css('background', '#66ff00')
                $('#jwb_s').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_s').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_s').css('background', '#FF0000')
                $('#jwb_s').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_t').length > 0) {
            var pattern = $('#jawaban_t').val(); // Pola yang ingin dicek
            var answer = $('#jwb_t').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_t').val('5')
                $('#jwb_t').css('background', '#66ff00')
                $('#jwb_t').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_t').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_t').css('background', '#FF0000')
                $('#jwb_t').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_u').length > 0) {
            var pattern = $('#jawaban_u').val(); // Pola yang ingin dicek
            var answer = $('#jwb_u').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_u').val('5')
                $('#jwb_u').css('background', '#66ff00')
                $('#jwb_u').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_u').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_u').css('background', '#FF0000')
                $('#jwb_u').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_v').length > 0) {
            var pattern = $('#jawaban_v').val(); // Pola yang ingin dicek
            var answer = $('#jwb_v').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_v').val('5')
                $('#jwb_v').css('background', '#66ff00')
                $('#jwb_v').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_v').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_v').css('background', '#FF0000')
                $('#jwb_v').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_w').length > 0) {
            var pattern = $('#jawaban_w').val(); // Pola yang ingin dicek
            var answer = $('#jwb_w').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_w').val('5')
                $('#jwb_w').css('background', '#66ff00')
                $('#jwb_w').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_w').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_w').css('background', '#FF0000')
                $('#jwb_w').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_x').length > 0) {
            var pattern = $('#jawaban_x').val(); // Pola yang ingin dicek
            var answer = $('#jwb_x').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_x').val('5')
                $('#jwb_x').css('background', '#66ff00')
                $('#jwb_x').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_x').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_x').css('background', '#FF0000')
                $('#jwb_x').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_y').length > 0) {
            var pattern = $('#jawaban_y').val(); // Pola yang ingin dicek
            var answer = $('#jwb_y').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_y').val('5')
                $('#jwb_y').css('background', '#66ff00')
                $('#jwb_y').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_y').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_y').css('background', '#FF0000')
                $('#jwb_y').css('color', '#FFFFFF')
                
            }
        }

        if ($('#jwb_z').length > 0) {
            var pattern = $('#jawaban_z').val(); // Pola yang ingin dicek
            var answer = $('#jwb_z').val();
            // var result = boyerMooreMatch(answer, pattern);
            var test = normalize(answer);
            var ngram = nGram(test, 2);
            var hash = calculateRollingHash(ngram, 2);
            var window = calculateWindow(hash, 4);
            const fingerprint = new Set(calculateFingerprints(window, 4));

            var test2 = normalize(pattern);
            var ngram2 = nGram(test2, 2);
            var hash2 = calculateRollingHash(ngram2, 2);
            var window2 = calculateWindow(hash2, 4);
            const fingerprint2 = new Set(calculateFingerprints(window2, 4));
            const coefficient = jaccardCoefficient(fingerprint, fingerprint2);
            if (coefficient == 1) {
                $('#nilai_z').val('5')
                $('#jwb_z').css('background', '#66ff00')
                $('#jwb_z').css('color', '#000000')
                
            } else {
                err = 1
                $('#nilai_z').val('0')
                // alert('Urutan Pertama salah')
                $('#jwb_z').css('background', '#FF0000')
                $('#jwb_z').css('color', '#FFFFFF')
                
            }
        }

        var j1 = $('#jawaban_1').val();
        var j2 = $('#jawaban_2').val();
        var j3 = $('#jawaban_3').val();
        var j4 = $('#jawaban_4').val();
        var j5 = $('#jawaban_5').val();
        var j6 = $('#jawaban_6').val();
        var j7 = $('#jawaban_7').val();
        var j8 = $('#jawaban_8').val();
        var ja = $('#jawaban_a').val();
        var jb = $('#jawaban_b').val();
        var jc = $('#jawaban_c').val();
        var jd = $('#jawaban_d').val();
        var je = $('#jawaban_e').val();
        var jf = $('#jawaban_f').val();
        var jg = $('#jawaban_g').val();
        var jh = $('#jawaban_h').val();
        var ji = $('#jawaban_i').val();

        // document.getElementById("demo1").innerHTML = j1;
        // document.getElementById("demo2").innerHTML = j2;
        // document.getElementById("demo3").innerHTML = j3;
        // document.getElementById("demo4").innerHTML = j4;
        // document.getElementById("demo5").innerHTML = j5;
        // document.getElementById("demo6").innerHTML = j6;
        // document.getElementById("demo7").innerHTML = j7;
        // document.getElementById("demo8").innerHTML = j8;
        // document.getElementById("demoa").innerHTML = ja;
        // document.getElementById("demob").innerHTML = jb;
        // document.getElementById("democ").innerHTML = jc;
        // document.getElementById("demod").innerHTML = jd;
        // document.getElementById("demod").innerHTML = je;
        // document.getElementById("demod").innerHTML = jf;
        // document.getElementById("demod").innerHTML = jg;
        // document.getElementById("demod").innerHTML = jh;
        // document.getElementById("demod").innerHTML = ji;

        if(err == 1) {
            $('#fail-alert').css('display', 'flex');
            $('#fail-alert').css('opacity', '1');
        } else {
            $('#success-alert').css('display', 'flex');
            $('#success-alert').css('opacity', '5');
        }
        
        var idsoal = $('#id_soal').val();
        var iduser = $('#id_user').val();
        var idessay = $('#id_essay').val();
        $.ajax({
            url: base_url+'ujianessay/save_history/' + idsoal + '/' + iduser + '/' + idessay,
            type: 'get',
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    $(this).removeAttr('disabled');
                    reload_ajax();
                }
            }
        });
    }

    function refresh() {
        location.reload();
    }

    function close_alert() {
        $('#fail-alert').css('display', 'none');
        $('#fail-alert').css('opacity', '0');
    }

    function python(){
        // var j1 = $('#jawaban_1').val();
        // var j2 = $('#jawaban_2').val();
        // var j3 = $('#jawaban_3').val();
        // var j4 = $('#jawaban_4').val();
        // var j5 = $('#jawaban_5').val();
        // var j6 = $('#jawaban_6').val();
        // var j7 = $('#jawaban_7').val();
        // var j8 = $('#jawaban_8').val();
        // var ja = $('#jawaban_a').val();
        // var jb = $('#jawaban_b').val();
        // var jc = $('#jawaban_c').val();
        // var jd = $('#jawaban_d').val();
        // var je = $('#jawaban_e').val();
        // var jf = $('#jawaban_f').val();
        // var jg = $('#jawaban_g').val();
        // var jh = $('#jawaban_h').val();
        // var ji = $('#jawaban_i').val();

        // document.getElementById("demo1").innerHTML = j1;
        // document.getElementById("demo2").innerHTML = j2;
        // document.getElementById("demo3").innerHTML = j3;
        // document.getElementById("demo4").innerHTML = j4;
        // document.getElementById("demo5").innerHTML = j5;
        // document.getElementById("demo6").innerHTML = j6;
        // document.getElementById("demo7").innerHTML = j7;
        // document.getElementById("demo8").innerHTML = j8;
        // document.getElementById("demoa").innerHTML = ja;
        // document.getElementById("demob").innerHTML = jb;
        // document.getElementById("democ").innerHTML = jc;
        // document.getElementById("demod").innerHTML = jd;
        // document.getElementById("demod").innerHTML = je;
        // document.getElementById("demod").innerHTML = jf;
        // document.getElementById("demod").innerHTML = jg;
        // document.getElementById("demod").innerHTML = jh;
        // document.getElementById("demod").innerHTML = ji;
        
        var py_div;
        var element = document.createElement("div");
        document.body.appendChild(element);
        // remove the previous script tag
        if (py_div) {
                py_div.remove();
        }
 
        // Wrap the Python code (py_code) with a PyScript tag
        // py_div.evaluate() will run the code within the <py-script> tag
        let html_tag = `
            <py-script>
                print("asd")
            </py-script>`
 
        // Create the DIV to attach the py-script tag
        let div = document.createElement("div");
        div.innerHTML = html_tag;
 
        py_div = div.firstElementChild;
        document.body.appendChild(py_div);
 
        try {
                // This will run the Python interpreter
                // for the code loaded into py_div
                py_div.evaluate();
        } catch (error) {
                console.error("Python error:");
                console.error(error);
        }
        return console.log (element);
    }

    function submit_hasil(id, level) {
        $.getJSON(base_url+'ujianessay/save_hasil/' + id, function (data) {
            window.location.href = '<?php echo site_url("ujian/list_ujian"); ?>/'+level
        });
    }

    function submit_kosong(id, level) {
        $.getJSON(base_url+'ujianessay/hasil_kosong/'+id, function (data) {
            window.location.href = '<?php echo site_url("ujian/list_ujian"); ?>/'+level
        });
    }

    var seconds = 0;
   // console.log(window.localStorage.getItem('taken_time_quiz_'+'<?= $idessay; ?>'));
    var timeTaken = '<?php echo $timeTaken?>';
    if(timeTaken == '')
    {
        if(window.localStorage.getItem('taken_time_quiz_'+'<?= $idessay; ?>') != null)
        {
            seconds = window.localStorage.getItem('taken_time_quiz_'+'<?= $idessay; ?>');
        }else{
            window.localStorage.removeItem('taken_time_quiz_'+'<?= $idessay; ?>');
            seconds = 0;
            window.localStorage.setItem('taken_time_quiz_'+'<?= $idessay; ?>', seconds);
        }
    }else{
        var plush = timeTaken;
        seconds = plush;
    }
    

    var timer = setInterval(upTimer, 1000);
    
    function upTimer() {
        ++seconds;
        var hour = Math.floor(seconds / 3600);
        var minute = Math.floor((seconds - hour * 3600) / 60);
        var updSecond = seconds - (hour * 3600 + minute * 60);

        document.getElementById("my_timer").innerHTML = hour + ":" + minute + ":" + updSecond;
        document.getElementById("waktu").value = hour + ":" + minute + ":" + updSecond;
        saveTimeTaken(seconds);
        
    }

    function saveTimeTaken(seconds)
    {
       window.localStorage.setItem('taken_time_quiz_'+'<?= $idessay; ?>', seconds);
    }

</script>
<script src="<?=base_url()?>template/js/quizessay.js"></script>
<script type="text/javascript">
    var base_url = "<?= base_url(); ?>";
    var id_tes = "<?= $id_tes; ?>";
    var widget = $(".step");
    var total_widget = widget.length;
</script>

<script src="<?= base_url() ?>assets/dist/js/app/essay/ujianessay.js"></script>