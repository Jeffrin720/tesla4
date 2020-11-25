/**
 * Site Related Javascript
 */

//  Prevent browsers from caching DOMContentLoaded event
//  Fix issue where back button disables submit button
window.onunload = function(){};


//
//  Modals
//

/* Add modal closing behavior to all buttons
   that should close something */

Array.prototype.forEach.call(
  document.querySelectorAll("button[data-should-open]"),

  function(button){
    button.addEventListener("click", function(ev) {
      var el = document.getElementById(button.getAttribute("data-should-open"));
      if (el) {
        el.setAttribute("open", "");
      }
    })
  }
);

/* Add modal closing behavior to all buttons
   and backdrops that should close something */

Array.prototype.forEach.call(
  document.querySelectorAll(".tds-modal-close[data-should-close], .tds-modal-backdrop[data-should-close]"),

  function(element) {
    element.addEventListener("click", function(ev) {
      document
        .getElementById(element.getAttribute("data-should-close"))
        .removeAttribute("open")
    })
  }
);


//
// Sticky hover fix in iOS
//
(function(l){var i,s={touchend:function(){}};for(i in s)l.addEventListener(i,s)})(document);


//*
(function() {
  //
  // Fullscreen height
  //
  function resizeHeight() {
    document.documentElement.style.setProperty('--vh', window.innerHeight/100 + 'px');
  }

  window.addEventListener("resize", debounce(resizeHeight, 500));
  window.addEventListener("orientationchange", resizeHeight);

  var pollInnerHeightInterval = setInterval(function() {
    //  For whatever reason there is a small window sizing that occurs - ignore
    if (window.innerHeight > 400) {
      resizeHeight();
      clearTimeout(innerHeightFallbackTimeout);
      clearInterval(pollInnerHeightInterval);

      window.addEventListener("resize", debounce(resizeHeight, 500));
    }
  }, 100);

  //  Set the --vh to 1 as a fallback
  var innerHeightFallbackTimeout = setTimeout(function() {
    clearInterval(pollInnerHeight);

    document.documentElement.style.setProperty("--vh", 1);
    resizeHeight();
  }, 5000);
})();
//*/


function debounce(fn, wait) {
  var timeout;
  
  return function executeFunction() {
    function later() {
      clearTimeout(timeout);
      fn.apply(null, arguments);
    }
    
    timeout = setTimeout(later, wait);
  }
}




