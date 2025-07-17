<div class="item-card" data-category="<?= $item['category'] ?>">
    <?php if (isset($item['badge'])): ?>
    <div class="card-badge <?= $item['badge_class'] ?? '' ?>"
         data-lang-en="<?= $item['badge'] ?>"
         data-lang-ta="<?= $item['badge_ta'] ?? $item['badge'] ?>"
         data-lang-hi="<?= $item['badge_hi'] ?? $item['badge'] ?>">
        <?= $item['badge'] ?>
    </div>
    <?php endif; ?>
    
    <div class="card-image">
        <img src="<?= $item['image'] ?>" 
             alt="<?= $current_lang == 'ta' ? ($item['name_ta'] ?? $item['name']) : 
                  ($current_lang == 'hi' ? ($item['name_hi'] ?? $item['name']) : $item['name']) ?>" 
             loading="lazy">
        <button class="quick-view-btn" data-id="<?= $item['id'] ?>">
            <i class="fas fa-search-plus"></i>
            <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
        </button>
    </div>
    
    <div class="card-content">
        <div class="card-header">
            <h3 data-lang-en="<?= $item['name'] ?>"
                data-lang-ta="<?= $item['name_ta'] ?? $item['name'] ?>"
                data-lang-hi="<?= $item['name_hi'] ?? $item['name'] ?>">
                <?= $item['name'] ?>
            </h3>
            <div class="rating">
                <i class="fas fa-star"></i>
                <span><?= $item['rating'] ?? 4.5 ?></span>
                <span class="review-count">(<?= $item['reviews'] ?? 100 ?>)</span>
            </div>
        </div>
        
        <p class="card-description"
           data-lang-en="<?= $item['description'] ?>"
           data-lang-ta="<?= $item['description_ta'] ?? $item['description'] ?>"
           data-lang-hi="<?= $item['description_hi'] ?? $item['description'] ?>">
            <?= $item['description'] ?>
        </p>
        
        <div class="card-footer">
            <div class="price">
                <span class="current-price">₹<?= $item['price'] ?></span>
            </div>
            <div class="add-to-cart">
                <div class="quantity-selector">
                    <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
                    <input type="number" min="1" value="1" class="qty-input">
                    <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
                </div>
                <button class="add-cart-btn"
                        data-id="<?= $item['id'] ?>"
                        data-type="<?= $category ?>"
                        data-name="<?= $item['name'] ?>"
                        data-name-ta="<?= $item['name_ta'] ?? $item['name'] ?>"
                        data-name-hi="<?= $item['name_hi'] ?? $item['name'] ?>"
                        data-price="<?= $item['price'] ?>"
                        data-image="<?= $item['image'] ?>">
                    <i class="fas fa-shopping-cart"></i>
                    <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
                </button>
            </div>
        </div>
    </div>
</div>