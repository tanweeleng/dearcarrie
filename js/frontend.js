/* for textarea to fit to text body height */
function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
}

/* for smooth scrolling to top */
function scrollToTop() {
  var timeOut;
  if (document.body.scrollTop!=0 || document.documentElement.scrollTop!=0){
      window.scrollBy(0,-50);
      timeOut=setTimeout('scrollToTop()', 1);
    }
    else clearTimeout(timeOut);
}

/* keep sidebar static */
function staticBar(elementName, topOffset) {
  $(elementName).affix({offset: {top: topOffset}});
}