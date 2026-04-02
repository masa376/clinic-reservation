<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


# クリニック予約管理システム

## 概要

放射線技師として医療現場で勤務した経験をもとに設計・開発した、クリニック向けの予約管理Webアプリケーションです。
医療現場で実際に必要とされる機能（アレルギー情報の管理・検査前注意事項の表示など）を盛り込み、現場目線の設計を意識しました。

## 使用技術

| 技術 | バージョン |
| PHP | 8.3 |
| Laravel | 11 |
| MySOL | 8.4 |
| TailwindCSS | 3系 |
| Docker | Laravel Sail |

## 機能一覧

### 認証機能
- ログイン / ログアウト
- ユーザー登録

### 予約管理
- 予約の登録・編集・削除・一覧・詳細
- ステータス管理（受付中 / 確定 / キャンセル / 完了）

### 患者管理
- 患者の登録・編集・削除・一覧・詳細
- アレルギー・禁忌情報の管理

### 医師管理
- 医師の登録・編集・削除・一覧・詳細

### スタッフ管理
- スタッフの登録・編集・削除・一覧・詳細
- 職種管理（放射線技師 / 看護師 / 受付 / その他）

### 診療メニュー管理
- メニューの登録・編集・削除・一覧・詳細
- 検査種別との紐付け・所要時間・料金管理

### 検査種別管理
- 検査種別の登録・編集・削除・一覧・詳細
- 検査前注意事項の管理（例：CT造影剤使用時の絶食時間など）

### ダッシュボード
- 本日の予約一覧（時間順）
- アレルギーあり患者の強調表示
- 総予約数・患者数・医師数・スタッフ数の集計

## 医療現場目線の設計ポイント

### アレルギー・禁忌情報の管理
造影剤を使用するCT・MRI検査では、アレルギー歴の確認が必須です。
予約詳細・ダッシュボードでアレルギーあり患者を赤バッチで強調表示し、見落としを防ぐ設計にしました。

### 検査前注意事項の自動表示
検査種別ごとに注意事項（例：腹部CT「4時間絶食」、MRI「金属類除去」）を登録できます。
予約詳細画面で自動表示されるため、スタッフが個別に確認する手間が省けます。

### ステータス管理
予約を「受付中⇒確定⇒完了」と段階的に管理できます。
キャンセル履歴もSoftDeletesにより保持されます。

## データベース設計
```
users          ：管理者・スタッフ・医師ログイン情報
patients       ：患者情報（アレルギーメモ含む）
doctors        ：医師情報
staffs         ：スタッフ情報（職種管理）
exam_types     ：検査種別（検査前注意事項含む）
menus          ：診療メニュー（検査種別に紐付く）
reservations   ：予約情報（上記全テーブルに紐付く）
```

## 作者について

放射線技師として医療現場での経験を経た後、Webエンジニアへのキャリアチェンジを目指しています。
医療×ITという専門性を活かし、医療系システムの開発・改善に貢献できるよう精進します。


## ローカル環境での起動方法

```bash
# リポジトリのクローン
git clone https://github.com/masa376/clinic-reservation.git
cd clinic-reservation

# 環境変数の設定
cp .env.example .env

# Sailの起動
./vendor/bin/sail up -d

# 依存パッケージのインストール
./vendor/bin/sail composer install

# アプリケーションキーの生成
./vendor/bin/sail artisan key:generate

# マイグレーション実行
./vendor/bin/sail artisan migrate

# フロントエンドのビルド
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```




