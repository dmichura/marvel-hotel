<?php
class NotFoundView implements View {
    public function __construct(&$page)
    {
        require_once APP_PATH."/inc/view/header.php";
        echo 'Nie ma takiej strony!';
        require_once APP_PATH."/inc/view/footer.php";
    }
}
?>