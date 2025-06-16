# LP-ASSR-AdmSys-2024-25 - 日本語版
セリン先生によるシステム管理プロジェクト：Dockerを使用した仮想化LAMP環境の構築とAWS RDSリモートデータベースの展開。

## 目的
本プロジェクトは、ヴィレットヌーズIUT（ソルボンヌ・パリ・ノール大学）での2024-2025年度の専門職ライセンスASSRの一環として実施されました。
中小企業MBFに対し、以下のターンキーソリューションを提供することを目的としています。

- ウェブの問い合わせフォームの設置
- AWS RDS上にホストされたMySQLデータベースへのデータ集中管理
- このソリューションの自動化、仮想化、およびコンテナ化による展開

## プロジェクト構成
- Vagrantfile # UbuntuのVMを2台作成し、LAMPセットアップスクリプトを実行
- install_lamp.sh # LAMPスタックの自動インストール用Bashスクリプト
- init_db.sql # テーブル作成用SQLスクリプト（leads、feedback）
- docker-php/
  - Dockerfile # PHPアプリ用Dockerイメージ
  - index.php # MBFサイトのホームページ
  - contact.php # 問い合わせフォーム（リード＋フィードバック）
  - style.css # フォームのデザイン
- README-JAP.md # 本ファイル

## 前提条件

- VirtualBox（バージョン7.1.4以上）
- Vagrant（バージョン2.4.5以上）
- Docker Desktop
- AWSアカウント（RDSが有効であること、MySQL 8.0）

## 展開手順

### 1. プロジェクトをクローン

```bash
git clone https://github.com/serena140/LP-ASSR-AdmSys.git
cd LP-ASSR-AdmSys
```

### 2. VMを起動

```bash
vagrant up          # UbuntuのVMを2台自動作成・設定  
vagrant ssh ubuntu_VM1   # 1台目のマシンに接続  
```
VMのIPアドレスは192.168.56.101と192.168.56.102になります。

### 3. AWS RDSにデータベースを作成
MySQL 8.0インスタンスを作成（名前：contact-db）
IP範囲192.168.56.0/24（ポート3306）を許可するセキュリティルールを追加
init_db.sqlスクリプトでテーブルを作成：
- leads：営業問い合わせ用
- feedback：顧客フィードバック用

### 4. Dockerでウェブアプリケーションを起動
```bash
cd docker-php
docker build -t appli-contact .
docker run -d -p 8080:80 --name projet-contact appli-contact
```
アプリは http://localhost:8080 でアクセス可能です。

## 実施したテスト
- VagrantによるVMの自動作成
- BashスクリプトによるLAMPの自動インストール
- リモートMySQL（AWS RDS）への接続確認
- PHPアプリのコンテナ化
- 問い合わせフォーム（リードとフィードバック）の動作確認
- メッセージ種類に応じたデータベースへの正しい保存

## 補足資料
技術的詳細、スクリーンショット、アーキテクチャ図、コメント付きコードはPDFレポート参照。

## 作成者
セレナ・パテ – 専門職ライセンスASSR 2024/2025
ソルボンヌ・パリ・ノール大学 ヴィレットヌーズIUT
指導教員：クリストフ・セリン
