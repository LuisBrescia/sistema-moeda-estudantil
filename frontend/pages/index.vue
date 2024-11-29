<script setup>
const handleProfessorLogin = () => {
  navigateTo('/professor/login');
};

const handleAlunoLogin = () => {
  navigateTo('/login');
};
</script>

<template>
  <div class="px-6 py-20 md:px-12 lg:px-20">
    <div class="text-center text-surface-700 dark:text-surface-100">
      <div class="text-primary mb-4 font-bold">
        <i class="pi pi-users" />
        &nbsp;Luís Felipe Brescia, Victor Reis Carlota e Gustavo Pereira
      </div>
      <div class="mb-4 text-5xl font-bold text-surface-900 dark:text-surface-0">
        Sistema de Moeda Estudantil
      </div>
      <div class="mb-8 text-2xl text-surface-700 dark:text-surface-100">
        Release 4
      </div>
      <Button
        label="Entrar como Aluno"
        rounded
        class="mr-2 whitespace-nowrap px-8 py-4 font-bold"
        @click="handleAlunoLogin"
      />
      <Button
        label="Entrar como Professor"
        severity="secondary"
        rounded
        class="whitespace-nowrap px-8 py-4 font-bold"
        @click="handleProfessorLogin"
      />
    </div>
  </div>
</template>
