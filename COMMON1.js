
// When the user scrolls down 50px from the top of the document, resize the header logo's font size
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        document.getElementById("logo").style.fontSize = "0px";
    } else {
        document.getElementById("logo").style.fontSize = "40px";
    }
}

