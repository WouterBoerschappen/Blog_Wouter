<?php
// Zoek het juiste .md bestand op basis van de slug
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$found = false;
foreach (glob(__DIR__ . '/posts/*.md') as $mdFile) {
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
        $fileSlug = !empty($meta['seo.slug']) ? $meta['seo.slug'] : (isset($meta['title']) ? strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($meta['title']))) : basename($mdFile, '.md'));
        $fileSlug = trim($fileSlug, '-');
        if ($fileSlug === $slug) {
            $found = true;
            break;
        }
    }
}
if (!$found) {
    http_response_code(404);
    echo "<h1>Blog niet gevonden</h1>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($meta['title'] ?? 'Blog') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .blog-md-full-cover {
            width: 100%;
            height: auto; /* Laat afbeelding originele hoogte behouden */
            overflow: visible;
        }
        
        .blog-md-full-cover img {
            width: 100%;
            height: auto; /* Houd originele beeldverhouding */
            object-fit: contain; /* Toon volledige afbeelding */
            display: block;
        }
        
        .blog-md-full-content h2 {
            font-size: 1.4rem;
            margin-bottom: 12px;
            color: #3C332D;
            line-height: 1.3;
        }
        
        .blog-md-full-meta {
            color: #a68c7b;
            font-size: 0.9rem;
            margin-bottom: 25px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            font-weight: 500;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .blog-md-author, .blog-md-category {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: none;
            color: #a68c7b;
            padding: 0;
            border-radius: 0;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .blog-post-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .blog-post-header {
            margin-bottom: 20px;
        }
        
        .blog-post-title {
            font-size: 2.5rem;
            margin: 0;
            color: #3C332D;
            word-wrap: break-word;
            line-height: 1.2;
        }
        
        /* Mobile responsive fixes for title */
        @media (max-width: 768px) {
            .blog-post-title {
                font-size: 1.8rem;
                line-height: 1.3;
                word-break: break-word;
                hyphens: auto;
            }
        }
        
        @media (max-width: 480px) {
            .blog-post-title {
                font-size: 1.6rem;
                line-height: 1.4;
                text-align: left;
                padding: 0 5px;
            }
            
            .blog-post-container {
                padding: 15px 10px;
            }
        }
        
        .blog-post-meta {
            color: #a68c7b;
            font-size: 0.9rem;
            margin: 10px 0;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .blog-post-cover {
            width: 100%;
            height: 350px;
            margin: 20px auto;
            display: block;
            max-width: 800px;
            object-fit: contain;
            border-radius: 0;
            border: none;
            outline: none;
            box-shadow: none;
        }
        
        .blog-post-content {
            font-size: 1rem;
            line-height: 1.6;
            color: #333;
        }
        
        .blog-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: #4e593d;
            padding: 10px 0;
            border-radius: 0;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .blog-back-btn:hover {
            color: #a4ad87;
        }
        
        .blog-back-btn svg {
            fill: currentColor;
            stroke: currentColor;
        }
        
        .box-section {
            margin: 40px 0;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .box-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .box-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        
        .box-content {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .box-text h2 {
            font-size: 1.8rem;
            margin: 0;
            color: #333;
        }
        
        .box-text p {
            margin: 0;
            color: #666;
        }
        
        .box-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            background-color: #4e593d;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        
        .box-btn:hover {
            background-color: #3c442d;
        }
        
        .btn-icon {
            width: 16px;
            height: 16px;
            margin-left: 8px;
            fill: currentColor;
            stroke: currentColor;
        }
        /* Recipe Section */
.recipe-section {
    width: 100vw;
    margin: 60px 0;
    margin-left: calc(-50vw + 50%);
    max-width: none;
}

.recipe-container {
    display: flex;
    align-items: center;
    gap: 40px;
    background: #80885E;
    border-radius: 0;
    padding: 40px 0;
    box-shadow: 0 4px 20px rgba(60, 51, 45, 0.1);
    position: relative;
    max-width: none;
    width: 100%;
    transform: skew(-1deg, 0.5deg);
}

.recipe-container > * {
    transform: skew(1deg, -0.5deg);
}

.recipe-image {
    flex: 1;
    display: flex;
    justify-content: center;
}

.recipe-image img {
    max-width: 100%;
    height: auto;
    border-radius: 0;
}

.recipe-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 24px;
    padding-left: 20px;
}

.recipe-text h2 {
    font-size: 2.5rem;
    color: #ffffff;
    margin-bottom: 16px;
    line-height: 1.2;
}

.recipe-text p {
    font-size: 1.2rem;
    color: #ffffff;
    line-height: 1.6;
    margin: 0;
}
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div style="height: 40px;"></div>

    <div class="content">
        <div class="blog-post-container">
            <?php
            $slug = $_GET['slug'] ?? '';
            $found = false;
            
            if ($slug) {
                $mdFiles = glob(__DIR__ . '/posts/*.md');
                
                foreach ($mdFiles as $mdFile) {
                    $content = file_get_contents($mdFile);
                    if (preg_match('/^---(.*?)---(.*)$/s', $content, $matches)) {
                        $yaml = trim($matches[1]);
                        $body = trim($matches[2]);
                        $meta = [];
                        foreach (explode("\n", $yaml) as $line) {
                            if (preg_match('/^([a-zA-Z0-9_.]+):\s*"(.*)"$/', $line, $kv)) {
                                $meta[$kv[1]] = $kv[2];
                            }
                        }
                    } else {
                        $meta = [];
                        $body = $content;
                    }
                    
                    $fileSlug = !empty($meta['seo.slug']) ? $meta['seo.slug'] : (isset($meta['title']) ? strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($meta['title']))) : basename($mdFile, '.md'));
                    $fileSlug = trim($fileSlug, '-');
                    
                    if ($fileSlug === $slug) {
                        $found = true;
                        ?>
                        <?php if (!empty($meta['cover'])): ?>
                            <img src="<?= htmlspecialchars($meta['cover']) ?>" alt="Blog Cover" class="blog-post-cover">
                        <?php endif; ?>
                        
                        <div class="blog-post-header">
                            <h1 class="blog-post-title"><?= htmlspecialchars($meta['title'] ?? 'Blog Post') ?></h1>
                            
                            <div class="blog-post-meta">
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
                        
                        <div class="blog-post-content">
                            <?php
                            // Convert markdown formatting to HTML
                            $htmlContent = $body;
                            
                            // Convert **bold** to <strong>
                            $htmlContent = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $htmlContent);
                            
                            // Convert __bold__ to <strong>
                            $htmlContent = preg_replace('/__(.*?)__/', '<strong>$1</strong>', $htmlContent);
                            
                            // Convert *italic* to <em>
                            $htmlContent = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $htmlContent);
                            
                            // Convert _italic_ to <em>
                            $htmlContent = preg_replace('/_(.*?)_/', '<em>$1</em>', $htmlContent);
                            
                            // Convert newlines to <br> tags
                            echo nl2br($htmlContent);
                            ?>
                        </div>
                        
                        <?php
                        // Randomly show either box or recipe section
                        $showBox = rand(0, 1);
                        if ($showBox) {
                            // Show box section
                            ?>
    <div class="content">
        <div class="box-section">
            <div class="box-container">
                <div class="box-image">
                    <img src="assets/Gemaksbox Vegan.png" alt="Boerschappen Box">
                </div>
                <div class="box-content">
                    <div class="box-text">
                        <h2>Ontdek onze verse producten</h2>
                        <p>Elke week een nieuwe selectie van lokale boeren, rechtstreeks bij jou thuisbezorgd.</p>
                    </div>
                    <a href="https://www.boerschappen.nl" class="box-btn">
                        Bestellen
                        <img src="assets/arrow-next-small-svgrepo-com.svg" alt="Next" class="btn-icon">
                    </a>
                </div>
            </div>
        </div>
    </div>
                            <?php
                        } else {
                            ?>
    <div style="height: 40px;"></div>

    <div class="content">
        <div class="recipe-section">
            <div class="recipe-container">
                <div class="recipe-image">
                    <img src="assets/receptkaarten.png" alt="Verse Recepten">
                </div>
                <div class="recipe-content">
                    <div class="recipe-text">
                        <h2>Verse recepten</h2>
                        <p>Heerlijke recepten met verse ingrediënten van lokale boeren.</p>
                    </div>
                    <a href="https://www.boerschappen.nl/recepten" class="recipe-btn">
                        Bekijk recepten
                        <img src="assets/arrow-next-small-svgrepo-com.svg" alt="Next" class="btn-icon">
                    </a>
                </div>
            </div>
        </div>
    </div>
                            <?php
                        }
                        ?>
                        
                                <div class="main-section">
                                <h1 class="main-section-title" id="alle-blogs" style="margin-top:120px;">Misschien ook leuk?</h1>
                                <div class="blogs-list">
                                <?php
                                // Get other blog posts (excluding current one)
                                $otherPosts = [];
                                foreach ($mdFiles as $otherMdFile) {
                                    if ($otherMdFile === $mdFile) continue; // Skip current post
                                    
                                    $otherContent = file_get_contents($otherMdFile);
                                    if (preg_match('/^---(.*?)---(.*)$/s', $otherContent, $otherMatches)) {
                                        $otherYaml = trim($otherMatches[1]);
                                        $otherMeta = [];
                                        foreach (explode("\n", $otherYaml) as $line) {
                                            if (preg_match('/^([a-zA-Z0-9_.]+):\s*"(.*)"$/', $line, $kv)) {
                                                $otherMeta[$kv[1]] = $kv[2];
                                            }
                                        }
                                        $otherSlug = !empty($otherMeta['seo.slug']) ? $otherMeta['seo.slug'] : (isset($otherMeta['title']) ? strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($otherMeta['title']))) : basename($otherMdFile, '.md'));
                                        $otherSlug = trim($otherSlug, '-');
                                        
                                        $otherPosts[] = [
                                            'meta' => $otherMeta,
                                            'slug' => $otherSlug
                                        ];
                                    }
                                }
                                
                                // Show only 2 other posts
                                shuffle($otherPosts);
                                $displayPosts = array_slice($otherPosts, 0, 2);
                                
                                foreach ($displayPosts as $otherPost):
                                ?>
                                <article class="blog-item animate-in">
                                    <a href="blog.php?slug=<?= urlencode($otherPost['slug']) ?>" class="blog-item-link">
                                        <?php if (!empty($otherPost['meta']['cover'])): ?>
                                            <img src="<?= htmlspecialchars($otherPost['meta']['cover']) ?>" alt="<?= htmlspecialchars($otherPost['meta']['title'] ?? 'Blog') ?>">
                                        <?php endif; ?>
                                        <div class="blog-item-content">
                                            <div class="blog-meta">
                                                <?php if (!empty($otherPost['meta']['category'])): ?>
                                                    <span>🌽 <?= htmlspecialchars($otherPost['meta']['category']) ?></span>
                                                <?php endif; ?>
                                                <?php if (!empty($otherPost['meta']['tags'])): ?>
                                                    <span>🍄‍🟫 <?= htmlspecialchars($otherPost['meta']['tags']) ?></span>
                                                <?php endif; ?>
                                                <?php if (!empty($otherPost['meta']['author'])): ?>
                                                    <span>👤 <?= htmlspecialchars($otherPost['meta']['author']) ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <h2><?= htmlspecialchars($otherPost['meta']['title'] ?? 'Blog Post') ?></h2>
                                        </div>
                                    </a>
                                </article>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php
                        break;
                    }
                }
            }
            
            if (!$found) {
                ?>
                <div class="blog-post-header">
                    <h1 class="blog-post-title">Blog post niet gevonden</h1>
                    <p>Sorry, de blog post die je zoekt bestaat niet.</p>
                    <a href="index.php" class="blog-back-btn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Terug naar overzicht
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>

