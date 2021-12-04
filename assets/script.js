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

    /* the Post Data being displayed + changing the title up
      Grabbing different items within the JSON that was being sent over.
    */
    //var id = data['post'][0]['post_id'];
    //var user = data['post'][0]['user_id'];
    var username = data['user'][0]['username'];
    var image = data['post'][0]['image_link'];
    var upload_date = $.format.date(data['post'][0]['upload_date'], "MMM/dd/yyyy");
    var title = data['post'][0]['title'];
    document.title = title;

    var post_img = '<img src="' + image + '" class="card-img rounded mx-auto d-block" alt="'+ title + '"/>';
    var post_title = '<h3>' + title + ' by ' + username + '</h3>';
    var upload = '<p class="date float-end" >' + upload_date + '</p>';

    $("#postImg").append(post_img);
    $("#postTitle").append(post_title);
    $("#postDate").append(upload);

    /* End Post data upload */

    /* Start tags uploads */
    var tags = "<div class='btn-group'>";
    for (let i = 0; i < data['tag'].length; i++) {
      tags = tags + "<button class='btn tagBtn'>" + data['tag'][i]['tag'] + "</button>";
    }
    tags = tags + "</div>";
    $("#postTag").append(tags);
  });
});