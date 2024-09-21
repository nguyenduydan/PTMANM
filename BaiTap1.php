<?php
    /*
    Viết chương trình nhận một giá trị ngẫu nhiên là số tự nhiên n có giá trị từ 1-> 100. Hãy xuất ra trình duyệt những số chẵn nằm trong khoảng 1->n đó.
    */
    // $n = rand(1,100);
    // echo "Giá trị các số chắn là <br>";
    // for($i = 1;$i <= $n; $i++){
    //     if($i % 2 == 0){
    //         echo "$i ";
    //     }
    // }
    // $n = rand(1,10);
    // echo "Bảng cửu chương $n:<br>";
    // for($i = 1; $i<=10; $i++){
    //     $c = $n * $i;
    //     echo "<br>";
    //     echo "$n x $i = $c";
    // }

    for($i=1;$i<=10;$i++){
        echo "<br>Bảng cửu chương $i";
        for($j=1;$j<=10;$j++)
        {
            $c = $i * $j;
            echo "<br>";
            echo "$i x $j = $c";
        }
    }

?>
