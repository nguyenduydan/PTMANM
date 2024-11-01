<?php
$employees = [];

session_start();

if (!isset($_SESSION['employees'])) {
    $_SESSION['employees'] = [];
}

if (isset($_POST['them_nv'])) {
    //xóa khoảng trắng
    $ma_nv = trim($_POST['ma_nv']);
    $ho_ten = trim($_POST['ho_ten']);
    $ngay_sinh = trim($_POST['ngay_sinh']);
    $gioi_tinh = trim($_POST['gioi_tinh']);
    $so_dien_thoai = trim($_POST['so_dien_thoai']);
    $ma_chuc_vu = $_POST['ma_chuc_vu'];

    if (!empty($ma_nv) && !empty($ho_ten) && !empty($ngay_sinh) && !empty($gioi_tinh) && !empty($so_dien_thoai)) {
        $is_duplicate = false;

        foreach ($_SESSION['employees'] as $employee) {
            if ($employee['ma_nv'] === $ma_nv) {
                $is_duplicate = true;
                break;
            }
        }

        if (!$is_duplicate) {
            $_SESSION['employees'][] = [
                'ma_nv' => $ma_nv,
                'ho_ten' => $ho_ten,
                'ngay_sinh' => $ngay_sinh,
                'gioi_tinh' => $gioi_tinh,
                'so_dien_thoai' => $so_dien_thoai,
                'ma_chuc_vu' => $ma_chuc_vu,
            ];

            echo "<div class='alert alert-success'>Thêm thành công NV!</div>";
        } else {
            echo "<div class='alert alert-warning'>Không thêm được NV: Mã NV đã tồn tại!</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Không thêm được NV: Vui lòng điền đầy đủ thông tin!</div>";
    }
}

$sticky_ma_nv = isset($_POST['ma_nv']) ? htmlspecialchars($_POST['ma_nv']) : '';
$sticky_ho_ten = isset($_POST['ho_ten']) ? htmlspecialchars($_POST['ho_ten']) : '';
$sticky_ngay_sinh = isset($_POST['ngay_sinh']) ? htmlspecialchars($_POST['ngay_sinh']) : '';
$sticky_gioi_tinh = isset($_POST['gioi_tinh']) ? htmlspecialchars($_POST['gioi_tinh']) : '';
$sticky_so_dien_thoai = isset($_POST['so_dien_thoai']) ? htmlspecialchars($_POST['so_dien_thoai']) : '';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Quản lý nhân viên</title>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="text-center mb-4">Thêm nhân viên</h2>
        <form method="POST" class="p-4 border rounded bg-white">
            <div class="mb-3">
                <label for="ma_nv" class="form-label">Mã NV:</label>
                <input type="text" id="ma_nv" name="ma_nv" value="<?= $sticky_ma_nv ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="ho_ten" class="form-label">Họ tên NV:</label>
                <input type="text" id="ho_ten" name="ho_ten" value="<?= $sticky_ho_ten ?>" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label for="ngay_sinh" class="form-label">Ngày sinh:</label>
                <input type="date" id="ngay_sinh" name="ngay_sinh" value="<?= $sticky_ngay_sinh ?>" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label for="gioi_tinh" class="form-label">Giới tính:</label>
                <input type="text" id="gioi_tinh" name="gioi_tinh" value="<?= $sticky_gioi_tinh ?>" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label for="so_dien_thoai" class="form-label">Số điện thoại:</label>
                <input type="text" id="so_dien_thoai" name="so_dien_thoai" value="<?= $sticky_so_dien_thoai ?>"
                    pattern="\d+" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="ma_chuc_vu" class="form-label">Mã chức vụ:</label>
                <select id="ma_chuc_vu" name="ma_chuc_vu" class="form-select">
                    <option value="CV01"
                        <?= isset($_POST['ma_chuc_vu']) && $_POST['ma_chuc_vu'] === 'CV01' ? 'selected' : '' ?>>CV01
                    </option>
                    <option value="CV02"
                        <?= isset($_POST['ma_chuc_vu']) && $_POST['ma_chuc_vu'] === 'CV02' ? 'selected' : '' ?>>CV02
                    </option>
                </select>
            </div>

            <button type="submit" name="them_nv" class="btn btn-success me-2">Thêm NV vào danh sách</button>
            <button type="submit" name="hien_thi" class="btn btn-primary">Hiển thị danh sách</button>
        </form>

        <?php
        if (isset($_POST['hien_thi'])) {
            echo "<h3 class='mt-5'>Danh sách nhân viên</h3>";
            if (!empty($_SESSION['employees'])) {
                echo "<table class='table table-bordered mt-3'>";
                echo "<thead><tr><th>Mã NV</th><th>Họ tên</th><th>Ngày sinh</th><th>Giới tính</th><th>Số điện thoại</th><th>Mã chức vụ</th></tr></thead>";
                echo "<tbody>";
                foreach ($_SESSION['employees'] as $employee) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($employee['ma_nv']) . "</td>";
                    echo "<td>" . htmlspecialchars($employee['ho_ten']) . "</td>";
                    echo "<td>" . htmlspecialchars($employee['ngay_sinh']) . "</td>";
                    echo "<td>" . htmlspecialchars($employee['gioi_tinh']) . "</td>";
                    echo "<td>" . htmlspecialchars($employee['so_dien_thoai']) . "</td>";
                    echo "<td>" . htmlspecialchars($employee['ma_chuc_vu']) . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<div class='alert alert-info'>Danh sách nhân viên trống!</div>";
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
