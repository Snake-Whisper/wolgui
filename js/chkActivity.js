var machines = [] //TODO: oop
window.onload = function () {
  
}

function chkMachine (ip) {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "xhr/ping_fast.php?ip=" + ip);
  xhr.overrideMimeType("text/plain");
  xhr.send();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      alert(xhr.response != "");
    }
  }
}
