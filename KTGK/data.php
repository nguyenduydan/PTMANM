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
        $message = "Không thêm được NV (Mã NV bị trùng).";
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
        $message = "Không thêm được NV (Các trường không được để trống).";
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
</head>

<body>
    <!-- Hiển thị thông báo -->
    <?php if (!empty($message)) {
        echo "<p>$message</p>";
    } ?>

    <form action="" method="post">
        <label for="maNV">Mã NV:</label>
        <input type="text" id="maNV" name="maNV" value="<?php echo htmlspecialchars($maNV); ?>"><br>

        <label for="hoTenNV">Họ tên NV:</label>
        <input type="text" id="hoTenNV" name="hoTenNV" value="<?php echo htmlspecialchars($hoTenNV); ?>"><br>

        <label for="ngaySinh">Ngày sinh:</label>
        <input type="date" id="ngaySinh" name="ngaySinh" value="<?php echo htmlspecialchars($ngaySinh); ?>"><br>

        <label for="gioiTinh">Giới tính:</label>
        <input type="text" id="gioiTinh" name="gioiTinh" value="<?php echo htmlspecialchars($gioiTinh); ?>"><br>

        <label for="soDienThoai">Số điện thoại:</label>
        <input type="tel" id="soDienThoai" name="soDienThoai" value="<?php echo htmlspecialchars($soDienThoai); ?>"><br>

        <label for="maChucVu">Mã chức vụ:</label>
        <select id="maChucVu" name="maChucVu">
            <option value="CV001" <?php if ($maChucVu == 'CV001') echo 'selected'; ?>>Quản lý</option>
            <option value="CV002" <?php if ($maChucVu == 'CV002') echo 'selected'; ?>>Nhân viên</option>
            <!-- Các chức vụ khác -->
        </select><br>

        <button type="submit" name="themNV">Thêm NV vào danh sách</button>
        <button type="submit" name="hienThiDS">Hiển thị danh sách</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hienThiDS'])): ?>
    <h2>Danh Sách Nhân Viên</h2>
    <?php if (!empty($employees)): ?>
    <table border="1">
        <tr>
            <th>Mã NV</th>
            <th>Họ tên NV</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Số điện thoại</th>
            <th>Mã chức vụ</th>
        </tr>
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
    </table>
    <?php else: ?>
    <p>Không có nhân viên nào trong danh sách.</p>
    <?php endif; ?>
    <?php endif; ?>
</body>

</html>