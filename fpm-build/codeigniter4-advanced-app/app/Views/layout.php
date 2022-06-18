<?php

helper(['html']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($this->data['title'] ?? 'Welcome to CodeIgniter 4!');?></title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <!-- STYLES -->
    <?= link_tag('css/style.css');?>
    <?= link_tag('css/custom.css');?>
    <?= $this->renderSection('head');?>
</head>
<body>
<?= $this->renderSection('beginBody');?>
<!-- HEADER: MENU + HEROE SECTION -->
<header>

    <div class="menu">
        <ul>
            <li class="logo"><a href="https://codeigniter.com" target="_blank"><?= view('_logo');?></a></li>
            <li class="menu-toggle">
                <button onclick="toggleMenu();">&#9776;</button>
            </li>

            <li class="menu-item hidden"><a href="<?= base_url();?>">Home</a></li>
            
            <li class="menu-item hidden"><a href="<?= site_url('admin');?>">Admin</a></li>

            <?php if(!auth()->isGuest()):?>

                <li class="menu-item hidden"><a href="<?= site_url('user/logout');?>">Logout</a>

            <?php else: ?>

                <li class="menu-item hidden"><a href="<?= site_url('user/signup');?>">Signup</a>

                <li class="menu-item hidden"><a href="<?= site_url('user/login');?>">Login</a>

            <?php endif;?>

            <li class="menu-item hidden"><a href="<?= site_url('contact');?>">Contact Us</a></li>

        </ul>
    </div>

    <div class="heroe">

        <?php if(auth()->isLogged()):?>

            <h1>Welcome to CodeIgniter, <?= auth()->getUser()->name;?>!</h1>

        <?php else:?>

            <h1>Welcome to CodeIgniter <?= CodeIgniter\CodeIgniter::CI_VERSION ?></h1>

        <?php endif;?>

        <h2>The small framework with powerful features</h2>

    </div>

</header>

<!-- CONTENT -->

<section>

    <?php $success = service('session')->getFlashdata('success');?>
    <?php if($success):?>
        <div class="alert alert-success"><?= $success;?></div>
    <?php endif;?>

    <?php $info = service('session')->getFlashdata('info');?>
    <?php if($info):?>
        <div class="alert alert-info"><?= $info;?></div>
    <?php endif;?>

    <?php $error = service('session')->getFlashdata('error');?>
    <?php if($error):?>
        <div class="alert alert-error"><?= $error;?></div>
    <?php endif;?>

    <?= $this->renderSection('content');?>

</section>

<?= $this->renderSection('beforeFooter');?>

<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->

<footer>
    <div class="environment">

        <p>Page rendered in {elapsed_time} seconds</p>

        <p>Environment: <?= ENVIRONMENT ?></p>

    </div>

    <div class="copyrights">

        <p>&copy; <?= date('Y') ?> CodeIgniter Foundation. CodeIgniter is open source project released under the MIT
            open source licence.</p>

    </div>

</footer>

<!-- SCRIPTS -->

<script>
    function toggleMenu() {
        var menuItems = document.getElementsByClassName('menu-item');
        for (var i = 0; i < menuItems.length; i++) {
            var menuItem = menuItems[i];
            menuItem.classList.toggle("hidden");
        }
    }
</script>

<!-- -->
<?= $this->renderSection('endBody');?>
</body>
</html>
