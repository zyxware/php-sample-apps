<head>
  <title>
    <?php $this->eprint($this->title); ?>
  </title>

  <body>
    <?php if(isset($this->row)): ?>
      <table>
        <tr>
          <th>Code</th>
          <th>Name</th>
          <th>Available Quantity</th>
          <th>Price</th>
          <th>Add quantity</th>
        </tr>
        <?php foreach ($this->row as $key => $val): ?>
          <tr>
            <td><?php echo $this->eprint($val['code']); ?></td>
            <td><?php echo $this->eprint($val['item_name']); ?></td>
            <td><?php echo $this->eprint($val['quantity']); ?></td>
            <td><?php echo $this->eprint($val['price']); ?></td>
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
      </table>
    <?php endif; ?>
  </body>
</html>

