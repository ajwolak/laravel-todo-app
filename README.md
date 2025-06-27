# To-Do List

## Wymagania

-   PHP >= 8.2
-   Composer
-   Node.js + NPM
-   MySQL
-   Laravel 11

---

## Wymagane usługi

Upewnij się, że masz lokalnie uruchomiony serwer MySQL. Domyślnie aplikacja korzysta z bazy MySQL (`localhost:3306`). Możesz to osiągnąć np. przez XAMPP lub inne środowisko.

Baza danych zostanie wypełniona danymi przez migracje, ale musi być utworzona wcześniej.

---

## Instalacja i uruchomienie

1. **Sklonuj repozytorium:**

```bash
git clone https://github.com/ajwolak/laravel-todo-app.git
cd laravel-todo-app
```

2. **Zainstaluj zależności:**

```bash
composer install
npm install
```

3. **Skonfiguruj plik `.env`:**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Zmodyfikuj plik `.env`:**

Ustaw dane połączenia do bazy danych MySQL (upewnij się, że masz zainstalowany i uruchomiony MySQL - domyślna konfiguracja wczyta się z pliku `.env`) oraz ustaw też konfigurację maila.

Konfiguracja maila (przykład Mailtrap):

-   MAIL_MAILER=smtp
-   MAIL_HOST=smtp.mailtrap.io
-   MAIL_PORT=2525
-   MAIL_USERNAME=twoj_mailtrap_login
-   MAIL_PASSWORD=twoj_mailtrap_password
-   MAIL_ENCRYPTION=null
-   MAIL_FROM_ADDRESS=example@example.com
-   MAIL_FROM_NAME="${APP_NAME}"

5. **Utwórz bazę danych i wykonaj migracje:**

Przed wykonaniem migracji utwórz bazę na serwerze:

```sql
CREATE DATABASE laravel_to_do_list;
```

Następnie uruchom migracje:

```bash
php artisan migrate
```

W trakcie migracji zostanie dodany użytkownik testowy:

-   Email: admin@test.pl
-   Hasło: admin123

6. **Uruchom aplikacje:**

Każdą z poniższych komend uruchom w osobnym terminalu:

```bash
npm run dev
php artisan serve
php artisan queue:work
php artisan schedule:work
```

---

## Dodatkowe informacje

Powiadomienia e-mail są wysyłane dzień przed terminem zadania o godzinie `08:00`.
Publiczny dostęp do zadań możliwy jest przez token z limitem czasowym.

---
