# Pigly

## 環境構築

### Dockerビルド
1. `git clone git@github.com:manami0630/Pigly.git`
2. `docker-compose up -d --build`

* MySQLは、OSによって起動しない場合があるので、それぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

### Laravel環境構築
1. `docker-compose exec php bash`
2. `composer install`
3. .env.exampleファイルから.envを作成し、環境変数を変更
4. `php artisan key:generate`
5. `php artisan migrate`
6. `php artisan db:seed`

## 使用技術
- PHP 7.4.9
- Laravel 8.83.8
- MySQL 8.0.26

## ER図
<img width="756" height="323" alt="スクリーンショット 2025-07-13 134847" src="https://github.com/user-attachments/assets/a333f909-e970-4a74-b62e-fab993f822d0" />

## URL
- 開発環境: [http://localhost](http://localhost)
- phpMyAdmin: [http://localhost:8080/](http://localhost:8080/)
