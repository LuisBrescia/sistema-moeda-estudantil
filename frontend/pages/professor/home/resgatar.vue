<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { useBreadcrumbStore } from '@/stores/breadcrumbStore';
import { useUsuarioStore } from '@/stores/usuarioStore';
import { useUnidadeStore } from '@/stores/unidadeStore';

// Definições de página
definePageMeta({
  layout: 'professor',
  middleware: ['authenticated'],
});

const usuarioStore = useUsuarioStore();
const unidadeStore = useUnidadeStore();
const breadcrumbStore = useBreadcrumbStore();

breadcrumbStore.setBreadcrumb([
  { name: 'Resgatar pontos', to: '/professor/home/resgatar' },
]);

// Variáveis reativas
const timeRemaining = ref(0);
const canRescue = ref(true);
const timerInterval = ref(null);
const message = ref('');

const formattedTimeRemaining = computed(() => {
  const totalSeconds = Math.floor(timeRemaining.value);
  const minutes = String(Math.floor(totalSeconds / 60)).padStart(2, '0');
  const seconds = String(totalSeconds % 60).padStart(2, '0');
  return `${minutes}:${seconds}`;
});

// Função para iniciar o timer
const startTimer = () => {
  if (timerInterval.value) return; // Evita múltiplos intervalos
  timerInterval.value = setInterval(() => {
    timeRemaining.value -= 1;
    if (timeRemaining.value <= 0) {
      clearInterval(timerInterval.value);
      timerInterval.value = null;
      canRescue.value = true;
      timeRemaining.value = 0;
      message.value = '';
    }
  }, 1000);
};

// Função para verificar o status de resgate
const checkResgateStatus = async () => {
  try {
    // Faz uma requisição GET para verificar o status
    const res = await useApiRequest('/professor/resgatar?status=true');
    console.log(res);

    if (res.tempo_restante) {
      // Ainda não pode resgatar
      canRescue.value = false;
      timeRemaining.value = res.tempo_restante;
      message.value = res.message;
      startTimer();
    } else {
      // Pode resgatar
      canRescue.value = true;
      timeRemaining.value = 0;
      message.value = res.message || '';
    }
  } catch (error) {
    console.error(error);
  }
};

// Função para lidar com o clique no botão de resgate
const handleRescueLoading = ref(false);
const handleRescue = async () => {
  handleRescueLoading.value = true;
  try {
    // Faz uma requisição GET para realizar o resgate
    const res = await useApiRequest('/professor/resgatar');
    console.log(res);
    if (res.saldo) {
      console.log('Atualizando saldo fora');
      usuarioStore.updateSaldo();
    }

    if (res.tempo_restante) {
      canRescue.value = false;
      timeRemaining.value = res.tempo_restante;
      message.value = res.message;
      startTimer();
    } else {
      canRescue.value = true;
      timeRemaining.value = 0;
      message.value = res.message;
      checkResgateStatus();
    }
  } catch (error) {
    console.error(error);
  } finally {
    handleRescueLoading.value = false;
  }
};

// Lifecycle hooks
onMounted(() => {
  checkResgateStatus();
});

onUnmounted(() => {
  if (timerInterval.value) {
    clearInterval(timerInterval.value);
  }
});
</script>

<template>
  <main class="grid h-full place-items-center gap-4 p-4">
    <div class="flex flex-col items-center justify-center">
      <div
        class="mb-8 text-2xl font-medium text-surface-900 dark:text-surface-100"
      >
        Saldo atual
      </div>
      <div
        class="saldo-atual mb-8 flex items-center text-7xl font-bold text-green-500"
      >
        <IconIndianRupee class="saldo-atual" :size="72" />
        {{ usuarioStore.user.saldo }}
      </div>
      <Button
        :disabled="!canRescue"
        @click="handleRescue"
        class="mb-4"
        :loading="handleRescueLoading"
      >
        Resgatar Pontos
      </Button>
      <div :style="{ opacity: canRescue ? 0 : 1 }" class="text-center">
        <p>Tempo até próximo resgate: {{ formattedTimeRemaining }}</p>
      </div>
    </div>
  </main>
</template>

<style lang="scss" scoped>
// .saldo-atual {
// text-shadow: 0 0 4px #22c55e;
// filter: drop-shadow(0 0 2px #22c55e);
// }
</style>
