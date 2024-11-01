<?php
// Mảng lưu trữ danh sách nhân viên
$nhanViens = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addEmployee'])) {
        $maNV = $_POST['MaNV'];
        $hoTenNV = $_POST['HoTenNV'];
        $ngaySinh = $_POST['NgaySinh'];
        $gioiTinh = $_POST['GioiTinh'];
        $soDienThoai = $_POST['SoDienThoai'];
        $maChucVu = $_POST['MaChucVu'];

        // Kiểm tra mã NV không được trùng
        $maNVDuplicated = false;
        foreach ($nhanViens as $nv) {
            if ($nv['MaNV'] === $maNV) {
                $maNVDuplicated = true;
                break;
            }
        }

        if ($maNVDuplicated) {
            echo "Không thêm được NV. Mã NV đã tồn tại!";
        } elseif (!empty($maNV) && !empty($hoTenNV) && !empty($ngaySinh) && !empty($gioiTinh) && !empty($soDienThoai) && !empty($maChucVu)) {
            // Thêm nhân viên vào mảng
            $nhanViens[] = [
                'MaNV' => $maNV,
                'HoTenNV' => $hoTenNV,
                'NgaySinh' => $ngaySinh,
                'GioiTinh' => $gioiTinh,
                'SoDienThoai' => $soDienThoai,
                'MaChucVu' => $maChucVu,
            ];
            echo "Thêm thành công NV!";
        } else {
            echo "Không thêm được NV. Vui lòng kiểm tra lại thông tin!";
        }
    }

    // Xử lý hiển thị danh sách nhân viên
    if (isset($_POST['showEmployees'])) {
        echo "<h2>Danh sách Nhân Viên</h2>";
        foreach ($nhanViens as $nv) {
            echo "Mã NV: " . $nv['MaNV'] . ", Họ tên: " . $nv['HoTenNV'] . ", Ngày sinh: " . $nv['NgaySinh'] . ", Giới tính: " . $nv['GioiTinh'] . ", SĐT: " . $nv['SoDienThoai'] . ", Mã chức vụ: " . $nv['MaChucVu'] . "<br>";
        }
    }
}
