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
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-size: 18px;

        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            transition: ease-in-out .5s;
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
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 5px 10px #46cfff;
            font-weight: bold;
            width: 200px;
            font-size: 18px;
            transition: ease-in-out 0.2s;
        }

        input[type="submit"]:hover {
            color: black;
            background-color: greenyellow;
            width: 230px;
            border-radius: 50px;
            box-shadow: 0 5px 10px #86f958;
        }

        .error {
            color: red;
            text-align: center;
            font-weight: bold;
        }

        .container div:last-child {
            text-align: center;
            margin-top: 20px;
        }

        .radio-group {
            display: block;
            align-items: center;
        }

        #pheptinh {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <?php
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operation = $_POST['operation'];

        if (empty($num1) || empty($num2)) {
            $error = 'Vui lòng nhập đầy đủ hai số!';
        } elseif (!is_numeric($num1) || !is_numeric($num2)) {
            $error = 'Vui lòng nhập số hợp lệ!';
        }
    }
    ?>
    <div class="container">
        <fieldset>
            <legend style="text-align: center;text-transform: uppercase;  font-weight: bold;">Phép tính trên 2 số</legend>
            <form action="xulykq2so.php" method="post">
                <div class="radio-group" style="text-align: center;">
                    <label style="font-weight: 900;">Chọn phép tính:</label><br>
                    <input type="radio" id="add" name="operation" value="add" checked>
                    <label id="pheptinh" for="add">Cộng</label>
                    <input type="radio" id="subtract" name="operation" value="subtract">
                    <label for="subtract" id="pheptinh">Trừ</label>
                    <input type="radio" id="multiply" name="operation" value="multiply">
                    <label for="multiply" id="pheptinh">Nhân</label>
                    <input type="radio" id="divide" name="operation" value="divide">
                    <label for="divide" id="pheptinh">Chia</label>
                </div>

                <div>
                    <label class="col-5" for="so1">Số thứ nhất:</label>
                    <input type="text" name="so1" value="<?php echo isset($_POST['so1']) ? $_POST['so1'] : ''; ?>" />
                </div>

                <div>
                    <label class="col-5" for="so2">Số thứ hai:</label>
                    <input type="text" name="so2" value="<?php echo isset($_POST['so2']) ? $_POST['so2'] : ''; ?>" />
                </div>

                <div>
                    <input type="submit" value="Tính" name="tinh" />
                </div>
            </form>
        </fieldset>
    </div>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
