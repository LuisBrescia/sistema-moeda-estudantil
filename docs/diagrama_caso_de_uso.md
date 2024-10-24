# Diagrama de caso de uso

```mermaid
---
title: Diagrama de Casos de Uso do Sistema de Mérito Estudantil
---

actor Estudante
actor Professor
actor EmpresaParceira

Estudante --> (Registrar-se)
Estudante --> (Autenticar-se)
Estudante --> (Consultar Extrato)
Estudante --> (Receber Moedas)
Estudante --> (Trocar Moedas por Vantagens)
Estudante --> (Receber Notificação por Email)

Professor --> (Autenticar-se)
Professor --> (Consultar Extrato)
Professor --> (Enviar Moedas aos Estudantes)
Professor --> (Receber Saldo Semestral)

EmpresaParceira --> (Registrar-se)
EmpresaParceira --> (Autenticar-se)
EmpresaParceira --> (Cadastrar Vantagens)
EmpresaParceira --> (Receber Notificação de Resgate)

(Enviar Moedas aos Estudantes) ..> (Enviar Notificação por Email) : inclui
(Trocar Moedas por Vantagens) ..> (Enviar Notificação por Email) : inclui

Sistema --> (Enviar Notificação por Email)

Estudante -- (Trocar Moedas por Vantagens) -- EmpresaParceira

```
