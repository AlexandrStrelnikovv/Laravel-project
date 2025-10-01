Task Manager — это веб-приложение на Laravel для эффективного управления задачами.   
Создавайте, отслеживайте и выполняйте задачи, назначайте исполнителей, задавайте приоритеты и находите нужные задачи с помощью удобного поиска.   
Всё это с поддержкой авторизации и персонализированным доступом.  
  
Основные возможности  
~Создание и редактирование задач  
~ Назначение исполнителей  
~ Установка приоритета (низкий, средний, высокий)  
~ Отметка задач как выполненных  
~ Просмотр списка своих задач   
~ Поиск по задачам (по названию, описанию, исполнителю и т.д.)  
~ Система авторизации (регистрация / вход)  
   
Чтобы запустить приложение:   
1 - git clone https://github.com/AlexandrStrelnikovv/Laravel-project.git  
2 - composer install   
3 - npm install   
4 - Создайте файл .env в корне проекта и добавьте следующие настройки  
{  
    DB_CONNECTION=mysql  
    DB_HOST=127.0.0.1  
    DB_PORT=3306  
    DB_DATABASE=taskmanager  
    DB_USERNAME=root  
    DB_PASSWORD=rootpassword  
}  
5  - php atrisan serve   
6  - docker-compose up -d  
7  - npm run dev   
8  - php atrisan migrate   
9  - php artisan make:data  
10 - php artisan db:seed  