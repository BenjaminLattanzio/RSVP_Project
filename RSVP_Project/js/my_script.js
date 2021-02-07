$("#sub").click( function() {
  alert("I clicked");
  console.log('I clicked');
 $.post( $("#myForm").attr("action"),
         $("#myForm :input").serializeArray(),
         function(info){
           console.log('I clicked');
           $("#result").html(info);
   });
clearInput();
});

$("#myForm").submit( function() {
  return false;
});
function clearInput() {
    $("#myForm :input").each( function() {
       $(this).val('');
    });
}
