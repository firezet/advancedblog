
$(document).ready(function(){

  var userHref;
  var userHrefSplitted;
  var userId;
  var imageSrc;
  var imageHrefSplitted;
  var imageName;
  var photoId;

  $(".thumbnail").click(function(){
    $("#set_user_image").prop("disabled", false);

    userHref = $("#userId").prop("href");
    userHrefSplitted = userHref.split("=");
    userId = userHrefSplitted[userHrefSplitted.length-1];

    imageSrc = $(this).find('img').prop("src");
    imageHrefSplitted = imageSrc.split("/");
    imageName = imageHrefSplitted[imageHrefSplitted.length-1];

    photoId = $(this).find('img').attr("data");

    $.ajax({
      url: "includes/ajax.php",
      data: {photoId:photoId},
      type: "POST",
      success: function(data){
        $("#modal_sidebar").html(data);
      }
    })
  });

  $("#set_user_image").click(function(){
    $.ajax({
      url: "includes/ajax.php",
      data: {imageName:imageName, userId:userId},
      type: "POST",
      success: function(data){
        $(".user_image_box a img").prop("src", data);
      }
    });
  });

  $(".info-box-header").click(function(){
    $(".box-inner").slideToggle("fast");
    $("#toggle").toggleClass("glyphicon-menu-up");
    $("#toggle").toggleClass("glyphicon-menu-down");
  });

  $(".deleteLink").click(function(){
    return confirm("Are you sure you want to delete?");
  });

  tinymce.init({ selector:'textarea' });
});
