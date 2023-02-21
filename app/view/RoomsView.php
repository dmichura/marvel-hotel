<?php
class RoomsView implements View {
    public function __construct(&$page)
    {
        require_once APP_PATH."/inc/view/header.php";
        ?>
        <section >
            <?php //_log($page['data']); ?> 
            <div class="rooms__wrapper">
                <?php foreach ($page['data']['rooms'] as $room): ?>
                    <article class="room" data-name='<?= $room['name'] ?>'>
                        <img data-src="./assets/img/room/<?= $room['thumbnail_path'] ?>" alt="" aria-label="" ?>">
                        <button class="room__book" data-ls="btn-book" data-roomid="<?= urlencode($room['id']) ?>"></button>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
        <?php

        require_once APP_PATH."/inc/view/footer.php";
    }
}
?>