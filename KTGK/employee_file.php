<?php
// Đọc danh sách nhân viên từ file nếu tồn tại
$employees = [];
if (file_exists('employees.txt')) {
    $employees = json_decode(file_get_contents('employees.txt'), true) ?? [];
}

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

        // Ghi thông tin nhân viên vào file
        file_put_contents('employees.txt', json_encode($employees));

        $message = "Thêm thành công NV.";
    } else {
        $message = "Error: Không thêm được NV (Các trường không được để trống).";
    }
}

// Xử lý khi bấm nút Reset
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset'])) {
    // Xóa file chứa danh sách nhân viên
    if (file_exists('employees.txt')) {
        unlink('employees.txt'); // Xóa file
    }
    $employees = []; // Đặt lại mảng về trạng thái rỗng
    $message = "Đã reset danh sách nhân viên.";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Nhân Viên</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container w-50">
        <!-- Hiển thị thông báo -->
        <?php if (!empty($message)) : ?>
        <!-- Kiểm tra xem có thông báo hay không -->
        <div class="alert <?php echo (strpos($message, 'Error') !== false) ? 'alert-danger' : 'alert-success'; ?>">
            <?php echo $message; ?>
        </div> <!-- Hiển thị thông báo -->
        <?php endif; ?>

        <form action="" method="post" class="mb-4">
            <h2 class="mt-4 text-center fw-bolder">Nhập Thông Tin Nhân Viên</h2>
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
                <select id="maChucVu" name="maChucVu" class="form-control">
                    <option value="CV001" <?php if ($maChucVu == 'CV001') echo 'selected'; ?>>Quản lý</option>
                    <option value="CV002" <?php if ($maChucVu == 'CV002') echo 'selected'; ?>>Nhân viên</option>
                </select>
            </div>
            <button type="submit" name="themNV" class="btn btn-primary">Thêm NV vào danh sách</button>
            <button type="submit" name="hienThiDS" class="btn btn-secondary">Hiển thị danh sách</button>
            <button type="submit" name="reset" class="btn btn-danger">Làm mới</button>
        </form>
    </div>
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hienThiDS'])): ?>
    <h2>Danh Sách Nhân Viên</h2>
    <?php if (!empty($employees)): ?>
    <table class="table table-striped">
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
            <?php foreach ($employees as $employee): ?>
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
    <?php else: ?>
    <p class="alert alert-warning">Không có nhân viên nào trong danh sách.</p>
    <?php endif; ?>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>