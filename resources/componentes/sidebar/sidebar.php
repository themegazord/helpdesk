<div class="d-flex flex-column flex-shrink-0 p-3 sidebar-dashboard">
    <p class="text-center mt-3 mb-3">
        <a href="/dashboard" class="mb-md-0 me-md-0 me-md-auto text-decoration-none logo">
            RESOLVE<span class="wise">WISE</span>
        </a>
    </p>
    <ul class="sidebar-links">
        <?php
            use infrastructure\mock\Sidebar\SidebarLinks;
            require 'infrastructure\mock\Sidebar\SidebarLinks.php';

            $sidebarLinks = new SidebarLinks();
            $links = $sidebarLinks->links();
            foreach ($links as $index => $link) {
                echo "
                    <li class='sidebar-link'>
                        <a href='{$link['url']}'>
                            {$link['svg']}
                            {$link['label']}
                        </a>
                    </li>  
                ";
            }
        ?>
    </ul>
</div>