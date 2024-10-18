# Histórias de Usuário

## 1. História de Usuário: Cadastro de Aluno

**Como** um aluno,  
**Eu quero** me cadastrar no sistema,  
**Para que** eu possa participar do programa de reconhecimento de mérito estudantil.

- **Critérios de aceitação:**
  - O aluno deve fornecer nome, email, CPF, RG, endereço, instituição de ensino e curso.
  - As instituições participantes já devem estar cadastradas no sistema, e o aluno deve selecionar uma delas.
  - O sistema deve validar a autenticidade dos dados inseridos.
  - Um email de confirmação de cadastro deve ser enviado.

## 2. História de Usuário: Cadastro de Professor

**Como** um administrador do sistema,  
**Eu quero** cadastrar os professores através de uma lista fornecida pela instituição,  
**Para que** eles possam distribuir moedas aos alunos.

- **Critérios de aceitação:**
  - Os professores devem ter nome, CPF e o departamento vinculado à instituição cadastrados.
  - Deve haver um vínculo claro entre o professor e a instituição de ensino.
  - Cada professor deve ter acesso a um saldo inicial de 1.000 moedas a cada semestre.

## 3. História de Usuário: Distribuição de Moedas por Professor

**Como** um professor,  
**Eu quero** distribuir moedas para os alunos,  
**Para que** eu possa reconhecer o bom desempenho e participação deles nas aulas.

- **Critérios de aceitação:**
  - O professor deve ser capaz de visualizar seu saldo de moedas.
  - O professor pode escolher um aluno e indicar o número de moedas a serem enviadas.
  - O professor deve fornecer uma mensagem com o motivo do reconhecimento.
  - O sistema deve verificar se o professor tem saldo suficiente antes de completar a transação.
  - O aluno deve ser notificado por email quando receber moedas.

## 4. História de Usuário: Extrato de Conta para Professores

**Como** um professor,  
**Eu quero** visualizar o extrato da minha conta de moedas,  
**Para que** eu saiba quantas moedas já distribui e quantas ainda restam.

- **Critérios de aceitação:**
  - O professor deve ver um histórico de todas as transações realizadas.
  - O extrato deve incluir o aluno que recebeu as moedas, a quantidade enviada e a mensagem de reconhecimento.
  - O saldo atual de moedas deve ser exibido.

## 5. História de Usuário: Resgate de Vantagens por Aluno

**Como** um aluno,  
**Eu quero** trocar minhas moedas por produtos e descontos oferecidos pelas empresas parceiras,  
**Para que** eu possa aproveitar as vantagens oferecidas no sistema.

- **Critérios de aceitação:**
  - O aluno deve ser capaz de ver uma lista de vantagens disponíveis.
  - Cada vantagem deve mostrar a descrição, foto, e o número de moedas necessário para a troca.
  - Ao resgatar uma vantagem, o saldo do aluno deve ser atualizado.
  - O aluno deve receber um email com um cupom e código gerado para utilizar na troca.
  - A empresa parceira também deve receber um email com o código gerado para conferência.

## 6. História de Usuário: Cadastro de Empresas Parceiras

**Como** uma empresa parceira,  
**Eu quero** me cadastrar no sistema,  
**Para que** eu possa oferecer produtos e descontos em troca das moedas virtuais dos alunos.

- **Critérios de aceitação:**
  - A empresa deve fornecer nome, email, CNPJ e uma descrição dos produtos ou serviços oferecidos.
  - A empresa deve adicionar as vantagens que deseja oferecer, incluindo descrição, foto e o número de moedas necessárias.
  - O sistema deve enviar um email de confirmação de cadastro.

## 7. História de Usuário: Extrato de Conta para Alunos

**Como** um aluno,  
**Eu quero** visualizar o extrato da minha conta de moedas,  
**Para que** eu saiba quantas moedas recebi e troquei até o momento.

- **Critérios de aceitação:**
  - O aluno deve ver um histórico de todas as transações, incluindo recebimento de moedas e trocas realizadas.
  - O extrato deve mostrar o professor que enviou as moedas e as vantagens trocadas.
  - O saldo atual de moedas deve ser exibido.

## 8. História de Usuário: Autenticação de Usuários

**Como** um usuário (aluno, professor ou empresa parceira),  
**Eu quero** realizar login no sistema com um email e senha,  
**Para que** eu possa acessar minha conta e utilizar as funcionalidades do sistema.

- **Critérios de aceitação:**
  - O sistema deve permitir login com email e senha previamente cadastrados.
  - O sistema deve garantir autenticação segura.
  - Deve haver uma opção para redefinir senha em caso de esquecimento.
