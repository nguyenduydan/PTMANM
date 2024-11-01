<?php
// Xây dựng lại mảng $employees từ dữ liệu gửi qua form
$employees = []; // Khởi tạo mảng để lưu trữ thông tin nhân viên

// Kiểm tra xem phương thức yêu cầu là POST hay không
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kiểm tra xem có bất kỳ mã nhân viên nào được gửi qua form không
    if (isset($_POST['employee_maNV'])) {
        // Duyệt qua từng mã nhân viên được gửi
        foreach ($_POST['employee_maNV'] as $index => $maNV) {
            // Lưu thông tin của mỗi nhân viên vào mảng $employees
            $employees[] = [
                'maNV' => $maNV, // Lưu mã nhân viên
                'hoTenNV' => $_POST['employee_hoTenNV'][$index], // Lưu họ tên nhân viên từ input tương ứng
                'ngaySinh' => $_POST['employee_ngaySinh'][$index], // Lưu ngày sinh nhân viên từ input tương ứng
                'gioiTinh' => $_POST['employee_gioiTinh'][$index], // Lưu giới tính nhân viên từ input tương ứng
                'soDienThoai' => $_POST['employee_soDienThoai'][$index], // Lưu số điện thoại nhân viên từ input tương ứng
                'maChucVu' => $_POST['employee_maChucVu'][$index] // Lưu mã chức vụ nhân viên từ input tương ứng
            ];
        }
    }
}

$message = ""; // Khởi tạo biến để lưu thông báo

// Xử lý khi bấm nút Thêm NV vào danh sách
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['themNV'])) {
    // Lấy thông tin nhân viên từ form
    $maNV = $_POST['maNV'];
    $hoTenNV = $_POST['hoTenNV'];
    $ngaySinh = $_POST['ngaySinh'];
    $gioiTinh = $_POST['gioiTinh'];
    $soDienThoai = $_POST['soDienThoai'];
    $maChucVu = $_POST['maChucVu'];

    // Kiểm tra mã NV không trùng và các trường không để trống
    $isDuplicate = false; // Biến kiểm tra sự trùng lặp mã NV
    foreach ($employees as $employee) {
        // So sánh mã NV mới với mã NV hiện có trong danh sách
        if ($employee['maNV'] === $maNV) {
            $isDuplicate = true; // Đánh dấu là trùng nếu tìm thấy
            break; // Thoát khỏi vòng lặp nếu đã tìm thấy trùng
        }
    }

    // Thông báo nếu mã NV bị trùng
    if ($isDuplicate) {
        $message = "Error: Không thêm được NV (Mã NV bị trùng).";
    } elseif (!empty($maNV) && !empty($hoTenNV) && !empty($ngaySinh) && !empty($gioiTinh) && !empty($soDienThoai) && !empty($maChucVu)) {
        // Thêm NV mới vào mảng nếu không có trùng và tất cả các trường đều không rỗng
        $employees[] = [
            'maNV' => $maNV,
            'hoTenNV' => $hoTenNV,
            'ngaySinh' => $ngaySinh,
            'gioiTinh' => $gioiTinh,
            'soDienThoai' => $soDienThoai,
            'maChucVu' => $maChucVu
        ];
        $message = "Thêm thành công NV."; // Thông báo thành công
    } else {
        $message = "Error: Không thêm được NV (Các trường không được để trống)."; // Thông báo nếu có trường bị để trống
    }
}

// Xử lý khi bấm nút reset mảng
if (isset($_POST['reset'])) {
    $employees = []; // Đặt lại mảng nhân viên về rỗng
    $message = "Đã reset danh sách nhân viên."; // Thông báo reset thành công
}

