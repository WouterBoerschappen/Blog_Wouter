<header style="background-color: #fff; color: black; padding: 20px; text-align: center; position: relative;">
  <div class="header-container" style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; position: relative;">

    <!-- Linkjes links -->
    <div class="header-left" style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap; min-width: 0;">
      <a href="/blog/" class="hover-link">Home</a>
      <a href="/blog/overons.php" class="hover-link2">Over ons</a>
      <a href="#" class="hover-link">Categorieën</a>
      <a href="#" class="hover-link2">Posts</a>
    </div>

    <!-- Logo absoluut in het midden -->
    <div class="header-center" style="position: absolute; left: 50%; transform: translateX(-50%);">
      <a href="https://www.boerschappen.nl/" style="display: inline-block;">
        <img src="assets/boerschappen_logo_zwart.png" alt="Boerschappen Logo" style="height: 30px;">
      </a>
    </div>

    <!-- Rechterkant -->
    <div class="header-right" style="display: flex; align-items: center; gap: 20px; position: relative; min-width: 0; margin-right: -28px;">
      <input id="search-bar" type="text" placeholder="Zoek op onderwerp"
        style="width: 0; opacity: 0; visibility: hidden; padding: 5px 0; border: 1px solid transparent; border-radius: 5px; background: white; transition: width 0.3s ease, opacity 0.3s ease; pointer-events: none;">
      <img id="search-icon" src="assets/search-svgrepo-com.svg" alt="Zoek icoon" style="height: 20px; cursor: pointer;">
      <a href="https://www.boerschappen.nl" class="hover-link" style="display: flex; align-items: center; gap: 5px; font-weight: bold; text-decoration: none;">
        Terug naar Boerschappen
        <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" fill="none" style="margin-top:4px;">
          <path d="M9.71069 18.2929C10.1012 18.6834 10.7344 18.6834 11.1249 18.2929L16.0123 13.4006C16.7927 12.6195 16.7924 11.3537 16.0117 10.5729L11.1213 5.68254C10.7308 5.29202 10.0976 5.29202 9.70708 5.68254C9.31655 6.07307 9.31655 6.70623 9.70708 7.09676L13.8927 11.2824C14.2833 11.6729 14.2833 12.3061 13.8927 12.6966L9.71069 16.8787C9.32016 17.2692 9.32016 17.9023 9.71069 18.2929Z" fill="currentColor"/>
        </svg>
      </a>
    </div>
  </div>

  <!-- Styles en script -->
  <style>
    .arrow-rotated {
      transform: rotate(180deg);
      transition: transform 0.3s;
    }

    .hover-link {
      color: #000 !important;
      transition: color 0.2s;
      text-decoration: none;
      font-weight: normal;
      display: flex;
      align-items: center;
    }

    .hover-link:hover {
      color: #707952 !important;
    }

    .hover-link2 {
      color: #000 !important;
      transition: color 0.2s;
      text-decoration: none;
      font-weight: normal;
      display: flex;
      align-items: center;
    }

    .hover-link2:hover {
      color: #eeaf92 !important;
    }

    .hover-link:hover img,
    .hover-link:hover .arrow-icon {
      fill: #707952 !important;
    }

    #search-bar.active {
      width: 150px !important;
      opacity: 1 !important;
      visibility: visible !important;
      padding: 5px 10px !important;
      border-color: #ccc !important;
      pointer-events: auto !important;
    }

    .header-container,
    .header-container * {
      font-family: 'Outfit', Arial, sans-serif;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const searchIcon = document.getElementById('search-icon');
      const searchBar = document.getElementById('search-bar');

      // Zoekbalk functionaliteit
      searchIcon.addEventListener('click', function (e) {
        e.stopPropagation();
        searchBar.classList.add('active');
        searchBar.focus();
      });

      searchBar.addEventListener('click', function (e) {
        e.stopPropagation();
      });

      document.addEventListener('click', function () {
        if (searchBar.classList.contains('active')) {
          searchBar.classList.remove('active');
        }
      });
    });
  </script>
</header>
