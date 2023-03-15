<?php
class AdminView implements View {
    public function __construct(&$page)
    {
        require_once APP_PATH."/inc/view/header.php";
        ?>
        <!-- <?php if($page['params']) ?> -->
        <?php
            // _log($page['params']);

        ?>
        <?php if( !isset($page['params']['mode']) ):  ?>
        <section class="aview">
            <h2><a href="/manage">AdminPanel</a></h2>

            <ul class="aview__menu">
                <li><a href="manage?mode=users">Użytkownicy</a></li>
                <li><a href="manage?mode=rooms">Pokoje</a></li>
            </ul>
        </section>
        <?php else: ?>
            <section class="aview">
            <h2><a href="/manage">AdminPanel</a> - <a href="/manage?mode=<?= $page['params']['mode'] ?>"><?= $page['params']['mode'] ?></a></h2>

            <?php if( $page['params']['mode'] == "users" ): ?>
                <?php if( !isset($page['params']['func'])): ?>
                    <ul class="aview__menu">
                        <li><a href="manage">Wstecz</a></li>
                        <li><a href="manage?mode=users&func=show">Pokaż</a></li>
                        <!-- <li><a href="manage?mode=users&func=add">Usuń</a></li> -->
                    </ul>
                <?php else: ?>
                    <a href="manage">Wstecz</a>

                    <table class="aview__table">
                        <tr>
                            <th>
                                id
                            </th>
                            <th>
                                username
                            </th>
                            <th>
                                email
                            </th>
                            <th>
                                register_time
                            </th>
                            <th>
                                role_id
                            </th>
                            <th>
                                role_name
                            </th>
                            <th>
                                Zarządzanie
                            </th>
                        </tr>
                        <?php foreach( $page['data']['users'] as $user ): ?>
                            <?php
                                // _log($user);
                            ?>
                            <tr>
                                <td>
                                    <?= $user['id'] ?>
                                </td>
                                <td>
                                    <?= $user['username'] ?>
                                </td>
                                <td>
                                    <?= $user['email'] ?>
                                </td>
                                <td>
                                    <?= $user['register_time'] ?>
                                </td>
                                <td>
                                    <?= $user['role_id'] ?>
                                </td>
                                <td>
                                    <?= $user['role_name'] ?>
                                </td>
                                <td class="aview__table__buttons">
                                    <a href="manage?mode=users&func=show&action=delete&id=<?= $user['id'] ?>">Usuń</a>
                                    <a href="manage?mode=users&func=show&action=edit&id=<?= $user['id'] ?>">Edytuj</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                <?php endif; ?>
            <?php elseif( $page['params']['mode'] == "rooms" ): ?>
                <ul class="aview__menu">
                    <li><a href="manage">Wstecz</a></li>
                    <li><a href="manage?mode=rooms&func=show">Pokaż</a></li>
                    <li><a href="manage?mode=rooms&func=add">Dodaj</a></li>
                    <!-- <li><a href="manage?mode=users&func=add">Usuń</a></li> -->
                </ul>
            <?php endif; ?>
        </section>
        <?php endif; ?>
        <?php

        require_once APP_PATH."/inc/view/footer.php";
    }
}
?>