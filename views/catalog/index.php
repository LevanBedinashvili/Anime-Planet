<!-- catalog -->
<div class="catalog" style="margin-top: 80px;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="catalog__nav">
                    <form action="/catalog" method="GET" style="display:flex; gap:15px; width:100%; align-items:center; flex-wrap: wrap; position: relative; z-index: 2;">
                        <input type="text" name="q" value="<?= htmlspecialchars($query) ?>" placeholder="მოძებნე ანიმე..." style="background: #2b2b31; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; flex-grow: 1; min-width: 200px;">
                        
                        <select name="order_by" style="background: #2b2b31; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
                            <option value="score" <?= (\Core\Request::input('order_by') == 'score') ? 'selected' : '' ?>>ქულით სორტირება</option>
                            <option value="title" <?= (\Core\Request::input('order_by') == 'title') ? 'selected' : '' ?>>სახელით სორტირება</option>
                            <option value="favorites" <?= (\Core\Request::input('order_by') == 'favorites') ? 'selected' : '' ?>>რჩეულებით სორტირება</option>
                        </select>

                        <select name="sort" style="background: #2b2b31; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
                            <option value="desc" <?= (\Core\Request::input('sort') == 'desc') ? 'selected' : '' ?>>კლებადობით</option>
                            <option value="asc" <?= (\Core\Request::input('sort') == 'asc') ? 'selected' : '' ?>>ზრდადობით</option>
                        </select>

                        <button type="submit" style="background: #ff55a5; color: #fff; border: none; padding: 10px 30px; border-radius: 4px; cursor: pointer;">გაფილტვრა</button>
                    </form>
                </div>

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
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: white;">ანიმე არ მოიძებნა.</p>
                    <?php endif; ?>
                </div>
                
                <?php if (!empty($pagination) && isset($pagination['has_next_page']) && $pagination['has_next_page']): ?>
                    <div style="text-align:center; margin-top: 20px;">
                        <a href="/catalog?q=<?= urlencode($query) ?>&page=<?= ($pagination['current_page'] ?? 1) + 1 ?>" style="color: #ff55a5; font-size: 18px;">შემდეგი გვერდი</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- end catalog -->