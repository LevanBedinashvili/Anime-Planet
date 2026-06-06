<?php use Core\Session; ?>
<header class="header">
    <style>
        .header__content,
        .header__nav-item {
            height: 80px !important;
            overflow: visible !important;
        }

        .header__user-dropdown .header__user-menu {
            margin-top: 5px !important;
        }

        @media (max-width: 767px) {
            .header__search-form {
                display: none !important;
            }

            .header__username_desktop {
                display: none !important;
            }

            .header__username_mobile {
                display: inline-block !important;
            }
        }

        .header__username_mobile {
            display: none;
            margin-right: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #e0e0e0;
        }

        .header__username {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline-block;
            vertical-align: middle;
        }
    </style>
    <div class="header__wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header__content">
                        <!-- header logo -->
                        <a href="/" class="header__logo" style="width: auto; white-space: nowrap; margin-right: 20px;">
                            <h2 style="color:white; margin:0; font-weight:bold;">Anime-Planet</h2>
                        </a>
                        <!-- end header logo -->

                        <!-- header nav -->
                        <ul class="header__nav">
                            <li class="header__nav-item">
                                <a href="/" class="header__nav-link">მთავარი</a>
                            </li>
                            <li class="header__nav-item">
                                <a href="/catalog" class="header__nav-link">კატალოგი</a>
                            </li>
                            <li class="header__nav-item">
                                <a href="/schedule" class="header__nav-link">განრიგი</a>
                            </li>
                            <li class="header__nav-item">
                                <a href="/random" class="header__nav-link"
                                    style="color: #ff55a5; font-weight: bold;">გამაოცე!</a>
                            </li>
                        </ul>
                        <!-- end header nav -->

                        <!-- header actions -->
                        <div class="header__actions">
                            <form action="/catalog" method="GET" class="header__search header__search-form"
                                style="margin-right:20px;">
                                <input class="header__search-input" type="text" name="q" placeholder="მოძებნე ანიმე...">
                                <button class="header__search-button" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M21.71,20.29,18,16.61A9,9,0,1,0,16.61,18l3.68,3.68a1,1,0,0,0,1.42,0A1,1,0,0,0,21.71,20.29ZM11,18a7,7,0,1,1,7-7A7,7,0,0,1,11,18Z" />
                                    </svg>
                                </button>
                            </form>

                            <?php if (Session::has('user_id')): ?>
                                <style>
                                    .header__user-dropdown {
                                        position: relative;
                                        display: inline-block;
                                        margin-left: 20px;
                                    }

                                    @media (min-width: 992px) {
                                        .header__user-dropdown {
                                            margin-left: 50px;
                                        }
                                    }

                                    .header__user-dropdown .header__user-menu {
                                        visibility: hidden;
                                        opacity: 0;
                                        position: absolute;
                                        top: 100%;
                                        right: 0;
                                        background: #131720;
                                        border: 1px solid #222831;
                                        border-radius: 4px;
                                        padding: 10px 0;
                                        min-width: 160px;
                                        z-index: 100;
                                        transition: 0.3s;
                                        margin-top: 10px;
                                    }

                                    .header__user-dropdown:hover .header__user-menu {
                                        visibility: visible;
                                        opacity: 1;
                                        margin-top: 5px;
                                    }

                                    @media (max-width: 767px) {
                                        .header__user-dropdown .header__user-menu {
                                            right: -20px;
                                            min-width: 140px;
                                        }
                                    }

                                    .header__user-menu a,
                                    .header__user-menu button {
                                        display: block;
                                        width: 100%;
                                        padding: 10px 20px;
                                        color: #e0e0e0;
                                        text-align: left;
                                        background: transparent;
                                        border: none;
                                        font-size: 14px;
                                        cursor: pointer;
                                        text-decoration: none;
                                        transition: 0.3s;
                                        font-family: inherit;
                                    }

                                    .header__user-menu a:hover,
                                    .header__user-menu button:hover {
                                        color: #ff55a5;
                                        background: #222831;
                                    }
                                </style>
                                <div class="header__user-dropdown">
                                    <div class="header__user" style="cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                        <span
                                            class="header__username header__username_desktop" style="margin: 0; line-height: 1; padding-top: 5px;"><?= htmlspecialchars(Session::get('username') ?? 'პროფილი') ?></span>
                                        <span class="header__username_mobile" style="margin: 0; line-height: 1; padding-top: 5px;">პროფილი</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"
                                            fill="#2f80ed">
                                            <path
                                                d="M12,12A6,6,0,1,0,6,6,6,6,0,0,0,12,12Zm0-10A4,4,0,1,1,8,6,4,4,0,0,1,12,2Zm8,16.5A1.5,1.5,0,0,0,18.5,17H5.5A1.5,1.5,0,0,0,4,18.5V21a1,1,0,0,0,2,0V19H18v2a1,1,0,0,0,2,0Z" />
                                        </svg>
                                    </div>
                                    <div class="header__user-menu">
                                        <a href="/profile">ჩემი სია</a>
                                        <form action="/logout" method="POST" style="margin: 0;">
                                            <?= Core\Csrf::field() ?>
                                            <button type="submit">გასვლა</button>
                                        </form>
                                    </div>
                                </div>
                            <?php else: ?>
                                <a href="/login" class="header__user">
                                    <span>შესვლა</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M20,12a1,1,0,0,0-1-1H11.41l2.3-2.29a1,1,0,1,0-1.42-1.42l-4,4a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l4,4a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L11.41,13H19A1,1,0,0,0,20,12ZM17,2H7A3,3,0,0,0,4,5V19a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V16a1,1,0,0,0-2,0v3a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V5A1,1,0,0,1,7,4H17a1,1,0,0,1,1,1V8a1,1,0,0,0,2,0V5A3,3,0,0,0,17,2Z" />
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                        <!-- end header actions -->

                        <!-- header menu btn -->
                        <button class="header__menu" type="button">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <!-- end header menu btn -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>