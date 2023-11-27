# TaskManager
No dia a dia sempre tem  alguma  tarefa  importante que deixamos de fazer por não lembrar se  temos muita coisa  a  fazer 
os gerenciadores de  tarefa vem  com  essa primissa, uma agenda onde você pode administrar  suas tarefas e asssim nunca se  perder durante
o dia.

# Sobre
O projeto taskmanager é dividido em duas partes uma api(backend) que processa as CRUDS e  envia os resultados ao taskmanagerapp(frontend).
Onde o usuário pode: criar,editar,deletar e receber suas atividades.

#deploy:
  - https://m4arthu.space/tasks

# tecnologias
 - PHP // linguagem de progamação
 - Slim // Framework para criar a api rest
 - mySQL // banco de dados
 - Docker // gerenciador de containers
 - Nginx // servidor

# Como Rodar
- instale as dependencias : Git, Docker e Composer
- Clone o  repositorio:
  ```````powershell
  git clone <ssh deste repositorio>
  ```````
  ps: não se esqueça de subistituir o espaço delimitado  por pela ssh <> para pegar a ssh va em code -> ssh e copie a ssh
- acesse a raiz da pasta TaskManager e rode no terminal
```````powershell
composer install 
````````
ps: se estiver no windows veja um tutorial  de como rodar composer no windows:
https://www.alura.com.br/artigos/primeiros-passos-com-composer?utm_term=&utm_campaign=%5BSearch%5D+%5BPerformance%5D+-+Dynamic+Search+Ads+-+Artigos+e+Conteúdos&utm_source=adwords&utm_medium=ppc&hsa_acc=7964138385&hsa_cam=11384329873&hsa_grp=111087461203&hsa_ad=682526577071&hsa_src=g&hsa_tgt=dsa-843358956400&hsa_kw=&hsa_mt=&hsa_net=adwords&hsa_ver=3&gad_source=1&gclid=CjwKCAiAmZGrBhAnEiwAo9qHiebtzeMb_FQhj5KEavj6eninQNaAjC7e27sePyfdXCGQPpMpJp1O8xoCiBgQAvD_BwE
- acesse a pasta TaskManager onde tem o  arquivo docker-compose.yml e rode no terminal:
  ```````powerShell
  docker-comppose up 
  ```````
  ps:para esse passo é necessário que a dependencia Docker esteja instalada corretamente. Ele pode ser um pouquinho demorado  !!
-  veja se  a mensagem taskmanagerapi-dump-1 exited with code 0 aparece,caso  apareçatudo você j mpode fazer requisições nas rotas ebaaaa!!
-  caso apareça  a mensagem taskmanagerapi-dump-1 exited with code 1, não se preocupe rode denovo o comando
   ```````powerShell
    docker-comppose up 
   ``````````
   ps: caso ainda assim não apareça a mensagem: taskmanagerapi-dump-1 exited with code 0 prossiga para o proximo passo
- Fazer o  dump manualmente:
  1- acesse apos iniciar os containers http://localhost:5000
  2- logue com  as credenciais : host: mysql, username: root, password: password,
  3- va em importar e selecione o arquivo: TaskManager/docker/dumper/dump.sql
  4 - pronto tudo  certo pode acessar as rotas hehehhe!!!

 
 # Rotas
- GET https://localhost:8080/tasks // retorna todas as tasks do  banco 
- POST https://localhost:8080/tasks // envia  uma task ao  banco
  exemplo de body a ser passado:
  ````json
  {
    "name":"Ir ao  mercado",
    "description": "comprar um ps5",
     "date": "2020-03-02"
  }
  ````
- PUT  https://localhost:8080/tasks
    exemplo de body a ser passado:
  ````json
  {
    "name":"Ir ao  mercado",
    "description": "comprar um ps5",
     "date": "2020-03-02",
     "taskId": "1"
  }
  `````
  ps: taskId precisa ser um id obtido  do get /tasks pois necessita ser existente no banco
  
- DELETE https://localhost:8080/tasks/:id
   ps: taskId precisa ser um id obtido  do get /tasks pois necessita ser existente no banco
  
  

 

 
 
