<style>
  
  /* Importing Google Fonts - Poppins */
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
  }
  ::-webkit-scrollbar {
    width: 6px;
    height: 6px;
  }
  ::-webkit-scrollbar-track {
    background: #151A2D;
    border-radius: 10px;
  }
  ::-webkit-scrollbar-thumb {
    background: #CBD4FF;
    border-radius: 10px;
  }
  ::-webkit-scrollbar-thumb:hover {
    background: #99A3FF;
  }
  body {
    min-height: 100vh;
    background: #151A2D;
  }
  .dekstop-hiden {
    display: none!important;
  }
  .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1;
    width: 200px;
    height: 100%;
    background: #151A2D;
    transition: all 0.4s ease;
  }
  .sidebar.collapsed {
    width: 85px;
  }
  .sidebar .sidebar-header {
    display: flex;
    position: relative;
    padding: 32px 20px;
    align-items: center;
    justify-content: space-between;
  }
  .sidebar-header .header-logo img {
    width: 46px;
    height: 46px;
    display: block;
    object-fit: contain;
    border-radius: 50%;
  }
  .sidebar-header .sidebar-toggler,
  .sidebar-menu-button {
    position: absolute;
    left: 30px;
    height: 35px;
    width: 35px;
    color: #151A2D;
    border: none;
    cursor: pointer;
    display: flex;
    background: #EEF2FF;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: 0.4s ease;
  }
  .sidebar-header .sidebar-toggler span,
  .sidebar-menu-button span {
    font-size: 1.75rem;
    transition: 0.4s ease;
  }
  .sidebar.collapsed .sidebar-header .sidebar-toggler span {
    transform: rotate(180deg);
  }
  .sidebar-header .sidebar-toggler:hover {
    background: #d9e1fd;
  }
  .sidebar-nav .nav-list {
    list-style: none;
    display: flex;
    gap: 4px;
    padding: 0 15px;
    flex-direction: column;
    transform: translateY(15px);
    transition: 0.4s ease;
  }
  .sidebar .sidebar-nav .primary-nav {
    overflow-y: auto;
    scrollbar-width: thin;
    padding-bottom: 20px;
    height: calc(100vh - 227px);
    scrollbar-color: transparent transparent;
  }
  .sidebar .sidebar-nav .primary-nav:hover {
    scrollbar-color: #EEF2FF transparent;
  }
  .sidebar.collapsed .sidebar-nav .primary-nav {
    overflow: unset;
  }
  .sidebar-nav .nav-item .nav-link {
    color: #fff;
    display: flex;
    gap: 12px;
    white-space: nowrap;
    border-radius: 8px;
    padding: 11px 15px;
    align-items: center;
    text-decoration: none;
    border: 1px solid #151A2D00;
    transition: 0.4s ease;
  }
  .sidebar-nav .nav-item:is(:hover, .open)>.nav-link:not(.dropdown-title) {
    color: #151A2D;
    background: #EEF2FF;
  }
  .sidebar .nav-link .nav-label {
    transition: opacity 0.3s ease;
  }
  .sidebar.collapsed .nav-link :where(.nav-label, .dropdown-icon) {
    opacity: 0;
    pointer-events: none;
  }
  .sidebar.collapsed .nav-link .dropdown-icon {
    transition: opacity 0.3s 0s ease;
  }
  .sidebar-nav .secondary-nav {
    position: absolute;
    bottom: 35px;
    width: 100%;
    background: #151A2D00;
  }
  .sidebar-nav .nav-item {
    position: relative;
  }

  /* Dropdown Stylings */
  .sidebar-nav .dropdown-container .dropdown-icon {
    margin: 0 -4px 0 auto;
    transition: transform 0.4s ease, opacity 0.3s 0.2s ease;
  }
  .sidebar-nav .dropdown-container.open .dropdown-icon {
    transform: rotate(180deg);
  }
  .sidebar-nav .dropdown-menu {
    height: 0;
    overflow-y: hidden;
    list-style: none;
    padding-left: 0;
    transition: height 0.4s ease;
  }
  .sidebar.collapsed .dropdown-menu {
    position: absolute;
    top: -10px;
    left: 100%;
    opacity: 0;
    height: auto !important;
    padding-right: 10px;
    overflow-y: unset;
    pointer-events: none;
    border-radius: 0 10px 10px 0;
    background: #151A2D;
    transition: 0s;
  }
  .sidebar.collapsed .dropdown-menu:has(.dropdown-link) {
    padding: 7px 10px 7px 24px;
  }
  .sidebar.sidebar.collapsed .nav-item:hover>.dropdown-menu {
    opacity: 1;
    pointer-events: auto;
    transform: translateY(12px);
    transition: all 0.4s ease;
  }
  .sidebar.sidebar.collapsed .nav-item:hover>.dropdown-menu:has(.dropdown-link) {
    transform: translateY(10px);
  }
  .dropdown-menu .nav-item .nav-link {
    color: #F1F4FF;
    padding: 9px 15px;
  }
  .sidebar.collapsed .dropdown-menu .nav-link {
    padding: 7px 15px;
  }
  .dropdown-menu .nav-item .nav-link.dropdown-title {
    display: none;
    color: #fff;
    padding: 9px 15px;
  }
  .dropdown-menu:has(.dropdown-link) .nav-item .dropdown-title {
    font-weight: 500;
    padding: 7px 15px;
  }
  .sidebar.collapsed .dropdown-menu .nav-item .dropdown-title {
    display: block;
  }
  .sidebar-menu-button {
    display: none;
  }
  .header {
    position: fixed;
    top: 0;
    left: 75px;
    width: calc(100% - 75px);
    background-color: #151A2D;
    color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px;
    z-index: 2;
}
  .logo{
    font-size: 1.5rem;
    font-weight: bold;
  	position: relative;
    color: #FFF;
    cursor: pointer;
    top: 10px;
  }
  .header .menu-button {
    background: none;
    border: none;
    color: #fff;
    font-size: 1.5rem;
    cursor: pointer;
  }
  .search-bar {
    display: flex;
    align-items: center;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    margin: 0 auto;
    width: 100%;
    max-width: 500px;
    height:40px;
    position: relative;
    right: 75px;
  }
  .search-bar input {
    border: none;
    padding: 5px 10px;
    outline: none;
    width: 100%;
  }
  .search-bar button {
    border: none;
    background: #FFFFFF00;
    padding: 5px 10px;
    cursor: pointer;
    position: relative;
    margin-top: 5px;
  }
  .upload-button {
    display: flex;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    position: relative;
    top: 10px;
  }
  span.material-symbols-rounded.upload-right{
   	margin-right:5px;
    margin-top: -1px;
  }

  .home {
    display: flex;
    overflow: unset;
    max-height: 100vh;
    flex-direction: column;
    width: calc(100% - 220px);
    left: 210px;
    top: 68px;
    position: relative;
  }
  .upload-button a {
    text-decoration: none;
    color: #FFF;
    display: flex;
  }

  /* Responsive media query code for small screens */
  @media (max-width: 768px) {
    .home{
      width: calc(100% - 20px);
      left: 10px;
      top: 120px;
    }
    .header{
      left: 0;
      width: 100%;
    }
    .logo,.upload-button{
      top: 5px;
    }
    .mobile-hiden{
      display:none!important;
    }
    .dekstop-hiden{
      display:flex!important;
    }
    .sidebar-menu-button {
      position: absolute;
      left: 10px;
      height: 35px;
      width: 35px;
      color: #151A2D;
      border: none;
      cursor: pointer;
      display: flex;
      background: #EEF2FF;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      transition: 0.4s ease;
    }
    .sidebar.collapsed {
      width: 270px;
      left: -270px;
    }
    .sidebar.collapsed .sidebar-header .sidebar-toggler {
      transform: none;
    }
    .sidebar.collapsed .sidebar-nav .primary-nav {
      transform: translateY(15px);
    }
    .logo {
      margin: 0 auto;
      left: 24px;
    }
    .search-bar{
      width: 70%;
      right: 0;
    }
    .search-mobile {
        position: relative;
        display: flex;
        top: 100px;
    }
  }
