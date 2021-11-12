function previewImage() {
    let file = document.getElementById("imageUpload").files;
    let display = document.getElementById("preview");
    if (file.length > 0) {
        let fileReader = new FileReader();
        fileReader.onload = function (event) {
            document.getElementById("preview").setAttribute("src", event.target.result);
        }
        fileReader.readAsDataURL(file[0]);
        display.style.display = "block";
    }
}