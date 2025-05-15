<style>
	@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }
  :root {
    --white-color: #fff;
    --black-color: #000;
    --red-color: #ce1212;
    --light-white-color: #f0f0f0;
    --light-gray-color: #e5e5e5;
    --border-color: #ccc;
    --primary-color: #3b82f6;
    --secondary-color: #404040;
    --overlay-dark-color: rgba(0, 0, 0, 0.6);
  }
  .dark-mode {
    --white-color: #171717;
    --black-color: #fff;
    --light-white-color: #333;
    --light-gray-color: #404040;
    --border-color: #808080;
    --secondary-color: #d4d4d4;
  }
  body {
    background: var(--white-color);
  }
  .container {
    display: flex;
    overflow: hidden;
    max-height: 100vh;
    flex-direction: column;
  }
  header,
  .sidebar .nav-left,
  .category-list {
    position: sticky;
    top: 0;
    z-index: 10;
    background: var(--white-color);
  }
  .navbar {
    display: flex;
    gap: 32px;
    align-items: center;
    padding: 8px 16px;
    justify-content: space-between;
  }
  :where(.navbar, .sidebar) .nav-section {
    gap: 16px;
  }
  :where(.navbar, .sidebar) :where(.nav-section, .nav-logo, .search-form) {
    display: flex;
    align-items: center;
  }
  :where(.navbar, .sidebar) :where(.logo-image, .user-image) {
    width: 32px;
    cursor: pointer;
    border-radius: 50%;
  }
  :where(.navbar, .sidebar) .nav-section .nav-button {
    border: none;
    height: 40px;
    width: 40px;
    cursor: pointer;
    background: none;
    border-radius: 50%;
  }
  :where(.navbar, .sidebar) .nav-section .nav-button:hover {
    background: var(--light-gray-color) !important;
  }
  :where(.navbar, .sidebar) .nav-button i {
    font-size: 1.5rem;
    display: flex;
    color: var(--black-color);
    align-items: center;
    justify-content: center;
  }
  :where(.navbar, .sidebar) .nav-logo {
    display: flex;
    gap: 8px;
    text-decoration: none;
    width: 200px;
  }
  :where(.navbar, .sidebar) .nav-logo .logo-text {
    color: var(--black-color);
    font-size: 1.25rem;
  }
  .navbar .search-back-button {
    display: none;
  }
  .navbar .nav-center {
    gap: 8px;
    width: 100%;
    display: flex;
    justify-content: center;
  }
  .navbar .search-form {
    flex: 1;
    height: 40px;
    max-width: 550px;
  }
  .navbar .search-form .search-input {
    width: 100%;
    height: 100%;
    font-size: 1rem;
    padding: 0 16px;
    outline: none;
    color: var(--black-color);
    background: var(--white-color);
    border-radius: 49px 0 0 49px;
    border: 1px solid var(--border-color);
    margin-left: -70px;
  }
  .navbar .search-form .search-input:focus {
    border-color: var(--primary-color);
  }
  .navbar .search-form .search-button {
    height: 40px;
    width: auto;
    padding: 0 20px;
    border-radius: 0 49px 49px 0;
    border: 1px solid var(--border-color);
    background: var(--red-color);
    border-left: 0;
  }
  .navbar .nav-center .mic-button {
    background: var(--light-white-color);
  }
  .navbar .nav-right .search-button {
    display: none;
  }
  .main-layout {
    display: flex;
    overflow-y: auto;
    scrollbar-color: #a6a6a6 transparent;
  }
  .main-layout .sidebar {
    display: block !important;
    width: 280px;
    overflow: hidden;
    padding: 0 11px 0;
    background: var(--white-color);
  }
  .main-layout .sidebar .nav-left {
    display: none;
    padding: 8px 5px;
  }
  body.sidebar-hidden .main-layout .sidebar {
    width: 0;
    padding: 0;
  }
  .sidebar .links-container {
    padding: 16px 0 32px;
    overflow-y: auto;
    height: calc(100vh - 60px);
    scrollbar-width: thin;
    scrollbar-color: transparent transparent;
  }
  .sidebar .links-container:hover {
    scrollbar-color: #a6a6a6 transparent;
  }
  .sidebar .link-section {
    list-style: none;
  }
  .sidebar .link-section .link-item {
    display: flex;
    cursor: pointer;
    color: var(--black-color);
    white-space: nowrap;
    align-items: center;
    font-size: 0.938rem;
    padding: 5px 12px;
    margin-bottom: 4px;
    border-radius: 8px;
    text-decoration: none;
  }
  .sidebar .link-section .link-item:hover {
    background: var(--light-gray-color);
  }
  .sidebar .link-section .link-item i {
    font-size: 1.4rem;
    margin-right: 10px;
  }
  .sidebar .link-section .section-title {
    color: var(--black-color);
    font-weight: 500;
    font-size: 0.938rem;
    margin: 16px 0 8px 8px;
  }
  .sidebar .section-separator {
    height: 1px;
    margin: 10px 0;
    background: var(--light-gray-color);
  }
  .main-layout .content-wrapper {
    padding: 0 16px;
    overflow-x: hidden;
    width: 100%;
  }
  .content-wrapper .category-list {
    display: flex;
    overflow-x: auto;
    gap: 12px;
    padding: 12px 0 11px;
    scrollbar-width: none;
  }
  .category-list .category-button {
    border: none;
    cursor: pointer;
    font-weight: 500;
    font-size: 13px;
    border-radius: 8px;
    white-space: nowrap;
    color: var(--black-color);
    padding: 5px 10px;
    background: var(--light-gray-color);
    text-decoration: none;
  }
  .category-list .category-button.active {
    color: var(--white-color);
    background: var(--red-color);
    pointer-events: none;
  }
  .dark-mode .category-list .category-button.active {
    color: var(--black-color);
  }
  .category-list .category-button:not(.active):hover {
    background: var(--border-color);
  }
  .content-wrapper .video-list {
    display: grid;
    gap: 16px;
    padding: 20px 0 64px;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  }
  .content-wrapper .video-list .video-card {
    text-decoration: none;
  }
  .content-wrapper .video-list .video-card .thumbnail-container {
    position: relative;
  }
  .content-wrapper .video-list .video-card .thumbnail {
    width: 100%;
    object-fit: cover;
    border-radius: 8px;
    aspect-ratio: 16 / 9;
    background: var(--light-white-color);
  }
  .content-wrapper .video-list .video-card .duration {
    position: absolute;
    right: 10px;
    bottom: 12px;
    color: #fff;
    font-size: 11px;
    padding: 0 5px;
    border-radius: 5px;
    background: var(--overlay-dark-color);
  }
  .content-wrapper .video-list .video-card .video-info {
    display: flex;
    gap: 11px;
    padding: 0 5px 10px 5px;
  }
  .content-wrapper .video-list .video-card .icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
  }
  .content-wrapper .video-list .video-card .title {
    font-size: 13px;
    color: var(--black-color);
    font-weight: 500;
    line-height: 1.3;
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
  }
  .content-wrapper .video-list .video-card p {
    font-size: 10px;
    color: var(--secondary-color);
    margin-top: 3px;
  }
  .content-wrapper .video-list .video-card .channel-name {
    margin: 4px 0 2px;
  }
  .uil-eye, .uil-calendar-alt{
    margin-right: 3px;
  }
  .uil-calendar-alt{
    margin-left: 10px;
  }
  .uil-sun{
    display: none!important;
  }
  i.fa.fa-chevron-circle-right {
    color: var(--red-color);
    margin-right: 5px;
    filter: brightness(115%);
    margin-left: 20px;
  }
  .title-wrap{
  	border-bottom: 1px solid #222;
    margin-top: 20px;
  }
  h2.section-title {
    letter-spacing: 1px;
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.5rem;
    margin-bottom: 1rem;
    position: relative;
    display: inline-block;
    text-transform: uppercase;
    font-family: 'Poppins', sans-serif;
    color: #FFF;
    margin-top: 40px;
  }
  h2.section-title:after {
    content: "";
    position: absolute;
    height: 4px;
    width: 50px;
    left: 0;
    bottom: -1rem;
    background: #ce1212;
  }
  h2.section-title.top {
    margin-top: 0;
  }
  .pagination {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin: -40px 0 50px;
    flex-wrap: wrap;
  }
  .page-link {
    padding: 8px 12px;
    text-decoration: none;
    color: var(--black-color);
    background: var(--light-gray-color);
    border-radius: 6px;
    font-weight: 500;
  }
  .page-link:hover {
    background: var(--border-color);
  }
  .page-link.active {
    background: var(--red-color);
    color: var(--black-color);
    pointer-events: none;
  }
  .thumbnail-container {
    position: relative;
    overflow: hidden;
  }
  .thumbnail-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7); /* gelap saat hover */
    opacity: 0;
    transition: opacity 0.25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .thumbnail-container:hover .thumbnail-overlay {
    opacity: 1;
  }
  .play-icon {
    color: #cdcdcd;
    font-size: 25px;
    pointer-events: none;
  }
  .swiper-container {
    width: 100%;
    margin: auto;
    padding: 10px 0;
    padding-top: 20px;
    overflow: hidden;
  }
  .swiper-slide {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    padding-bottom: 56.25%;
  }
  .swiper-slide img {
    position: absolute; 
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 5px;
  }
  .slider-title {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 10px;
    color: #FFF;
    font-size: 13px;
    text-align: left;
    box-sizing: border-box;
    background: linear-gradient(
        to top, 
        rgba(0, 0, 0, 0.7) 0px, 
        rgba(0, 0, 0, 0.5) 25px, 
        rgba(0, 0, 0, 0.3) 30px, 
        rgba(0, 0, 0, 0) 40px
    );
    display: block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 10px;
    box-shadow: 0 15px 0 #101010c4;
  }
  @media (min-width: 768px) {
    .toggle{
      display: none;
    }
    .content-wrapper .video-list .video-card .duration {
      font-size: 13px;
    }
    .swiper-container{
      display: none;
    }
  }
  @media (max-width: 768px) {
    .navbar {
      gap: 1rem;
    }
    .navbar .nav-center,
     body.show-mobile-search .navbar .nav-left,
     body.show-mobile-search .navbar .nav-right {
       display: none;
    }
    .navbar .nav-right .search-button,
    body.show-mobile-search .navbar .search-back-button,
    body.show-mobile-search .navbar .nav-center {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .main-layout .screen-overlay {
      position: absolute;
      left: 0;
      top: 0;
      z-index: 15;
      width: 100%;
      height: 100vh;
      background: var(--overlay-dark-color);
      transition: 0.2s ease;
    }
    body.sidebar-hidden .main-layout .screen-overlay {
      opacity: 0;
      pointer-events: none;
    }
    .main-layout .sidebar {
      display: unset !important;
      position: absolute;
      left: 0;
      top: 0;
      z-index: 20;
      height: 100vh;
      transition: 0.2s ease;
    }
    body.sidebar-hidden .main-layout .sidebar {
      left: -280px;
    }
    .main-layout .sidebar .nav-left {
      display: flex;
    }
    :where(.navbar, .sidebar) .nav-logo {
      width: 100%;
    }
    .navbar .search-form .search-input {
      margin-left: 0;
    }
    i.fa.fa-chevron-circle-right {
      margin-left: 0;
    }
    .content-wrapper .video-list .video-card .title {
      font-size: 11px;
    }
    .content-wrapper .video-list .video-card .views {
      font-size: 8px;
    }  
  }
  @media (max-width: 562px) {
    .content-wrapper .video-list {
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    }
  }
  @media (max-width: 462px) {
    .content-wrapper .video-list {
      grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    }
  }
  @media (max-width: 362px) {
    .content-wrapper .video-list {
       grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    }
  }
</style>