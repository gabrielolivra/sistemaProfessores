App SistemaProfessores

1. Baixar e instalar o xampp
2. git clone na pasta htdocs no xampp
3. start xampp
4. localhost/phpmyadmin
5. criar um banco com o nome sistemaprofessores
6. importar o arquivo sistemaprofessores.sql
7. acessar localhost/sistemaprofessores
8. login do admin
   8.1 usuario: root
   8.2 senha : root

Na tela do admin 
1. pode cadastrar, editar e excluir o professor.
2. Ver mensagens de todos os professores.
3. Editar, aprovar e excluir mensagens.

Na tela autenticada
O usuario criado pelo admin pode ter acesso a:
1. Ver mensagens
2. Editar, aprovar e excluir mensagens vinculadas a ele.

Na tela public
1. Qualquer aluno pode enviar mensagem para qualquer professor cadastrado no sistema menos o admin

Tabelas criadas:
1. Usuarios
2. Mensagens (As mensagens estão vinculada ao usuario)
