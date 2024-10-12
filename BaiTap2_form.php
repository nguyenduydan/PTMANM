<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiểm tra số nguyên tố</title>
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
            padding: 40px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            width: 100%;
        }

        fieldset {
            border: 2px solid #007bff;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        legend {
            font-size: 30px;
            font-weight: 900;
            color: #007bff;
            text-align: center;
            text-transform: uppercase;
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

        input[type="number"] {
            padding: 10px;
            border-radius: 20px;
            border: 2px solid black;
            font-size: 20px;
            width: 40vh;
        }

        .glow-on-hover {
            width: 220px;
            height: 50px;
            font-size: 20px;
            border: none;
            outline: none;
            color: #fff;
            background: #111;
            cursor: pointer;
            position: relative;
            z-index: 0;
            font-weight: 600;
            border-radius: 50px;
        }

        .glow-on-hover:before {
            content: '';
            background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
            position: absolute;
            top: -2px;
            left: -2px;
            background-size: 400%;
            z-index: -1;
            filter: blur(5px);
            width: calc(100% + 4px);
            height: calc(100% + 4px);
            animation: glowing 20s linear infinite;
            opacity: 0;
            transition: opacity .3s ease-in-out;
            border-radius: 50px;
        }

        .glow-on-hover:active {
            color: #000
        }

        .glow-on-hover:active:after {
            background: transparent;
        }

        .glow-on-hover:hover:before {
            opacity: 1;
        }

        .glow-on-hover:after {
            z-index: -1;
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: #111;
            left: 0;
            top: 0;
            border-radius: 50px;
        }

        @keyframes glowing {
            0% {
                background-position: 0 0;
            }

            50% {
                background-position: 400% 0;
            }

            100% {
                background-position: 0 0;
            }
        }

        .arr-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            /* Cho phép phần tử trong container xuống dòng */
            max-height: 200px;
            /* Giới hạn chiều cao */
            overflow: auto;
            /* Tạo thanh cuộn nếu cần */
            margin-top: 10px;
            /* Khoảng cách từ phần trên */
        }

        .arr {
            display: inline-block;
            padding: 10px 10px;
            background-color: #05fbdd;
            margin: 10px;
            border-radius: 10px;
            font-size: 18px;
            text-align: center;
        }

        .date {
            font-size: 18px;
            color: #757575;
        }
    </style>
</head>

<body>
    <div class='container'>
        <form method="POST">
            <fieldset>
                <legend>Kiểm tra số nguyên tố</legend>
                <input type="number" name="n" min="1" required placeholder="Nhập số nguyên n...">
                <button class="glow-on-hover" type="submit">Kiểm Tra</button>
                <?php
                // Thiết lập múi giờ
                date_default_timezone_set('Asia/Ho_Chi_Minh');

                // Mảng chứa tên thứ bằng tiếng Việt
                $thu = [
                    'Sunday' => 'Chủ Nhật',
                    'Monday' => 'Thứ Hai',
                    'Tuesday' => 'Thứ Ba',
                    'Wednesday' => 'Thứ Tư',
                    'Thursday' => 'Thứ Năm',
                    'Friday' => 'Thứ Sáu',
                    'Saturday' => 'Thứ Bảy'
                ];

                // Lấy ngày hiện tại
                $ngayHienTai = date('l, d/m/Y');
                $ngayHienTai = str_replace(array_keys($thu), array_values($thu), $ngayHienTai);
                ?>
                <div class="date"><?php echo $ngayHienTai; ?></div>
            </fieldset>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy giá trị n từ form
            $n = intval($_POST['n']);

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

            // Đếm số chữ số của n
            $dem = 0;
            $temp = $n; // Lưu giá trị của n vào biến tạm để giữ nguyên giá trị ban đầu
            while ($temp > 0) {
                $temp = (int)($temp / 10);  // Chia lấy phần nguyên cho 10
                $dem++;
            }
            echo "<p>- Số chữ số của n: <span class='result'>$dem</span>.</p>";

            // Mảng
            $arr = array();
            for ($i = 0; $i < $n; $i++) {
                $arr[$i] = rand(-100, 100);
            }
            echo "<p>- Mảng:</p>";
            echo "<div class='arr-container'>";
            foreach ($arr as $x) {
                echo "<p class='arr'>$x</p>";
            }
            echo "</div>"; // Mảng sẽ nằm trong container mà không bị tràn ra ngoài
        }
        ?>
    </div>
</body>

</html>
