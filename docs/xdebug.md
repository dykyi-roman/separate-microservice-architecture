## Настройка xdebug
**GNU/Linux platform**
1. Добавляем в IDE php интерпретатор с docker контейнера. Открываем
   **Settings > Languages and Frameworks > PHP** и в строке **CLI
   Interpreter** нажимаем на кнопку **...**

   ![step1](images/php-xdebug-1.png)

2. Добавляем новый интерпретатор через нажатие на **+** и выбор **From
   docker...**

   ![step2](images/php-xdebug-2.png)

3. Выбираем **Docker** и нажимаем **OK**

   ![step3](images/php-xdebug-3.png)

4. Перейти в **Settings > Servers** и добавить `market.travel.docker`. Также
   обратите внимание на **Path mapping**

   ![step4](images/php-xdebug-4.png)

5. По умолчанию xdebug настроен на 9003 порт,
   устанавливаем это значение в **Debug port** на странице настроек
   **Settings > Languages and Frameworks > PHP > Debug**

   ![step5](images/php-xdebug-5.png)

**Mac OS X platform**
1. Выполнить пункты 1, 2, 3, 5 настройки для GNU/Linux
2. Перейти в **Settings > Servers** и добавить `market.travel.docker`. Также
   обратите внимание на **Path mapping**
   
   ![step2](images/php-xdebug-mac-1.png)
   
3. Перейти в **Preferences > PHP > Debug > DBGp Proxy**

   ![step2](images/php-xdebug-mac-2.png)