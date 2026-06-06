<?php use Core\Session; ?>
<div class="sign section--bg" style="margin-top: 80px; min-height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sign__content">
                    <form action="/login" class="sign__form" method="POST">
                        <?= Core\Csrf::field() ?>
                        <a href="/" class="sign__logo">
                            <h1 style="color:white; font-size:32px;">Anime-Planet</h1>
                        </a>
                        
                        <?php if (Session::hasFlash('error')): ?>
                            <p style="color: #ff55a5;"><?= htmlspecialchars(Session::getFlash('error')) ?></p>
                        <?php endif; ?>
                        
                        <?php if (Session::hasFlash('success')): ?>
                            <p style="color: #29b474;"><?= htmlspecialchars(Session::getFlash('success')) ?></p>
                        <?php endif; ?>

                        <div class="sign__group">
                            <input type="email" name="email" class="sign__input" placeholder="ელ. ფოსტა" required>
                        </div>

                        <div class="sign__group">
                            <input type="password" name="password" class="sign__input" placeholder="პაროლი" required>
                        </div>

                        <button class="sign__btn" type="submit">შესვლა</button>

                        <span class="sign__text">არ გაქვთ ანგარიში? <a href="/signup">დარეგისტრირდით!</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>