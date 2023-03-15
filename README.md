# marvel-hotel

## Live

You can see my project <a href=''> here </a> (not ready yet)

## About

This project presents an innovative hotel managment website. Created for the purposes of the school final project

## Public endpoints

| Path     | Description             | Method |
| -------- | ----------------------- | ------ |
| /        | Redirect to /home       | GET    |
| /home    | View home               | GET    |
| /about   | View about              | GET    |
| /contact | View contact            | GET    |
| /contact | Send contact form       | POST   |
| /room    | View room               | GET    |
| /room    | Booking room            | POST   |
| /rooms   | View rooms              | GET    |
| /account | View account            | GET    |
| /rule    | View rule               | GET    |
| /auth    | Login & Register        | POST   |
| /logout  | Logout                  | GET    |
| /manage  | View manage (for admin) | GET    |

## Tech i used:

<img src='https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white'/> <img src='https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white'/> <img src='https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E'/> <img src='https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white'/>

## Build

### 1. Otwórz plik xampp\apache\conf\extra\httpd-vhosts.conf

```
   <VirtualHost *:80>
    ServerAdmin webmaster@domain1.com
    # Poniżej ścieżka do folderu public
    DocumentRoot "D:\Programy\xampp\htdocs\marvel-hotel\public"
    ServerName localhost
    ServerAlias www.localhost
   </VirtualHost>
```

### 2. Wyłacz usługi Apache, MySQL a następnie włącz

### 3. Wejdź na stronę localhost
