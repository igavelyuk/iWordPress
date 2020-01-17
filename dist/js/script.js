$(document).ready(function () {
  $("#Personal").hover(
  function () {
     $('.subpersonal').fadeIn("slow");
  },
  function () {
     $('.subpersonal').fadeOut();
  }
);

$("#About").hover(
function () {
   $('.subabout').fadeIn("slow");
   var pos = $( "#About" ).position();
   $('.subabout').css({position:'relative'});
   $('.subabout').css('left', pos.left-300);
},
function () {
   $('.subabout').fadeOut();
}
);

$(".subpersonal").hover(
function () {
   $('.subpersonal').fadeIn();
},
function () {
   $('.subpersonal').fadeOut("slow");
}
);

$(".subabout").hover(
function () {
   $('.subabout').fadeIn();
   var pos = $( "#About" ).position();
   $('.subabout').css({position:'relative'});
   $('.subabout').css('left', pos.left-300);
},
function () {
   $('.subabout').fadeOut("slow");
}
);

});
