<?php
class AccountView implements View {
    public function __construct(&$page)
    {
        require_once APP_PATH."/inc/view/header.php";
       ?>
            <?php if($page['user']->isLogged()): ?>
            <section>
                Konto
            </section>
            <?php else:?>
            <section class="account">
                <form action="" class="account__login">
                    <input type="text" name="account__login-login" id="" placeholder="Login">
                    <input type="password" name="account__login-password" id="" placeholder="Hasło">

                    <input type="submit"  value="Zaloguj się">
                </form>
                <form action="" class="account__register">
                    <input type="text" name="account__register-login" id="" placeholder="Login">
                    <input type="email" name="account__register-email" id="" placeholder="Email">
                    <input type="password" name="account__register-password" id="" placeholder="Hasło">
                    <input type="password" name="account__register-password2" id="" placeholder="Powtórz Hasło">

                    <input type="submit"  value="Zaloguj się">
                </form>
            </section>
            <?php endif;?>
        <?php
        require_once APP_PATH."/inc/view/footer.php";
    }
}
?>