// Sticky form: giữ lại thông tin đã nhập
$maNV = $_POST['maNV'] ?? ''; // Giữ mã NV đã nhập
$hoTenNV = $_POST['hoTenNV'] ?? ''; // Giữ họ tên NV đã nhập
$ngaySinh = $_POST['ngaySinh'] ?? ''; // Giữ ngày sinh NV đã nhập
$gioiTinh = $_POST['gioiTinh'] ?? ''; // Giữ giới tính NV đã nhập
$soDienThoai = $_POST['soDienThoai'] ?? ''; // Giữ số điện thoại NV đã nhập
$maChucVu = $_POST['maChucVu'] ?? ''; // Giữ mã chức vụ đã chọn

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
        /* Đặt lề cho body */
    }

    label {
        font-weight: bolder;
        /* Đặt kiểu chữ in đậm cho nhãn */
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
            <!-- Tạo các input ẩn cho mỗi nhân viên hiện có trong danh sách -->
            <?php foreach ($employees as $employee) : ?>
            <input type="hidden" name="employee_maNV[]" value="<?php echo htmlspecialchars($employee['maNV']); ?>">
            <input type="hidden" name="employee_hoTenNV[]" value="<?= htmlspecialchars($employee['hoTenNV']); ?>">
            <input type="hidden" name="employee_ngaySinh[]" value="<?= htmlspecialchars($employee['ngaySinh']); ?>">
            <input type="hidden" name="employee_gioiTinh[]" value="<?= htmlspecialchars($employee['gioiTinh']); ?>">
            <input type="hidden" name="employee_soDienThoai[]"
                value="<?= htmlspecialchars($employee['soDienThoai']); ?>">
            <input type="hidden" name="employee_maChucVu[]" value="<?= htmlspecialchars($employee['maChucVu']); ?>">
            <?php endforeach; ?>

            <!-- Các trường nhập thông tin cho nhân viên mới -->
            <div class="form-group">
                <label for="maNV">Mã NV:</label>
                <input type="text" id="maNV" name="maNV" class="form-control" value="<?= htmlspecialchars($maNV); ?>">
            </div>
            <div class="form-group">
                <label for="hoTenNV">Họ tên NV:</label>
                <input type="text" id="hoTenNV" name="hoTenNV" class="form-control"
                    value="<?= htmlspecialchars($hoTenNV); ?>">
            </div>
            <div class="form-group">
                <label for="ngaySinh">Ngày sinh:</label>
                <input type="date" id="ngaySinh" name="ngaySinh" class="form-control"
                    value="<?= htmlspecialchars($ngaySinh); ?>">
            </div>
            <div class="form-group">
                <label for="gioiTinh">Giới tính:</label>
                <input type="text" id="gioiTinh" name="gioiTinh" class="form-control"
                    value="<?= htmlspecialchars($gioiTinh); ?>">
            </div>
            <div class="form-group">
                <label for="soDienThoai">Số điện thoại:</label>
                <input type="tel" id="soDienThoai" name="soDienThoai" class="form-control"
                    value="<?= htmlspecialchars($soDienThoai); ?>">
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
                <button type="submit" name="reset" class="btn btn-warning">Làm mới</button>
            </div>
        </form>
    </div>

    <div class="container">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hienThiDS'])): ?>
        <h2 class="mt-5">Danh sách nhân viên</h2>
        <?php if (empty($employees)): ?>
        <p class="alert alert-warning">Không có nhân viên nào trong danh sách.</p>
        <!-- Hiển thị thông báo nếu không có nhân viên -->
        <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mã NV</th>
                    <th>Họ tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Số điện thoại</th>
                    <th>Mã chức vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee) : ?>
                <tr>
                    <td><?= htmlspecialchars($employee['maNV']); ?></td>
                    <td><?= htmlspecialchars($employee['hoTenNV']); ?></td>
                    <td><?= htmlspecialchars($employee['ngaySinh']); ?></td>
                    <td><?= htmlspecialchars($employee['gioiTinh']); ?></td>
                    <td><?= htmlspecialchars($employee['soDienThoai']); ?></td>
                    <td><?= htmlspecialchars($employee['maChucVu']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
        <?php endif; ?>
    </div>

</body>

</html>