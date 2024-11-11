<?php
defined('_JEXEC') or die;
?>
<style>
    .articles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .article-item {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 5px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .article-item h3 {
        margin-top: 0;
        font-size: 1.2em;
    }

    .article-item p {
        color: #666;
    }
</style>

<div class="articles-grid">
    <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $article): ?>
            <?php
            // Generate the link to the full article with correct ID, alias, and category ID
            $articleLink = JRoute::_('index.php?option=com_content&view=article&id=' . $article->id . ':' . $article->alias . '&catid=' . $article->catid);
            ?>
            <div class="article-item">
                <a href="<?php echo $articleLink; ?>" class="article-link">
                    <h3><?php echo htmlspecialchars($article->title, ENT_QUOTES, 'UTF-8'); ?></h3>
                    <?php echo htmlspecialchars($article->introtext, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No articles found.</p>
    <?php endif; ?>
</div>