</style>


<!-- Header -->
<header class="header">
  <!-- Mobile Sidebar Menu Button -->
  <button class="sidebar-menu-button">
    <span class="material-symbols-rounded">menu</span>
  </button>
  <div class="logo">DASHBOARD</div>
  <div class="upload-button">
    <a href="../admin/logout.php"><span class="material-symbols-rounded upload-right">logout</span><span class="mobile-hiden">Logout</span></a>
  </div>
</header>
<aside class="sidebar">
  <!-- Sidebar Header -->
  <header class="sidebar-header">
    <button class="sidebar-toggler">
      <span class="material-symbols-rounded">chevron_left</span>
    </button>
  </header>

  <nav class="sidebar-nav">
    <!-- Primary Top Nav -->
    <ul class="nav-list primary-nav">
      <li class="nav-item">
        <a href="/admin/" class="nav-link">
          <span class="material-symbols-rounded">home</span>
          <span class="nav-label">Home</span>
        </a>
        <ul class="dropdown-menu">
          <li class="nav-item"><a class="nav-link dropdown-title">Home</a></li>
        </ul>
      </li>
	
      <li class="nav-item">
        <a href="/admin/settings.php" class="nav-link">
          <span class="material-symbols-rounded">settings</span>
          <span class="nav-label">Settings</span>
        </a>
        <ul class="dropdown-menu">
          <li class="nav-item"><a class="nav-link dropdown-title">settings</a></li>
        </ul>
      </li>
      
      <li class="nav-item">
        <a href="/admin/adsterra.php" class="nav-link">
          <span class="material-symbols-rounded">attach_money</span>
          <span class="nav-label">Adsterra</span>
        </a>
        <ul class="dropdown-menu">
          <li class="nav-item"><a class="nav-link dropdown-title">attach_money</a></li>
        </ul>
      </li>
      
    </ul>

    <!-- Secondary Bottom Nav -->
    <ul class="nav-list secondary-nav" style="display:none;">
      <li class="nav-item">
        <a href="#" class="nav-link">
          <span class="material-symbols-rounded">help</span>
          <span class="nav-label">Support</span>
        </a>
        <ul class="dropdown-menu">
          <li class="nav-item"><a class="nav-link dropdown-title">Support</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <span class="material-symbols-rounded">logout</span>
          <span class="nav-label">Sign Out</span>
        </a>
        <ul class="dropdown-menu">
          <li class="nav-item"><a class="nav-link dropdown-title">Sign Out</a></li>
        </ul>
      </li>
    </ul>
  </nav>
