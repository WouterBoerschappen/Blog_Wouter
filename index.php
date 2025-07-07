<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Blog Boerschappen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
        <?php include 'header.php'; ?>
        <div style="height: 40px;"></div>

    <div class="content">
<div class="farm-banner">
  <img src="assets/aardappel.webp"      class="Boerschappen aardappel" alt="aardappel">
  <img src="assets/pompoen.webp"       class="Boerschappen pompoen" alt="pompoen">
  <img src="assets/rodeui.webp"         class="Boerschappen rodeUi" alt="rode ui">
  <img src="assets/setjeTomaten.webp"   class="Boerschappen setjeTomaten" alt="tomaten">
  <img src="assets/walnoot.webp"        class="Boerschappen walnoot" alt="walnoot">
  <img src="assets/paddenstoel.webp"    class="Boerschappen paddenstoel" alt="paddenstoel">
  <img src ="assets/radijs.webp"         class="Boerschappen radijs" alt="radijs">
  <img src ="assets/walnoot2.webp"       class="Boerschappen walnoot2" alt="walnoot2">
  <img src ="assets/tomaat1.webp"       class="Boerschappen tomaat1" alt="tomaat1">
  <img src ="assets/kaas.webp"      class="Boerschappen kaas" alt="kaas">
  <img src ="assets/paksoi.webp"        class="Boerschappen paksoi" alt="paksoi">

  <div class="farm-content">
      <h1>Boerschappen Blog</h1>
      <p>Elke week vers van het land, lokaal geoogst en met zorg bij jou thuisbezorgd.</p>
      <a href="#alle-blogs" class="farm-btn">
        Bekijk alle Posts
        <img src="assets/arrow-next-small-svgrepo-com.svg" alt="Next" class="btn-icon">
      </a>
  </div>
</div>

<div class="main-section">
  <h1 class="main-section-title" id="alle-blogs" style="margin-top:120px;">Alle Blogs</h1>
  <div class="blogs-list">
    <?php
    // Pagination settings
    $postsPerPage = 6;
    $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($currentPage - 1) * $postsPerPage;
    
    // Get all markdown files from posts directory
    $mdFiles = glob(__DIR__ . '/posts/*.md');
    $totalPosts = count($mdFiles);
    $totalPages = ceil($totalPosts / $postsPerPage);
    
    // Get posts for current page
    $currentPageFiles = array_slice($mdFiles, $offset, $postsPerPage);
    
    foreach ($currentPageFiles as $mdFile) {
        $content = file_get_contents($mdFile);
        if (preg_match('/^---(.*?)---(.*)$/s', $content, $matches)) {
            $yaml = trim($matches[1]);
            $body = trim($matches[2]);
            $meta = [];
            foreach (explode("\n", $yaml) as $line) {
                if (preg_match('/^([a-zA-Z0-9_]+):\s*"(.*)"$/', $line, $kv)) {
                    $meta[$kv[1]] = $kv[2];
                }
            }
        } else {
            $meta = [];
            $body = $content;
        }
        $slug = !empty($meta['seo.slug']) ? $meta['seo.slug'] : (isset($meta['title']) ? strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($meta['title']))) : basename($mdFile, '.md'));
        $slug = trim($slug, '-');
        ?>
        <a class="blog-item-link" href="blog.php?slug=<?= urlencode($slug) ?>">
          <div class="blog-item">
            <?php if (!empty($meta['cover'])): ?>
              <img src="<?= htmlspecialchars($meta['cover']) ?>" alt="cover">
            <?php endif; ?>
            <div class="blog-item-content">
              <h2><?= htmlspecialchars($meta['title'] ?? basename($mdFile, '.md')) ?></h2>
              <div class="blog-meta">
                <?php if (!empty($meta['category'])): ?>
                  <span>🌽 <?= htmlspecialchars($meta['category']) ?></span>
                <?php endif; ?>
                <?php if (!empty($meta['tags'])): ?>
                  <span>🍄‍🟫 <?= htmlspecialchars($meta['tags']) ?></span>
                <?php endif; ?>
                <?php if (!empty($meta['author'])): ?>
                  <span>👤 <?= htmlspecialchars($meta['author']) ?></span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </a>
        <?php
    }
    ?>
  </div>
  
  <?php if ($totalPages > 1): ?>
  <div class="pagination">
    <?php if ($currentPage > 1): ?>
      <a href="?page=<?= $currentPage - 1 ?>#alle-blogs" class="pagination-btn pagination-prev">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
          <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Vorige
      </a>
    <?php endif; ?>
    
    <div class="pagination-numbers">
      <?php
      $startPage = max(1, $currentPage - 2);
      $endPage = min($totalPages, $currentPage + 2);
      
      if ($startPage > 1) {
        echo '<a href="?page=1#alle-blogs" class="pagination-number">1</a>';
        if ($startPage > 2) {
          echo '<span class="pagination-dots">...</span>';
        }
      }
      
      for ($i = $startPage; $i <= $endPage; $i++) {
        $activeClass = $i == $currentPage ? ' active' : '';
        echo '<a href="?page=' . $i . '#alle-blogs" class="pagination-number' . $activeClass . '">' . $i . '</a>';
      }
      
      if ($endPage < $totalPages) {
        if ($endPage < $totalPages - 1) {
          echo '<span class="pagination-dots">...</span>';
        }
        echo '<a href="?page=' . $totalPages . '#alle-blogs" class="pagination-number">' . $totalPages . '</a>';
      }
      ?>
    </div>
    
    <?php if ($currentPage < $totalPages): ?>
      <a href="?page=<?= $currentPage + 1 ?>#alle-blogs" class="pagination-btn pagination-next">
        Volgende
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
          <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    <?php endif; ?>
  </div>
  <?php endif; ?>
