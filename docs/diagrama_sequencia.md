sequenceDiagram
    %% Envio de Moedas
    participant Professor
    participant ContaProfessor as ContaP
    participant TransacaoEnvio as EnvioMoedas
    participant ContaAluno as ContaA
    participant Aluno
    participant Sistema

    %% Resgate de Vantagem
    participant EmpresaParceira as Empresa
    participant Vantagem
    participant TransacaoResgate as ResgateVantagem

    %% Envio de Moedas
    Professor->>ContaP: solicitarEnvioMoedas(aluno, valor)
    ContaP->>EnvioMoedas: criarTransacao(remetente, destinatario, valor)
    EnvioMoedas->>ContaP: debitarSaldo(valor)
    ContaP->>ContaA: creditarSaldo(valor)
    ContaA->>EnvioMoedas: registrarTransacao()
    EnvioMoedas->>Sistema: enviarNotificacao(aluno, "Você recebeu moedas")
    Sistema->>Aluno: notificaçãoRecebida()
    Aluno->>Aluno: atualizarSaldo()

    %% Resgate de Vantagem
    Aluno->>ContaA: solicitarResgate(vantagem, empresa)
    ContaA->>ResgateVantagem: criarTransacao(solicitante, parceiro, vantagem)
    ResgateVantagem->>ContaA: debitarSaldo(custo)
    ContaA->>ResgateVantagem: registrarTransacao()
    ResgateVantagem->>Empresa: notificarResgate(vantagem)
    Empresa->>Vantagem: confirmarDisponibilidade()
    Vantagem->>ResgateVantagem: confirmarResgate()
    ResgateVantagem->>Sistema: enviarNotificacao(aluno, "Vantagem resgatada com sucesso")
    Sistema->>Aluno: notificaçãoRecebida()
    Aluno->>Aluno: atualizarSaldoEBeneficios()
