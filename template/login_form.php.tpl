<?php if(isset($this->msg)): ?>
      <?php echo $this->eprint($this->msg); ?>
    <?php endif; ?>
    <?php if(isset($this->form)): ?>
        <form action = "index.php" method = "post">
          Username : <input type = "text" name = "username"><br />
          Password : <input type = "password" name = "password"></br>
          <input type = "submit" value = "Log Me In">
        </form>
      <?php endif; ?>

