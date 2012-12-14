<html>
  <head>
    <title>
      <?php $this->eprint($this->title); ?>
    </title>
    <script type = "text/javascript" src = "template/js/jquery.min.js"></script>
    <script type = "text/javascript" src = "template/js/autoload.js"></script>

  </head>
  <body>

    <div class = "nav" style = "height:25px; width:100%">
      <?php $nav = generate_menu("billing"); ?>
      <?php foreach ($nav as $val): ?>
        <a href = "<?php echo $val['#href']; ?>"><?php echo $val['description']; ?></a>
      <?php endforeach; ?>
    </div>
    <div style = "clear:both"></div>
    <div id = "content">
    <form name = "bill" action = "index.php?p=billing" method = "post" id = "billingForm">
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
          <input type = "text" name = "item-<?php echo $i; ?>-code" class = "current-code">
        </td>
        <td>
          <input type = "text" name = "item-<?php echo $i; ?>-item" class = "current-item">
        </td>
        <td>
          <input type = "text" name = "item-<?php echo $i; ?>-quantity" class = "current-value">
        </td>
        <td>
          <input type = "text" name = "item-<?php echo $i; ?>-price" class = "current-price">
        </td>
        <td>
          <input type = "text" name = "item-<?php echo $i; ?>-total" class = "current-total">
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
    </div>
  </body>
</html>

