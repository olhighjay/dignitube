// import axios from "axios";

var player = videojs('video')

var viewLogged = false;
player.on('timeupdate', function() {

  var percentagePlayed = Math.ceil((player.currentTime() / player.duration()) * 100)

  console.log(player.currentTime());

  if (percentagePlayed > 5 && !viewLogged) {
    axios.put('/videos/' + window.CURRENT_VIDEO)
    // console.log(window.CURRENT_VIDEO);

    viewLogged = true
  }
  
})