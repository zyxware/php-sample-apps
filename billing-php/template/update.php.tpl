<div class = "nav" style = "height:25px; width:100%">
  <?php $nav = generate_menu("update"); ?>
  <?php foreach ($nav as $val): ?>
  <a href = "<?php echo $val['#href']; ?>"><?php echo $val['description']; ?></a>
  <?php endforeach; ?>
</div>
<?php if(isset($this->row)): ?>
<form name = "Search" action = "index.php" method = "get">
  <input type = "hidden" name = "p" value = "update">
  <input type = "text" name = "search">
  <input type = "submit" value = "Search">
</form>
<form name = "disable_option" action = "index.php?p=update" method = "post">
  <table style = "width:100%; text-align:center">
    <tr>
      <td>

      </td>
    </tr>
    <tr>
      <th></th>
      <th>Code</th>
      <th>Name</th>
      <th>Available Quantity</th>
      <th>Price</th>
      <th><th>
      <th>Add quantity</th>
    </tr>
    <?php foreach ($this->row as $key => $val): ?>
    <tr>
      <td><input type = "checkbox" name = "checkbox_values[]" value = "<?php echo $this->eprint($val['code']); ?>"></td>
      <td><?php echo $this->eprint($val['code']); ?></td>
      <td><?php echo $this->eprint($val['item_name']); ?></td>
      <td><?php echo $this->eprint($val['quantity']); ?></td>
    <form name = "price-<?php echo $this->eprint($val['code']); ?>" action = "index.php?p=update" method = "post">
      <input type = "hidden" value = "<?php echo $this->eprint($val['code']); ?>" name = "code">
      <td><input type = "text" name = "rate" value = "<?php echo $this->eprint($val['price']); ?>"</td>
      <td><input type = "submit" name = "rateUpdate" value = "update Rate"></td>
    </form>
    <form name = "update-<?php echo $this->eprint($val['code']); ?>" action = "index.php?p=update" method = "post">
      <td>
        <input type = "hidden" value = "<?php echo $this->eprint($val['code']); ?>" name = "code">
        <input type = "text" name = "amount">
      </td>
      <td>
        <input type = "Submit" value = "Update" name = "submit">
      </td>
    </form>
    </tr>
    <?php endforeach; ?>

    <tr>
      <td><td>
    </tr>
</form>
<input type = "submit" value = "block" name = "block">
</table>
<?php endif; ?>
