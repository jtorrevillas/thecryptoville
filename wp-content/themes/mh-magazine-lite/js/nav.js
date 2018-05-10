var active;

function convertToSlug(e) {
    return e.toLowerCase().replace(/[^\w ]+/g, "").replace(/ +/g, "-")
}

function attachClickListener(e, t) {
    document.querySelectorAll("#" + e + " a").forEach(function(e) {
        e.addEventListener("click", function(e) {
            sessionStorage.setItem("activeNav", t)
        })
    })
}

function createNavDom(e) {
    var t = e.childNodes,
        n = convertToSlug(e.childNodes[0].innerText),
        c = Array.prototype.indexOf.call(e.parentNode.children, e) + 1;
    if (n != active && t.length > 1) {
        var a = jQuery(".active");
        a.length && a.removeClass("active");
        var i = document.getElementById(n);
        if (i) active = n, i.classList.add("active");
        else {
            var o = t[2];
            o.setAttribute("id", n), attachClickListener(n, c), document.getElementById(n).classList.add("active"), document.querySelector(".mh-dp-menu").appendChild(o)
        }
    }
}
setTimeout(function() {
    createNavDom(document.querySelector("#menu-header-menu>li:nth-child(" + (sessionStorage.getItem("activeNav") || 2) + ")")), 2 != sessionStorage.getItem("activeNav") && sessionStorage.setItem("activeNav", 2), document.querySelectorAll("#menu-header-menu>li:not(:first-child)").forEach(function(e) {
        e.childNodes[0].addEventListener("click", function(t) {
            e.childNodes.length > 1 && t.preventDefault()
        }), e.addEventListener("mouseenter", function() {
            createNavDom(this)
        })
    })
}, 200);