console.log('le document est pas chargé');
document.addEventListener('DOMContentLoaded', function(){

  var writingtext = document.getElementById('writing');
  var bdd = document.getElementById('bdd');
  var inputmsg = document.getElementById('message');
  var emoji = document.getElementsByClassName("emoji");
  var buttonEnvoyer = document.getElementById('valider');
  var textmsg = document.getElementById('messenger')


  inputmsg.addEventListener('keypress', function (enter) {
    var enterkey = enter.keyCode;
    testclavier(enterkey)
  });
  buttonEnvoyer.addEventListener('click', envoyer);
  setInterval(bddzone, 4000);


  for (var i = 0; i < emoji.length; i++) {
    emoji[i].addEventListener('click', function () {
      var code = this.innerText;
      emojifonction(code);
    });
  }


  function bddzone() {
    console.log('bdd msg');
    textmsg.innerText += bdd.innerText;
    bdd.innerText = '';
  }



  function envoyer() {
    console.log('touche détécté');
    bdd.innerHTML = inputmsg.value + '<br>';
    inputmsg.value = '';
    writingtext.style.opacity = 0 ;
  }

  function emojifonction(code) {
    console.log('touche emoji détécté ' + code);
    inputmsg.value = inputmsg.value + code;
  }

  function testclavier(enter) {
    writingtext.style.opacity = 1 ;
    if (enter == 13) {
      envoyer();
    }
  }



    console.log('le document est chargé');
}, false);
