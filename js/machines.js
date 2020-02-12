function Machine (domMachine) {
  var dom = {
    root : domMachine,
    ip : domMachine.getElementsByClassName("atrIP")[0],
    svg : domMachine.getElementsByClassName("buttonVector")[0],
    link : domMachine.getElementsByClassName("buttonLink")[0]
  };

  var vars = {
    isOnline : false
  };

  getIP = function () {
    return dom.ip.textContent;
  };

  this.setOnline = function () {
    /*if (vars.isOnline) {
      return;
    }*/
    dom.svg.src = dom.svg.src.replace("red", "green");
    dom.link.href = dom.link.href.replace("action=wol", "action=cmd");
  };

  this.setOffline = function () {
    /*if (!vars.isOnline) {
      return;
    }*/
    dom.svg.src = dom.svg.src.replace("green", "red");
    dom.link.href = dom.link.href.replace("action=cmd", "action=wol");
  };

  this.chkOnline = function () {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "xhr/ping_fast.php?ip=" + getIP());
    xhr.overrideMimeType("text/plain");
    xhr.send();
    xhr.onreadystatechange = function (dummy, link=dom.link, svg=dom.svg) {
      if (xhr.readyState === 4) {
        console.log("entered");
        if (xhr.response != "") {
          svg.src = svg.src.replace("red", "green");
          link.href = link.href.replace("action=wol", "action=cmd");

        } else {
          svg.src = svg.src.replace("green", "red");
          link.href = link.href.replace("action=cmd", "action=wol");
        }
      }
    }
  };
}


window.onload=function () {
  var d = document.getElementsByClassName("machineBox");
  var mach = new Machine(d[0]);
  mach.chkOnline();
}
