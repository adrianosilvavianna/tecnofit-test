# tecnofit-test

* Construi uma Api de consulta restful Http.

* Construi uma collection no Postman para facilitar os testes.
disponível no link:
https://www.getpostman.com/collections/3fa48a72dc173e637aca

## Start da aplicação

* composer install
* Rodar o arquivo tecnofit.sql em seu banco de dados
*  Alterar username, senha e nome do banco no arquivo .env (tecnofit-api/.env) de    acordo com a configuração do banco local.
* php artisan migrate
* php artisan serve - http://localhost:8000/
* php artisan route:list - (para visualizar as rotas)

## Detalhes da aplicação

* Framework PHP: Laravel
* Banco de Dados: Mysql

A api possui um banco de dados relacional Mysql com 3 tabelas sendo manipuladas. 

* product
* order
* product_order (Pivot)

O codigo e as tabelas estão em inglês por convenção.








