# lsi_rekrutacja

1. git pull
2. W pliku .env podmień dane dostępowe do bazy danych zamiast 'app' (login) i '!ChangeMe!' (hasło)
3. Jeśli korzystasz z innej wersji MySQL niż 5.7 to również podmień tą wartość na zgodną z Twoim środowiskiem
4. symfony serve -d
5. bin/console doctrine:database:create
6. bin/console doctrine:migrations:migrate
7. bin/console doctrine:fixtures:load
8. Otwórz w przeglądarce adres https://locahost:8000