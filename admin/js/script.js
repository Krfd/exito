let list = document.querySelectorAll(".navigation li");

function activeLink() {
    list.forEach(item => {
        item.classList.remove("hovered");
    })
    this.classList.add("hovered");
}
list.forEach((item) => item.addEventListener("mouseover", activeLink));

let toggle = document.querySelector(".toggle");
let nagivation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
    nagivation.classList.toggle("active");
    main.classList.toggle("active");
}