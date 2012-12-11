<head>
  <title>
    <?php $this->eprint($this->title); ?>
  </title>
  
  <body>
    <?php if(is_array($this->menuoptions)): ?>
      <?php foreach ($this->menuoptions as $key => $val): ?>
        <a href = "<?php echo $this->eprint($val['#href']); ?>"><?php echo $this->eprint($val['description']); ?></a><br/>
      <?php endforeach; ?>
    <?php endif; ?>
  </body>
</html>

