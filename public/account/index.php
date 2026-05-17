<?php
    session_start();

    // Check user session exist
    if(!isset($_SESSION["user"])){
        ?>
            <script>location.replace("/account/login.php")</script>
        <?php
    }else{
        ?>
            <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="shortcut icon" href="../icon.png" type="image/x-icon">
                    <title>Lunar Archive</title>

                    <!-- CDNs -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

                </head>
                <body>
                    
                    <nav class="navbar flex-column bg-dark text-white p-0 pt-3 justify-content-center sticky-top" data-bs-theme="dark">
                        <h5 class="m-1">Lunar Archive</h5>

                        <div class="nav nav-underline">
                            <a href="/" class="nav-link text-white">Trang chủ</a>
                            <a href="/account" class="nav-link text-white active">Tài khoản</a>
                        </div>
                    </nav>

                    <main class="m-1">
                        <?php
                            require("../../config/database.php");
                            $sql = $mysql->prepare("SELECT users.email, roles.role_name, roles.maximum_capacity
                                                    FROM users JOIN roles ON users.roleID = roles.roleID
                                                    WHERE userID=?");
                            $sql->bind_param("s", $_SESSION["user"]["id"]);
                            $sql->execute();
                            $user = $sql->get_result()->fetch_assoc();
                        ?>

                        <div class="bg-dark p-3 rounded text-white">
                            <h3>Thông tin tài khoản</h3>
                            <p class="d-flex">
                                <strong style="width: 150px;">Tên tài khoản:</strong>
                                <span><?php echo $_SESSION["user"]["name"]?></span>
                            </p>
                            <p class="d-flex">
                                <strong style="width: 150px;">Email:</strong>
                                <span><?php echo $user["email"]?></span>
                            </p>
                            <p class="d-flex">
                                <strong style="width: 150px;">Vai trò:</strong>    
                                <span><?php echo $user["role_name"]?></span>
                            </p>
                            <p class="d-flex">
                                <strong style="width: 150px;">Dung lượng:</strong>
                                <span><?php echo $user["maximum_capacity"]?>GB</span>
                            </p>
                            <a href="/account/logout.php" class="btn btn-danger">Đăng xuất tài khoản</a>
                        </div>
                    </main>
                </body>
                </html>
        <?php
    }
?>