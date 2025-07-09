<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Lawrence Kimasar - full stack Developer'; ?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/my_logo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/projects-new.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="nav-brand">
                <div class="logo">LK</div>
            </div>
            <nav class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="projects.php" class="<?php echo ($current_page == 'projects.php') ? 'active' : ''; ?>">Projects</a></li>
                    <li><a href="contact.php" class="<?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">Contact</a></li>
                    <li><button class="theme-toggle" id="themeToggle"><i class="fas fa-moon"></i></button></li>
                </ul>
            </nav>
            <div class="mobile-menu-toggle" id="mobileToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>
