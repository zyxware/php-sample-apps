<html>
  <head>
    <title>
      <?php $this->eprint($this->title); ?>
    </title>
  </head>
  <body>
    <div class = "nav" style = "height:25px; width:100%">
      <?php $nav = generate_menu("billing"); ?>
      <?php foreach ($nav as $val): ?>
        <a href = "<?php echo $val['#href']; ?>"><?php echo $val['description']; ?></a>
      <?php endforeach; ?>
      <p style = "float:right">Billing System</p>
    </div>
    <p>Bill NO : <?php echo $this->eprint($this->bill_no); ?></p>
    <p>Total : <?php echo $this->eprint($this->total); ?></p>
    <table style = "width:100%;text-align:center">
      <tr>
        <th>#</th>
        <th>Item</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Amount</th>
      <tr>
      <?php foreach ($this->rows as $key => $val): ?>
        <tr>
          <td></td>
          <td><?php echo $this->eprint($val['item_name']); ?></td>
          <td><?php echo $this->eprint($val['quantity']); ?></td>
          <td><?php echo $this->eprint($val['price']); ?></td>
          <td><?php echo $this->eprint($val['price'] * $val['quantity']); ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </body>
</html>

