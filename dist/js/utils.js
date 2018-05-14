// function storageAvailable(type) {
//     try {
//         var storage = window[type],
//             x = '__storage_test__';
//         storage.setItem(x, x);
//         storage.removeItem(x);
//         return true;
//     }
//     catch(e) {
//         return e instanceof DOMException && (
//             // everything except Firefox
//             e.code === 22 ||
//             // Firefox
//             e.code === 1014 ||
//             // test name field too, because code might not be present
//             // everything except Firefox
//             e.name === 'QuotaExceededError' ||
//             // Firefox
//             e.name === 'NS_ERROR_DOM_QUOTA_REACHED') &&
//             // acknowledge QuotaExceededError only if there's something already stored
//             storage.length !== 0;
//     }
// }

// function setStyles() {
//   var currentColor = localStorage.getItem('bgcolor');
//   var currentFont = localStorage.getItem('font');
//   var currentImage = localStorage.getItem('image');

//   document.getElementById('bgcolor').value = currentColor;
//   document.getElementById('font').value = currentFont;
//   document.getElementById('image').value = currentImage;

//   htmlElem.style.backgroundColor = '#' + currentColor;
//   pElem.style.fontFamily = currentFont;
//   imgElem.setAttribute('src', currentImage);
// }


// function populateStorage() {
//   localStorage.setItem('bgcolor', document.getElementById('bgcolor').value);
//   localStorage.setItem('font', document.getElementById('font').value);
//   localStorage.setItem('image', document.getElementById('image').value);

//   setStyles();
// }

// if (storageAvailable('localStorage')) {
//   // Yippee! We can use localStorage awesomeness
// }
// else {
//   // Too bad, no localStorage for us
// }

// if(!localStorage.getItem('bgcolor')) {
//   populateStorage();
// } else {
//   setStyles();
// }

/*
 * How to get client's IP address using JavaScript only?
 * https://stackoverflow.com/a/32841164
*/
function findLocalIP(onNewIP) { //  onNewIp - your listener function for new IPs
  var myPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection; //compatibility for firefox and chrome
  var pc = new myPeerConnection({iceServers: []}),
    noop = function() {},
    localIPs = {},
    ipRegex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g,
    key;

  function ipIterate(ip) {
    if (!localIPs[ip]) onNewIP(ip);
    localIPs[ip] = true;
  }
  pc.createDataChannel(""); //create a bogus data channel
  pc.createOffer(function(sdp) {
    sdp.sdp.split('\n').forEach(function(line) {
      if (line.indexOf('candidate') < 0) return;
      line.match(ipRegex).forEach(ipIterate);
    });
    pc.setLocalDescription(sdp, noop, noop);
  }, noop); // create offer and set local description
  pc.onicecandidate = function(ice) { //listen for candidate events
    if (!ice || !ice.candidate || !ice.candidate.candidate || !ice.candidate.candidate.match(ipRegex)) return;
    ice.candidate.candidate.match(ipRegex).forEach(ipIterate);
  };
}

function eraseCookie(name) {
  document.cookie = name + '=; Max-Age=0'
}

function setCookie(name,value,days) {
  var expires = "";
  if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days*24*60*60*1000));
      expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}
// function eraseCookie(name) {
//   document.cookie = name+'=; Max-Age=-99999999;';
// }

// findIP(gotIP);