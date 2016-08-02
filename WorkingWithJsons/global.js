$("#add").on('submit', function(){
  var that = $(this);
  var content = that.serialize();

  $.ajax({
    url: 'add.php',
    dataType: 'json',
    type: 'post',
    data: content,

    success: function(data){
      if(data.success){
        alert("The result is " +data.result);
      };
    }
  });
  return false;
});
