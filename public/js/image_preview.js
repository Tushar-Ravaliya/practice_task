let fileinput = document.getElementById("images");
let preview = document.getElementById("preview");

function preview_image() {
    for ( i of fileinput.files) {
        let reader = new FileReader()
        let figure = document.createElement('figure')
        let figcap = document.createElement('caption')
        figcap.innerText = i.name
        figure.appendChild(figcap)
        reader.onload=()=>{
            let img =document.createElement("img")
            img.setAttribute("src",reader.result)
            img.style.width = "13rem"
            img.style.height = "13rem"
            figure.insertBefore(img,figcap)
        }
        preview.appendChild(figure)
        reader.readAsDataURL(i)
    }
}
