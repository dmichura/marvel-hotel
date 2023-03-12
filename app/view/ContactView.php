<?php
class ContactView implements View {
    public function __construct(&$page)
    {
        require_once APP_PATH."/inc/view/header.php";
        ?>
        <section class="contact">
            <?php
                // _log($page);
                if (  isset($page) && isset($page['data'])) {
                    if (isset($page['data']['sendTicket'])) {
                        echo '
                        <article class="contact__info">
                            <h2>
                                Dziękujemy za przesłanie formularza kontaktowego!
                            </h2>

                            <h3>
                                Miłego dnia!
                            </h3>

                            <h4>
                                Za 5 sekund zostaniesz przeniesiony na podstronę kontakt
                            </h4>
                        </article>
                        <script>
                            new Redirect("contact", 5000);
                        </script>
                        ';
                    }
                }
                
            ?>

            <article class="acordeons__wrapper">
                <h2 class="acordeons__title">Najczęsciej zadawane pytania</h2>

            </article>

            <form action="/contact?type=addTicket" method="POST" class="contact__form">
                <h3>Formularz kontaktowy</h3>
                <input type="text" name="contact__form-title" placeholder="Tytuł" id=""/>
                <input type="email" name="contact__form-email" placeholder="E-mail" id=""/>
                <textarea name="contact__form-content" id="" placeholder="Opis" ></textarea>
                <input type="submit" value="Wyślij">
            </form>

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2931.7984252899982!2d27.721639815467295!3d42.70798877916497!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40a69fcd2c76960b%3A0xc9121c6d7f292ee4!2sHotel%20Marvel!5e0!3m2!1spl!2spl!4v1678049126610!5m2!1spl!2spl" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
        <?php

        require_once APP_PATH."/inc/view/footer.php";
    }
}
?>