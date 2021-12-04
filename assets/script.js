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
  
  $(".deleteMe").on("click", function(){
    $(this).closest("li").remove(); 
  });

  $.ajax({
    method:"GET",
    url: "../posts/post.php",
    dataType: "json",
    contentType: "application/json",
  }).done(function(data) {
    $.each(data, function(key, value){
  
      var id;
      var user;

      var title = value[0][0]['title'];
      document.title = title;

      console.log(value['post']['title']);

      if (key == 0){
        
        id = value[key][0]['post_id'];
        user = value[key][0]['user_id'];
        var image = value[key][0]['image_link'];
        var upload_date = $.format.date(value[key][0]['upload_date'], "MMM/d/yyyy");
  
  
        var post_img = '<img href="' + image + '" class="post-img" alt="'+ title + '"/>';
        var post_title = '<h3 class="post-title>' + title + '</h3>';
        var upload = '<p class="date">' + upload_date + '</p>';
  
        var post = post_img + post_title + upload;
  
        $("#postTitle").append(post);
      }
      /* the Post Data being displayed + changing the title up */
      /*var title = value['title'];
      var id = value['post_id'];
      var user = value['user_id'];
      var image = value['image_link'];
      var upload_date = $.format.date(value['upload_date'], "MMM/d/yyyy");
  
      var insert_title = '<title>'+ title + '</title>';
  
      var post_img = '<img href="' + image + '" class="post-img" alt="'+ title + '"/>';
      var post_title = '<h3 class="post-title>' + title + '</h3>';
      var upload = '<p class="date">' + upload_date + '</p>';
  
      var post = post_title + upload;
  
      $("#postTitle").append(post);
      $("#postContainer").append(post_img);*/
    });
  
  });
});