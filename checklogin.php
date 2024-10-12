<html>

<body>
    <?php
    $user = $_REQUEST["username"];
    $pass = $_REQUEST["pass"];
    if (isset($user, $pass)) {
        if ($user == "admin" && $pass == "123") {
            echo "<h1 style='color: green;'>Đăng nhập thành công</h1>";
            echo "<font color=blue>Welcom to, " . $user . "</font>";
        } else {
            echo "<h1 style='color: red;'>Đăng nhập thất bại. Vui lòng nhập lại</h1>";
        }
    } else {
        echo "<h1>Vui lòng nhập giá trị</h1>";
    }
    ?>
</body>

</html>
