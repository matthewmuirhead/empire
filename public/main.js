function headerScroll() {
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    document.getElementById("header").className = "header header-active";
  } else {
    document.getElementById("header").className = "header";
  }
}

function myLoadEvent() {
  // start
  window.onscroll = function() {headerScroll()};

  // Block inspect element
  // https://stackoverflow.com/questions/28690564/is-it-possible-to-remove-inspect-element
  // document.addEventListener('contextmenu', function(e) {
  //   e.preventDefault();
  // });
  // document.onkeydown = function(e) {
  //   if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
  //    return false;
  //   }
  // }
}

document.addEventListener('DOMContentLoaded', myLoadEvent);
