<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiểm tra số nguyên tố, tính tổng và ma trận</title>
    <style>
        body {
            font-family: monospace;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-size: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: max-content;
            width: 100%;
        }

        fieldset {
            border: 2px solid #007bff;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        legend {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            padding: 8px;
            text-align: center;
            border: 1px solid #007bff;
        }

        p {
            color: #333;
        }

        .result {
            color: #28a745;
            font-weight: bold;
        }

        .matrix {
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class='container'>
        <fieldset>
            <legend>Kết quả kiểm tra</legend>
            <?php
            // Khai báo hằng số
            define("N", 10000);

            // Random số nguyên n từ 1 đến N
            $n = rand(1, N);

            // Kiểm tra số nguyên tố
            $isPrime = true;

            if ($n <= 1) {
                echo "<p>- <span class='result'>$n</span> không phải là số nguyên tố.</p>";
            } else {
                for ($i = 2; $i <= sqrt($n); $i++) {
                    if ($n % $i == 0) {
                        $isPrime = false;
                        break;
                    }
                }
                if ($isPrime) {
                    echo "<p>- <span class='result'>$n</span> là số nguyên tố.</p>";
                } else {
                    echo "<p>- <span class='result'>$n</span> không phải là số nguyên tố.</p>";
                }
            }

            // Tính tổng các số lẻ có 2 chữ số
            $t = 0;
            for ($i = 0; $i < $n; $i++) {
                if ($i % 2 != 0 && $i >= 10 && $i <= 99) {
                    $t += $i;
                }
            }
            echo "<p>- Tổng các số lẻ có 2 chữ số nhỏ hơn $n: <span class='result'>$t</span>.</p>";

            // Đếm số chữ số của n
            $dem = 0;
            $temp = $n; // Lưu giá trị của n vào biến tạm để giữ nguyên giá trị ban đầu
            while ($temp > 0) {
                $temp = (int)($temp / 10);  // Chia lấy phần nguyên cho 10
                $dem++;
            }
            echo "<p>- Số chữ số của n: <span class='result'>$dem</span>.</p>";
            ?>
        </fieldset>
    </div>
</body>

</html>
