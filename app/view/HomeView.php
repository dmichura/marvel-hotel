<?php
class HomeView implements View {
    public function __construct(&$page)
    {
        require_once APP_PATH."/inc/view/header.php";
        // _log($page['data']);
        ?>
      <section>
          <div class="typing__wrapper">
            <h2 class="typing__text" id="header-logo"></h2>
            <div class="typing__bar"></div>
          </div>
      </section>
        <?php
        require_once APP_PATH."/inc/view/footer.php";
    }
}
?>