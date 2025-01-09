## Projekt zaliczeniowy z laboratorium "Programowanie aplikacji internetowych"

## Tematyka Projektu: Forum Internetowe

## Autor: Kacper Wiącek

## Funkcjonalności:
- uwierzytelnienie
- dodawanie wpisów
- dodawanie ogłoszeń (administrator)
- dodawanie odpowiedzi na wpis
- panel użytkownika:
  - zmiana hasła
  - usunięcie konta
  - dodanie i edycja opisu konta
- panel administratora:
  - podgląd statystyk
  - podgląd użytkowników
  - usuwanie wpisów

## Narzędzia i technologie:
- strona serwera: Laravel
- baza danych: MySQL
- strona klienta: Laravel Blade

## Wymagania
PHP 8.4.1
Composer 2.8.3
npm 11.0.0
nodejs v23.4.0
Nie testowałem na niższych, moim głównym środowiskiem był Linux, 

## Uruchomienie

## Uwagi
Dodałem wiele wpisów generowanych przez Laravela, poprzez moduły Factory i Seeder. 
Wygenerowane treści mogą się różnić między uruchomieniami, ponieważ są to treści losowe.
Są przygotowane specjalne wpisy do bazy danych, które przy każdej "migracji" zostaną wstawione w celach testowych

Konto administratora posiada dodatkowe funkcjonalności na podstronach projektu, ukryte dla użytkowników nieautoryzowanych

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
