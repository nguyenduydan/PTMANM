<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài tập 4</title>
    <style>
        body {
            font-family: monospace;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            font-size: 18px;
        }

        p {
            font-weight: bold;
            margin: 0;
        }

        .result-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            border: 1px solid #ddd;
            max-width: 600px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        fieldset {
            border: 2px solid #007bff;
            border-radius: 10px;
            padding: 20px;
        }

        legend {
            color: #007bff;
            font-weight: bold;
            padding: 0 10px;
        }

        .number {
            color: #007bff;
            font-weight: bold;
        }

        .sum {
            color: #28a745;
            font-weight: bold;
        }

        .array-container {
            margin-top: 15px;
            text-align: center;
        }

        .array {
            font-weight: bold;
            color: #007bff;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            margin: 3px;
            border: 2px solid #007bff;
            border-radius: 50%;
            background-color: #fff;
            transition: ease-in-out .2s;
            width: 40px;
            height: 40px;
            font-size: 15px;
        }

        .array:hover {
            background-color: #007bff;
            color: #fff;
        }

        .btn-reset {
            margin-top: 20px;
            padding: 10px 20px;
            width: 200px;
            background-color: #28a745;
            border-radius: 20px;
            border: 2px solid;
            font-size: 20px;
            font-weight: 600;
            color: #fff;
            transition: ease-in-out .2s;
        }

        .btn-reset:hover {
            background-color: transparent;
            color: #28a745;
            border: 2px solid #28a745;
        }

        .date {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            transition: background-color ease-in-out .3s;
        }

        .date:hover {
            background-color: #e8e8e8;
        }
    </style>
</head>

<body>
    <div class="result-container">
        <fieldset>
            <legend>Bài tập 4</legend>
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
            // In ra kết quả
            echo "<div class='date'>" . $ngayHienTai . "</div>";

            // Tạo số ngẫu nhiên từ -50 đến 50
            $n = rand(-50, 50);
            if ($n < 0) {
                $n = abs($n); // Lấy giá trị tuyệt đối nếu $n < 0
            }

            // In giá trị của $n
            echo "<p>Số lượng phần tử trong mảng (n) = <span class='number'>" . $n . "</span></p>";

            $a = array(); // Khởi tạo mảng

            // Tạo mảng với các số ngẫu nhiên từ -100 đến 100
            for ($i = 0; $i < $n; $i++) {
                $a[$i] = rand(-100, 100);
            }

            // Tính tổng các phần tử lẻ trong mảng
            $t = 0;
            foreach ($a as $value) {
                if ($value % 2 != 0) {
                    $t += $value;
                }
            }

            // Hàm Merge Sort
            function mergeSort($array)
            {
                if (count($array) < 2) {
                    return $array; // Nếu mảng có 0 hoặc 1 phần tử, trả về mảng
                }

                $mid = floor(count($array) / 2);
                $left = mergeSort(array_slice($array, 0, $mid)); // Sắp xếp nửa bên trái
                $right = mergeSort(array_slice($array, $mid)); // Sắp xếp nửa bên phải

                return merge($left, $right); // Hợp nhất hai nửa đã sắp xếp
            }

            // Hàm hợp nhất
            function merge($left, $right)
            {
                $result = array();
                while (count($left) > 0 && count($right) > 0) {
                    if ($left[0] <= $right[0]) {
                        $result[] = array_shift($left); // Lấy phần tử nhỏ hơn từ mảng bên trái
                    } else {
                        $result[] = array_shift($right); // Lấy phần tử nhỏ hơn từ mảng bên phải
                    }
                }

                // Thêm phần tử còn lại từ mảng bên trái hoặc bên phải
                return array_merge($result, $left, $right);
            }

            // Sắp xếp mảng bằng Merge Sort
            $sortedArray = mergeSort($a);
            // In mảng đã sắp xếp
            echo "<div class='array-container'><p>Các phần tử trong mảng sau khi sắp xếp:</p>";
            foreach ($sortedArray as $value) {
                echo "<span class='array'>" . $value . "</span>";
            }
            // In tổng các số lẻ
            echo "<p>Tổng các số lẻ: <span class='sum'>" . $t . "</span></p>";

            echo "</div>";
            ?>
        </fieldset>

        <!-- Nút Reset -->
        <form method="POST">
            <button class="btn-reset" type="submit">Reset</button>
        </form>
    </div>
</body>

</html>
