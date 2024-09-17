$(document).ready(function(){

  $("#site_change").change(function(){
    //console.log($(this).find(":selected").val());
    window.location.href = $(this).find(":selected").val();
  });

});