<?php
// Kiểm tra và giải mã chuỗi JSON thành mảng PHP
$employees = isset($_POST['employees']) && !empty($_POST['employees']) ? json_decode($_POST['employees'], true) : [];
$message = "";

// Xử lý khi bấm nút Thêm NV vào danh sách
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['themNV'])) {
    $maNV = $_POST['maNV'];
    $hoTenNV = $_POST['hoTenNV'];
    $ngaySinh = $_POST['ngaySinh'];
    $gioiTinh = $_POST['gioiTinh'];
    $soDienThoai = $_POST['soDienThoai'];
    $maChucVu = $_POST['maChucVu'];

    // Kiểm tra mã NV không trùng và các trường không để trống
    $isDuplicate = false;
    foreach ($employees as $employee) {
        if ($employee['maNV'] === $maNV) {
            $isDuplicate = true;
            break;
        }
    }

    if ($isDuplicate) {
        $message = "Error: Không thêm được NV (Mã NV bị trùng).";
    } elseif (!empty($maNV) && !empty($hoTenNV) && !empty($ngaySinh) && !empty($gioiTinh) && !empty($soDienThoai) && !empty($maChucVu)) {
        // Thêm NV mới vào mảng
        $employees[] = [
            'maNV' => $maNV,
            'hoTenNV' => $hoTenNV,
            'ngaySinh' => $ngaySinh,
            'gioiTinh' => $gioiTinh,
            'soDienThoai' => $soDienThoai,
            'maChucVu' => $maChucVu
        ];
        $message = "Thêm thành công NV.";
    } else {
        $message = "Error: Không thêm được NV (Các trường không được để trống).";
    }
}

// Sticky form: giữ lại thông tin đã nhập
$maNV = $_POST['maNV'] ?? '';
$hoTenNV = $_POST['hoTenNV'] ?? '';
$ngaySinh = $_POST['ngaySinh'] ?? '';
$gioiTinh = $_POST['gioiTinh'] ?? '';
$soDienThoai = $_POST['soDienThoai'] ?? '';
$maChucVu = $_POST['maChucVu'] ?? '';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản Lý Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        margin: 20px;
    }

    label {
        font-weight: bolder;
    }
    </style>
</head>

<body class="container mt-5">
    <div class="container w-50 mb-4">
        <h2 class="mt-4 text-center fw-bolder">Nhập Thông Tin Nhân Viên</h2>
        <?php if (!empty($message)) : ?>
        <!-- Kiểm tra xem có thông báo hay không -->
        <div class="alert <?php echo (strpos($message, 'Error') !== false) ? 'alert-danger' : 'alert-success'; ?>">
            <?php echo $message; ?>
        </div> <!-- Hiển thị thông báo -->
        <?php endif; ?>

        <form action="" method="post" class="row g-3">
            <input type="hidden" name="employees" value="<?php echo htmlspecialchars(json_encode($employees)); ?>">
            <div class="form-group">
                <label for="maNV">Mã NV:</label>
                <input type="text" id="maNV" name="maNV" class="form-control"
                    value="<?php echo htmlspecialchars($maNV); ?>">
            </div>
            <div class="form-group">
                <label for="hoTenNV">Họ tên NV:</label>
                <input type="text" id="hoTenNV" name="hoTenNV" class="form-control"
                    value="<?php echo htmlspecialchars($hoTenNV); ?>">
            </div>
            <div class="form-group">
                <label for="ngaySinh">Ngày sinh:</label>
                <input type="date" id="ngaySinh" name="ngaySinh" class="form-control"
                    value="<?php echo htmlspecialchars($ngaySinh); ?>">
            </div>
            <div class="form-group">
                <label for="gioiTinh">Giới tính:</label>
                <input type="text" id="gioiTinh" name="gioiTinh" class="form-control"
                    value="<?php echo htmlspecialchars($gioiTinh); ?>">
            </div>
            <div class="form-group">
                <label for="soDienThoai">Số điện thoại:</label>
                <input type="tel" id="soDienThoai" name="soDienThoai" class="form-control"
                    value="<?php echo htmlspecialchars($soDienThoai); ?>">
            </div>
            <div class="form-group">
                <label for="maChucVu">Mã chức vụ:</label>
                <select id="maChucVu" name="maChucVu" class="form-select">
                    <option value="CV001" <?php if ($maChucVu == 'CV001') echo 'selected'; ?>>Quản lý</option>
                    <option value="CV002" <?php if ($maChucVu == 'CV002') echo 'selected'; ?>>Nhân viên</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" name="themNV" class="btn btn-primary">Thêm NV vào danh sách</button>
                <button type="submit" name="hienThiDS" class="btn btn-secondary">Hiển thị danh sách</button>
            </div>
        </form>
    </div>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hienThiDS'])): ?>
    <h2 class="mt-5">Danh sách nhân viên</h2>
    <?php if (!empty($employees)): ?>
    <div class="table-responsive">
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Mã NV</th>
                    <th>Họ tên NV</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Số điện thoại</th>
                    <th>Mã chức vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($employee['maNV']); ?></td>
                    <td><?php echo htmlspecialchars($employee['hoTenNV']); ?></td>
                    <td><?php echo htmlspecialchars($employee['ngaySinh']); ?></td>
                    <td><?php echo htmlspecialchars($employee['gioiTinh']); ?></td>
                    <td><?php echo htmlspecialchars($employee['soDienThoai']); ?></td>
                    <td><?php echo htmlspecialchars($employee['maChucVu']); ?></td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <?php else : ?>
    <p class="alert alert-warning">Không có nhân viên nào trong danh sách.</p>
    <?php endif; ?>
    <?php endif; ?>
</body>

</html>