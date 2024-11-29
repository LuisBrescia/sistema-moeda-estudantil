<script setup lang="ts">
import type { Salao } from '@/types/Salao';
import { DiasSemana } from '@/enums/DiasSemana';
import { formatarHorario } from '@/utils/formatarHorario';

defineProps({
  salao: {
    type: Object as PropType<Salao>,
    required: true,
  },
});

const formatarDias = (dias: Set<DiasSemana>) => {
  return Array.from(dias)
    .map((dia: DiasSemana) => {
      return DiasSemana[dia];
    })
    .join(', ');
};
</script>

<template>
  <div
    class="group relative min-w-72 cursor-pointer rounded border border-surface-300 bg-surface-0 p-4 transition-shadow hover:shadow-lg dark:border-surface-700 dark:bg-surface-900"
  >
    <h3 class="mb-2 text-base font-semibold">{{ salao.nome }}</h3>

    <div
      class="rounded-custom absolute right-2 top-2 bg-primary-500 p-2 text-surface-100 opacity-0 transition-opacity group-hover:opacity-100"
    >
      <IconPencil :size="18" />
    </div>

    <div class="mb-2">
      <h4 class="text-xs text-surface-600 dark:text-surface-400">
        Horário de funcionamento
      </h4>
      <p class="text-sm">
        {{ formatarHorario(salao.horario_funcionamento_inicio) }} às
        {{ formatarHorario(salao.horario_funcionamento_fim) }}
      </p>
    </div>

    <div class="mb-2">
      <h4 class="text-xs text-surface-600 dark:text-surface-400">
        Dias da semana
      </h4>
      <p class="text-sm">{{ formatarDias(salao.dias_funcionamento) }}</p>
    </div>
  </div>
</template>
