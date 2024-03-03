## Instruções e instalação
Extrair os arquivos referenta a aplicação:
Rodar o script do banco de dados 'l5_networks.sql', a tabela está vazia e será preenchida após a aplicação ser iniciada, qualquer alteração feita nos arquivos filas/ramais serão refletidas nesta tabela do banco.

Execute o seguinte comando na pasta raiz:
php -S localhost:8000 -t public
Onde 8000 é referente a porta que será utilizada, portanto pode ser qualquer outra porta de sua preferencia que não esteja sendo usada em outras aplicações.

### MELHORIAS APLICADAS
- Apliquei a arquitetura MVC no projeto, pensando numa manutenção futura ter tudo bem separado e definido ajuda a facilitar o trabalho.
- Criei um sistema de rotas simples para controlar de forma eficiente o fluxo de navegação do usuário e direcionar solicitações HTTP.
- Fiz algumas melhorias no layout da aplicação, adicionei algumas cores e melhorei a responsividade utilizando o próprio bootstrap que já estava aqui(4.0).
- Adicionei um timestamp abaixo do painel para que o usuário saiba exatamente quando foi a última vez que as infromações dispostas foram atualizadas.


## Teste analista junior

Neste teste você dispõe de um cenário fictício, onde há um painel de monitoramento de ramais que contem alguns bugs que precisam ser corrigidos. Este painel também deverá ser melhorado, o minimo de melhorias que deverá ser acrescentado serão 3. Abaixo uma relação dos itens que deverão ser corrigidos:

- Os ramais offiline não são exibidos corretamente no painel, para corrigir você deverá exibir os ramais indisponiveis, fazendo com que o card do painel fique cinza e traga um icone circular no canto superior direito com a cor cinza mais escura.✔
- Os ramais que estão em pausa no grupo de callcenter não estão sendo exibidos corretamente, para corrigir você deverá exibir os ramais que estão com com status de pausa, trazendo um icone circular no canto superior direito com a cor laranja.✔
- Os card deverão exibir os nomes dos agentes que estão no grupo de callcenter SUPORTE (arquivo lib\filas)✔

### MELHORIAS  
Após a correção destes itens, você deverá aplicar ao menos 3 (três) melhorias neste sistema.

### OBRIGATÓRIO  
O teste também contará com algumas atividades obrigatórias:
- Transformar o arquivo lib\ramais.php em uma classe e utiliza-lo neste sistema. Após a criação da classe o arquivo lib\ramais.php não deverá ser mais utilizado.✔
- Apesar dos registros serem estaticos, deverá ser criada uma base de dados utilizando mysql ou mariadb para armazenar as informações de cada ramal, como numero, nome, IP,  status do ramal no grupo de callcente (disponivel, pausa, offiline, etc).✔
- As informações da tela devem ser atualizadas a cada 10 segundos utilizando ajax e estas informações devem ser atualizadas na base de dados. Para verificar se está sendo atualizado na base de dados você poderá alterar as informações dos arquivos  lib\filas e lib\ramais✔

### IMPORTANTE
0. Você não podera utilizar frameworks, o código terá de ser 100% seu.
1. O arquivo lib\filas simula as informações de um grupo de callcenter  
2. O arquivo lib\ramais simula as informações dos ramais  
3. Estes arquivos se completam  
4. Estes arquivos NÃO devem unidos em um só arquivo  
5. Estes arquivos poderão ser alterados apenas para teste do AJAX  
6. Ao concluir o teste, deverá ser encaminhado um arquivo .zip contendo todo o código, dump da base de dados e instruções de instalação e a lista das melhorias aplicadas.