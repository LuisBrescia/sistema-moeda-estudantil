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
    const res = await useApiRequest('/professor/resgatar');
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
const handleRescue = async () => {
  try {
    // Faz uma requisição GET para realizar o resgate
    const res = await useApiRequest('/professor/resgatar');
    if (res.pontos) {
      usuarioStore.updateSaldo(res.pontos);
    }

    if (res.tempo_restante) {
      // Não pôde resgatar, inicia o timer
      canRescue.value = false;
      timeRemaining.value = res.tempo_restante;
      message.value = res.message;
      startTimer();
    } else {
      // Resgate realizado com sucesso
      canRescue.value = true;
      timeRemaining.value = 0;
      message.value = res.message;
    }
  } catch (error) {
    console.error(error);
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
  <main class="flex items-center gap-4 p-4">
    <Button :disabled="!canRescue" @click="handleRescue" size="small">
      Resgatar Pontos
    </Button>
    <div v-if="!canRescue">
      <p>Tempo até próximo resgate: {{ formattedTimeRemaining }}</p>
    </div>
  </main>
</template>
