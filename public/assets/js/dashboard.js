function filterFunction() {
    let x = document.getElementById("filter");
    if (x.style.display === "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block"; 
    }
  }


const searchBar = document.querySelector('#search-title');
const bookContent = document.querySelector('#container-book');
searchBar.addEventListener('keyup', () => {
  fetch('/books?title=' + searchBar.value)
  .then(response => {
    return response.text()
    
  }) 
  .then(html => {
    bookContent.innerHTML = html
  })
})
