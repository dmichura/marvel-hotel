<?php


class Calendar {
    private $year;
    private $month;
    public function __construct($year, $month)
    {
        $this->year = intval( ($year != false) ? $year : date("Y") );
        $this->month = intval( ($year != false) ? $year : date("n") );

        var_dump($this->year);
        var_dump($this->month);
    }
}

class RoomView implements View {
    public function __construct(&$page)
    {
        require_once APP_PATH."/inc/view/header.php";
        ?>
        <section class="room__preview__wrapper">

            <article class="room__preview__image" data-name='<?= $page['data']['room']['name'] ?>'>
                <img data-src="./assets/img/room/<?= $page['data']['room']['thumbnail_path'] ?>" alt="" aria-label="">
            </article>
            <h1 class="room__preview__title">
                <?= $page['data']['room']['name'] ?>
            </h1>
            <p>
                <?= $page['data']['room']['description'] ?>
            </p>

            <div class="room__preview__calendar">
                <div class="room__preview__calendar__top">
                    <button class="room__preview__calendar__top-prev">&lt;</button>

                    <span class="room__preview__calendar__top-title">
                        Styczeń - 2023
                    </span>

                    <button class="room__preview__calendar__top-next">&gt;</button>
                </div>
                <div class="room__preview__calendar__content">
                    <?php
                    // _log($page['data']['reservations']);
                    // _log($page['data']['month']);

                    $calendar = new Calendar($page['data']['year'], $page['data']['month']);

                    // if( $page['data']['year'] == false ) {
                    // // _log($page['data']);
                    // }
                    ?>
                </div>
            </div>

            <button class="room__book relative" data-action="book" data-ls="btn-book"></button>

        </section>
        <?php

        require_once APP_PATH."/inc/view/footer.php";
    }
}
?>