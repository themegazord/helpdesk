<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/resources/views/css/geral.css">
    <title>Home - Helpdesk</title>
</head>
<body>
<nav id="navbar">
    <div id="logo">
        LOGO
    </div>
    <div id="nav-links">
        <ul class="links">
            <?php
            /**
             * @var array $data
             */
            use infrastructe\mock\HomeNavLinks\NavLinks;
            require 'infrastructure\mock\HomeNavLinks\NavLinks.php';

            $navLinks = new NavLinks();
            $data = [
                    'navlinks' => $navLinks->links(),
            ];
            for ($i = 0; $i < count($data['navlinks']); $i += 1) {
                echo "<li><a class='link' href='{$data['navlinks'][$i]['url']}'>{$data['navlinks'][$i]['label']}</a></li>";
            }
            ?>
        </ul>
    </div>
</nav>