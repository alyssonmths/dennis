<h1>projeto-dennis</h1>

> Sistema web para gerenciamento de funcionários e produção mensal

### Projeto desenvolvido para uma fábrica de peças de roupas femininas, com foco no gerenciamento da produção de funcionários de maneira ágil. 👖

## Funcionalidades 📝

- Cadastro de itens de produção
- Cadastro de funcionários
- Realização de cálculos e atribuição aos funcionários
- Acompanhamento da produção mensal e fluxo de caixa através de tabelas
- Exportação de PDFs

> Conheça Dennis

![Capturar](https://github.com/user-attachments/assets/66a38cc8-c631-4d42-ae9a-2ea76cb36380)

Esta é a página inicial, onde o usuário pode ver algumas estatísticas e informações.

### Página de realização dos cálculos

![calculos](https://github.com/user-attachments/assets/ed92cee0-ff75-42a7-bcb6-6c9cccbee418)

Aqui encontra-se uma das funcionalidades mais importantes do Dennis, a realização de cálculos.
Através da biblioteca PHP Laracart, foi possível implementar a funcionalidade de criar e registrar cálculos de maneira rápida e simples.
> Tudo isso integrado com os funcionários e itens cadastrados! 🔥

### Página de preços

![precos](https://github.com/user-attachments/assets/9c806011-c7c5-4141-a33e-cb16c97def50)

Os preços são necessários para que o usuário possa realizar os cálculos. Dessa maneira, desenvolvi uma maneira de adicioná-los e visualizar de maneira clara, através de uma tabela.

### Página de estatísticas

![estatisticas](https://github.com/user-attachments/assets/fff6101e-8a94-49cc-a982-34ab48a53744)

Aqui o usuário pode consultar o fluxo de caixa de sua empresa na forma de gráficos 📊
As tabelas fornecem informações valiosas na administração do negócio.

### Página de funcionários

![funcionarios](https://github.com/user-attachments/assets/155477d4-0418-4ea2-9a58-9fb03fce82df)

Os funcionários são apresentados nessa página. É possível também ver os detalhes de cada funcionário ao clicar sobre o mesmo.

# Diferencial do projeto
<strong>Geração de relatórios em PDF dos funcionários, tabela de preços e dos cálculos. Para isso, foi usada a famosa biblioteca DomPDF</strong>

![pdf](https://github.com/user-attachments/assets/dc4bdb6e-0950-46cc-a852-044eff8c3e1c)

## E aí, gostou de conhecer o Dennis? Agora vamos para algumas informações mais técnicas:

🛠️ Tecnologias e Ferramentas
- PHP com Laravel: Framework para desenvolvimento do back-end.
- JavaScript com jQuery: Utilizado para realizar requisições de CRUD.
- Bootstrap: Para estilização e responsividade.

📊 Bibliotecas Utilizadas
- Chart.js: Geração de gráficos detalhados sobre os pagamentos e fluxo de caixa.
- DataTables: Funcionalidades de ordenação e paginação em tabelas, facilitando a navegação e consulta dos dados.
- DomPDF: Geração de relatórios em PDF, permitindo fácil compartilhamento e armazenamento.
- Laracart: Gerenciamento de dados de cálculo, como quantidade, valor unitário, e detalhes do produto.
