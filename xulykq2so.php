<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            transition: ease-in-out .5s;
            max-width: 500px;
        }

        .container:hover {
            box-shadow: 0 4px 12px #025f80;
        }

        fieldset {
            border: 2px solid #007bff;
            border-radius: 8px;
            padding: 20px;
            margin: 0;
        }

        legend {
            font-size: 20px;
            color: #007bff;
            padding: 0 10px;
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        div {
            margin-bottom: 15px;
        }

        label {
            text-align: center;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            padding: 8px;
            border-radius: 5px;
            border: 2px solid #ccc;
            font-size: 16px;
            display: inline-block;
        }

        span {
            font-size: 14px;
            color: #666;
            margin-left: 5px;
            display: inline-block;
        }

        input[type="submit"] {
            padding: 10px 30px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 200px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .container div:last-child {
            text-align: center;
            margin-top: 20px;
        }

        .radio-group {
            display: block;
            align-items: center;
        }

        .btn {
            width: 150px;
            font-size: 18px;
            font-weight: bold;
            border: 4px solid;
            border-radius: 15px;
            box-shadow: 1px 3px 10px #0dcaf0;
            transition: ease-in-out 0.2s;
        }

        .btn:hover {
            width: 200px;
            border-radius: 25px;

        }
    </style>
</head>

<body>
    <?php
    function calculate($so1, $so2, $operation)
    {
        switch ($operation) {
            case 'add':
                return $so1 + $so2;
            case 'subtract':
                return $so1 - $so2;
            case 'multiply':
                return $so1 * $so2;
            case 'divide':
                return $so2 != 0 ? $so1 / $so2 : 'Không thể chia cho 0';
            default:
                return 'Phép tính không hợp lệ';
        }
    }
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $so1 = $_POST['so1'];
        $so2 = $_POST['so2'];
        $operation = $_POST['operation'];

        if (empty($so1) || empty($so2)) {
            $error = 'Vui lòng nhập đầy đủ hai số!';
        } elseif (!is_numeric($so1) || !is_numeric($so2)) {
            $error = 'Vui lòng nhập số hợp lệ!';
        } else {
            $so1 = $_POST['so1'];
            $so2 = $_POST['so2'];
            $operation = $_POST['operation'];
            $result = calculate($so1, $so2, $operation);
            $operationText = '';

            switch ($operation) {
                case 'add':
                    $operationText = 'Cộng';
                    break;
                case 'subtract':
                    $operationText = 'Trừ';
                    break;
                case 'multiply':
                    $operationText = 'Nhân';
                    break;
                case 'divide':
                    $operationText = 'Chia';
                    break;
            }
        }
    } else {
        header('Location: pheptinh2so.php');
        exit();
    }
    ?>
    <div class="container">
        <fieldset>
            <legend style="text-align: center;text-transform: uppercase;  font-weight: bold;">Phép tính trên 2 số</legend>
            <form action="" method="post">
                <?php if (!empty($error)): ?>
                    <!-- Hiển thị lỗi nếu có -->
                    <div class="alert alert-danger" style="text-align: center;">
                        <?php echo $error; ?>
                    </div>
                <?php else: ?>
                    <div class="radio-group" style="text-align: center;">
                        <label style="font-weight: 900;">Phép tính: <?php echo $operationText; ?></label><br>
                    </div>

                    <div>
                        <label class="col-5" for="so1">Số thứ nhất:</label>
                        <input type="text" disabled="disabled" name="so1" value="<?php echo $so1; ?>" />
                    </div>

                    <div>
                        <label class="col-5" for="so2">Số thứ hai:</label>
                        <input type="text" disabled="disabled" name="so2" value="<?php echo $so2; ?>" />
                    </div>
                    <div>
                        <label class="col-5" style="color: #007bff;" for="so2">Kết quả:</label>
                        <input type="text" name="so2" disabled="disabled" value="<?php echo $result; ?>" />
                    </div>
                <?php endif; ?>

                <div>
                    <a class="btn btn-outline-info" href="javascript:window.history.back(-1);">Trở về</a>
                </div>
            </form>
        </fieldset>
    </div>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
