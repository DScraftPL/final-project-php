## Projekt zaliczeniowy z laboratorium "Programowanie aplikacji internetowych"

## Tematyka Projektu: Forum Internetowe

## Autor: Kacper Wiącek

## Funkcjonalności:
- uwierzytelnienie
- dodawanie i edytowanie wpisów
- dodawanie, edytowanie i usuwanie ogłoszeń (administrator)
- dodawanie i edytowanie odpowiedzi na wpis
- panel użytkownika:
  - zmiana hasła
  - usunięcie konta
  - dodanie i edycja opisu konta
  - zmianę zdjęcia profilowego (z 5 możliwych)
- panel administratora:
  - podgląd statystyk
  - podgląd użytkowników
  - usuwanie wpisów
  - blokowanie użytkowników

## Narzędzia i technologie:
- strona serwera: Laravel
- baza danych: MySQL
- strona klienta: Laravel Blade, Tailwind CSS

## Wymagania
PHP 8.4.1
Composer 2.8.3
npm 11.0.0
nodejs v23.4.0
Nie testowałem na niższych, moim głównym środowiskiem był Linux, 

## Uruchomienie

1. rozpakować projekt
2. w terminalu, należy przejść do katalogu projektu
3. w katalogu należy wpisać polecenie `npm install`, w celu doinstalowania pakietów
4. w katalogu należy wpisać polecenie `composer install` w celu doinstalowania pakietów
5. w XAMPP należy uruchomić bazę danych MySQL
6. jeżeli plik .env nie istnieje w katalogu głównym, należy skopiować plik .env.example i zmienić jego nazwę na .env i wpisać polecenie `php artisan key:generate --force`
7. w katalogu projektu, aby przygotować bazę danych, należy wpisać polecenie `php artisan migrate` (należy zaznaczyć 'yes') 
8. w katalogu projektu, aby dodać dane do bazy danych, należy wpisać polecenie `php db:seed` (należy zaznaczyć 'yes')
9. w katalogu projektu wpisanie `php artisan serve` spowoduje uruchomienie projektu
10. w przeglądarce należy wpisać adres `localhost:8000`

## Uwagi
Dodałem wiele wpisów generowanych przez Laravela, poprzez moduły Factory i Seeder. 
Wygenerowane treści mogą się różnić między uruchomieniami, ponieważ są to treści losowe.
Są przygotowane specjalne wpisy do bazy danych, które przy każdej "migracji" zostaną wstawione w celach testowych

Konto administratora posiada dodatkowe funkcjonalności na podstronach projektu, ukryte dla użytkowników nieautoryzowanych

Kod projektu jest dostępny na githubie: https://github.com/DScraftPL/final-project-php

W przypadkach problemów z plikami: 
- serwer musi działać na porcie 8000 (uruchomiony poleceniem php artisan serve)
- należy wpisać polecenie `php artisan storage:link`
## Konta Testowe

- John Doe:
  - email: john@example.com
  - password: password123
- Jane Smith:
  - email: jane@example.com 
  - password: password123
- Kacper Wiacek:
  - email: kacper@wiacek.pl
  - password: kacperwiacek
- unlimitedPower: (to konto jest kontem administratora)
  - email: admin@example.com
  - password: password
