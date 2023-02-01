<?php

include("header.php");
include("nav-bar.php");
?>

<div class="container">
    <div class="col-4">
        <?php if ($userList) { 
            foreach($userList as $user){
                echo "<li>" . $user->getNombre() . "</li>";
            }?>
        <?php } ?>
    </div>
    <div class="col-8">
        <?php if (!$userList) { ?>
            <p> No existen chats</p>
        <?php } else { ?>
            <h1><?php echo $user2->getNombre() . $user2->getApellido() ?></h1>
            <?php foreach($chatList as $chat){
                if($chat->getIdEmisor() == $user1->getId()){ ?>
                    <p class="text-end"><?php echo $chat->getMensaje(); ?></p>
                <?php } else{ ?>
                    <p class="text-start"><?php echo $chat->getMensaje(); ?></p>
                <?php }
            } ?>
            <form action="<?php echo FRONT_ROOT ?>Chat/Add" method="Post">
                <div class="form-floating">
                    <textarea class="form-control" name="mensaje" placeholder="mensaje" id="floatingTextarea" style="height: 120px"></textarea>
                    <label for="floatingTextarea">Mensaje</label>
                </div>
                <input type="hidden" name="idEmisor" value="<?php echo $user1->getId() ?>">
                <input type="hidden" name="idReceptor" value="<?php echo $user2->getId() ?>">
            </form>
        <?php } ?>
    </div>
</div>

<?php
include("footer.php");
?>