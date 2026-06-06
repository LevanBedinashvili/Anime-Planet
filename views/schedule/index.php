<div class="catalog" style="margin-top: 80px; min-height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="profile__content" style="margin-bottom: 30px;">
                    <div class="profile__user">
                        <div class="profile__meta">
                            <h3 style="color:white; font-size:28px;">კვირის განრიგი</h3>
                            <span style="color:#ff55a5; font-size:18px;">მიმდინარე სეზონის ანიმეები</span>
                        </div>
                    </div>
                </div>

                <!-- Days Navigation -->
                <div style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:40px;">
                    <?php foreach ($days as $key => $label): ?>
                        <a href="/schedule?day=<?= $key ?>" 
                           style="padding: 10px 20px; border-radius: 4px; color: white; font-size: 16px; text-decoration: none; <?= $currentDay === $key ? 'background: #ff55a5; font-weight: bold;' : 'background: #2b2b31;' ?> transition: 0.3s;">
                            <?= $label ?>
                        </a>
                    <?php endforeach; ?>
                </div>

                <!-- Anime Grid -->
                <div class="row row--grid">
                    <?php if (!empty($animeList)): ?>
                        <?php foreach ($animeList as $anime): ?>
                            <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                                <div class="card">
                                    <a href="/details/<?= htmlspecialchars((string)$anime['mal_id']) ?>" class="card__cover">
                                        <img src="<?= htmlspecialchars($anime['images']['jpg']['image_url'] ?? '/img/card/1.png') ?>" alt="">
                                    </a>
                                    <button class="card__add" type="button" onclick="addToWatchlist(<?= htmlspecialchars((string)$anime['mal_id']) ?>)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white"><path d="M16,2H8A3,3,0,0,0,5,5V21a1,1,0,0,0,.5.87,1,1,0,0,0,1,0L12,18.69l5.5,3.18A1,1,0,0,0,18,22a1,1,0,0,0,.5-.13A1,1,0,0,0,19,21V5A3,3,0,0,0,16,2Zm1,17.27-4.5-2.6a1,1,0,0,0-1,0L7,19.27V5A1,1,0,0,1,8,4h8a1,1,0,0,1,1,1Z"/></svg></button>
                                    <span class="card__rating">⭐ <?= htmlspecialchars((string)($anime['score'] ?? 'N/A')) ?></span>
                                    <h3 class="card__title"><a href="/details/<?= htmlspecialchars((string)$anime['mal_id']) ?>"><?= htmlspecialchars($anime['title'] ?? 'Unknown') ?></a></h3>
                                    <ul class="card__list">
                                        <li><?= htmlspecialchars($anime['type'] ?? 'TV') ?></li>
                                        <li style="color:#ff55a5;"><?= htmlspecialchars($anime['broadcast']['time'] ?? 'Unknown') ?> (JST)</li>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: white; font-size:16px;">ამ დღეს ანიმე არ გამოდის.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
