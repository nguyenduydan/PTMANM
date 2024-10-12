<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
            height: 100vh;
        }

        .matrix-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .matrix {
            border-collapse: collapse;
            background-color: #fff;
            padding: 10px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .matrix th,
        .matrix td {
            padding: 10px;
            text-align: center;
            width: 50px;
            border-radius: 20px;
            transition: ease-in-out .2s;
        }

        .matrix td:hover {
            background-color: #ccc;
        }

        .matrix-header {
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
            text-align: center;
            font-size: 18px;
        }

        .matrix td.negative {
            border-radius: 20px;
            color: red;
            font-weight: 600;
            transition: ease-in-out .2s;
        }

        .matrix td.negative:hover {
            background-color: red;
            color: #fff;
        }

        .matrix td.zero {
            border-radius: 20px;
            color: lawngreen;
            transition: ease-in-out .2s;
            font-weight: 600;
        }

        .matrix td.zero:hover {
            background-color: lawngreen;
            color: black;
        }

        .btn-reset-container {
            display: flex;
            justify-content: center;
            /* Căn giữa */
            margin-top: 20px;
        }

        .btn-reset {
            display: flex;
            justify-content: center;
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

        .sorted-matrix-container {
            display: flex;
            justify-content: center;
            /* Căn giữa */
            margin-top: 20px;
        }

        .date {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 24px;
            text-align: center;
            font-weight: bold;
            color: #333;
            width: max-content;
            margin-bottom: 10px;
            transition: background-color ease-in-out 0.3s;
        }

        .date:hover {
            background-color: #e8e8e8;
        }
    </style>
</head>

<body>

    <?php
    // Tạo ma trận ngẫu nhiên
    $n = rand(2, 5);
    $m = rand(2, 5);

    $originalMatrix = []; // Ma trận gốc
    $modifiedMatrix = []; // Ma trận đã sửa đổi (điểm âm thành 0)
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
    // Hiển thị ma trận ban đầu
    echo '<div class="matrix-container">';
    echo '<div>';
    echo '<div class="matrix-header">Ma trận ban đầu</div>';
    echo '<table class="matrix">';
    for ($i = 0; $i < $n; $i++) {
        echo '<tr>';
        for ($j = 0; $j < $m; $j++) {
            $x = rand(-100, 100);
            $originalMatrix[$i][$j] = $x; // Lưu giá trị vào ma trận gốc
            echo "<td class='" . ($x < 0 ? "negative" : "") . "'>" . $x . "</td>";
        }
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';

    // Hiển thị ma trận sau khi chuyển đổi giá trị âm thành 0
    echo '<div>';
    echo '<div class="matrix-header">Ma trận sau</div>';
    echo '<table class="matrix">';
    for ($i = 0; $i < $n; $i++) {
        echo '<tr>';
        for ($j = 0; $j < $m; $j++) {
            $x = $originalMatrix[$i][$j];
            if ($x < 0) {
                $x = 0;
            }
            $modifiedMatrix[$i][$j] = $x; // Lưu giá trị vào ma trận đã sửa đổi
            echo "<td class='" . ($x == 0 ? "zero" : "") . "'>" . $x . "</td>";
        }
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
    echo '</div>';

    // Hàm sắp xếp Merge Sort
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

    // Chuyển đổi ma trận 2D thành một mảng 1D để sắp xếp
    $flatArray = array_merge(...$originalMatrix); // Gộp các hàng thành một mảng
    $sortedArray = mergeSort($flatArray); // Sắp xếp mảng

    // Hiển thị ma trận đã sắp xếp
    echo '<div class="sorted-matrix-container">'; // Thêm class để căn giữa
    echo '<div>';
    echo '<div class="matrix-header">Ma trận sau khi sắp xếp</div>';
    echo '<table class="matrix">';
    $index = 0; // Chỉ số để truy cập phần tử trong mảng đã sắp xếp
    for ($i = 0; $i < $n; $i++) {
        echo '<tr>';
        for ($j = 0; $j < $m; $j++) {
            echo "<td>" . $sortedArray[$index++] . "</td>"; // In từng phần tử đã sắp xếp
        }
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
    echo '</div>';
    ?>

    <!-- Nút Reset -->
    <div class="btn-reset-container"> <!-- Thêm class container để căn giữa -->
        <form method="POST">
            <button class="btn-reset" type="submit">Reset</button>
        </form>
    </div>
</body>

</html>
