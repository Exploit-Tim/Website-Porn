<script>
  const menuButtons = document.querySelectorAll(".menu-button");
  const screenOverlay = document.querySelector(".main-layout .screen-overlay");
  const themeButton = document.querySelector(".navbar .theme-button i");
  const searchButton = document.querySelector("#search-button");
  const searchBackButton = document.querySelector("#search-back-button");

  menuButtons.forEach((button) => {
    button.addEventListener("click", () => {
      document.body.classList.toggle("sidebar-hidden");
    });
  });

  screenOverlay.addEventListener("click", () => {
    document.body.classList.toggle("sidebar-hidden");
  });

  const darkModeSetting = localStorage.getItem("darkMode");
  const prefersDark = darkModeSetting === null || darkModeSetting === "enabled";

  if (prefersDark) {
    document.body.classList.add("dark-mode");
    themeButton.classList.replace("uil-moon", "uil-sun");
  } else {
    themeButton.classList.replace("uil-sun", "uil-moon");
  }

  themeButton.addEventListener("click", () => {
    const isDarkMode = document.body.classList.toggle("dark-mode");
    localStorage.setItem("darkMode", isDarkMode ? "enabled" : "disabled");
    themeButton.classList.toggle("uil-sun", isDarkMode);
    themeButton.classList.toggle("uil-moon", !isDarkMode);
  });

  if (window.innerWidth <= 768) {
    document.body.classList.add("sidebar-hidden");
  }

  const toggleSearchBar = () => {
    document.body.classList.toggle("show-mobile-search");
  };
  searchButton.addEventListener("click", toggleSearchBar);
  searchBackButton.addEventListener("click", () => searchButton.click());
</script>