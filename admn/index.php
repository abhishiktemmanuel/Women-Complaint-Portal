











<!DOCTYPE html>
<html lang="en">
<html>
<head>
    <meta charset="utf-8">
    <title>User Authentication</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>


    <div class="wrapper" class="container-xl">
        <div class="form-box login">
            <h2>Login</h2>
            <form action="authenticate.php" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                    <input type="text" id="username" name="username" required>
                    <label>Admin ID</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="key-outline"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="remember">Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn" name="login_submit">Login</button>
    
                <div class="err"></div>
            </form>
        </div>
    </div>
    


<script src="script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
