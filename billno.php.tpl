<html>
  <head>
    <title>
      <?php $this->eprint($this->title); ?>
    </title>
  </head>
  <body>
    <div class = "nav" style = "height:25px; width:100%">
      <a href = "index.php">Billing</a>
      <p style = "float:right">Billing System</p>
    </div>
    <form name = "bill_no" action = "index.php?p=billing" method = "get">
      <input type = "hidden" value = "billing" name = "p">
      Enter Bill No : <input type = "text" name = "view">

    </form>

  </body>
</html>

