document.addEventListener("DOMContentLoaded", function () {
  const collapsibles = document.querySelectorAll(".collapsible");

  collapsibles.forEach((item) => {
    item.querySelector(".menu-title").addEventListener("click", function () {
      item.classList.toggle("active");
    });
  });
});