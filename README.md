## Instruction

- Run ```docker-compose up -d --build```
- Run ```docker-compose exec php composer install```
- Run ```docker-compose exec php cp .env.example .env```
- Run ```docker-compose exec php php artisan key:generate```
- Run ```docker-compose exec php php artisan migrate --seed```
  
- Access localhost:8080/products
- Access localhost:8080/products?category=boots&priceLessThan=75000




