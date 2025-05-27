# Cadastro de Eventos Web Servidor

Projeto desenvolvido para a disciplina de Web Servidor do curso de Análise e Desenvolvimento de Sistemas na UTFPR.

## Descrição do Projeto

Este é um projeto desenvolvido em PHP que tem como objetivo gerenciar eventos e reservas de ingressos. O sistema permite que os usuários se cadastrem, façam login, criem eventos, reservem ingressos e visualizem suas reservas. O foco do projeto é oferecer uma interface simples e funcional para o gerenciamento de eventos.

## Instalação

Para instalar e configurar o projeto localmente, siga os passos abaixo:

1. Clone o repositório:

   ```bash
   [git clone https://github.com/CarlosEduardoTito/Cadastro_Eventos_Web-Servidor.git]
   (https://github.com/CarlosEduardoTito/Cadastro_Eventos_Web-Servidor.git)
   ```

2. Com o XAMPP instalado na máquina, inicie o Apache:

   [Download XAMPP](https://www.apachefriends.org/pt_br/download.html)

3. Adicione a pasta `trabalho2` na pasta `htdocs`:

   ```
   C:\xampp\htdocs
   ```

4. Instale as dependências do Composer (caso utilize alguma biblioteca no futuro):

   ```bash
   cd trabalho2
   composer install
   ```

5. Importe o banco de dados MySQL:

   - No phpMyAdmin, crie um banco chamado `eventos_db`.
   - Importe o arquivo [`eventos_db.sql`](eventos_db.sql) localizado na raiz do projeto para criar as tabelas necessárias.

6. Acesse o projeto em [http://localhost/trabalho2/public/](http://localhost/trabalho2/public/)

## Utilização do Composer

O projeto está estruturado para utilizar o [Composer](https://getcomposer.org/) como gerenciador de dependências e autoload de classes. O autoload está configurado via PSR-4, facilitando a organização e o carregamento automático das classes do diretório `app/`.  
Mesmo que não haja dependências externas no momento, o Composer é utilizado para garantir um padrão de organização e facilitar futuras expansões.

## Banco de Dados

O sistema utiliza um banco de dados MySQL para armazenar informações de usuários, eventos e reservas.  
A estrutura do banco pode ser criada facilmente importando o arquivo [`eventos_db.sql`](eventos_db.sql), que contém todas as tabelas e relacionamentos necessários para o funcionamento do sistema.

- **Tabelas principais:**
  - `usuarios`: Armazena os dados dos usuários cadastrados.
  - `eventos`: Armazena os eventos criados pelos usuários.
  - `reservas`: Armazena as reservas de ingressos feitas pelos usuários.

As credenciais de acesso ao banco de dados podem ser configuradas no arquivo [`app/config/database.php`](trabalho2/app/config/database.php).

## Funcionalidades Faltantes

- Sistema de notificações para eventos.

## Funcionalidades do Projeto

- Cadastro de usuários com autenticação (registro, login, logout).
- CRUD para gerenciamento de eventos (criar, listar, editar e excluir eventos).
- Sistema de reservas de ingressos com controle de disponibilidade.
- Listagem de eventos e reservas.

## Tecnologias Utilizadas

- **PHP** - Linguagem principal.
- **HTML/CSS** - Para o desenvolvimento do frontend.
- **JavaScript** - Para interatividade no frontend.

## Observações

- O CRUD de eventos está implementado, permitindo criar, visualizar, editar e excluir eventos.
- O Composer é utilizado para autoload das classes e organização do projeto.
- O banco de dados MySQL é essencial para o funcionamento do sistema.