</aside>



<!-- Script -->
<script>
  // Toggle the visibility of a dropdown menu
  const toggleDropdown = (dropdown, menu, isOpen) => {
    dropdown.classList.toggle("open", isOpen);
    menu.style.height = isOpen ? `${menu.scrollHeight}px` : 0;
  };

  // Close all open dropdowns
  const closeAllDropdowns = () => {
    document.querySelectorAll(".dropdown-container.open").forEach((openDropdown) => {
      toggleDropdown(openDropdown, openDropdown.querySelector(".dropdown-menu"), false);
    });
  };

  // Attach click event to all dropdown toggles
  document.querySelectorAll(".dropdown-toggle").forEach((dropdownToggle) => {
    dropdownToggle.addEventListener("click", (e) => {
      e.preventDefault();

      const dropdown = dropdownToggle.closest(".dropdown-container");
      const menu = dropdown.querySelector(".dropdown-menu");
      const isOpen = dropdown.classList.contains("open");

      closeAllDropdowns(); // Close all open dropdowns
      toggleDropdown(dropdown, menu, !isOpen); // Toggle current dropdown visibility
    });
  });

  // Attach click event to sidebar toggle buttons
  document.querySelectorAll(".sidebar-toggler, .sidebar-menu-button").forEach((button) => {
    button.addEventListener("click", () => {
      closeAllDropdowns(); // Close all open dropdowns
      document.querySelector(".sidebar").classList.toggle("collapsed"); // Toggle collapsed class on sidebar
      
      // Update the .home class width and left position
      	if (window.innerWidth > 768) {
          const homeSection = document.querySelector(".home");
          if (document.querySelector(".sidebar").classList.contains("collapsed")) {
              homeSection.style.width = "calc(100% - 105px)";
              homeSection.style.left = "95px";
          } else {
              homeSection.style.width = "calc(100% - 220px)"; // Kembali ke ukuran awal
              homeSection.style.left = "210px";
          }
        }
    });
  });
  document.addEventListener("DOMContentLoaded", () => {
    if (window.innerWidth > 768) {
        document.querySelector(".home").style.transition = "all 0.4s ease";
    }
  });

  // Collapse sidebar by default on small screens
  if (window.innerWidth <= 1024) document.querySelector(".sidebar").classList.add("collapsed");
  
  document.addEventListener("DOMContentLoaded", function () {
    const logo = document.querySelector(".logo");

    if (logo) {
      logo.addEventListener("click", function () {
        window.location.href = "/admin/";
      });
    }
  });
</script>
