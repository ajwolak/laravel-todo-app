# TODO.md

## Aplikacja "To-Do List"

### Opis projektu

Aplikacja "To-Do List" umożliwia zarządzanie zadaniami użytkownika.

---

## Wymagania funkcjonalne

### 1. CRUD (Create, Read, Update, Delete) zadań

-   [x] Nazwa zadania (max 255 znaków, wymagane)
-   [x] Opis (opcjonalnie)
-   [x] Priorytet (`low`, `medium`, `high`)
-   [x] Status (`to-do`, `in progress`, `done`)
-   [x] Termin wykonania (wymagana data)

### 2. Przeglądanie i filtrowanie zadań

-   [x] Filtrowanie po:
    -   [x] Priorytecie
    -   [x] Statusie
    -   [x] Terminie wykonania

### 3. Powiadomienia e-mail

-   [x] Wysyłanie przypomnienia na 1 dzień przed terminem zadania
-   [x] Wdrożony Laravel Scheduler oraz Queue

### 4. Walidacja formularzy

-   [x] Sprawdzenie wymaganych pól
-   [x] Ograniczenie znaków (nazwa)
-   [x] Formatowanie daty
-   [x] Obsługa błędów i komunikatów

### 5. Obsługa wielu użytkowników

-   [x] System rejestracji i logowania (Laravel Breeze)
-   [x] Każdy użytkownik widzi tylko swoje zadania

### 6. Publiczne linki z tokenem

-   [x] Generowanie tokenu dostępu
-   [x] Link umożliwia podgląd zadania bez logowania
-   [x] Tokeny mają termin ważności (dostęp wygasa)

---

## Funkcje dodatkowe

### 7. Historia edycji zadań

-   [x] Rejestrowanie każdej zmiany zadania
-   [x] Historia wyświetlana na stronie zadania

### 8. Integracja z Google Calendar

-   [ ] Niezrealizowana (opcja opcjonalna)

---

## Wymagania techniczne

-   Laravel 11
-   MySQL / SQLite
-   REST API
-   Blade
-   Laravel Breeze
-   Eloquent ORM
-   Migracje
-   Kolejki i harmonogram
-   Możliwość uruchomienia lokalnie
