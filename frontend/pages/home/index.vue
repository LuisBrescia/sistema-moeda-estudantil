<script setup>
import { useBreadcrumbStore } from '@/stores/breadcrumbStore';
import { useUsuarioStore } from '@/stores/usuarioStore';
import { useUnidadeStore } from '@/stores/unidadeStore';

definePageMeta({
  layout: 'aluno',
  middleware: ['authenticated'],
});

const usuarioStore = useUsuarioStore();
const unidadeStore = useUnidadeStore();
const breadcrumbStore = useBreadcrumbStore();
breadcrumbStore.setBreadcrumb([{ name: 'Início', to: '/professor/home/' }]);

const historico = ref([]);
const departamentoNome = ref('');

const getMe = async () => {
  const res = await useApiRequest(`/me`);
  historico.value = res.user.historico;
  departamentoNome.value = res.departamento;
};

const formatDate = (date) => {
  const d = new Date(date);
  return `${d.getDate()}/${d.getMonth() + 1}/${d.getFullYear()} às ${d.getHours()}:${d.getMinutes()}`;
};

onMounted(() => {
  getMe();
});
</script>

<template>
  <div class="px-6 py-8 md:px-12 lg:px-20">
    <div class="flex flex-col items-start lg:flex-row lg:justify-between">
      <div>
        <div class="text-3xl font-medium text-surface-900 dark:text-surface-0">
          {{ usuarioStore.user.nome }}
        </div>
        <div
          class="flex flex-wrap items-center text-surface-700 dark:text-surface-100"
        >
          <div
            class="mr-8 mt-4 flex items-center font-bold text-green-500 dark:text-green-400"
          >
            <IconIndianRupee class="mr-2" />
            {{ usuarioStore.user ? usuarioStore.user.saldo : '0' }}
          </div>
          <div class="mr-8 mt-4 flex items-center">
            <IconBuilding class="mr-2" />
            <span>Cursando {{ departamentoNome }}</span>
          </div>
        </div>
      </div>
    </div>

    <div
      class="mb-8 mt-16 text-2xl font-semibold text-surface-700 dark:text-surface-300"
    >
      Histórico de transação
    </div>

    <div v-if="historico.length">
      <div
        v-for="transacao in historico"
        :key="transacao.id"
        class="mb-2 flex justify-between rounded border border-surface-300 bg-surface-0 p-4 dark:border-surface-700 dark:bg-surface-900"
      >
        <div class="flex items-center gap-4">
          <IconTrendingUp
            v-if="transacao.tipo === 'entrada'"
            class="text-sky-500 dark:text-sky-400"
          />
          <IconTrendingDown
            v-else-if="transacao.tipo === 'saida'"
            class="text-red-500 dark:text-red-400"
          />
          <span
            class="flex items-center gap-1 text-base font-black text-green-500 dark:text-green-400"
          >
            <IconIndianRupee :size="16" />
            <span>{{ transacao.valor }}</span>
          </span>
        </div>
        <span>
          {{ formatDate(transacao.date) }}
        </span>
      </div>
    </div>

    <div v-else>
      <div
        class="rounded border border-surface-300 bg-surface-100 p-4 text-center text-surface-700 dark:border-surface-700 dark:bg-surface-900 dark:text-surface-300"
      >
        Nenhuma transação encontrada
      </div>
    </div>
  </div>
</template>
