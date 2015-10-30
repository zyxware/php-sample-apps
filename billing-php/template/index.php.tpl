<head>
  <title>
    <?php $this->eprint($this->title); ?>
  </title>
</head>
<body>
  <?php if(isset($this->content)): ?>
  <?php echo $this->content; ?>
  <?php endif; ?>
</body>
</html>

