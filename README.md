# スポっとる

このアプリは、 **スポット（空港内の航空機を駐機する場所）の予約を行うアプリ** です。  
小型航空機を所有する個人や、事業用に航空機を使う会社をターゲットに、より簡単なスポットの予約管理ができるようになります。  
また、スポットを管理する空港管理者側の管理ページから、予約管理やスポットの編集などが行えます。

## 使用環境
- Laravel 8.83.23
- MySQL(MariaDB) 10.4.25
- Composer 2.3.5

## 使用方法
会員登録後、使用機材・スポット・日時を選択して予約できます。
予約後は、マイページから日時変更・予約取り消しが可能です。

https://user-images.githubusercontent.com/102412898/229983767-cbaaa6a0-f9de-4eea-911b-e35ebafe9307.mp4

空港管理者ページでは、利用者へのメール作成や予約確認、必要なデータの編集管理ができます。

![管理画面](https://user-images.githubusercontent.com/102412898/229997274-0c298cd2-f830-4318-a462-00eb12c6febb.png)

## インストール方法

```
$ git clone https://github.com/doingen/spottle.git
$ composer install
```

.envファイル作成し、適宜書き換えてご利用ください。
