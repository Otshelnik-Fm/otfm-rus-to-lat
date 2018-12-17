== Установка/Обновление ==

<h3 style="text-align: center;">Установка:</h3>
Т.к. это дополнение для WordPress плагина <a href="https://codeseller.ru/groups/plagin-wp-recall-lichnyj-kabinet-na-wordpress/" target="_blank">WP-Recall</a>, то оно устанавливается через <a href="https://codeseller.ru/obshhie-svedeniya-o-dopolneniyax-wp-recall/" target="_blank"><strong>менеджер дополнений WP-Recall</strong></a>.

1. В админке вашего сайта перейдите на страницу "WP-Recall" -> "Дополнения" и в самом верху нажмите на кнопку "Обзор", выберите .zip архив дополнения на вашем пк и нажмите кнопку "Установить".
2. В списке загруженных дополнений, на этой странице, найдите это дополнение, наведите на него курсор мыши и нажмите кнопку "Активировать". Или выберите чекбокс и в выпадающем списке действия выберите "Активировать". Нажмите применить.


<h3 style="text-align: center;">Обновление:</h3>
Дополнение поддерживает <a href="https://codeseller.ru/avtomaticheskie-obnovleniya-dopolnenij-plagina-wp-recall/" target="_blank">автоматическое обновление</a> - два раза в день отправляются вашим сервером запросы на обновление.
Если в течении суток вы не видите обновления (а на странице дополнения вы видите что версия вышла новая), советую ознакомиться с этой <a href="https://codeseller.ru/post-group/rabota-wordpress-krona-cron-prinuditelnoe-vypolnenie-kron-zadach-dlya-wp-recall/" target="_blank">статьёй</a>




== Настройки ==
Настроек нет. Активировал и работай.
Всё делается автоматически.




== Changelog ==
= 2018-12-17 =
v1.3
* присутствующие в заголовке спецсимволы иногда рушили урл. 
теперь заголовки вида <code>REDEMPTION 2 ➤ Прохождение</code> будут преобразованы в <code>redemption-2-proxozhdenie</code>
* исправлен баг - при включении дополнения страница по адресу отдавала 404 (работа в `query` запросах)


= 2018-12-10 =
v1.2
* поддержка WP-Recall от v16.17.0
* поддержка Gutenberg v4.6.1
* поддержка WordPress 5.0
- Внимание!! в вордпресс 5.0 баг с транслитом. Он в автосохранении не работает. А работает когда: Вы создаете запись - сохраняете ее в черновик или публикуете - транслит отрабатывает.
команда ВП этот баг исправит в версии 5.0.1


= 2018-05-19 =
v1.1
* поддержка WP-Recall от v16.15.2 (именно там появились соответствующие фильтры, позволившие расширить таблицу символов транслитерации)
* добавил поддержку украинского языка и казахского:
для вкладок;
для metakey в полях профиля, форме публикации и в произвольных вкладок (формируемый slug);
для заголовка PrimeForum (slug урл);
теперь имя вида:  <code>Ї#1%№$ЇӘаВптйёиD</code> переведется в такой <code>i1niaavptjyoid</code> slug и metakey

= 2017-09-15 =
v1.0
* Release




== Поддержка и контакты ==

* Поддержка осуществляется в рамках текущего функционала дополнения
* При возникновении проблемы, создайте соотвествующую тему на <a href="https://codeseller.ru/forum/product-15871/" target="_blank">форуме поддержки</a> товара
* Если вам нужна доработка под ваши нужды - вы можете обратиться ко мне в <a href="https://codeseller.ru/author/otshelnik-fm/?tab=chat" target="_blank">ЛС</a> с техзаданием на платную доработку.

Все мои работы опубликованы <a href="https://otshelnik-fm.ru/?p=2562&utm_source=free-addons&utm_medium=addon-description&utm_campaign=otfm-rus-to-lat&utm_content=codeseller.ru&utm_term=all-my-addons" target="_blank">на моём сайте</a> и в каталоге магазина <a href="https://codeseller.ru/author/otshelnik-fm/?tab=publics&subtab=type-products" target="_blank">CodeSeller.ru</a>
