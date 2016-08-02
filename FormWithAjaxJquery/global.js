$("form.ajax").on('submit', function(){
  var that = $(this);
  var content = that.serialize();
console.log(content);
  $.ajax({
    url: 'contact.php',
    dataType: 'json',
    type: 'post',
    data: content,

    success: function(data){
      if(data.success){
       alert(data.name +" has said:  "+ data.message);
      //console.log(data);
      };
    }
  });
  return false;
});
