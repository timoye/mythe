## Instruction

- To Setup ```bash run-setup.sh```
- To Run Test, after setup, run ```docker-compose exec php php artisan test```

- Access localhost:8080/products
- Access localhost:8080/products?category=boots&priceLessThan=75000


## Explanation on Decisions Taken

- Use of Laravel - I am very comfortable with Laravel

- Use of mysql - I find it comfortable to query an RDMS using Eloquent

- Use of docker - An instruction said **The project must be runnable with 1 simple command from any machine** Docker ensures that is achieved wasily

- Use of Classes called Services - It is easier to break down code this way, for readability ans reusability

- End 

