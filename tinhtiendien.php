<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        fieldset {
            border: 2px solid #007bff;
            border-radius: 5px;
            padding: 10px;
        }

        legend {
            font-size: 18px;
            color: #007bff;
        }

        table {
            width: 100%;
        }

        td {
            padding: 8px 0;
        }

        input[type="text"] {
            width: 100%;
            padding: 5px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            text-align: center;
        }

        form {
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        $chisocu = 0;
        $chisomoi = 0;
        $dongia = 20000;
        $tienthanhtoan = 0;
        $tenchuho = '';
        if (isset($_GET['tinh'])) {
            $tenchuho = isset($_GET['tenchuho']) ? trim($_GET['tenchuho']) : 0;
            $chisomoi = isset($_GET['chisomoi']) ? trim($_GET['chisomoi']) : 0;

            $dongia = isset($_GET['dongia']) ? trim($_GET['dongia']) : 0;
            $chisocu = isset($_GET['chisocu']) ? trim($_GET['chisocu']) : 0;

            if (is_numeric($chisomoi) && is_numeric($chisocu) && is_numeric($dongia) && $chisomoi >= 0 && $chisocu >= 0 && $dongia >= 0) {
                $tienthanhtoan = ($chisomoi - $chisocu) * $dongia;
            } else {
                echo "<p class='error'>Vui lòng nhập các giá trị hợp lệ!</p>";
                $tienthanhtoan = " ";
            }
        }

        ?>
        <fieldset>
            <legend style="text-align: center;text-transform: uppercase;  font-weight: bold;">Tính tiền điện</legend>
            <form action="" method="get">
                <table>
                    <tr>
                        <td>Tên chủ hộ:</td>
                        <td><input type="text" name="tenchuho" value="<?php echo $tenchuho ?>" /></td>

                    </tr>
                    <tr>
                        <td>Chỉ số cũ:</td>
                        <td><input type="text" name="chisocu" value="<?php echo $chisocu; ?>" /><span>(Kw)</span></td>

                    </tr>
                    <tr>
                        <td>Chỉ số mới:</td>
                        <td><input type="text" name="chisomoi" value="<?php echo $chisomoi; ?>" />(Kw)</td>

                    </tr>
                    <tr>
                        <td>Đơn giá:</td>
                        <td><input type="text" name="dongia" value="<?php echo $dongia; ?>" />(VNĐ)</td>

                    </tr>
                    <tr>
                        <td>Số tiền thanh toán:</td>
                        <td><input type="text" disabled="disabled" value="<?php echo $tienthanhtoan; ?>" />(VNĐ)</td>

                    </tr>

                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="Tính" name="tinh" /></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </div>
</body>

</html>
