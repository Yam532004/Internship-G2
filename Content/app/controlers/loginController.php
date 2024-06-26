<?php
session_start();
require '../../public/dbconnect.php';
require '../../public/validate.php';

// kết nối dữ liệu 
// validate password đúng với format đã -> hash và so sánh vừa password và email có bằng không
// nếu có thì tạo và lưu một token -> thay đổi trang homepage avatar 
// nếu không thì hiện lỗi format password hoặc lỗi nếu đúng email sai mật khẩu trả về sai mật khẩu hoặc ngược lại
// nếu sai cả hai thì báo không tồn tại user với email ...

?>