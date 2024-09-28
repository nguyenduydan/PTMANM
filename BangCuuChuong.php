<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng cửu chương</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 20px;
        }
        .multiplication-table {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .table-container {
            background-color: #e6f7ff;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #b3d9ff;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
            width: 200px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .table-container:hover{
            transform: scale(1.1);
        }

        h2 {
            text-align: center;
            color: #007acc;
        }
        p {
            margin: 5px 0;
            color: #333;
            text-align: center;
        }
        h3{
            text-align: center;
            color: #007acc;
        }
        h1{
            text-align: center;

        }
        .kq{
            color: blue;
        }

    </style>
</head>
<body>
    <h1>Bảng cửu chương</h1>
    <div class="multiplication-table">
        <?php
        for($i=1; $i<=10; $i++){
            echo "<div class='table-container'>";
                echo "<h3 >Bảng cửu chương $i</h3>";
                for($j=1; $j<=10; $j++){
                    $c = $i * $j;
                    echo "<p>$i x $j = <span class='kq'>$c</span></p>";
                }
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
