<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## API Calendar Egolist

### Получение параметров календаря GET
- "date_start" : 30.06.22
- "date_end" : 30.08.22
 
Api Responce:

- {
    - "data": [
        - {
            - "title": "Calendar Title 6",
            - "description": "Calendar Title Dscription 6",
            - "date": "30.06.22",
            - "duration": "20:00-21:30"
        - },
        - {
            - "title": "Calendar Title 7",
            - "description": "Calendar Title Dscription 7",
            - "date": "30.07.22",
            - "duration": "15:00-16:00"
        - },
        - {
            - "title": "Calendar Title 8",
            - "description": "Calendar Title Dscription 8",
            - "date": "30.08.22",
            - "duration": "17:00-20:00"
        - }
    - ]
- }


- Доступен только для аутентифицированных пользователей.

### Создание записи POST

- {
    - "title": "Calendar Title 11",
    - "description": "Calendar Title Dscription 11",
    - "date": "30.10.22",
    - "duration": "15:00-16:00"
- }


- Поле "duration" может указать только зарегистрированый пользователь.

### Обновление записи PATCH

- {
    - "title": "Calendar Title 12",
    - "description": "Calendar Title Dscription 12",
    - "date": "30.11.22",
    - "duration": "15:00-16:00"
- }

- Запись можно обновить за 3 часа до указанного времени "duration"


- {
    - "massage": "Updates are possible 3 hours before of the duration specified!"
- }


- Доступен только для аутентифицированных пользователей.

### Удаление записи DELETE

- Удаление возможно за 3 часа до указанного времени "duration"


- {
    - "massage": "Delete are possible 3 hours before of the duration specified!"
- }


- Доступен только для аутентифицированных пользователей.

<hr>

Новый Token можно создать при регистрации.

Bearer Token для проверки: 15|Qjdi55jmX1jQCqUHGr6c3FZgRgcUm8KEIKdJA1cj

Database: database.sqlite



