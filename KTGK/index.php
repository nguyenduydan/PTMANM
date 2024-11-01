<?php
session_start();

// Khởi tạo mảng nhân viên nếu chưa có
if (!isset($_SESSION['employees'])) {
    $_SESSION['employees'] = [];
}

// Thông báo
$message = '';

// Xử lý form khi người dùng gửi dữ liệu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addEmployee'])) {
        $maNV = trim($_POST['maNV']);
        $hoTen = trim($_POST['hoTen']);
        $ngaySinh = $_POST['ngaySinh'];
        $gioiTinh = $_POST['gioiTinh'];
        $soDienThoai = trim($_POST['soDienThoai']);
        $maChucVu = $_POST['maChucVu'];

        // Kiểm tra các trường nhập liệu
        if (empty($maNV) || empty($hoTen) || empty($ngaySinh) || empty($gioiTinh) || empty($soDienThoai) || empty($maChucVu)) {
            $message = "Không thêm được NV: Các trường không được để trống.";
        } elseif (isset($_SESSION['employees'][$maNV])) {
            $message = "Không thêm được NV: Mã NV đã tồn tại.";
        } else {
            $_SESSION['employees'][$maNV] = [
                'hoTen' => $hoTen,
                'ngaySinh' => $ngaySinh,
                'gioiTinh' => $gioiTinh,
                'soDienThoai' => $soDienThoai,
                'maChucVu' => $maChucVu
            ];
            $message = "Thêm thành công NV.";
        }
    } elseif (isset($_POST['resetSession'])) {
        // Xóa session khi nhấn nút làm mới
        session_destroy();
        session_start();
        $_SESSION['employees'] = [];
        $message = "Đã làm mới danh sách nhân viên.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập Thông Tin Nhân Viên</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 20px;
        }

        .message {
            margin-top: 20px;
            color: red;
            font-style: italic;
        }
    </style>
</head>

<body>

    <div class="container w-50">
        <h2 class="mt-4 text-center">Nhập Thông Tin Nhân Viên</h2>

        <form method="POST" action="" class="mt-3">
            <div class="form-group">
                <label for="maNV">Mã NV:</label>
                <input type="text" class="form-control" id="maNV" name="maNV"
                    value="<?php echo isset($_POST['maNV']) ? htmlspecialchars($_POST['maNV']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="hoTen">Họ tên NV:</label>
                <input type="text" class="form-control" id="hoTen" name="hoTen"
                    value="<?php echo isset($_POST['hoTen']) ? htmlspecialchars($_POST['hoTen']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="ngaySinh">Ngày sinh:</label>
                <input type="date" class="form-control" id="ngaySinh" name="ngaySinh"
                    value="<?php echo isset($_POST['ngaySinh']) ? htmlspecialchars($_POST['ngaySinh']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="gioiTinh">Giới tính:</label>
                <input type="text" class="form-control" id="gioiTinh" name="gioiTinh"
                    value="<?php echo isset($_POST['gioiTinh']) ? htmlspecialchars($_POST['gioiTinh']) : ''; ?>"
                    placeholder="Nhập giới tính (Nam, Nữ, Khác)">
            </div>

            <div class="form-group">
                <label for="soDienThoai">Số điện thoại:</label>
                <input type="tel" class="form-control" id="soDienThoai" name="soDienThoai"
                    value="<?php echo isset($_POST['soDienThoai']) ? htmlspecialchars($_POST['soDienThoai']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="maChucVu">Mã chức vụ:</label>
                <select class="form-control" id="maChucVu" name="maChucVu">
                    <option value="">Chọn mã chức vụ</option>
                    <option value="CV01">Chức vụ 1</option>
                    <option value="CV02">Chức vụ 2</option>
                    <option value="CV03">Chức vụ 3</option>
                </select>
            </div>

            <button type="submit" name="addEmployee" class="btn btn-success">Thêm NV vào danh sách</button>
            <button type="submit" name="showList" class="btn btn-info">Hiển thị danh sách</button>
            <button type="submit" name="resetSession" class="btn btn-danger">Làm mới</button>
        </form>

        <div class="message">
            <?php echo $message; ?>
        </div>

        <?php if (isset($_POST['showList'])): ?>
            <h3 class="mt-4">Danh sách nhân viên:</h3>
            <table class="table table-bordered mt-3">
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
                    <?php
                    if (!empty($_SESSION['employees'])) {
                        foreach ($_SESSION['employees'] as $maNV => $info) {
                            // Kiểm tra nếu $info là mảng trước khi truy cập
                            if (is_array($info)) {
                                echo "<tr>
                                    <td>$maNV</td>
                                    <td>{$info['hoTen']}</td>
                                    <td>{$info['ngaySinh']}</td>
                                    <td>{$info['gioiTinh']}</td>
                                    <td>{$info['soDienThoai']}</td>
                                    <td>{$info['maChucVu']}</td>
                                </tr>";
                            }
                        }
                    } else {
                        echo "<tr><td colspan='6'>Danh sách nhân viên trống.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
