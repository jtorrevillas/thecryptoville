var active;
function convertToSlug(txt){return txt.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');}
function createNavDom($li) {
    var childNodes = $li.childNodes;
    var id=convertToSlug($li.childNodes[0].innerText);
    if(id!=active){
        var $active=document.querySelectorAll(".active:not(#"+id+")");
        var $selected=document.getElementById(id);
        if($active.length){ $active.classList.remove("active"); }
        if(!$selected) {
            var $sub=childNodes[2];
            var $dp=document.querySelector(".mh-dp-menu");
            $sub.setAttribute("id", id);
            document.getElementById(id).classList.add("active");
            $dp.innerHTML = $dp.innerHTML + childNodes[2].innerHTML;
            $sub.remove();
        } else {
            active = id;
            $selected.classList.add("active");
        }
    }
}
setTimeout(function() {
    createNavDom(document.querySelector("#menu-header-menu>li:nth-child(2)"));
},200)

console.log(document.querySelectorAll("#menu-header-menu>li"));