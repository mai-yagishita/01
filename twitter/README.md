
1.任意のディレクトリ内でコンポーザーをインストール<br>
以下のコマンドを入力<br>
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');<br>
  php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"<br>
  php composer-setup.php<br>
  php -r "unlink('composer-setup.php');"<br>

2.Twitteroauthをインストール<br>
以下のコマンドを入力<br>
  php composer.phar require abraham/twitteroauth
