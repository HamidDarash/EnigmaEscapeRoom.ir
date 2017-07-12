
$(document).ready(function () {
   $(".navbar-custom .navbar-nav li").click(function () {
     $(".navbar-custom .navbar-nav li").removeClass('active');
     $(this).addClass('active');
   });
});
