<?php 

session_start();

require_once('../php/info.php');
require_once('../php/db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: $base_url/login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, created_at FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$error = '';
$success = '';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_profile'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        try {
            $stmt = $conn->prepare("UPDATE users SET name = :name WHERE id = :id");
            $stmt->execute(['name' => $name, 'id' => $user_id]);
            $_SESSION['user_name'] = $name;
            $success = "Profile updated successfully!";
            $user['name'] = $name;
        } catch(PDOException $e) {
            $error = "Error updating profile: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="<?=$base_url?>/img/favicon.ico">
    <title><?=$website_name?> | User Profile</title>
    <meta name="robots" content="index, follow" />
    <meta name="description" content="Watch anime online in English. You can watch free series and movies online and English subtitle.">
    <meta name="keywords" content="gogoanime,watch anime, anime online, free anime, english anime, sites to watch anime">
    <meta itemprop="image" content="<?=$base_url?>/img/logo.png" />
    <meta property="og:site_name" content="Gogoanime" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?=$website_name?> | User Profile" />
    <meta property="og:description" content="Watch anime online in English. You can watch free series and movies online and English subtitle.">
    <meta property="og:url" content="" />
    <meta property="og:image" content="<?=$base_url?>/img/logo.png" />
    <meta property="og:image:secure_url" content="<?=$base_url?>/img/logo.png" />
    <meta property="twitter:card" content="summary" />
    <meta property="twitter:title" content="<?=$website_name?> | User Profile" />
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
        .profile-form { max-width: 400px; margin: 20px auto; }
        .profile-form input[type="text"] { width: 100%; padding: 8px; margin: 5px 0; }
        .profile-form button { width: 100%; padding: 10px; background: #00a651; color: white; border: none; cursor: pointer; }
        .profile-info { margin: 20px 0; }
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
                            <h2>User Profile</h2>
                        </div>
                        <div class="content-login">
                            <div class="form-login">
                                <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?></h1>
                                <?php if($error): ?>
                                    <div class="message error"><?php echo $error; ?></div>
                                <?php endif; ?>
                                <?php if($success): ?>
                                    <div class="message success"><?php echo $success; ?></div>
                                <?php endif; ?>
                                <div class="profile-info">
                                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                                    <p><strong>Member Since:</strong> <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
                                </div>
                                <form method="post" class="profile-form">
                                    <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                                    <button type="submit" name="update_profile">Update Profile</button>
                                </form>
                                <a href="/home" class="link-sign">Back to Home</a>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content_right">
                    <div class="clr"></div>
                    <div class="banner_center">
                        <div class="anime_name guide">
                            <i class="icongec-guide i_pos"></i>
                            <h2>Features</h2>
                        </div>
                        <div class="content_items">
                            Your membership includes:<br /><br />
                            - Bookmark your favorite anime<br />
                            - Get notifications for new episodes<br />
                            - Customize your viewing preferences<br />
                            - Access to member-only features<br /><br />
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