<?php
class RoomView implements View {
    public function __construct(&$page)
    {
        require_once APP_PATH."/inc/view/header.php";
        ?>
        <section >
            <?php //_log($page['data']); ?> 
            <div class="rooms__wrapper">
                <?php foreach ($page['data']['rooms'] as $room): ?>

                    <article class="room"><img data-src="./assets/img/room/<?= $room['thumbnail_path'] ?>" alt="pokój o nazwie <?= $room['name'] ?>"></article>
                <?php endforeach; ?>
            </div>
        </section>
        <?php

        require_once APP_PATH."/inc/view/footer.php";
    }
}
?>