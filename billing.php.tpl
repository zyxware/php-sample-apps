<html>
  <head>
    <title>
      <?php $this->eprint($this->title); ?>
    </title>
  </head>
  <body>

    <div class = "nav" style = "height:25px; width:100%">
      <a href = "?p=home">Edit Stock</a>
      <p style = "float:right">Billing System</p>
    </div>
    <div style = "clear:both"></div>
    <form name = "bill" action = "index.php?p=billing" method = "post">
    <table style = "width:100%; text-align:center">
      <tr>
        <th>#</th>
        <th>Code</th>
        <th>Item</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total</th>
      </tr>
      <?php $i = 1; ?>
      <?php if(isset($this->rows)): ?>
        <?php foreach ($this->rows as $key => $val): ?>
          <tr>
            <td><?php echo $i; ?>
              <input type = "hidden" name = "item-<?php echo $i; ?>">
            </td>
            <td>
              <input type = "text" name = "item-<?php echo $i; ?>-code" value = "<?php echo $this->eprint($val['code']); ?>">
            </td>
            <td>
              <input type = "text" name = "item-<?php echo $i; ?>-item" value = "<?php echo $this->eprint($val['item']); ?>">
            </td>
            <td>
              <input type = "text" name = "item-<?php echo $i; ?>-quantity" value = "<?php echo $this->eprint($val['quantity']); ?>">
            </td>
            <td>
              <input type = "text" name = "item-<?php echo $i; ?>-price" value = "<?php echo $this->eprint($val['price']); ?>">
            </td>
            <td>
              <input type = "text" name = "item-<?php echo $i; ?>-total" value = "<?php echo $this->eprint($val['total']); ?>">
            </td>
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>
      <?php endif; ?>
      <tr>
        <td><?php echo $i; ?>
          <input type = "hidden" name = "item-<?php echo $i; ?>">
        </td>
        <td>
          <input type = "text" name = "item-<?php echo $i; ?>-code">
        </td>
        <td>
          <input type = "text" name = "item-<?php echo $i; ?>-item">
        </td>
        <td>
          <input type = "text" name = "item-<?php echo $i; ?>-quantity">
        </td>
        <td>
          <input type = "text" name = "item-<?php echo $i; ?>-price">
        </td>
        <td>
          <input type = "text" name = "item-<?php echo $i; ?>-total">
        </td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Total</td>
        <td><?php echo $this->eprint($this->sum); ?><td/>
      </tr>
    </table>
    <input type = "submit" value = "Add more" name = "add More">
    <input type = "submit" value = "Bill" name = "Bill">
    </form>
  </body>
</html>
S
