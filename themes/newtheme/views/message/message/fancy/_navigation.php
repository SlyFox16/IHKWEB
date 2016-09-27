<div class="medium-4 large-3 columns right-50 ">
    <ul class="messages_menu">
        <li class="<?php echo $this->_curNav == 'inbox' ? 'selected' : ''; ?>"><a href="<?php echo $this->createUrl('inbox/') ?>">inbox</a></li>
        <li class="<?php echo $this->_curNav == 'compose' ? 'selected' : ''; ?>"><a href="<?php echo $this->createUrl('compose/') ?>">compose</a></li>
    </ul>
</div>
