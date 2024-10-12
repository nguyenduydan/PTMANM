<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sổ Xố Ngẫu Nhiên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            /* Màu nền nhẹ nhàng */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            max-width: 700px;
            max-height: 95vh;
            transition: ease-in-out 0.8s;
        }

        .container:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.8);
        }

        .header {
            background-color: #ffeb3b;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .header .date {
            font-size: 18px;
            color: #757575;
            /* Màu xám cho ngày tháng */
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            border-radius: 20px;
        }

        th {
            background-color: #ffeb3b;
            padding: 10px;
            font-size: 20px;
            border-bottom: 2px solid #ccc;
            /* Đường viền dưới cho tiêu đề */
        }

        td {
            padding: 15px;
            font-size: 18px;
            border-bottom: 1px solid #ddd;
            transition: ease-in-out .3s;
            text-align: center;
            flex-wrap: wrap;
        }

        td.winning {
            color: #d32f2f;
            /* Màu đỏ cho giải thưởng */
            font-weight: bold;
            font-size: 20px;
            /* Kích thước chữ lớn hơn cho giải đặc biệt */
        }

        td:hover {
            background-color: #ffeb3b;
            /* Đổi màu nền thành màu #ffeb3b khi hover */
            cursor: pointer;
            /* Thay đổi con trỏ thành tay */
            transition: background-color 0.2s;
            /* Thời gian hiệu ứng đổi màu */
        }

        .footer {
            font-size: 18px;
            color: #616161;
            /* Màu xám cho footer */
            text-align: center;
            margin-top: 20px;
        }

        .button-container {
            text-align: center;
            /* Căn giữa nội dung */
            margin-top: 20px;
            /* Khoảng cách giữa bảng và nút */
        }

        .btn-reset {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #ffeb3b;
            border: 2px solid #ffeb3b;
            border-radius: 5px;
            cursor: pointer;
            transition: ease-in-out 0.2s;
            margin-top: 10px;
        }

        .btn-reset:hover {
            background-color: transparent;
            border: 2px solid #ffeb3b;
            /* Hiệu ứng phóng to khi hover */
        }

        .space {
            margin: 10px;
        }

        .color-special {
            background-color: #fcffcf;
        }

        td.tengiai {
            font-weight: 600;
        }
    </style>
</head>
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

// Hàm để sinh số ngẫu nhiên cho xổ số
function randomso($length, $min = 0, $max = null)
{
    if ($max === null) {
        $max = str_repeat('9', $length);
    }
    return str_pad(rand($min, $max), $length, '0', STR_PAD_LEFT);
}

// Sinh số cho các giải xổ số
$giaiDacBiet = randomso(6); // Giải Đặc Biệt: 6 chữ số
$giaiNhat = randomso(5); // Giải Nhất: 5 chữ số
$giaiNhi = randomso(5); // Giải Nhì: 5 chữ số
$giaiBa = [randomso(5), randomso(5)]; // Giải Ba: 2 số 5 chữ số
$giaiTu = [
    randomso(5),
    randomso(5),
    randomso(5),
    randomso(5),
    randomso(5),
    randomso(5),
    randomso(5)
]; // Giải Tư: 6 số 5 chữ số
$giaiNam = randomso(4); // Giải Năm: 4 chữ số
$giaiSau = [
    randomso(4),
    randomso(4),
    randomso(4)
]; // Giải Sáu: 3 số 4 chữ số
$giaiBay = randomso(3); // Giải Bảy: 3 chữ số
$giaiTam = randomso(2); //Giải tám: 2 chữ số
?>

<body>
    <div class="container">
        <div class="header">
            <h1>Kết quả Xổ số Khánh Hòa</h1>
            <div class="date"><?php echo "XSMT " . $ngayHienTai; ?></div>
        </div>

        <table>
            <tr>
                <th style="width: 100px;">Giải</th>
                <th>Số</th>
            </tr>
            <tr class="color-special">
                <td class="tengiai">Giải Tám</td>
                <td class="winning"><?php echo $giaiTam; ?></td>
            </tr>
            <tr>
                <td class="tengiai">Giải Bảy</td>
                <td><?php echo $giaiBay; ?></td>
            </tr>
            <tr class="color-special">
                <td class="tengiai">Giải Sáu</td>
                <td><?php echo implode("<span class='space'></span>", $giaiSau); ?></td>
            </tr>
            <tr>
                <td class="tengiai">Giải Năm</td>
                <td><?php echo $giaiNam; ?></td>
            </tr>
            <tr class="color-special">
                <td class="tengiai">Giải Tư</td>
                <td><?php echo implode("<span class='space'></span>", $giaiTu); ?></td>
            </tr>
            <tr>
                <td class="tengiai">Giải Ba</td>
                <td><?php echo $giaiBa[0] . "<span class='space'></span>" . $giaiBa[1]; ?></td>
            </tr>
            <tr class="color-special">
                <td class="tengiai">Giải Nhì</td>
                <td><?php echo $giaiNhi; ?></td>
            </tr>
            <tr>
                <td class="tengiai">Giải Nhất</td>
                <td><?php echo $giaiNhat; ?></td>
            </tr>
            <tr class="color-special">
                <td class="tengiai">Giải Đặc Biệt</td>
                <td class="winning"><?php echo $giaiDacBiet; ?></td>
            </tr>
        </table>


        <!-- Nút Reset (làm mới trang) -->
        <div class="button-container">
            <form method="POST">
                <button class="btn-reset" type="submit">Làm Mới</button>
            </form>
        </div>

        <div class="footer">
            <p>XS Khánh Hòa - Kết quả Xổ số Khánh Hòa - SXKH hôm nay</p>
        </div>
    </div>
</body>

</html>
