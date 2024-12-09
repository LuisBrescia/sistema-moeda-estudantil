# Moeda Estudantil

Referente aos labs 3, 4 e 5 de Desenvolvimento de sistemas

## Alunos:

- Luís Felipe Teixeira Dias Brescia
- Gustavo Pereira de Oliveira
- Victor Reis Carlota

## Documentação:

- [Diagramas de caso de uso](docs/diagrama_caso_de_uso.md)
- [Histórias de usuário](docs/historias_de_usuario.md)
- [Diagrama de classes](docs/diagrama_classes.md)
- [Diagrama de componentes](docs/diagrama_componentes.md)
- [Diagrama de sequência](docs/diagrama_sequencia.md)
- [Diagrama Entidade-Relacionamento](docs/diagrama_er.md)

<hr>

## Como usar a aplicação

O projeto **AraVault** utiliza Docker, Laravel Sail no backend e PNPM no frontend.

### Backend
1. Navegue até o diretório `backend`

```bash
cd backend
```
2. Instale as dependências utilizando o Composer com a imagem Docker do Laravel Sail:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs

```

3. Construa a imagem do sail sem cache:

```bash
   ./vendor/bin/sail build --nocache
```

4. Inicie os containers em segundo plano:
```bash
./vendor/bin/sail up -d

```

5. Execute as migrações e seeders:
```bash
./vendor/bin/sail artisan migrate:fresh --seed

```


### Frontend

1. Navegue até o diretório `frontend`:

```bash
cd frontend
```

2. Instale o PNPM globalmente (caso ainda não tenha):

```bash
npm i -g pnpm

```

3. Instale as dependências do frontend:

```bash
pnpm install
```

4. Inicie o servidor de desenvolvimento:

```bash
pnpm dev

```


<hr>


# Definição e implementação da estratégia de acesso ao banco de dados

O sistema **AraVault** utiliza o framework Laravel para o desenvolvimento backend, implementando a estratégia de acesso ao banco de dados através do **Eloquent ORM** (object-relational mapping).


## Eloquent Orm

O **Eloquent ORM** é a implementação de mapeamento objeto-relacional nativa do Laravel. ele fornece uma forma simples e intuitiva de interagir com o banco de dados, permitindo que os desenvolvedores trabalhem com modelos orientados a objetos e relações entre tabelas sem a necessidade de escrever sql puro.

### Principais características do eloquent:

- **Active Record Pattern**: cada tabela do banco de dados possui uma classe correspondente que interage com ela.
- **Relacionamentos Elegantes**: suporte a relacionamentos como um-para-um, um-para-muitos, muitos-para-muitos, polimórficos, entre outros.
- **Consultas Fluentes**: interface intuitiva para construção de consultas ao banco de dados.
- **Eventos e Observadores**: possibilidade de executar código em determinados pontos do ciclo de vida dos modelos (por exemplo, ao criar ou atualizar um registro).

## Implementação no projeto

### Modelos

Para cada entidade definida no diagrama entidade-relacionamento, foi criado um modelo correspondente em Laravel. os principais modelos incluem:

- **Usuário**: classe base que contém atributos e métodos comuns a todos os tipos de usuários (alunos, professores e empresas parceiras).

- **Aluno**: estende usuario e adiciona atributos específicos como nome, email, cpf, rg, endereço e curso.

- **Professor**: estende usuario e inclui atributos como nome, cpf e departamento.

- **Empresa Parceira**: estende usuario e contém informações específicas da empresa.

- **Instituição**: representa as instituições de ensino participantes.

- **Vantagem**: refere-se aos produtos ou descontos oferecidos pelas empresas parceiras.

- **Conta**: gerencia o saldo de moedas dos usuários.

- **Transação**: registra as transações realizadas no sistema, como envio e resgate de moedas.

### Herança e Polimorfismo

Utilizamos a herança para que `Aluno`, `Professor` e `EmpresaParceira` estendam a classe `Usuario`. O Eloquent suporta herança através do uso de **Model Inheritance** e **Traits**.

## Definição de relacionamentos

Os relacionamentos entre os modelos foram definidos conforme o diagrama er:

**Usuário e conta**

- **Um usuário possui uma conta.**
- **Relacionamento**: `hasOne` e `belongsTo`.

```php
class Usuario extends Authenticatable
{
    public function conta()
    {
        return $this->hasOne(Conta::class, 'id_usuario');
    }
}

