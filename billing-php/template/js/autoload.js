$(document).ready(function () {
  $(".current-code").focus().change(function () {
    $.getJSON("index.php", "p=getdetails&code=" + $(".current-code").val(), function (data) {
      $(".current-item").val(data.item);
      $(".current-price").val(data.price);
      $(".current-value").focus().change(function () {
        $(".current-total").val($(".current-value").val() * $(".current-price").val());
      });
    });
  });
});

