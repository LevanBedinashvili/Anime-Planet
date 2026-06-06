<?php use Core\Session; ?>
<!-- profile -->
<div class="catalog" style="margin-top: 80px; min-height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="profile__content" style="margin-bottom: 30px;">
                    <div class="profile__user">
                        <div class="profile__meta">
                            <h3 style="color:white; font-size:28px;">მოგესალმებით, <?= htmlspecialchars($username ?? 'User') ?>!</h3>
                            <span style="color:#ff55a5; font-size:18px;">თქვენი სია</span>
                        </div>
                    </div>
                </div>

                <div class="row row--grid">
                    <?php if (!empty($watchlist)): ?>
                        <?php foreach ($watchlist as $anime): ?>
                            <div class="col-6 col-sm-4 col-lg-3 col-xl-2" id="anime-card-<?= htmlspecialchars((string)$anime['mal_id']) ?>">
                                <div class="card">
                                    <a href="/details/<?= htmlspecialchars((string)$anime['mal_id']) ?>" class="card__cover">
                                        <img src="<?= htmlspecialchars($anime['images']['jpg']['image_url'] ?? '/img/card/1.png') ?>" alt="">
                                    </a>
                                    <button class="card__add" type="button" onclick="removeFromWatchlist(<?= htmlspecialchars((string)$anime['mal_id']) ?>)" style="background:#ff55a5;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white"><path d="M19,11H5a1,1,0,0,0,0,2H19a1,1,0,0,0,0-2Z"/></svg>
                                    </button>
                                    <span class="card__rating">⭐ <?= htmlspecialchars((string)($anime['score'] ?? 'N/A')) ?></span>
                                    <h3 class="card__title"><a href="/details/<?= htmlspecialchars((string)$anime['mal_id']) ?>"><?= htmlspecialchars($anime['title'] ?? 'Unknown') ?></a></h3>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: white; font-size:16px;">თქვენი სია ცარიელია. მოძებნეთ ანიმე!</p>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- end profile -->