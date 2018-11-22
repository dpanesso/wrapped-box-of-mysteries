# Wrapped Box of Mysteries

Christmas List and Secret Santa Organizer written using the [Laravel](https://laravel.com/) framework.

This site is in beta and is likely to change until we have all the features ready for a normal release.

## Local Development

Copy .env.example to .env and set the correct values.

```
npm install
composer install
docker-compose up
docker-compose exec web php artisan migrate --seed
```

Navigate to [localhost:8080](http://localhost:8080)

## Features

- Create groups
    - Add users to group (email or link)
- Users add items to their wishlist
- Users can create lists for other people (kids and people without computers)
- Users "Claim" items on other peoples wishlists that they will purchase
