<?php




class RoomView implements View {
    private $calendar;
    public function __construct(&$page)
    {
        $this->calendar = $page['data']['calendar'];

        require_once APP_PATH."/inc/view/header.php";
        ?>
        <section class="room__preview__wrapper">
           <?= $page['user']->showMessages() ?>
            <article class="room__preview__image" data-name='<?= $page['data']['room']['name'] ?>'>
                <img data-src="./assets/img/room/<?= $page['data']['room']['thumbnail_path'] ?>" alt="" aria-label="">
            </article>
            <h1 class="room__preview__title">
                <?= $page['data']['room']['name'] ?>
            </h1>
            <p>
                <?= $page['data']['room']['description'] ?>
            </p>
            <?php
                // $a = array("s1.jpg", "s2.jpg");
                // echo json_encode($a);
                if( isset($page['data']['room']['images']) && gettype($page['data']['room']['images']) == "string" ):
                    $imgs = json_decode($page['data']['room']['images']);

                    if (isset($imgs) && count($imgs) > 0):
                    ?>

                        <div class="room__preview__slider" data-imgs="<?= implode(",", $imgs) ?>">
                            <div class="room__preview__slider__image__wrapper">
                                <img src="" alt="" class="room__preview__slider__image">
                            </div>

                            <button class="room__preview__slider__prev">
                                &lt;
                            </button>
                            <button class="room__preview__slider__next">
                                &gt;
                            </button>
                            <span class="room__preview__slider__info">
                                
                            </span>
                        </div>
                        <?php

                    endif;

                endif;
                ?>


            <div class="room__preview__calendar">
                <div class="room__preview__calendar__top">
                    <button class="room__preview__calendar__top-prev">&lt;</button>

                    <span class="room__preview__calendar__top-title">
                        <?= $this->calendar->getMonthName() ?> - <?= $this->calendar->getYear() ?>
                    </span>

                    <button class="room__preview__calendar__top-next">&gt;</button>
                </div>
                <div class="room__preview__calendar__content">
                    <?= $this->calendar->showDays()?>
                </div>
            </div>
            <form action="room?type=book&id=<?= $page['data']['room']['id'] ?>" method="POST" class="room__preview__form">
                <?php
                    // TODO: set first free reservation dae
                ?>
                <!-- <input type="hidden" name="id" value=""> -->
                <input type="hidden" name="account_id" value="<?= $page['user']->getID() ?>">
                <div class="room__preview__input">
                    <label for="">Od: </label>
                    <input type="date" name="start" value="<?= date("Y-m-d") ?>" min="<?= date("Y-m-d") ?>">
                </div>
                <div class="room__preview__input">
                    <label for="">Do: </label>
                    <input type="date" name="end" value="<?= date("Y-m-d") ?>">
                </div>
                <button type="submit" class="room__book relative" data-action="book" data-ls="btn-book"></button>
            </form>

        </section>
        <?php

        require_once APP_PATH."/inc/view/footer.php";
    }
}
?>