<style>
    .style{
        padding: 10px;
        font-size: 10px;
    }

    th, td{
        padding: 5px;
    }
</style>
<body>
    <br>
    <br>
    <?php foreach ($datas as $dt):
            $input = $dt['jawaban'];
            $input2 = $dt['kunci_jawaban'];
            $input3 = $dt['jawaban_2'];
            $input4 = $dt['kunci_jawaban_2'];
            $prime_number = 2;
            $n_gram_value = 2;
            $window_value = 4;
            class winnowing {
                
                static function normalize(string $input): string
                {
                    return strtolower(preg_replace('/[^a-zA-Z0-9()%\*&|<>%!:=+-,;"]/', '', $input));
                }
                
                static function normalize2(string $input2): string
                {
                    return strtolower(preg_replace('/[^a-zA-Z0-9()%\*&%!:=+-,;"]/', '', $input2));
                }
                
                static function normalize3(string $input3): string
                {
                    return strtolower(preg_replace('/[^a-zA-Z0-9()%\*&%!:=+-,;"]/', '', $input3));
                }
                
                static function normalize4(string $input4): string
                {
                    return strtolower(preg_replace('/[^a-zA-Z0-9()%\*&%!:=+-,;"]/', '', $input4));
                }
                
                public static function n_gram($input, $n)
                {
                    $ngrams = array();
                    $length = strlen($input);
                    for($i = 0; $i < $length; $i++) {
                        if($i > ($n - 2)) {
                            $ng = '';
                            for($j = $n-1; $j >= 0; $j--) {
                                $ng .= $input[$i-$j];
                            }
                            $ngrams[] = $ng;
                        }
                    }
                    return $ngrams;
                }
                
                public static function hash(string $text, int $primeNumber): int
                {
                    $length = strlen($text);
                    
                    if (1 == $length) {
                        return ord($text);
                    }
                    
                    $result = 0;
                    
                    for ($i = 0; $i < $length; ++$i) {
                        $result += ord(substr($text, $i, 1)) * pow($primeNumber, $length - $i) / 2;
                    }
                    
                    return $result;
                }
                
                public static function calculateRollingHash(array $ngram, int $primeNumber): array
                {
                    $rollingHash = array();
                    
                    foreach ($ngram as $ng) {
                        $rollingHash[] = self::hash($ng, $primeNumber);
                    }
                    
                    return $rollingHash;
                }
                
                public static function calculateWindow(array $rollingHash, int $nWindowValue): array
                {
                    $ngram = array();
                    $length = count($rollingHash);
                    $x = 0;
                    
                    for ($i = 0; $i < $length; ++$i) {
                        if ($i > ($nWindowValue - 2)) {
                            $ngram[$x] = array();
                            $y = 0;
                            for ($j = $nWindowValue - 1; $j >= 0; --$j) {
                                $ngram[$x][$y] = $rollingHash[$i - $j];
                                ++$y;
                            }
                            ++$x;
                        }
                    }
                    
                    return $ngram;
                }
                
                public static function calculateFingerprints(array $windowTable, int $nWindowValue): array
                {
                    $fingers = array();
                    
                    for ($i = 0; $i < count($windowTable); ++$i) {
                        $min = $windowTable[$i][0];
                        for ($j = 1; $j < $nWindowValue; ++$j) {
                            if ($min > $windowTable[$i][$j]) {
                                $min = $windowTable[$i][$j];
                            }
                        }
                        $fingers[] = $min;
                    }
                    
                    return $fingers;
                }
                
                public static function jaccardCoeficient(array $fingerprint1, array $fingerprint2): float
                {
                    $intersection = array_intersect($fingerprint1, $fingerprint2);
                    $unions = array_merge($fingerprint1, $fingerprint2);
                    
                    $intersectionCount = count($intersection);
                    $unionsCount = count($unions);
                    
                    $divisor = $unionsCount - $intersectionCount;
                    $coefficient = $divisor > 0 ? $intersectionCount / $divisor : 0;
                    
                    return $coefficient;
                }
            }
            ?>
            <?php
                //Process 1
                $normalize = winnowing::normalize($input);
                $ngram =  winnowing::n_gram($normalize, $n_gram_value);
                $hash = winnowing::calculateRollingHash($ngram, $prime_number);
                $window = winnowing::calculateWindow($hash, $window_value);
                $fingerprint = winnowing::calculateFingerprints($window, $window_value);
                
                //Process 2
                $normalize2 = winnowing::normalize2($input2);
                $ngram2 =  winnowing::n_gram($normalize2, $n_gram_value);
                $hash2 = winnowing::calculateRollingHash($ngram2, $prime_number);
                $window2 = winnowing::calculateWindow($hash2, $window_value);
                $fingerprint2 = winnowing::calculateFingerprints($window2, $window_value);
                
                //Process 3
                $normalize3 = winnowing::normalize3($input3);
                $ngram3 =  winnowing::n_gram($normalize3, $n_gram_value);
                $hash3 = winnowing::calculateRollingHash($ngram3, $prime_number);
                $window3 = winnowing::calculateWindow($hash3, $window_value);
                $fingerprint3 = winnowing::calculateFingerprints($window3, $window_value);
                
                //Process 4
                $normalize4 = winnowing::normalize4($input4);
                $ngram4 =  winnowing::n_gram($normalize4, $n_gram_value);
                $hash4 = winnowing::calculateRollingHash($ngram4, $prime_number);
                $window4 = winnowing::calculateWindow($hash4, $window_value);
                $fingerprint4 = winnowing::calculateFingerprints($window4, $window_value);
                
                //Result
                $jaccardCoeff = winnowing::jaccardCoeficient($fingerprint, $fingerprint2);
                $jaccardCoeff2 = winnowing::jaccardCoeficient($fingerprint3, $fingerprint4);
                ?>
            <?php endforeach?>
            <table class border="1px solid black"  style="width:80%; display: flex; margin: auto;">
                <tr class="style">
                    <th>JAWABAN</th>
                    <th>NORMALISASI</th>
                    <th>JUMLAH N_GRAM</th>
                    <th>HASHING</th>
                    <th>WINDOW</th>
                    <th>FINGERPRINT</th>
                </tr>
                <tr class="style">
                    <td><?php echo $dt['jawaban'];?></td>
                    <td><?php echo "<ul>"; echo $normalize; echo "</ul>" ?></td>
                    <td>
                        <?php
                            $count = 1;
                            echo "<ul>";
                            foreach($ngram as $n){
                                for($i=1;$i<strlen($n);$i++){
                                    echo "<li>"."$count. ".$n."</li>";   
                                }
                                $count++;
                            }
                            echo "</ul>";
                        ?>
                    </td>
                    <td><?php echo print_r($hash)?></td>
                    <td><?php echo print_r($window)?></td>
                    <td><?php echo print_r($fingerprint)?></td>
                </tr>
            </table>
            <br>
            <table border="1px solid black"  style="width:80%; display: flex; margin: auto;">
                <tr class="style">
                    <th>JAWABAN KUNCI</th>
                    <th>NORMALISASI KUNCI JAWABAN</th>
                    <th>JUMLAH N_GRAM KUNCI</th>
                    <th>HASHING KUNCI</th>
                    <th>WINDOW KUNCI</th>
                    <th>FINGERPRINT KUNCI</th>
                </tr>
                <tr class="style">
                    <td><?php echo $dt['kunci_jawaban'];?></td>
                    <td><?php echo $normalize2;?></td>
                    <td>
                        <?php
                            $count = 1;
                            echo "<ul>";
                            foreach($ngram2 as $n){
                                for($i=1;$i<strlen($n);$i++){
                                    echo "<li>"."$count. ".$n."</li>";   
                                }
                                $count++;
                            }
                            echo "</ul>";
                        ?>
                    </td>
                    <td><?php echo print_r($hash2); ?></td>
                    <td><?php echo print_r($window2)?></td>
                    <td><?php echo print_r($fingerprint2)?></td>
                </tr>
            </table>
            <div style = "display: flex;">
                <h2 style="margin-left: auto;">
                    Similarity Percentage Result:&nbsp<h2 style="margin-right: auto;"><?php 
                    $result = $jaccardCoeff;
                    if ($result == 1){
                        echo $result * 100 . '%';
                        echo '&nbsp Correct';
                    } else {
                        echo $result * 100 . '%';
                        echo '&nbsp Wrong';
                    }
                        ?></h2>
                </h2>
            </div>
            <table border="1px solid black"  style="width:80%; display: flex; margin: auto;">
                <tr class="style">
                    <th>JAWABAN 100%</th>
                    <th>NORMALISASI JAWABAN 100%</th>
                    <th>JUMLAH N_GRAM 100%</th>
                    <th>HASHING 100%</th>
                    <th>WINDOW 100%</th>
                    <th>FINGERPRINT 100%</th>
                </tr>
                <tr class="style">
                    <td><?php echo $dt['jawaban_2'];?></td>
                    <td><?php echo $normalize3;?></td>
                    <td>
                        <?php
                            $count = 1;
                            echo "<ul>";
                            foreach($ngram3 as $n){
                                for($i=1;$i<strlen($n);$i++){
                                    echo "<li>"."$count. ".$n."</li>";   
                                }
                                $count++;
                            }
                            echo "</ul>";
                        ?>
                    </td>
                    <td><?php echo print_r($hash3); ?></td>
                    <td><?php echo print_r($window3)?></td>
                    <td><?php echo print_r($fingerprint3)?></td>
                </tr>

            </table>
            <br>
            <table border="1px solid black"  style="width:80%; display: flex; margin: auto;">
                <tr class="style">
                    <th>JAWABAN KUNCI 100%</th>
                    <th>NORMALISASI KUNCI JAWABAN 100%</th>
                    <th>JUMLAH N_GRAM KUNCI 100%</th>
                    <th>HASHING KUNCI 100%</th>
                    <th>WINDOW KUNCI 100%</th>
                    <th>FINGERPRINT KUNCI 100%</th>
                </tr>
                <tr class="style">
                    <td><?php echo $dt['kunci_jawaban_2'];?></td>
                    <td><?php echo $normalize4;?></td>
                    <td>
                        <?php
                            $count = 1;
                            echo "<ul>";
                            foreach($ngram4 as $n){
                                for($i=1;$i<strlen($n);$i++){
                                    echo "<li>"."$count. ".$n."</li>";   
                                }
                                $count++;
                            }
                            echo "</ul>";
                        ?>
                    </td>
                    <td><?php echo print_r($hash4); ?></td>
                    <td><?php echo print_r($window4)?></td>
                    <td><?php echo print_r($fingerprint4)?></td>
                </tr>
            </table>

        <div style = "display: flex;">
            <h2 style="margin-left: auto;">
                Similarity Percentage Result 2:&nbsp<h2 style="margin-right: auto;"><?php
                $result = $jaccardCoeff2;
                if ($result == 1){
                    echo $result * 100 . '%';
                    echo '&nbsp Correct';
                } else {
                    echo $result * 100 . '%';
                    echo '&nbsp Wrong';
                }
                ?></h2>
            </h2>
        </div>

    </body>
