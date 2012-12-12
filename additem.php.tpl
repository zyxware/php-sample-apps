<head>
  <title>
    <?php $this->eprint($this->title); ?>
  </title>

  <body>
    <?php if(isset($this->form_fields)): ?>
      <form name = "additem" action = "index.php?p=addItem" method = "post">


        <?php foreach ($this->form_fields as $key => $val): ?>
          <?php echo $this->eprint($val['description']); ?> : <input type = "<?php echo $this->eprint($val['type']); ?>" name = "<?php echo $this->eprint($val['name']); ?>"><br />
        <?php endforeach; ?>

      <input type = "submit" name = "submit" Value = "Submit">
    <?php elseif(isset($this->error_msg)): ?>
      <div id = "error">
      <?php foreach($this->error_msg as $val): ?>
        <?php echo $this->eprint($val); ?><br />
      <?php endforeach; ?>
      </div>
    <?php elseif(isset($this->display_item)): ?>
      <?php foreach($this->display_item as $key => $val): ?>
        <?php echo $this->eprint($val['description']); ?>  :  <?php echo $this->eprint($val['value']); ?><br />
      <?php endforeach; ?>
    <?php endif; ?>
    </form>
  </body>
</html>

