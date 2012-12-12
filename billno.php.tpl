<html>
  <head>
    <title>
      <?php $this->eprint($this->title); ?>
    </title>
  </head>
  <body>
    <form name = "bill_no" action = "index.php?p=billing" method = "get">
      <input type = "hidden" value = "billing" name = "p">
      Enter Bill No : <input type = "text" name = "view">

    </form>

  </body>
</html>

