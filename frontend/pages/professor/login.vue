<script setup>
definePageMeta({
  layout: 'auth',
});
</script>

<template>
  <p class="mb-8 text-sm text-surface-700 dark:text-surface-0/70">
    Esse acesso é utilizado para inserir ou organizar reservas e fila de espera.
    Se está precisando utilizar a ferramenta administrativa do Onakagasuita para
    criar e configurar todos os seus serviços, deverá utilizar o
    <span class="font-semibold">Painel Administrativo.</span>
    Entre os recursos disponíveis nesse painel estão:
  </p>

  <ul class="m-0 list-none p-0">
    <li class="mb-6 flex justify-start">
      <div>
        <span
          class="rounded-custom flex h-[38px] w-[38px] items-center justify-center bg-surface-950 text-surface-0 dark:bg-surface-0 dark:text-surface-900"
        >
          <i class="pi pi-calendar"></i>
        </span>
      </div>
      <div class="ml-4">
        <span class="mb-12">Gestão de Reservas</span>
        <p class="mt-1 text-sm text-surface-700 dark:text-surface-0/70">
          Inserção, edição e organização das reservas realizadas pelos clientes.
        </p>
      </div>
    </li>
    <li class="mb-6 flex justify-start">
      <div>
        <span
          class="rounded-custom flex h-[38px] w-[38px] items-center justify-center bg-surface-950 text-surface-0 dark:bg-surface-0 dark:text-surface-950"
        >
          <i class="pi pi-users"></i>
        </span>
      </div>
      <div class="ml-4">
        <span class="mb-12">Gerenciamento de Fila de Espera</span>
        <p class="mt-1 text-sm text-surface-700 dark:text-surface-0/70">
          Controle e organização da fila de espera para melhor atender os
          clientes.
        </p>
      </div>
    </li>
    <li class="flex justify-start">
      <div>
        <span
          class="rounded-custom flex h-[38px] w-[38px] items-center justify-center bg-surface-950 text-surface-0 dark:bg-surface-0 dark:text-surface-950"
        >
          <i class="pi pi-bell"></i>
        </span>
      </div>
      <div class="ml-4">
        <span class="mb-12">Notificações em Tempo Real</span>
        <p class="mt-1 text-sm text-surface-700 dark:text-surface-0/70">
          Recebimento de notificações sobre novas reservas e atualizações na
          fila de espera.
        </p>
      </div>
    </li>
  </ul>
</template>
