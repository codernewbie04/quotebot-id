# quotebot-id


Sebuah projek unfaedah, tapi bisa dijadikan ladang adsense :D

<h1><b>Cara install</b></h1>


1. install dulu composer
2. setelah selesai install buka cmd / terminal
3. masuk ke direktori file tsb ex: cd C:\xampp\htdocs\quotebot
4. masukan command berikut 
<blockquote>composer update</blockquote>
dan
<blockquote>composer dump-autoload -o</blockquote>

5. buka file index.php
6. edit line 57 dan 58
7. sesuaikan username dan password ig kalian
8. buka folder vendor/mgp25/src
9. buka file instagram.php
10. ubah variable $allowDangerousWebUsageAtMyOwnRisk menjadi true
hasilnya 
<blockquote>public static $allowDangerousWebUsageAtMyOwnRisk = true;</blockquote>
