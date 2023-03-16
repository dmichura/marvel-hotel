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
            <div class="breadcrumbs">
                <a href="/manage">AdminPanel</a> 
            </div>
            <ul class="aview__menu">
                <li><a href="manage?mode=users">Użytkownicy</a></li>
                <li><a href="manage?mode=rooms">Pokoje</a></li>
                <li><a href="manage?mode=reservations">Rezerwacje</a></li>
                <li><a href="manage?mode=tickets">Wiadomości</a></li>
            </ul>
        </section>
        <?php else: ?>
            <section class="aview">
            <div class="breadcrumbs">
                <a href="/manage">AdminPanel</a> 
                ->
                <a href="/manage?mode=<?= $page['params']['mode'] ?>"><?= $page['params']['mode'] ?></a>
                <?php if( isset($page['params']['func']) ): ?>
                ->
                <a href="/manage?mode=<?= $page['params']['mode'] ?>&func=<?= $page['params']['func']?>"><?= $page['params']['func'] ?></a>
                <?php endif; ?>
            </div>
            <?php if( $page['params']['mode'] == "users" ): ?>
                <?php if( !isset($page['params']['func'])): ?>
                    <ul class="aview__menu">
                        <li><a href="manage?mode=users&func=show">Pokaż</a></li>
                        <!-- <li><a href="manage?mode=users&func=add">Usuń</a></li> -->
                    </ul>
                <?php else: ?>
                    <?php if( $page['params']['func'] == "show"): ?>
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
                                <!-- <th>
                                    Zarządzanie
                                </th> -->
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
                                    <!-- <td class="aview__table__buttons">
                                        <a href="manage?mode=users&func=show&action=delete&id=<?= $user['id'] ?>">Usuń</a>
                                        <a href="manage?mode=users&func=show&action=edit&id=<?= $user['id'] ?>">Edytuj</a>
                                    </td> -->
                                </tr>
                            <?php endforeach; ?>
                            
                        </table>
                    <?php endif; ?>
                <?php endif; ?>
            <?php elseif( $page['params']['mode'] == "rooms" ): ?>
                <?php if( !isset($page['params']['func'])): ?>
                    <ul class="aview__menu">
                        <li><a href="manage?mode=rooms&func=show">Pokaż</a></li>
                        <!-- <li><a href="manage?mode=rooms&func=add">Dodaj</a></li> -->
                    </ul>
                <?php else: ?>
                    <?php if($page['params']['func'] == "show"): ?>
                        <table class="aview__table">
                            <tr>
                                <th>
                                    id
                                </th>
                                <th>
                                    name
                                </th>
                                <th>
                                    description
                                </th>
                                <th>
                                    thumbnail_path
                                </th>
                                <th>
                                    images
                                </th>
                                <!-- <th>
                                    Zarządzanie
                                </th> -->
                            </tr>
                            <?php foreach( $page['data']['rooms'] as $room ): ?>
                                <?php
                                    // _log($user);
                                ?>
                                <tr>
                                    <td>
                                        <?= $room['id'] ?>
                                    </td>
                                    <td>
                                        <?= $room['name'] ?>
                                    </td>
                                    <td>
                                        <?= $room['description'] ?>
                                    </td>
                                    <td class="aview__table__image__wrapper">
                                        <img src="./assets/img/room/<?= $room['thumbnail_path'] ?>" alt="">
                                    </td>
                                    <td>
                                        <?= $room['images'] ?>
                                    </td>
    
                                    <!-- <td class="aview__table__buttons">
                                        <a href="manage?mode=users&func=show&action=delete&id=<?= $user['id'] ?>">Usuń</a>
                                        <a href="manage?mode=users&func=show&action=edit&id=<?= $user['id'] ?>">Edytuj</a>
                                    </td> -->
                                </tr>
                            <?php endforeach; ?>
                            
                        </table>
                    <?php endif; ?>
                <?php endif; ?>
            <?php elseif( $page['params']['mode'] == "tickets" && isset( $page['data']['tickets']) && count( $page['data']['tickets']) >0  ): ?>
                <table class="aview__table">
                    <tr>
                        <th>
                            id
                        </th>
                        <th>
                            title
                        </th>
                        <th>
                            email
                        </th>
                        <th>
                            reason
                        </th>
                        <th>
                            status
                        </th>
                        <th>
                            created
                        </th>
                        <!-- <th>
                            Zarządzanie
                        </th> -->
                    </tr>
                    <?php foreach( $page['data']['tickets'] as $ticket ): ?>
                        <?php
                            // _log($user);
                        ?>
                        <tr>
                            <td>
                                <?= $ticket['id'] ?>
                            </td>
        
                            <td>
                                <?= $ticket['title'] ?>
                            </td>
        
        
                            <td>
                                <?= $ticket['email'] ?>
                            </td>
        
                            <td>
                                <?= $ticket['reason'] ?>
                            </td>
        
                            <td>
                                <?= $ticket['status'] ?>
                            </td>
        
                            <td>
                                <?= $ticket['created'] ?>
                            </td>
<!--         
                            <td class="aview__table__buttons">
                                <a href="manage?mode=users&func=show&action=delete&id=<?= $ticket['id'] ?>">Usuń</a>
                                <a href="manage?mode=users&func=show&action=edit&id=<?= $ticket['id'] ?>">Edytuj</a>
                            </td> -->
                        </tr>
                    <?php endforeach; ?>
                    
                </table>
            <?php elseif( $page['params']['mode'] == "reservations" ): ?>
                <?php 
                $page['data']['maxDays'] = cal_days_in_month(CAL_GREGORIAN, $page['data']['month'], $page['data']['year']);

                ?>

                <div class="aview__c_buttons">
                    <button class="aview__c_button__prev">&lt;</button>
                    <h2><?= $page['data']['months'][$page['data']['month'] - 1] ?> - <?= $page['data']['year'] ?></h2>
                    <button class="aview__c_button__next">&gt;</button>
                </div>
                <table class="aview__table">
                    <tr>
                        <th>
                            Data:
                        </th>
                        <?php for( $i = 1; $i <= $page['data']['maxDays']; $i++ ): ?>
                            <th>
                                <?= $i; ?>
                            </th>
                        <?php endfor; ?>
                    </tr>

                    <?php foreach ($page['data']['rooms'] as $room): ?>
                        <tr>
                        <td>
                            <?= $room['name']; ?>
                        </td>
                        <?php for( $i = 1; $i <= $page['data']['maxDays']; $i++ ): ?>
                            <?php
                                $class = "aview__table__day";
                                $date = "$i-{$page['data']['month']}-{$page['data']['year']}";
                                $dataAccount = null;
                                    

                                if( isset( $page['data']['reservations'][$room['id']] ) ) {
                                    if ( isset( $page['data']['reservations'][$room['id']][$date] ) ) {
                                        $class.=" hired";
                                        $dataAccount = array(
                                            "username" => $page['data']['reservations'][$room['id']][$date]['username'],
                                            "email" => $page['data']['reservations'][$room['id']][$date]['email'],
                                        );
                                    }
                                }
                            ?>
 
                            <td class="<?= $class ?>" <?=isset($dataAccount) ? "data-account-username='{$dataAccount['username']}'" : "" ?><?=isset($dataAccount) ? "data-account-email='{$dataAccount['email']}'" : "" ?>>
                   
                            </td>
                        <?php endfor; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
            </section>
            <?php endif; ?>
        <?php

        require_once APP_PATH."/inc/view/footer.php";
    }
}
?>