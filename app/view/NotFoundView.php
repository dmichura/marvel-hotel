<?php
class NotFoundView implements View {
    public function __construct(&$page)
    {
        require_once APP_PATH."/inc/view/header.php";
        ?>
        <section>
            <h1 class="section__notfound" data-ls="404-message"></h1>
        </section>
        <?php
        require_once APP_PATH."/inc/view/footer.php";
    }
}
?>