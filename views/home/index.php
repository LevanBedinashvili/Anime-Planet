<!-- home -->
<style>
    .home__carousel .owl-dots {
        padding-left: 0 !important;
        justify-content: center !important;
        width: 100%;
    }
</style>
<section class="home home--static">
    <div class="home__carousel owl-carousel" id="flixtv-hero">
        <?php if (!empty($airingAnime)): ?>
            <?php foreach (array_slice($airingAnime, 0, 8) as $anime): ?>
                <div class="home__card">
                    <a href="/details/<?= htmlspecialchars((string) $anime['mal_id']) ?>">
                        <img src="<?= htmlspecialchars($anime['images']['jpg']['large_image_url'] ?? $anime['images']['jpg']['image_url'] ?? '/img/home/1.jpg') ?>"
                            alt="">
                    </a>
                    <div>
                        <h2><?= htmlspecialchars($anime['title'] ?? 'Unknown') ?></h2>
                        <ul>
                            <li><?= htmlspecialchars($anime['type'] ?? 'TV') ?></li>
                            <li><?= htmlspecialchars((string) ($anime['year'] ?? 'Airing')) ?></li>
                        </ul>
                    </div>
                    <button class="home__add" type="button"
                        onclick="addToWatchlist(<?= htmlspecialchars((string) $anime['mal_id']) ?>)"><svg
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M16,2H8A3,3,0,0,0,5,5V21a1,1,0,0,0,.5.87,1,1,0,0,0,1,0L12,18.69l5.5,3.18A1,1,0,0,0,18,22a1,1,0,0,0,.5-.13A1,1,0,0,0,19,21V5A3,3,0,0,0,16,2Zm1,17.27-4.5-2.6a1,1,0,0,0-1,0L7,19.27V5A1,1,0,0,1,8,4h8a1,1,0,0,1,1,1Z" />
                        </svg></button>
                    <span class="home__rating"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z" />
                        </svg> <?= htmlspecialchars((string) ($anime['score'] ?? 'N/A')) ?></span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <button class="home__nav home__nav--prev" data-nav="#flixtv-hero" type="button"
        style="background: rgba(0,0,0,0.5); border-radius: 50%; width: 40px; height: 40px; align-items: center; justify-content: center;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24" height="24">
            <path d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z" />
        </svg>
    </button>
    <button class="home__nav home__nav--next" data-nav="#flixtv-hero" type="button"
        style="background: rgba(0,0,0,0.5); border-radius: 50%; width: 40px; height: 40px; align-items: center; justify-content: center;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24" height="24">
            <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
        </svg>
    </button>
</section>
<!-- end home -->

<!-- content -->
<section class="content" style="margin-top: 50px;">
    <div class="content__head">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="content__title" style="color: #fff; margin-bottom: 20px;">ტოპ ანიმე</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row row--grid">
            <?php if (!empty($topAnime)): ?>
                <?php foreach (array_slice($topAnime, 0, 12) as $anime): ?>
                    <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                        <div class="card">
                            <a href="/details/<?= htmlspecialchars((string) $anime['mal_id']) ?>" class="card__cover">
                                <img src="<?= htmlspecialchars($anime['images']['jpg']['image_url'] ?? '/img/card/1.png') ?>"
                                    alt="">
                            </a>
                            <button class="card__add" type="button"
                                onclick="addToWatchlist(<?= htmlspecialchars((string) $anime['mal_id']) ?>)"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
                                    <path
                                        d="M16,2H8A3,3,0,0,0,5,5V21a1,1,0,0,0,.5.87,1,1,0,0,0,1,0L12,18.69l5.5,3.18A1,1,0,0,0,18,22a1,1,0,0,0,.5-.13A1,1,0,0,0,19,21V5A3,3,0,0,0,16,2Zm1,17.27-4.5-2.6a1,1,0,0,0-1,0L7,19.27V5A1,1,0,0,1,8,4h8a1,1,0,0,1,1,1Z" />
                                </svg></button>
                            <span class="card__rating">⭐ <?= htmlspecialchars((string) ($anime['score'] ?? 'N/A')) ?></span>
                            <h3 class="card__title"><a
                                    href="/details/<?= htmlspecialchars((string) $anime['mal_id']) ?>"><?= htmlspecialchars($anime['title'] ?? 'Unknown') ?></a>
                            </h3>
                            <ul class="card__list">
                                <li><?= htmlspecialchars($anime['type'] ?? 'TV') ?></li>
                                <li><?= htmlspecialchars((string) ($anime['year'] ?? 'N/A')) ?></li>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color: white;">ტოპ ანიმე არ მოიძებნა.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="content" style="margin-top: 50px; margin-bottom: 80px;">
    <div class="content__head">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="content__title" style="color: #fff; margin-bottom: 20px;">ანიმეები მალე</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row row--grid">
            <?php if (!empty($upcomingAnime)): ?>
                <?php foreach (array_slice($upcomingAnime, 0, 12) as $anime): ?>
                    <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                        <div class="card">
                            <a href="/details/<?= htmlspecialchars((string) $anime['mal_id']) ?>" class="card__cover">
                                <img src="<?= htmlspecialchars($anime['images']['jpg']['image_url'] ?? '/img/card/1.png') ?>"
                                    alt="">
                            </a>
                            <button class="card__add" type="button"
                                onclick="addToWatchlist(<?= htmlspecialchars((string) $anime['mal_id']) ?>)"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
                                    <path
                                        d="M16,2H8A3,3,0,0,0,5,5V21a1,1,0,0,0,.5.87,1,1,0,0,0,1,0L12,18.69l5.5,3.18A1,1,0,0,0,18,22a1,1,0,0,0,.5-.13A1,1,0,0,0,19,21V5A3,3,0,0,0,16,2Zm1,17.27-4.5-2.6a1,1,0,0,0-1,0L7,19.27V5A1,1,0,0,1,8,4h8a1,1,0,0,1,1,1Z" />
                                </svg></button>
                            <span class="card__rating">⭐ <?= htmlspecialchars((string) ($anime['score'] ?? 'N/A')) ?></span>
                            <h3 class="card__title"><a
                                    href="/details/<?= htmlspecialchars((string) $anime['mal_id']) ?>"><?= htmlspecialchars($anime['title'] ?? 'Unknown') ?></a>
                            </h3>
                            <ul class="card__list">
                                <li><?= htmlspecialchars($anime['type'] ?? 'TV') ?></li>
                                <li>მომავალი</li>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color: white;">მომავალი ანიმე არ მოიძებნა.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- end content -->