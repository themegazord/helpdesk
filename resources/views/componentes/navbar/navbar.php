<?php include 'resources/views/componentes/header/header.php'?>
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