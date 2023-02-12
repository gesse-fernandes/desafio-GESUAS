### Deafio para vaga Desenvolvedor(a) Full Stack Pleno :

 O desafio foi criado para avaliar meus conhecimentos técnicos a partir de uma seleção para uma vaga full-stack


## Solicitado

  1. Crie uma aplicação contendo um formulário para cadastrar cidadãos. 
  2. O formulário deve conter um único campo para informar o nome do cidadão. 
  3. Ao ser cadastrado, um número NIS deve ser gerado automaticamente, atribuído a esta pessoa e então exibido na tela junto de uma mensagem de sucesso. 
  4. Deve ser possível também pesquisar os registros já existentes através do número NIS. 
  5. Caso o NIS informado já esteja cadastrado, a aplicação deve exibir o nome do cidadão e seu número NIS. 
  6. Caso não esteja, deve exibir: “Cidadão não encontrado”. 
  7. Lembre-se de criar um README contendo as instruções necessárias para executarmos a aplicação

## regras
 1. O backend da aplicação deve ser escrito em PHP; 
 2. O código deve ser escrito com o paradigma da Programação Orientada a Objetos; 
 3. Não é permitido usar nenhum framework para criação de aplicações inteiras como Symfony ou Laravel. Mas você pode usar "frameworks" para tarefas específicas, como o PHPUnit para testes por exemplo.
 4. Você pode usar qualquer outra biblioteca de terceiros que desejar. 

 ## o que será avaliado

 1. O funcionamento correto da aplicação de acordo com os requisitos do desafio;

 2. A arquitetura da aplicação; 

 3. A qualidade, clareza e organização do código entregue. Iremos ler cada linha de código, então capriche!

 4. A utilização de boas práticas de desenvolvimento.

##  Bônus

 1. Utilização de padrões arquiteturais e de projeto; 

 2. Testes automatizados; 

 3. A utilização de um gerenciador de pacotes.


## configuração

 1. precisa ter o xamp ou wamp instalado

 2. php 7 ou 8 e mysql Intalado

 3. composer instalado

 4. configurar no arquivo raiz do projeto /index.php manter do jeito que está a constante INCLUDE_PATH: http://localhost/desafio-GESUAS/ como também  INCLUDE_PATH_STATIC: http://localhost/desafio-GESUAS/app/Views/pages/
 mas deve ter esta pasta no htdocs desafio-GESUAS para modificar fique a vontade.

 ## instalação

``` bash
#clonar o repositório.

 git clone https://github.com/gesse-fernandes/desafio-GESUAS

# usar o composer para instalar.
 composer install

 # entrar na pasta /app/DataBase/
 # copiar todo o conteúdo do SistemaCidadao.sql para criar o banco de dados e a tabela ou se preferir no phpmyadmin importar.
 ```

 ## pacotes usados

 - o proprio composer:

        - para inicializar o autoload

 - Testes com PHP Unit:

        - [PHPUnit](https://phpunit.readthedocs.io/pt_BR/latest/)

 ## Padrões Utilizados e Arquitetura
  
   Foi utilizado dois padrões de Arquitetura MVC(Model,View, Controller) e também REST API com PHP puro configurado por mim mesmo usando regras de pradrões de htaccess na pasta / do projeto e outro configurado na pasta /app/API para criar rotas dinâmicas. foi usado também o paradigma de Orientação a Objetos toda estruturada com classes, atributos e métodos e instanciada de acordo com a estrutura utilizada. também foi criado um arquivo Applicatiton responsavel por toda aplicação dinamica pelo metodo run() que executa tudo que está sendo passado pelo controller pois tudo foi mapeado.
  
  ## para realizar os testes 

   bom uma observação criei varios testes pensando na situações e tomadas de decisões do algoritmo pode tomar
  ``` bash
   #primeiro certificar que o phpunit/phpunit está instalado 
   #em seguida executar o comando
    vendor/bin/phpunit CitizenTest.php

   #para testes especificos rode o comando
   #testMetodo é apenas um exemplo.

   vendor/bin/phpunit --filter testMetodo   CitizenTest.php

  
  ```

  ## testar API.

   para testar API foi criada deve certificar que o banco de dados e a tabela já esta instalado como foi citado acima
   segundo certificar de saber qual a baseURl está na constante INCLUDE_PATH= http://localhost/desafio-GESUAS/
   após isso navegar para -> http://localhost/desafio-GESUAS/ + app/API

   ``` bash
    #ENDPOINTS:index, /store, /pesquisar, /delete/id, /edit/id, /indexOne/id, /existeId/id

    #o primeiro index lista todos os cidadãos paginados no limite 6 ele usa verbo GET
    http://localhost/desafio-GESUAS/app/API/


    #/store: este recebe como parametro(name) para cadastrar o cidadão e usa verbo POST
     {
      "name":"JOHN DOE"
     }
     http://localhost/desafio-GESUAS/app/API/store/

     #/pesquisar: este recebe como parametro(nis) para consultar o cidadão e usa o verbo POST
       {
      "nis":"xxx.xxx.xxx-xx"
     }
     http://localhost/desafio-GESUAS/app/API/pesquisar/

    #/delete/id: este recebe na url o número id do que ele vai deletar o cidadão ele usa o verbo DELETE
     http://localhost/desafio-GESUAS/app/API/delete/1

     #edit/id: este recebe um parametro(name) para atualizar os dados e outro na url o id do cidadão ele usa o verbo POST
      {
      "name":"JOHN DOE"
     }
     http://localhost/desafio-GESUAS/app/API/edit/1

     #/indexOne/id: este vai retornar o cidadão que recebe na url o id para buscar o cidadão ele usa o verbo GET
     http://localhost/desafio-GESUAS/app/API/indexOne/1

     #/existeId/id: este vai retornar se o cidadão existe ou não apenas para retornar verdadeiro ou falso ele usa o verbo
     #GET
     http://localhost/desafio-GESUAS/app/API/existeId/1

  ```
  fique a vontade de deseja criar uma aplicação de front-end com vueJS para consumir essa API mas na frente desejo atualizar a documentação da API criando a partir front-end como deve ser consumida.

  ## minhas considerações

   Este teste foi muito proveitoso pois tentei de tudo caprichar da melhor forma possível ter criado também uma API pois ja era uma vontade minha á muito tempo e este teste mais ainda pois foi capaz de eu realizar testes automatizados como também montar uma arquitetura de MVC um pouco mais facil de ser interpretada e utilizada e melhor ainda sem a necessidade de e usar algum framework para que eu mesma possa criar minhas rotas dinamicas e regras a partir de configurações do autoload e do proprio .htaccess  espero que vocês compreendam todo o código como também a execução do mesmo e também da documentação deste repositório para avaliação.

  ### Agradeço bastante a oportunidade obrigado mesmo.

  


