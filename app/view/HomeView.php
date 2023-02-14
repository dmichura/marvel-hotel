<?php
class HomeView implements View {
    public function __construct(&$page)
    {
        require_once APP_PATH."/inc/view/header.php";
        // _log($page['data']);
        require_once APP_PATH."/inc/view/footer.php";
    }
}
?>