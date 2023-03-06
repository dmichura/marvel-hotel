<?php
class RoomView implements View {
    public function __construct(&$page)
    {
        require_once APP_PATH."/inc/view/header.php";
        ?>
        <section >
            <div class="rooms__wrapper">
                <article class="room" data-name='<?= $page['data']['room']['name'] ?>'>
                    <img data-src="./assets/img/room/<?= $page['data']['room']['thumbnail_path'] ?>" alt="" aria-label="" ?>">
                    <button class="room__book" data-ls="btn-book" data-roomid="<?= urlencode($page['data']['room']['id']) ?>"></button>
                </article>
            </div>
        </section>
        <?php

        require_once APP_PATH."/inc/view/footer.php";
    }
}
?>