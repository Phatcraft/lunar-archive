<?php
    session_start();

    // Check user session exists
    if(isset($_SESSION["user"])){
        ?>
            <script>location.replace("/")</script>
        <?php
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập | Lunar Archive</title>
    <link rel="shortcut icon" href="../icon.png" type="image/x-icon">
    
    <!-- CDNs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>
<body>
    
    <nav class="navbar flex-column bg-dark text-white p-0 pt-3 justify-content-center sticky-top" data-bs-theme="dark">
        <h5 class="m-1">Lunar Archive</h5>

        <div class="nav nav-underline">
            <a href="/" class="nav-link text-white">Trang chủ</a>
            <a href="/account" class="nav-link text-white active">Tài khoản</a>
        </div>
    </nav>

    <div id="message"></div>

    <main class="d-flex justify-content-center">
        <form method="post" class="bg-dark p-4 py-5 m-4 mx-2 text-white rounded" style="width: 330px;">
            <h3 class="mb-3">Đăng nhập</h3>

            <div class="input-group my-3 mt-4">
                <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                <input type="text" name="username" class="form-control" placeholder="Tên tài khoản">
            </div>

            <div class="input-group my-3 mb-1">
                <div class="input-group-text"><i class="bi bi-key"></i></div>
                <input type="password" name="password" class="form-control password" placeholder="Mật khẩu">
            </div>

            <div class="form-check">
                <input type="checkbox" id="checkbox" class="form-check-input">
                <label class="form-check-label">Hiển thị mật khẩu</label>
            </div>
            <script src="../scripts/show-password.js"></script>

            <button type="submit" id="submit" class="btn btn-danger my-3 w-100">Đăng nhập</button>
            <p class="text-center">Chưa có tài khoản? <a href="/account/signup.php" class="link-light">Đăng ký ngay</a></p>

        </form>
    </main>

    <?php
        require("../../config/database.php");
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $username = htmlspecialchars($_POST["username"]);
            $password = htmlspecialchars($_POST["password"]);

            // Find a user in database
            $user_sql = $mysql->prepare("SELECT userID, password FROM users WHERE username=?");
            $user_sql->bind_param("s", $username);
            $user_sql->execute();
            
            $userData = $user_sql->get_result();
            if($userData->num_rows <= 0){
                ?>
                    <script type="module">
                        import {failed_message} from "../scripts/messages.js"
                        failed_message("Người dùng hoặc mật khẩu không đúng")
                    </script>
                <?php
            }else{
                $user = $userData->fetch_assoc();
                if(password_verify($password, $user["password"])){
                    $_SESSION["user"] = [
                        "id" => $user["userID"],
                        "name" => $username
                    ];
                    
                    ?>
                        <script type="module">
                            import {success_message} from "../scripts/messages.js"
                            success_message("Đăng nhập thành công")
                        </script>
                    <?php
                }else{
                    ?>
                    <script type="module">
                        import {failed_message} from "../scripts/messages.js"
                        failed_message("Người dùng hoặc mật khẩu không đúng")
                    </script>
                <?php
                }
            }
        }
    ?>

</body>
</html>