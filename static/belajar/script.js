function myMove() {
  var elem 	= document.getElementById("myBox");   
  var pos 	= 0;
  var id 	= setInterval(frame, 10);
  function frame() {
    if (pos == 200) {
      clearInterval(id);
    } else {
      pos++; 
      elem.style.top = pos + 'px'; 
      elem.style.left = pos + 'px'; 
    }
  }
}