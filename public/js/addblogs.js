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
   var copiedImages = document.getElementsByClassName("title");
   var copiedFigs = document.getElementsByClassName("links");
   
   box.removeChild(copiedImages[copiedImages.length-1]);
   box.removeChild(copiedFigs[copiedFigs.length-1]); 
 }