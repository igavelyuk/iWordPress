$(document).ready(function () {
  $("#Personal").hover(
  function () {
     $('.subpersonal').fadeIn("slow");
  },
  function () {
     $('.subpersonal').fadeOut();
  }
);

$("#playbotton").click(function(){
  // $(".play").fireEvent('onclick');
  $("#playbotton").css('display', 'none'); //visibility: hidden;
  $("img.play-pre").css('display', 'none');
  // $("iframe.superhidden").css('display', 'block');

  var options = {
       id: 378822964,
       width: 1057,
       loop: true
   };

   var player = new Vimeo.Player('playerone', options);
   // player.setVolume(0);
   player.on('play', function() {});

   player.play()
   .then(function() {

   })
   .catch(function(error) {
     switch (error.name) {
          case 'PasswordError':
          // the video is password-protected and the viewer needs to enter the
          // password first
          break;
          case 'PrivacyError':
          // the video is private
          break;

          default:
        // some other error occurred
        break;
      }
    });
});

// $("img.play-pre").click(function(){
//   // $(".play").fireEvent('onclick');
//   // $("#playbotton").css('display', 'none'); //visibility: hidden;
//   // $("img.play-pre").css('display', 'none');
//   $("iframe.superhidden").css('display', 'block');
//   var x = $('iframe');
//   var player = new Vimeo.Player(x);
//   player.on('play', function() {
//       console.log('played the video!');
//   });
// });


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
