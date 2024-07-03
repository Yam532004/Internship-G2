<?php include_once '../../config/database.php';
include_once '../../config/dbconnect.php'
?>
<button class="btn btn-sm btn-warning col-2" data-toggle="modal" data-target="#staticBackdrop3"><i class="fa fa-pen-to-square ">
    </i></button>

<div class="modal fade" id="staticBackdrop3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content w-75">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-center">Edit user</h3>
                    </div>

                    <?php
                    if (isset($_GET['id'])) {
                        $id = htmlspecialchars($_GET['id']);

                        // Thực hiện kết nối CSDL và truy vấn để lấy thông tin người dùng
                        $databaseService = new DatabaseService();
                        $conn = $databaseService->getConnection();
                        $query = $conn->prepare("SELECT * FROM users WHERE user_id = :id");
                        $query->bindParam(':id', $id);
                        $query->execute();
                        $row = $query->fetch(PDO::FETCH_ASSOC);

                        // Lấy thông tin từ kết quả truy vấn
                        if ($row) {
                            $username = $row['username'];
                            $phone_number = $row['phone_number'];
                            $email = $row['email'];
                            // Không hiển thị mật khẩu trong form chỉnh sửa
                            $password = ''; // hoặc có thể gán giá trị rỗng để người dùng không thay đổi mật khẩu
                        }

                        $conn = null; // Đóng kết nối CSDL sau khi hoàn thành
                    }
                    ?>
                    <form action="../../api/edit-user.php" id="myform" method="post">
                        <div class="card-body container">
                            <input type="hidden" id="token" name="token">
                            <div class="form-group">
                                <p class="text-left">User name</p>
                                <input type="text" name="username" class="form-control" id="username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">
                                <span class="error text-left">Hello guy</span>
                            </div>
                            <div class="form-group">
                                <p class="text-left">Phone number</p>
                                <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Enter phone number" value="<?php echo isset($phone_number) ? htmlspecialchars($phone_number) : ''; ?>">
                                <span class="error text-left"></span>
                            </div>
                            <div class="form-group">
                                <p class="text-left">Email address</p>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                                <span class="error text-left"></span>
                            </div>
                            <div class="form-group">
                                <p class="text-left">Password</p>
                                <input type="text" name="password" class="form-control" id="password" placeholder="Password" value="<?php echo isset($password) ? password_needs_rehash($password, PASSWORD_DEFAULT) : ''; ?>">
                                <span class="error text-left"></span>
                                <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onClick="console.log('helo guy ')">Save changes</button>
                        <div class="modal-footer">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>