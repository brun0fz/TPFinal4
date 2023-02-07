<?php
include("header.php");
include("nav-bar.php");
?>

<!-- PAGE -->
<div class="container">
    <div class="row bg-white">
        <div class="col-12 col-sm-4 border border-secundary border-end-0 p-0">
            <ul class="list-group list-group-flush">
            <?php foreach($userList as $user){ ?>
                <a class="list-group-item list-group-item-action py-4 d-flex border-bottom <?php if($user2->getId() == $user->getId()){echo "active";} ?>" href="<?php echo FRONT_ROOT . "Chat/ShowChatView/" . $user->getId() ?>">
                    <img src="<?php echo IMG_PATH . $user->getRutaFoto() ?>" alt="profilePic" width="42" height="42" class="rounded-circle img-unselect my-auto me-2">    
                    <p class="my-auto"><?php echo $user->getNombre() . " " . $user->getApellido() ?></p>
                </a>
            <?php } ?>
            </ul>
        </div>
        <div class="col-12 col-sm-8 chat d-flex flex-column border border-secundary">
                <div class="d-flex">
                    <img src="<?php echo IMG_PATH . $user2->getRutaFoto() ?>" alt="profilePic" width="56" height="56" class="rounded-circle img-unselect my-auto me-2">
                    <h2 class="my-4"><?php echo $user2->getNombre() . " " . $user2->getApellido() ?></h2>
                </div>
                <hr class="mt-1 mb-3" />
                <div class="chat-msgs overflow-auto" id="chatMsgs">
                    <?php if (!$chatList) { ?>
                        <p class="d-flex justify-content-center text-muted mt-3">Todavia no han iniciado una conversación.</p>
                    <?php } else { ?>
                        <?php foreach($chatList as $chat){
                            if($chat->getIdEmisor() == $user1->getId()){ ?>
                                <p class="text-end text-break alert alert-primary ms-auto me-1 rounded-5 rounded-end text-dark p-2" style="width: fit-content">
                                    <span><?php echo $chat->getMensaje(); ?></span>
                                    <span class="text-muted align-bottom"><sub><?php echo date_format(date_create($chat->getFecha()), 'j/n/y H:i') . "hs"; ?></sub></span>
                                </p>
                            <?php } else{ ?>
                                <p class="text-start text-break alert alert-secondary ms-1 rounded-5 rounded-start text-dark p-2" style="width: fit-content">
                                    <span><?php echo $chat->getMensaje(); ?></span>
                                    <span class="text-muted"><sub><?php echo date_format(date_create($chat->getFecha()), 'j/n/y H:i') . "hs"; ?></sub></span>
                                </p>
                            <?php }
                        } } ?>
                    <span id="scrollToBottom"></span>
                </div>
                <div class="my-2">
                    <form action="<?php echo FRONT_ROOT ?>Chat/Add" method="Post" class="d-flex">
                        <textarea class="form-control chat-textarea" name="mensaje" placeholder="Escribe un mensaje" id="message"></textarea>
                        <input type="hidden" name="idEmisor" value="<?php echo $user1->getId() ?>">
                        <input type="hidden" name="idReceptor" value="<?php echo $user2->getId() ?>">
                        <button type="submit" class="btn btn-sm btn-primary rounded-circle ms-1 my-1" id="submitBtn">
                            <img src="<?php echo ASSETS_PATH . "sendButton.png" ?>" >
                        </button>
                    </form>
                </div>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script>
    const msg = document.getElementById('message');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('form');

    msg.addEventListener('keydown', function (evt) {
        const keyCode = evt.which || evt.keyCode;
        if (keyCode === 13 && !evt.shiftKey) {
            evt.preventDefault();
            if(msg.value != ""){
                submitBtn.click();
            }
        }
    });
</script>

<script>
    const chatMsgs = document.getElementById('scrollToBottom');
    chatMsgs.scrollIntoView({block: "end"});
</script>

<?php
include("footer.php");
?>