class Conta extends Model
{
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
```

**Aluno e instituição**

- **Um aluno pertence a uma instituição**.
- **Relacionamento**: `belongsTo`.

```php
class Aluno extends Usuario
{
    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class, 'id_instituicao');
    }
}
```

**Professor e Instituição:**

- **Um professor pertence a uma instituição.**
- **Relacionamento**: `belongsTo`.

```php
class Professor extends Usuario
{
    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class, 'id_instituicao');
    }
}
```

**Empresa Parceira e Vantagens:**

- **Uma empresa parceira pode oferecer várias vantagens.**
- **Relacionamento**: `hasMany`.

```php
class EmpresaParceira extends Usuario
{
    public function vantagens()
    {
        return $this->hasMany(Vantagem::class, 'id_empresa');
    }
}
```

**Conta e Transações:**

- **Uma conta pode ter várias transações.**
- **Relacionamento**: `hasMany` e `belongsTo`.

```php
class Conta extends Model
{
    public function transacoes()
    {
        return $this->hasMany(Transacao::class, 'id_conta');
    }
}

class Transacao extends Model
{
    public function conta()
    {
        return $this->belongsTo(Conta::class, 'id_conta');
    }
}
```

**Transação e Vantagem:**

- **Uma transação pode envolver uma vantagem (no caso de resgate)**.
- **Relacionamento**: `belongsTo`.

```php
class Transacao extends Model
{
    public function vantagem()
    {
        return $this->belongsTo(Vantagem::class, 'id_vantagem');
    }
}
```

### Operações CRUD

O Eloquent simplifica as operações de criação, leitura, atualização e exclusão (CRUD) com métodos como `save()`, `find()`, `update()`, e `delete()`.

**Exemplo de criação de um novo aluno:**

```php
$aluno = new Aluno();
$aluno->nome = 'João Silva';
$aluno->email = 'joao.silva@example.com';
$aluno->CPF = '123.456.789-00';
$aluno->RG = 'MG-12.345.678';
$aluno->endereco = 'Rua A, 123';
$aluno->curso = 'Engenharia';
$aluno->login = 'joaosilva';
$aluno->senha = bcrypt('senha123');
$aluno->id_instituicao = $instituicao->id;
$aluno->save();
```

### Consultas Complexas

O Eloquent permite realizar consultas complexas de forma simplificada:

```php
// Obter todas as vantagens de uma empresa parceira específica
$vantagens = EmpresaParceira::find($id_empresa)->vantagens;

// Obter o extrato de um aluno
$extrato = Aluno::find($id_aluno)->conta->transacoes;
```

### Migrações

As **migrações** do Laravel foram utilizadas para criar as tabelas do banco de dados de acordo com o diagrama ER. Isso assegura que a estrutura do banco de dados seja versionada e reproduzível.

**Exemplo de migração para a tabela usuarios:**

```php
Schema::create('usuarios', function (Blueprint $table) {
    $table->increments('id_usuario');
    $table->string('login')->unique();
    $table->string('senha');
    $table->string('tipo_usuario'); // aluno, professor ou empresa_parceira
    $table->timestamps();
});
```

### Padrão DAO (Data Access Object)

Embora o Eloquent forneça uma camada de abstração robusta, utilizamos o padrão DAO em cenários onde é necessário encapsular operações de acesso a dados mais complexas ou específicas, promovendo a separação de responsabilidades e facilitando a manutenção.

**Exemplo de um DAO para transações:**

```php
class TransacaoDAO
{
    public function registrarEnvioMoedas($professor, $aluno, $valor, $mensagem)
    {
        // Lógica para registrar a transação de envio de moedas
    }

    public function registrarResgateVantagem($aluno, $vantagem)
    {
        // Lógica para registrar o resgate de uma vantagem
    }

}
```

### Segurança e Boas Práticas

- **Autenticação e Autorização**: Implementadas utilizando os mecanismos nativos do Laravel, garantindo que apenas usuários autenticados acessem determinadas rotas e recursos.

- **Proteção Contra Injeção de SQL**: O Eloquent utiliza consultas parametrizadas, mitigando riscos de injeção de SQL.

- **Validação de Dados**: Utilizamos as Requests do Laravel para validar os dados de entrada antes de processá-los.

- **Hashing de Senhas**: As senhas são armazenadas de forma segura utilizando o algoritmo de hashing `bcrypt`.

### Benefícios da Abordagem Adotada

- **Produtividade**: O uso do Eloquent agiliza o desenvolvimento, permitindo focar na lógica de negócios.

- **Manutenibilidade**: Código mais organizado e fácil de manter devido à separação de responsabilidades.

- **Escalabilidade**: A arquitetura adotada permite que o sistema seja facilmente escalado e adaptado a novas necessidades.

- **Comunidade** e Suporte: O Laravel possui uma grande comunidade e extensa documentação, facilitando a resolução de problemas e implementação de novas funcionalidades.

<hr>

### Conclusão

A estratégia de acesso ao banco de dados utilizando o **Eloquent ORM** do Laravel proporciona uma forma eficiente e elegante de interagir com o banco de dados, alinhando-se às boas práticas de desenvolvimento. Combinado com o padrão **DAO** onde necessário, garante-se uma arquitetura robusta, segura e de fácil manutenção, atendendo plenamente aos requisitos do sistema **Moeda Estudantil**.
