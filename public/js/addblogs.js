var box = document.getElementById('links_box')
var title = document.getElementById('title')
var links = document.getElementById('links')
function add_links(){
   let clone = title.cloneNode(true)
   let clone1 = links.cloneNode(true)
   box.appendChild(clone)
   box.appendChild(clone1)
}

function remove_links(){
   var titles = document.getElementsByClassName("title");
   var links = document.getElementsByClassName("links");
   if(!(titles.length < 2)){
   box.removeChild(titles[titles.length-1]);
   box.removeChild(links[links.length-1]); 
   }
 }