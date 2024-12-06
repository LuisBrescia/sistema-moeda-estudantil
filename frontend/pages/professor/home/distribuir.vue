<script setup>
definePageMeta({
  layout: 'professor',
  middleware: ['authenticated'],
});

const alunosData = ref([]);
const modalEdicaoAluno = ref(false);

const getAlunos = async () => {
  const res = await useApiRequest('/alunos');
  alunosData.value = res;
  console.log(res);
};

const handleExibirAluno = (aluno) => {
  console.log(aluno);
};

onMounted(() => {
  getAlunos();
});
</script>

<template>
  <main class="p-4">
    <div
      class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5"
    >
      <!-- class="flex flex-col items-center gap-2 rounded border border-surface-300 bg-surface-0 p-4 dark:border-surface-700 dark:bg-surface-900" -->
      <div
        v-for="aluno in alunosData"
        :key="aluno.id"
        class="flex flex-col items-center rounded"
      >
        <AppAvatar
          :letra="aluno.nome[0]"
          shape="square"
          size="xlarge"
          class="mb-4"
        />
        <div
          class="mb-2 flex max-w-fit items-center gap-4 truncate text-nowrap"
        >
          {{ aluno.nome }}
        </div>
        <div class="mb-4 flex items-center gap-6">
          <div class="flex items-center text-green-500 dark:text-green-400">
            <IconIndianRupee :size="16" />
            <span class="ml-1 text-sm font-black">
              {{ aluno.saldo === '0.00' ? '0' : aluno.saldo }}
            </span>
          </div>
          <div class="flex items-center text-pink-500 dark:text-pink-400">
            <IconBadge :size="16" />
            <span class="ml-1 text-sm font-black">0</span>
          </div>
        </div>
        <Button
          label="Exibir aluno"
          outlined
          size="small"
          class="mb-8"
          @click="handleExibirAluno(aluno)"
        />
      </div>
    </div>

    <Modal
      v-model="modalEdicaoAluno"
      title="Editar aluno"
      size="lg"
      :footer="[
        {
          label: 'Cancelar',
          outlined: true,
          onClick: () => (modalEdicaoAluno = false),
        },
        {
          label: 'Salvar',
          onClick: () => (modalEdicaoAluno = false),
        },
      ]"
    ></Modal>

    <!-- <pre>
      {{ alunosData }}
    </pre> -->
  </main>
</template>
