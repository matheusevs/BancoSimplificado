# Banco Simplificado - Plataforma de Gerenciamento de contas

O Banco Simplificado é uma plataforma de gerenciamento de usuários desenvolvida para facilitar o registro, edição e exclusão de usuários em uma aplicação web. Este projeto é ideal para administradores que desejam controlar a base de usuários com eficiência e garantir a segurança dos dados.

## Funcionalidades do Sistema

- **Registro de Usuários:** Permite que novos usuários se cadastrem fornecendo informações como nome, CPF, endereço de e-mail e senha. O sistema garante que CPF e endereço de e-mail sejam únicos, permitindo apenas um cadastro por CPF ou e-mail. - Funcionalidade em desenvolvimento

- **Login e Token de Sessão:** Os usuários podem fazer login em suas contas com segurança usando seu endereço de e-mail e senha. Um token de sessão é gerado após o login e permanece válido por 24 horas, oferecendo acesso contínuo às funcionalidades exclusivas.

- **Recuperação de Senha:** Permite que os usuários redefinam suas senhas caso as esqueçam. Realizando o envio de um e-mail com um link para redefinir a senha. - Funcionalidade em desenvolvimento

- **Gestão de Usuários:** Os usuários autenticados podem visualizar, editar e excluir suas próprias informações de perfil, proporcionando controle sobre seus dados pessoais.

- **Histórico de Atividades:** A funcionalidade de histórico de atividades é útil para acompanhar e registrar as ações realizadas pelos usuários no sistema.

- **Usuários Administradores:** Os administradores têm privilégios estendidos, incluindo a capacidade de editar informações de outros usuários e, quando necessário, excluir contas de usuário.

- **Proteção de Acesso:** O Banco Simplificado garante que apenas os administradores tenham acesso às funcionalidades de edição e exclusão de usuários, mantendo a segurança e a integridade do sistema.

- **Transferência de Dinheiro:** Usuários têm a capacidade de enviar dinheiro, realizando transferências entre si ou para lojistas. - Funcionalidade em desenvolvimento

- **Recebimento de Dinheiro por Lojistas:** Lojistas podem receber transferências de dinheiro, mas não têm a capacidade de enviar dinheiro a terceiros. - Funcionalidade em desenvolvimento

- **Validação de Saldo:** Antes de completar qualquer transferência, o sistema valida se o usuário tem saldo suficiente para realizar a transação. - Funcionalidade em desenvolvimento

- **Verificação Externa da Transferência:** Antes de finalizar uma transferência, o sistema consulta um serviço autorizador externo, utilizando um mock para simulação. Isso garante que a transação seja consistente. - Funcionalidade em desenvolvimento

- **Transações Reversíveis:** Todas as transferências são tratadas como transações, o que significa que, em caso de qualquer inconsistência, o dinheiro é reembolsado para a conta do usuário remetente. - Funcionalidade em desenvolvimento

- **Notificações de Pagamento:** Tanto usuários quanto lojistas recebem notificações de pagamento por meio de serviços de terceiros. O sistema utiliza um mock para simular o envio de notificações, com a consideração de que o serviço de terceiros pode estar indisponível em alguns momentos. - Funcionalidade em desenvolvimento

- **Serviço RESTFul:** O sistema é construído como um serviço RESTFul, permitindo a integração fácil com outros sistemas e aplicativos. - Funcionalidade em desenvolvimento 

## Tecnologias Utilizadas

- PHP
- MySQL

## Benefícios do Projeto

- Uma plataforma confiável e eficiente para gerenciar informações de usuários em um ambiente web.
- Facilita a supervisão e o gerenciamento de registros de usuários para administradores.
- A funcionalidade de token de sessão otimiza a experiência do usuário, minimizando a necessidade de login frequente.
- Promove a segurança dos dados do usuário e a integridade do sistema.

## Como Começar

- Clone este repositório para o seu ambiente de desenvolvimento.
- Configure seu ambiente de servidor web e banco de dados.
- Execute o script SQL fornecido para criar o esquema do banco de dados.
- Personalize e integre o Banco Simplificado em seu projeto web.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir problemas (issues) e enviar pull requests para melhorar o Banco Simplificado.
