<?php
class GalleryView implements View {
    public function __construct(&$page)
    {
        require_once APP_PATH."/inc/view/header.php";
        ?>
        <section>
            <?= _log($page['data']); ?>
        </section>
        <?php

        require_once APP_PATH."/inc/view/footer.php";
    }
}
?>