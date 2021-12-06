$(document).ready(function(){

  $("#sketches").click(function(){
    $(".clicked").removeClass("clicked");
    $(".show").addClass("hide")
    $(".show").removeClass("show");

    $("#sketchesPNG").removeClass("hide");
    $("#sketches").addClass("clicked")
    $("#sketchesPNG").addClass("show");
  });

  $("#commissions").click(function(){
    $(".clicked").removeClass("clicked");
    $(".show").addClass("hide")
    $(".show").removeClass("show");

    $("#commissionsPNG").removeClass("hide");
    $("#commissions").addClass("clicked")
    $("#commissionsPNG").addClass("show");
  });

  $("#gallery").click(function(){
    $(".clicked").removeClass("clicked");
    $(".show").addClass("hide")
    $(".show").removeClass("show");

    $("#galleryPNG").removeClass("hide");
    $("#gallery").addClass("clicked")
    $("#galleryPNG").addClass("show");
  });

  $.ajax({
    method:"GET",
    url: "../posts/post.php",
    dataType: "json",
    contentType: "application/json",
  }).done(function(data) {

    /* the Post Data being displayed + changing the title up
      Grabbing different items within the JSON that was being sent over.
    */
    //var id = data['post'][0]['post_id'];
  
});