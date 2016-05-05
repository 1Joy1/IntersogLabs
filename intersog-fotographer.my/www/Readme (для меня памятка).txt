Эта папка не является корневой, как обычно в Денвере.
Настройки изменения корня, находится в файле ..\usr\local\apache\conf\httpd.conf
558 строка

<VirtualHost 127.0.0.1:80>
  DocumentRoot "W:/home/intersog-fotographer.my/www/basic/web"  
  ServerName "intersog-fotographer.my"
  ServerAlias "intersog-fotographer.my" "www.intersog-fotographer.my" 
  ScriptAlias /cgi/ "/home/intersog-fotographer.my/cgi/"
  ScriptAlias /cgi-bin/ "/home/intersog-fotographer.my/cgi-bin/"
</VirtualHost>

<VirtualHost 127.0.0.1:443>
  SSLEngine on
  DocumentRoot "W:/home/intersog-fotographer.my/www/basic/web"  
  ServerName "intersog-fotographer.my"
  ServerAlias "intersog-fotographer.my" "www.intersog-fotographer.my" 
  ScriptAlias /cgi/ "/home/intersog-fotographer.my/cgi/"
  ScriptAlias /cgi-bin/ "/home/intersog-fotographer.my/cgi-bin/"
</VirtualHost>

Также в новой корневой папке W:/home/intersog-fotographer.my/www/basic/web
есть файл .htaccess для более тонкой настройки.