document.addEventListener("DOMContentLoaded", function () {
  const collapsibles = document.querySelectorAll(".collapsible");

  collapsibles.forEach((item) => {
    item.querySelector(".menu-title").addEventListener("click", function () {
      item.classList.toggle("active");
    });
  });
});

function loadPage(page) {
document.getElementById('page-frame').src = page;
}



// ----------------------User_dropdown-------------------------
function toggleUserMenu() {
    const menu = document.getElementById("userDropdown");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
  }

  function goToProfile() {
    alert("Đi đến trang hồ sơ (chưa gắn link)");
    // Ví dụ: window.location.href = 'profile.html';
  }

  function logout() {
    alert("Đăng xuất...");
    // Ví dụ: window.location.href = 'logout.php';
  }

  // Ẩn dropdown nếu click ra ngoài
  window.addEventListener('click', function(e) {
    const menu = document.getElementById("userDropdown");
    if (!e.target.closest('.user-menu')) {
      menu.style.display = "none";
    }
  });