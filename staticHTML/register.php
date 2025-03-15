<?php 
require_once('../php/info.php');
require_once('../php/db_connect.php');

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $cf_password = $_POST['cf_password'];

    if ($password !== $cf_password) {
        $error = "Passwords do not match";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long";
    } else {
        try {
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            if ($stmt->fetch()) {
                $error = "Email already exists";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
                $stmt->execute([
                    'name' => $name,
                    'email' => $email,
                    'password' => $hashed_password
                ]);
                $success = "Registration successful! Redirecting to login...";
                header("Refresh: 2; url=/login.html");
            }
        } catch(PDOException $e) {
            $error = "An error occurred: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="<?=$base_url?>/img/favicon.ico">
    <title><?=$website_name?> | Register</title>
    <meta name="robots" content="index, follow" />
    <meta name="description" content="Watch anime online in English. You can watch free series and movies online and English subtitle.">
    <meta name="keywords" content="gogoanime,watch anime, anime online, free anime, english anime, sites to watch anime">
    <meta itemprop="image" content="<?=$base_url?>/img/logo.png" />
    <meta property="og:site_name" content="Gogoanime" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?=$website_name?> | Register" />
    <meta property="og:description" content="Watch anime online in English. You can watch free series and movies online and English subtitle.">
    <meta property="og:url" content="" />
    <meta property="og:image" content="<?=$base_url?>/img/logo.png" />
    <meta property="og:image:secure_url" content="<?=$base_url?>/img/logo.png" />
    <meta property="twitter:card" content="summary" />
    <meta property="twitter:title" content="<?=$website_name?> | Register" />
    <meta property="twitter:description" content="Watch anime online in English. You can watch free series and movies online and English subtitle." />
    <link rel="canonical" href="<?=$base_url?><?php echo $_SERVER['REQUEST_URI'] ?>" />
    <link rel="alternate" hreflang="en-us" href="<?=$base_url?><?php echo $_SERVER['REQUEST_URI'] ?>" />
    <link rel="stylesheet" type="text/css" href="<?=$base_url?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?=$base_url?>/css/user_auth.css" />
    <link rel="stylesheet" type="text/css" href="<?=$base_url?>/css/user.css" />
    <?php require_once('../php/advertisments/popup.html'); ?>
    <script type="text/javascript" src="<?=$base_url?>/js/libraries/jquery.js"></script>
    <script>
        var base_url = 'https://' + document.domain + '/';
        var base_url_cdn_api = 'https://ajax.gogocdn.net/';
        var api_anclytic = 'https://ajax.gogocdn.net/anclytic-ajax.html';
    </script>
    <script type="text/javascript" src="https://cdn.gogocdn.net/files/gogo/js/main.js?v=6.9"></script>
    <style>
        .message { text-align: center; padding: 10px; margin-bottom: 15px; }
        .error { color: red; background: #ffe6e6; }
        .success { color: green; background: #e6ffe6; }
    </style>
</head>
<body>
<div class="clr"></div>
<div id="wrapper_inside">
    <div id="wrapper">
        <div id="wrapper_bg">
            <?php require('../php/include/header.php'); ?>
            <section class="content">
                <section class="content_left">
                    <div class="main_body">
                        <div class="anime_name reg">
                            <i class="icongec-reg i_pos"></i>
                            <h2>Register</h2>
                        </div>
                        <div class="content-login">
                            <div class="form-login">
                                <h1>Register to Gogoanime</h1>
                                <?php if($error): ?>
                                    <div class="message error"><?php echo $error; ?></div>
                                <?php endif; ?>
                                <?php if($success): ?>
                                    <div class="message success"><?php echo $success; ?></div>
                                <?php endif; ?>
                                <form method='post'>
                                    <input type='text' name='name' placeholder='Display name' required='true' value=''>
                                    <input type='email' name='email' placeholder='Email' required='true' value=''>
                                    <input type='password' name='password' placeholder='Password' required='true'>
                                    <input type='password' name='cf_password' placeholder='Retype password' required='true'>
                                    <button type='submit'>Sign up</button>
                                </form>
                                <a class="link-forget" href="/forget.html">Forgot password?</a>
                                <a class="link-sign" href="/login.html">Sign in</a>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content_right">
                    <div class="clr"></div>
                    <div class="banner_center">
                        <div class="anime_name guide">
                            <i class="icongec-guide i_pos"></i>
                            <h2>Guidelines</h2>
                        </div>
                        <div class="content_items">
                            As a member you can:<br /><br />
                            - Bookmark anime: This feature will auto notify you when the anime have new episode.<br />
                            - Various options: Such as Default HD, disable auto play, etc….<br />
                            - Updated: You will be updated all the extra feature automatically when it publish.<br /><br />
                        </div>
                    </div>
                </section>
            </section>
            <div class="clr"></div>
            <footer>
                <div class="menu_bottom">
                    <a href="/about-us.html"><h3>Abouts us</h3></a>
                    <a href="/contact-us.html"><h3>Contact us</h3></a>
                    <a href="/privacy.html"><h3>Privacy</h3></a>
                </div>
                <div class="croll">
                    <div class="big"><i class="icongec-backtop"></i></div>
                    <div class="small"><i class="icongec-backtop_mb"></i></div>
                </div>
            </footer>
        </div>
    </div>
</div>
<div id="off_light"></div>
<div class="clr"></div>
<div class="mask"></div>
<script type="text/javascript" src="<?=$base_url?>/js/files/combo.js"></script>
<script type="text/javascript" src="<?=$base_url?>/js/files/video.js"></script>
<script type="text/javascript" src="<?=$base_url?>/js/files/jquery.tinyscrollbar.min.js"></script>
<?php include('../php/include/footer.php')?>
</body>
</html>