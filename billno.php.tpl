<html>
  <head>
    <title>
      <?php $this->eprint($this->title); ?>
    </title>
  </head>
  <body>
    <div class = "nav" style = "height:25px; width:100%">
       <?php $nav = generate_menu(); ?>
      <?php foreach ($nav as $val): ?>
        <a href = "<?php echo $val['#href']; ?>"><?php echo $val['description']; ?></a>
      <?php endforeach; ?>
    </div>
    <form name = "bill_no" action = "index.php?p=billing" method = "get">
      <input type = "hidden" value = "billing" name = "p">
      Enter Bill No : <input type = "text" name = "view">

    </form>

  </body>
</html>

