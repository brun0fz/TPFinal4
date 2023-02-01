<?php

include("header.php");
include("nav-bar.php");
?>

<div class="container">
    <div class="col-4">
        <?php foreach($userList as $user){ ?>
            <li><a href="<?php echo FRONT_ROOT . "Chat/ShowChatView/" . $user->getId() ?>"><?php echo $user->getNombre() ?></a></li>
        <?php } ?>
    </div>
    <div class="col-8">
        <?php if (!$userList) { ?>
            <p> No existen chats</p>
        <?php } else { ?>
            <h1><?php echo $user2->getNombre() . " " . $user2->getApellido() ?></h1>
            <?php foreach($chatList as $chat){
                if($chat->getIdEmisor() == $user1->getId()){ ?>
                    <p class="text-end">
                        <span class="text-end"><?php echo $chat->getMensaje(); ?></span>
                        <span class="text-end text-muted"><?php echo date_format(date_create($chat->getFecha()), 'j/n/y H:i') . "hs"; ?></span>
                    </p>
                <?php } else{ ?>
                    <p class="text-start">
                        <span class="text-start"><?php echo $chat->getMensaje(); ?></span>
                        <span class="text-start text-muted"><?php echo date_format(date_create($chat->getFecha()), 'j/n/y H:i') . "hs"; ?></span>
                    </p>
                <?php }
            } ?>
            <form action="<?php echo FRONT_ROOT ?>Chat/Add" method="Post">
                <div class="form-floating">
                    <textarea class="form-control" name="mensaje" placeholder="mensaje" id="floatingTextarea" style="height: 120px"></textarea>
                    <label for="floatingTextarea">Mensaje</label>
                </div>
                <input type="hidden" name="idEmisor" value="<?php echo $user1->getId() ?>">
                <input type="hidden" name="idReceptor" value="<?php echo $user2->getId() ?>">
                <input class="btn btn-lg btn-primary w-100" type="submit" value="Enviar">
            </form>
        <?php } ?>
    </div>
</div>

<?php
include("footer.php");
?>