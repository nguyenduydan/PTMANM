<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính chu vi và diện tích hình tam giác</title>
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
        if (isset($_GET['tinh'])) {
            $canh1 = isset($_GET['canh1']) ? trim($_GET['canh1']) : 0;
            $canh2 = isset($_GET['canh2']) ? trim($_GET['canh2']) : 0;
            $canh3 = isset($_GET['canh3']) ? trim($_GET['canh3']) : 0;

            if (is_numeric($canh1) && is_numeric($canh2) && is_numeric($canh3) && $canh1 > 0 && $canh2 > 0 && $canh3 > 0) {
                if ($canh1 + $canh2 > $canh3 && $canh2 + $canh3 > $canh1 && $canh3 + $canh1 > $canh2) {
                    $chuvi = $canh1 + $canh2 + $canh3;
                    $p = $chuvi / 2;
                    $dientich = (float)sqrt($p * ($p - $canh1) * ($p - $canh2) * ($p - $canh3));
                    $dientich = round($dientich, 3);
                } else {
                    echo "<p class='error'>Ba cạnh không tạo thành một tam giác!</p>";
                    $chuvi = $dientich = " ";
                }
            } else {
                echo "<p class='error'>Vui lòng nhập các giá trị hợp lệ!</p>";
                $chuvi = $dientich = " ";
            }
        }

        ?>
        <fieldset>
            <legend style="text-align: center;text-transform: uppercase;  font-weight: bold;">Tính chu vi và diện tích hình tam giác</legend>
            <form action="" method="get">
                <table>
                    <tr>
                        <td>Cạnh 1:</td>
                        <td><input type="text" name="canh1" value="<?php echo isset($_GET['canh1']) ? $_GET['canh1'] : ''; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Cạnh 2:</td>
                        <td><input type="text" name="canh2" value="<?php echo isset($_GET['canh2']) ? $_GET['canh2'] : ''; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Cạnh 3:</td>
                        <td><input type="text" name="canh3" value="<?php echo isset($_GET['canh3']) ? $_GET['canh3'] : ''; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Diện tích:</td>
                        <td><input type="text" disabled="disabled" value="<?php echo isset($dientich) ? $dientich : ''; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Chu vi:</td>
                        <td><input type="text" disabled="disabled" value="<?php echo isset($chuvi) ? $chuvi : ''; ?>" /></td>
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
