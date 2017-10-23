var web = {};

web.toggleElement = function(e) {
    var s = window.getComputedStyle(e, null).getPropertyValue("display");
    if (s === "block") {
        e.style.display = "none";
    } else {
        e.style.display = "block";
    }
};

web.toggleClassName = function(e, className) {
    if (e.classList.contains(className)) {
        e.classList.remove(className);
    } else {
        e.classList.add(className);
    }
};

web.scrollTop = function () {
    var scrollTop;
    if(typeof(window.pageYOffset) === "number")
    {
        // DOM compliant, IE9+
        scrollTop = window.pageYOffset;
    }
    else
    {
        // IE6-8 workaround
        if(document.body && document.body.scrollTop)
        {
            // IE quirks mode
            scrollTop = document.body.scrollTop;
        }
        else if(document.documentElement && document.documentElement.scrollTop)
        {
            // IE6+ standards compliant mode
            scrollTop = document.documentElement.scrollTop;
        }
    }
    return scrollTop;
};

web.topup = function (msg) {
    var cls = "topup";
    
    if (msg === (document.querySelector("." + cls + " .message") || {}).innerHTML) {
        return;
    }
    
    var style = document.createElement("style");
    var topup = document.createElement("div");
    var modal = document.createElement("div");
    var content = document.createElement("div");
    var message = document.createElement("div");

    style.innerHTML = [
        ".", cls, "{position:fixed;top:0;bottom:0;left:0;right:0;z-index:99999}",
        ".", cls, " .content, .", cls, " .modal{position:absolute;top:0;bottom:0;left:0;right:0}",
        ".", cls, " .modal{background:#000;opacity:.7}",
        ".", cls, " .content{margin:auto;background:#fff;border-radius:3px;box-sizing:border-box;border:1px solid #ccc;padding:2rem;max-width:calc(100% - 1rem);max-height:calc(100% - 1rem);width:max-content;height:max-content;overflow:auto}",
        ".", cls, " .message{}"
    ].join("");

    topup.className = "topup";
    modal.className = "modal";
    content.className = "content";
    message.className = "message";

    modal.onclick = function() {
        topup.parentNode.removeChild(topup);
    };
    message.innerHTML = msg;

    content.appendChild(message);
    
    topup.appendChild(style);
    topup.appendChild(modal);
    topup.appendChild(content);
    
    document.body.appendChild(topup);
};

HTMLElement.prototype.slideshow = function(time) {
    var slideshow = this;
    if (!time) time = 5000;
    
    var photos = slideshow.getElementsByClassName("photos")[0];

    var prev_button = slideshow.getElementsByClassName("prev-button")[0];
    var next_button = slideshow.getElementsByClassName("next-button")[0];

    prev_button.addEventListener("click", prev);
    next_button.addEventListener("click", next);
    
    var number = photos.children.length;
    var current_index = 0;

    function prev() {
        if (current_index === 0) {
            current_index = number - 1;
        } else {
            current_index--;
        }

        setActiveClass();
    }

    function next() {
        if (current_index === number - 1) {
            current_index = 0;
        } else {
            current_index++;
        }

        setActiveClass();
    }

    function setActiveClass() {
        for (var i = 0; i < number; i++) {
            if (i === current_index) {
                photos.children[i].classList.add("active");
            } else {
                photos.children[i].classList.remove("active");
            }
        }
    }
    
    var autorun = setInterval(next, time);
    slideshow.onmouseout = function() {
        autorun = setInterval(next, time);
    };
    slideshow.onmouseover = function() {
        clearInterval(autorun);
    };
};