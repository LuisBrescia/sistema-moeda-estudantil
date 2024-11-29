<script setup>
definePageMeta({
  layout: 'auth',
  middleware: ['redirect-if-authenticated'],
});
</script>

<template>
  <p class="mb-8 text-sm text-surface-700 dark:text-surface-0/70">
    Esse acesso é utilizado para criar e configurar todos os seus serviços no
    Syscoin. Se está precisando utilizar a ferramenta operacional do Syscoin
    para inserir ou organizar reservas e fila de espera, deverá utilizar o
    <span class="font-semibold">Painel Operacional.</span>
    Entre os recursos disponíveis nesse painel estão:
  </p>

  <ul class="m-0 list-none p-0">
    <li class="mb-6 flex justify-start">
      <div>
        <span
          class="rounded-custom flex h-[38px] w-[38px] items-center justify-center bg-surface-950 text-surface-0 dark:bg-surface-0 dark:text-surface-900"
        >
          <i class="pi pi-clock"></i>
        </span>
      </div>
      <div class="ml-4">
        <span class="mb-12">Configuração de horário de funcionamento</span>
        <p class="mt-1 text-sm text-surface-700 dark:text-surface-0/70">
          Criação e edição da disponibilidade tanto de reservas quanto de fila
          de espera.
        </p>
      </div>
    </li>
    <li class="mb-6 flex justify-start">
      <div>
        <span
          class="rounded-custom flex h-[38px] w-[38px] items-center justify-center bg-surface-950 text-surface-0 dark:bg-surface-0 dark:text-surface-950"
        >
          <i class="pi pi-face-smile"></i>
        </span>
      </div>
      <div class="ml-4">
        <span class="mb-12">Acesso as pesquisas de satisfação</span>
        <p class="mt-1 text-sm text-surface-700 dark:text-surface-0/70">
          Visualização das respostas dos clientes e geração de relatórios
          personalizados.
        </p>
      </div>
    </li>
    <li class="flex justify-start">
      <div>
        <span
          class="rounded-custom flex h-[38px] w-[38px] items-center justify-center bg-surface-950 text-surface-0 dark:bg-surface-0 dark:text-surface-950"
        >
          <i class="pi pi-lock"></i>
        </span>
      </div>
      <div class="ml-4">
        <span class="mb-12">Gerenciamento de permissões</span>
        <p class="mt-1 text-sm text-surface-700 dark:text-surface-0/70">
          Criação, edição e exclusão de usuários e definição de permissões para
          o Painel Operacional.
        </p>
      </div>
    </li>
  </ul>
</template>
