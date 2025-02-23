# Gerenciador de discografia
[![NPM](https://img.shields.io/npm/l/react)](https://github.com/LuscaKF/discography-manager-API/blob/main/LICENSE)

# Sobre o projeto

A API é um serviço web desenvolvido para fornecer funcionalidades relacionadas à gestão de álbuns e faixas de música. Com essa API, os usuários podem visualizar, adicionar, editar e excluir álbuns e faixas de música, além de acessar informações detalhadas sobre cada uma delas. Oferecendo uma interface intuitiva e de fácil integração, a API possibilita aos desenvolvedores criar aplicativos e serviços que explorem o vasto catálogo musical.

## Exemplo do Index de faixas
![image](https://github.com/LuscaKF/discography-manager-API/assets/62342102/a142787a-387f-4d09-a290-684b95a93e96)

# Execute as migrações
## É necessário trocar os dados do arquivo .env na raiz do projeto pelos dados do seu banco de dados
## Após ter feito isso execute as migrações com: ```bash php artisan migrate ```

# Como criar um album ou faixa?
## Vá até a rota desejada, exempo: http://127.0.0.1:8000/api/albums

![image](https://github.com/LuscaKF/discography-manager-API/assets/62342102/d7edce77-f9d4-4626-b84e-dca4c007fbcb)

# Tecnologias utilizadas
## Back end
- Composer
- Laravel Framework 10
- PHP 8
- Axios
## Implantação em produção
- Teste da API: Insomia
- Banco de dados: MySQL

# Como executar o projeto

## Back end
Pré-requisitos: Laravel 10 | PHP 8

```bash
# Copiar dependências de:
(https://github.com/LuscaKF/discography-manager-API/blob/master/composer.json)

# Logo em seguina no projeto execute
composer install

# executar o projeto
php artisan serve
```
# Autor

Lucas Kirow Fernandes

https://www.linkedin.com/in/lucas-kirow-fernandes-304b74272/
