<?php
    //Tạo 2 số ngẫu nhiên m,n phạm vi từ 2->8. Sau đó tạo ma trận m x n trong đó các phần tử là số nguyên

    // $m = rand(2,8);
    // $n = rand(2,8);
    // $chuoi = rand(10,10);
    // echo "Ma trận $m x $n <br>";
    // for($i=0;$i<=$m;$i++){
    //     echo " <br>";
    //     for($j=$i+1;$j<=$n;$j++)
    //     {
    //         echo "$chuoi\t";

    //     }
    // }

    // //bt1
    define("N",10000);

    $n = rand(1,N);

    $isPrime = true;

    if ($n <= 1) {
        echo "-$n không phải là số nguyên tố <br>";
    } else {
        for ($i = 2; $i <= sqrt($n); $i++) {
            if ($n % $i == 0) {
                $isPrime = false;
                break;
            }
        }
        if ($isPrime) {
            echo "-$n là số nguyên tố <br>";
        } else {
            echo "-$n không phải là số nguyên tố <br>";
        }
    }

    $t = 0;
    echo "-Tính tổng: ";
    for($i = 0; $i < $n; $i++){
        if($i % 2 != 0 && $i >= 10 && $i <= 99) {
            $t += $i;
        }
    }
    echo "$t <br>";

    $dem=0;
    while($n >0){
       $n = (int)($n / 10);  // Chia lấy phần nguyên cho 10
        $dem++;
    }
    echo "-Tổng số n = $dem <br>";

    $n = rand(1,N);
    echo "-Ma trận: <br>";
    for($i = 0; $i < $dem; $i++){
        for($j = 0; $j < $dem; $j++){
            echo "$n ";
        }
        echo "<br>";
    }

?>
