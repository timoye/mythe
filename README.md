## Instruction

- To set up Run 
```
bash run-setup.sh
```
  
- To Run Test, after set up, run 
```
docker-compose exec php php artisan test
```

- Access the URL 
```
http://localhost:8080/products
```

- Access 
```  
http://localhost:8080/products?category=boots&priceLessThan=75000
```


## Explanation on Decisions Taken

- Use of Laravel - I am very comfortable with Laravel and it provides a solid base to grow a project

- Use of mysql - The dataset is a highly related like in the case of products and category, this is a relationship that can be best done with a relational db to maintain consitency

- Use of docker - An instruction said *The project must be runnable with 1 simple command from any machine* Docker ensures that is achieved wasily

- Use of Classes called Services - It is easier to break down code this way, for readability and re-usability
