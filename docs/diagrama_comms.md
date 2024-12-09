```mermaid
flowchart LR
    %% Definição dos nós (participantes)
    Professor[Professor]
    ContaP[ContaP]
    TransacaoEnvio[EnvioMoedas]
    ContaA[ContaA]
    Aluno[Aluno]
    Sistema[Sistema]
    Empresa[Empresa]
    Vantagem[Vantagem]
    TransacaoResgate[ResgateVantagem]

    %% Relações básicas
    Professor --- ContaP
    ContaP --- TransacaoEnvio
    TransacaoEnvio --- ContaA
    ContaA --- Aluno
    Aluno --- Sistema

    Aluno --- TransacaoResgate
    TransacaoResgate --- Empresa
    Empresa --- Vantagem

    %% Mensagens - Envio de Moedas
    Professor -->|1: solicitarEnvioMoedas(aluno, valor)| ContaP
    ContaP -->|2: criarTransacao(remetente, destinatario, valor)| TransacaoEnvio
    TransacaoEnvio -->|3: debitarSaldo(valor)| ContaP
    ContaP -->|4: creditarSaldo(valor)| ContaA
    ContaA -->|5: registrarTransacao()| TransacaoEnvio
    TransacaoEnvio -->|6: enviarNotificacao(aluno, "Você recebeu moedas")| Sistema
    Sistema -->|7: notificaçãoRecebida()| Aluno
    Aluno -->|8: atualizarSaldo()| Aluno

    %% Mensagens - Resgate de Vantagem
    Aluno -->|9: solicitarResgate(vantagem, empresa)| ContaA
    ContaA -->|10: criarTransacao(solicitante, parceiro, vantagem)| TransacaoResgate
    TransacaoResgate -->|11: debitarSaldo(custo)| ContaA
    ContaA -->|12: registrarTransacao()| TransacaoResgate
    TransacaoResgate -->|13: notificarResgate(vantagem)| Empresa
    Empresa -->|14: confirmarDisponibilidade()| Vantagem
    Vantagem -->|15: confirmarResgate()| TransacaoResgate
    TransacaoResgate -->|16: enviarNotificacao(aluno, "Vantagem resgatada com sucesso")| Sistema
    Sistema -->|17: notificaçãoRecebida()| Aluno
    Aluno -->|18: atualizarSaldoEBeneficios()| Aluno
