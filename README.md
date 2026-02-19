確認テスト＿お問い合わせフォーム（FashionablyLate）

---

⚪︎環境構築

##Dockerビルド

１、リポジトリをクローン

・git clone https://github.com/nagika0000-code/test.git

・cd test


２、Dockerコンテナを起動

・docker-compose up -d --build


３、PHPコンテナへ入る

・docker compose exec php bash



４、Composerインストール

・composer install



５、.envファイル作成

・cp .env.example .env



６、アプリケーションキー生成

・php artisan key:generate



７、データベースマイグレーション実行

・php artisan migrate --seed



⚪︎DB設定

.envファイルに以下を設定してください。

DB_CONNECTION=mysql

DB_HOST=mysql

DB_PORT=3306

DB_DATABASE=laravel_db

DB_USERNAME=laravel_user

DB_PASSWORD=laravel_pass



※vendorディレクトリはGit管理していません。初回起動時は必ず以下を実行してください。

・composer install



##開発環境

・お問い合わせ画面
http://localhost/

・ユーザー登録：
http://localhost/register

・ログイン：
http://localhost/login

・管理画面（ログイン後）：
http://localhost/admin

・phpMyAdmin：
http://localhost:8080/


⚪︎使用技術（実行環境）

・PHP 8.2.11

・Laravel 8.83.29

・MySql:8.0

・nginx:1.21.1

・Docker / docker-compose


⚪︎ER図
<img width="1674" height="1198" alt="image" src="https://github.com/user-attachments/assets/bd1ff1e7-c96e-4591-9290-731ef77b314a" />
