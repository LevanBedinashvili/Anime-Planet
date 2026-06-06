<?php

return new class {
    public function up(\PDO $pdo): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS user_anime_lists (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            jikan_anime_id INT NOT NULL,
            status ENUM('watching', 'completed', 'on_hold', 'dropped', 'plan_to_watch') DEFAULT 'plan_to_watch',
            score INT DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )";
        $pdo->exec($sql);
    }

    public function down(\PDO $pdo): void
    {
        $pdo->exec("DROP TABLE IF EXISTS user_anime_lists");
    }
};
