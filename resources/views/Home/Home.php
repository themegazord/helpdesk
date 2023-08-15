<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Helpdesk</title>
</head>
<body>
    <nav>
        <div id="logo"></div>
        <div id="nav-links">
            <ul class="links">
                <?php
                    for ($i = 0; $i < count($navlinks); $i += 1) {
                        echo "<li><a href='{$navlinks['url']}'>{$navlinks['label']}</a></li>";
                    }
                ?>
            </ul>
        </div>
    </nav>
</body>
</html>