</div>
    </div>
    <?php include 'footer.php'; ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
  console.log('Script loaded'); // Debug line
  
  // Check if we're on mobile
  function isMobile() {
    return window.innerWidth <= 700;
  }
  
  // Get all vegetables
  const vegetables = document.querySelectorAll('.Boerschappen');
  console.log('Found vegetables:', vegetables.length); // Debug line
  
  // Function to add mobile handlers
  function addMobileHandlers() {
    vegetables.forEach(function(veggie, index) {
      console.log('Adding handler to veggie', index); // Debug line
      
      // Remove existing listeners first
      veggie.removeEventListener('click', handleVeggieClick);
      
      // Add click handler
      veggie.addEventListener('click', handleVeggieClick);
      veggie.style.cursor = 'pointer';
      
      // Add touch feedback
      veggie.addEventListener('touchstart', function() {
        this.style.transform = 'scale(0.95)';
      });
      
      veggie.addEventListener('touchend', function() {
        setTimeout(() => {
          if (!this.classList.contains('weg')) {
            this.style.transform = '';
          }
        }, 100);
      });
    });
  }
  
  // Click handler function
  function handleVeggieClick(e) {
    e.preventDefault();
    console.log('Veggie clicked!'); // Debug line
    
    // Add disappearing animation class
    this.classList.add('weg');
    
    // Remove the element after animation completes
    setTimeout(() => {
      this.style.display = 'none';
      console.log('Veggie hidden'); // Debug line
    }, 700);
  }
  
  // Initialize on mobile
  if (isMobile()) {
    console.log('Mobile detected, adding handlers'); // Debug line
    addMobileHandlers();
  }
  
  // Re-check on window resize
  window.addEventListener('resize', function() {
    if (isMobile()) {
      addMobileHandlers();
    } else {
      vegetables.forEach(function(veggie) {
        veggie.style.cursor = 'auto';
        veggie.removeEventListener('click', handleVeggieClick);
      });
    }
  });

  // Scroll animation for blog posts
  const blogItems = document.querySelectorAll('.blog-item');
  
  function checkScroll() {
    blogItems.forEach(function(item) {
      const rect = item.getBoundingClientRect();
      const isVisible = rect.top < window.innerHeight - 100;
      
      if (isVisible && !item.classList.contains('animate-in')) {
        item.classList.add('animate-in');
      }
    });
  }
  
  // Initial check
  checkScroll();
  
  // Check on scroll with throttling
  let scrollTimeout;
  window.addEventListener('scroll', function() {
    if (scrollTimeout) {
      clearTimeout(scrollTimeout);
    }
    scrollTimeout = setTimeout(checkScroll, 10);
  });
});
</script>
