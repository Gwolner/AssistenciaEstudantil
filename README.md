# SAE - Sistema de Assistência Estudantil <img src="logo/scriptcase.jpg" width="50" height="50" align="right">

> Sistema de apoio ao fornecimento de fardamentos e empréstimos de livros desenvolvido durante estágio no Depart. de Gestão de Tecnologia da Informação (DGTI) do IFPE campus Recife para a Diretoria de Assistência ao Estudante do mesmo campus.

## Necessidade

Os processos de fornecimento de livros didáticos e entrega de fardamento eram realizados via protocolo em papel, o que levava tempo para sua localização em arquivos físicos. Com objetivo de reduzir o volume de papeis gastos nestas operações, bem como organziar e proteger as transações realizadas, foi solicitado ao DGTI um sistema que otimizasse estes processos.

## Ferramentas utilizadas

Para elaborar este sistema foi utilizado o Scriptcase v8.0, ambiente de desenvolvimento focado em PHP. Como ferramentas auxiliares foram utilizados Visual Studio Code para manipulação e análise de arquivos HTML, Javascript e CSS, usados de forma auxiliar ao Scriptcase, além do Mozilla Firefox e Google Chrome para testes de compatibilidade entre navegadores.

## Funcionalidades

O sistema possibilita:

* Cadastrar alunos;
* Consultar alunos por CPF ou matrícula;
* Atualizar dados dos alunos;
* Cadastrar livros;
* Consultar livros;
* Atualizar dados dos livros;
* Associar alunos aos livros;
* Gerar relatório de livros emprestados por período;
* Gerar relatório de livros emprestados por aluno;
* Gerar relatório de livros emprestados por curso;
* Associar alunos aos fardamentos
* Gerar pdf de Acompanhamento Domiciliar;
* Login de usuário através de LDAP;

## Consumo de API

Os dados dos alunos são preenchidos através do banco de dados do próprio Instituto Federal. Para acessar esses dados foi utilziado uma API interna com requisições Get e Post e resposta em JSON. O uso desta API só foi possível com autorização dos departamentos DADT (Diretoria de Avaliação e Desenvolvimento de Tecnologias) e DGTI (Depart. de Gestão de Tecnologia da Informação), tendo em vista que o sistema desenvolvido era em prol da oferta de melhor qualidade de serviço para aos alunos.

## Agradecimentos

* Aos estagiários e colegas de equipe: Marcos Antonio Ferrreira da Silva Junior e Eduardo Pinto Feitosa da Silva Filho;
* Ao supervisor da equipe de Desenvolvimento, Victor Monte;
* Ao responsável pelo Depart. de Gestão de Tecnologia da Informação, Tárcio Luna;
* Ao professor e servidor do Diretoria de Avaliação e Desenvolvimento de Tecnologias, Henrique Santos;
* E a todos os funcionários da Diretoria de Assistência ao Estudante por colaborarem com a equipe de Desenvolvimento.
