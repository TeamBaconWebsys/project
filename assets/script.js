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
  
  function click_me1(){
    var result ="<?php delete_following(); ?>"
    document.write(result);
  }
  function click_me2(){
    var result ="<?php delete_follower(); ?>"
    document.write(result);
  }
  
});
