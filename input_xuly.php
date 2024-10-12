<html>

<head>

    <title>Input/Ouput data</title>
</head>

<body>
    <!-- bài 1 -->
    <div class="xuly">
        <form action="input_xuly.php" name="myform" method="post">
            Your Name: <input type="test" name="yourname" size=20 value="<?php if (isset($_POST['yourname'])) echo $_POST['yourname']; ?>" />
            <br>
            <input type="submit" value="Submit">
        </form>
        <?php

        if (isset($_POST["yourname"]))
            print "Hello " . $_POST["yourname"];
        ?>
    </div>
    <!-- bài 2 -->
    <div class="names">
        <form action="input_xuly.php" name="myform" method="post">
            First Name: <input type="text" name="Name[]" size=20 value="<?php if (isset($_POST['Name'])) echo $_POST['Name'][0]; ?>" /><br>
            Last Name: <input type="text" name="Name[]" size=20 value="<?php if (isset($_POST['Name'])) echo $_POST['Name'][1]; ?>" /><br>
            <input type="submit" value="Submit">
        </form>

        <?php
        if (isset($_POST['Name'])) {
            echo "Chào bạn " . $_POST['Name'][0] . " " . $_POST['Name'][1];
        }
        ?>
    </div>
    <!-- bài 3 -->
    <div class="text-area">
        <form action="input_xuly.php" name="myform" method="post">
            Your comment:
            <br>
            <textarea name="comment" rows="3" cols="40">
                <?php if (isset($_POST['comment'])) echo $_POST['comment']; ?>
            </textarea>
            <br>
            <input type="submit" value="Submit">
        </form>
        <?php
        if (isset($_POST["comment"]))
            print "Your comment: " . $_POST["comment"];
        ?>
    </div>

    <div>
        <form method="post" action="input_xuly.php">
            <input type="checkbox" name="chk1" value="en"
                <?php if (isset($_POST['chk1']) && $_POST['chk1'] == 'en') echo 'checked';
                else echo "" ?> />English <br>
            <input type="checkbox" name="chk2" value="vn"
                <?php if (isset($_POST['chk2']) && $_POST['chk2'] == 'vn') echo 'checked';
                else echo "" ?> />Vietnam<br>

            <input type="submit" value="submit"><br>
        </form>

        <?php
        if (isset($_POST['chk1'])) echo "checkbox 1 : " . $_POST['chk1'] . "<br>";
        if (isset($_POST['chk2'])) echo "checkbox 2 : " . $_POST['chk2'];

        ?>
    </div>

    <div class="dientich-hcn">
        <h1></h1>
    </div>
</body>

</html>
