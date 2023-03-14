<?php
class AccountView implements View {
    public function __construct(&$page)
    {
        require_once APP_PATH."/inc/view/header.php";
       ?>
            <?php if($page['user']->isLogged()): ?>
            <section class="account__dashboard">
                <h2>
                    Witaj <b><?= $page['user']->getLogin() ?> (<?= $page['user']->getID() ?>)</b>!
                    <!-- RoleName <b><?= $page['user']->getRole() ?></b> -->
                </h2>
                <a href="logout">Wyloguj się</a>
            </section>
            <?php else:?>
            <section class="account">
                <?= $page['user']->showMessages() ?>
                <form action="/auth?type=login" method="POST" class="account__login">
                    <h2>Logowanie</h2>
                    <input type="text" name="account__login-login" id="" placeholder="Login">
                    <input type="password" name="account__login-password" id="" placeholder="Hasło">


                    <input type="submit"  value="Zaloguj się">
                </form>
                <form action="/auth?type=register" method="POST" class="account__register">
                    <h2>Rejstracja</h2>
                    <input type="text" name="account__register-login" id="" placeholder="Login">
                    <input type="email" name="account__register-email" id="" placeholder="Email">
                    <input type="password" name="account__register-password" id="" placeholder="Hasło">
                    <input type="password" name="account__register-password2" id="" placeholder="Powtórz Hasło">


                    <div>
                        <input type="checkbox" name="account__register-accept" id="account__register-accept">

                        <label for="account__register-accept">Akceptuję <a href="/rule">
                        regulamin
                        </a> tego serwisu</label>
                    </div>
                    
                    <input type="submit"  value="Zarejestruj się">
                </form>
            </section>
            <?php endif;?>
        <?php
        require_once APP_PATH."/inc/view/footer.php";
    }
}
?>