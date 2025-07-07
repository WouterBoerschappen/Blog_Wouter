<header style="background-color: #fff; color: black; padding: 48px 20px 20px 20px; text-align: center; position: relative;">
  <div class="header-container" style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; position: relative;">
    
    <!-- Logo absoluut in het midden -->
    <div class="header-center" style="position: absolute; left: 50%; transform: translateX(-50%);">
      <a href="/blog" style="display: inline-block;">
        <img src="assets/boerschappen_logo_zwart.png" alt="Boerschappen Logo" style="height: 30px;">
      </a>
      <div class="header-mobile-nav" style="display: none; flex-direction: row; justify-content: center; align-items: center; gap: 16px; margin-top: 12px;">
        <a href="/blog/" class="nav-link">Home</a>
        <a href="https://www.boerschappen.nl/over-boerschappen/" class="nav-link2">Over ons</a>
        <a href="/blog/Tags.php" class="nav-link">Categorieën</a>
      </div>
    </div>

    <!-- Desktop navigatie -->
    <nav class="header-left" style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap; min-width: 0;">
      <a href="/blog/" class="nav-link">Home</a>
      <a href="https://www.boerschappen.nl/over-boerschappen/" class="nav-link2">Over ons</a>
      <a href="/blog/Tags.php" class="nav-link">Categorieën</a>
    </nav>

    <!-- Terug naar Boerschappen -->
    <div class="header-right" style="display: flex; align-items: center; gap: 16px;">
      <a href="https://www.boerschappen.nl" class="footer-static-link header-boerschappen-link" style="color: #000; font-weight: 600;">
        Terug naar Boerschappen
        <span class="arrow-icon" style="display: inline-flex; vertical-align: middle;">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 2px;">
            <path d="M9.71069 18.2929C10.1012 18.6834 10.7344 18.6834 11.1249 18.2929L16.0123 13.4006C16.7927 12.6195 16.7924 11.3537 16.0117 10.5729L11.1213 5.68254C10.7308 5.29202 10.0976 5.29202 9.70708 5.68254C9.31655 6.07307 9.31655 6.70623 9.70708 7.09676L13.8927 11.2824C14.2833 11.6729 14.2833 12.3061 13.8927 12.6966L9.71069 16.8787C9.32016 17.2692 9.32016 17.9023 9.71069 18.2929Z" fill="#000"/>
          </svg>
        </span>
      </a>
    </div>
  </div>

  <style>
    .nav-link {
      color: #3C332D !important;
      transition: color 0.2s;
      text-decoration: none;
      font-weight: normal;
      display: flex;
      align-items: center;
    }

        .nav-link2 {
      color: #3C332D !important;
      transition: color 0.2s;
      text-decoration: none;
      font-weight: normal;
      display: flex;
      align-items: center;
    }

    .nav-link:hover {
      color: #80885E !important;
    }

        .nav-link2:hover {
      color: #505A3D !important;
    }

    .arrow-rotated {
      transform: rotate(180deg);
      transition: transform 0.3s;
    }

    #search-bar-mobile.active, #search-bar-desktop.active {
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

    .footer-static-link {
      text-decoration: underline !important; /* Show underline by default */
      transition: text-decoration-color 0.4s ease, opacity 0.4s ease;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      text-underline-position: under;
      text-decoration-thickness: 2px;
      text-underline-offset: 2px;
      font-weight: 600;
      text-decoration-color: #000 !important; /* Black underline for header */
    }

    .footer-static-link:hover {
      text-decoration-color: transparent !important; /* Fade to transparent on hover */
      opacity: 1;
      text-decoration-skip-ink: none;
    }

    .footer-static-link .arrow-icon {
      margin-top: 4px;
      vertical-align: middle;
      text-decoration: inherit;
    }

    .footer-static-link.header-boerschappen-link {
      color: #000 !important;
      text-decoration-color: #000 !important; /* Ensure black underline */
    }

    .footer-static-link.header-boerschappen-link:hover {
      text-decoration-color: transparent !important; /* Fade away on hover */
    }

    .footer-static-link.header-boerschappen-link .arrow-icon svg path {
      fill: #000 !important;
    }

    /* Toon/verberg juiste zoekbalk en icoon op mobiel/desktop */
    @media (max-width: 700px) {
      .header-left,
      .header-right {
        display: none !important;
      }
      .header-mobile-nav {
        display: flex !important;
      }
      #search-bar-mobile,
      #search-icon-mobile {
        display: inline-block !important;
      }
      #search-bar-desktop,
      #search-icon-desktop {
        display: none !important;
      }
    }

    @media (min-width: 701px) {
      .header-mobile-nav {
        display: none !important;
      }
      .header-left,
      .header-right {
        display: flex !important;
      }
      #search-bar-mobile,
      #search-icon-mobile {
        display: none !important;
      }
      #search-bar-desktop,
      #search-icon-desktop {
        display: inline-block !important;
      }
    }
  </style>
</header>
