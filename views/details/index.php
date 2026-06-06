<?php if ($anime): ?>
<!-- details -->
<section class="section details" style="margin-top: 80px;">
    <div class="details__bg" data-bg="<?= htmlspecialchars($anime['images']['jpg']['large_image_url'] ?? '') ?>"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="details__title" style="color: #fff; font-weight: bold; margin-bottom: 30px;"><?= htmlspecialchars($anime['title'] ?? 'Unknown') ?></h1>
            </div>

            <div class="col-12 col-xl-6">
                <div class="card card--details">
                    <div class="row">
                        <!-- Left column: Image + Watchlist -->
                        <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-5">
                            <div class="card__cover" style="margin-bottom: 20px;">
                                <img src="<?= htmlspecialchars($anime['images']['jpg']['image_url'] ?? '') ?>" alt="">
                            </div>
                            <button class="sign__btn" type="button" onclick="addToWatchlist(<?= htmlspecialchars((string)$anime['mal_id']) ?>)" style="width:100%; margin-bottom: 30px;">
                                სიაში დამატება
                            </button>
                        </div>

                        <!-- Right column: Meta Info -->
                        <div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                            <div class="card__content">
                                <ul class="card__meta" style="color: white; margin-bottom: 20px;">
                                    <li style="margin-bottom: 10px;"><span style="color: #ff55a5; font-weight: bold; margin-right: 10px;">ქულა:</span> ⭐ <?= htmlspecialchars((string)($anime['score'] ?? 'N/A')) ?></li>
                                    <li style="margin-bottom: 10px;"><span style="color: #ff55a5; font-weight: bold; margin-right: 10px;">ტიპი:</span> <?= htmlspecialchars($anime['type'] ?? 'TV') ?></li>
                                    <li style="margin-bottom: 10px;"><span style="color: #ff55a5; font-weight: bold; margin-right: 10px;">ეპიზოდები:</span> <?= htmlspecialchars((string)($anime['episodes'] ?? '?')) ?></li>
                                    <li style="margin-bottom: 10px;"><span style="color: #ff55a5; font-weight: bold; margin-right: 10px;">სტატუსი:</span> <?= htmlspecialchars($anime['status'] ?? 'Unknown') ?></li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Full width description -->
                        <div class="col-12">
                            <div class="card__description details__description" style="border-top: 1px solid #222831; padding-top: 20px; margin-top: 20px;">
                                <p style="color: #e0e0e0; font-size: 15px; line-height: 1.8; margin: 0;"><?= nl2br(htmlspecialchars($anime['synopsis'] ?? 'აღწერა არ არის.')) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if (!empty($anime['trailer']['embed_url'])): ?>
            <div class="col-12 col-xl-6">
                <iframe width="100%" height="315" style="border-radius: 8px;" src="<?= htmlspecialchars($anime['trailer']['embed_url']) ?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<!-- end details -->
<?php else: ?>
    <div class="container"><h1 style="color:white; margin-top:100px;">ანიმე არ მოიძებნა</h1></div>
<?php endif; ?>