This project is about getting data from delfi.lv/rss and
adding to database. Files are shown on localhost where you
can delete rows, edit title for each row, sort alphabetically by title
and search after title.

To run this project:<br>
Run composer install.<br>
Run cp .env.example .env or copy .env.example .env.<br>
Run php artisan key:generate.<br>
Create database with name according to .env file.<br>
Run php artisan migrate.<br>
Run php artisan serve.<br>
