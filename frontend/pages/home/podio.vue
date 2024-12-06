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
breadcrumbStore.setBreadcrumb([{ name: 'Pódio', to: '/home/podio' }]);

const podioData = ref([]);

const getPodio = async () => {
  try {
    const res = await useApiRequest('/aluno/podio');
    podioData.value = res;
  } catch {
    console.log('Erro ao buscar o pódio');
  }
};

onMounted(() => {
  getPodio();
});

const primeiroLugar = computed(() => podioData.value[0]);
const segundoLugar = computed(() => podioData.value[1]);
const terceiroLugar = computed(() => podioData.value[2]);
const resto = computed(() => podioData.value.slice(3));
</script>

<template>
  <div class="px-6 py-8 md:px-12 lg:px-20">
    <div class="mb-8 flex flex-col items-center justify-center">
      <h1 class="mt-8 text-4xl font-bold text-surface-900 dark:text-surface-0">
        Pódio
      </h1>
      <p class="text-xl text-gray-700 dark:text-surface-300">
        Veja quem está no topo!
      </p>
    </div>

    <div
      class="mx-auto grid max-w-[1000px] grid-cols-1 md:grid-cols-3"
      v-if="podioData.length"
    >
      <div class="relative top-32 flex flex-col items-center">
        <AppAvatar size="xlarge" :letra="segundoLugar.nome[0]" />
        <div class="mt-2">{{ segundoLugar.nome }}</div>
        <div class="flex items-center gap-1 text-green-500 dark:text-green-400">
          <IconIndianRupee :size="24" />
          <span class="text-2xl font-medium">
            {{ segundoLugar.saldo }}
          </span>
        </div>
      </div>

      <div class="flex flex-col items-center">
        <AppAvatar size="xlarge" :letra="primeiroLugar.nome[0]" />
        <div class="mt-2">{{ primeiroLugar.nome }}</div>
        <div class="flex items-center gap-1 text-green-500 dark:text-green-400">
          <IconIndianRupee :size="24" />
          <span class="text-2xl font-medium">
            {{ primeiroLugar.saldo }}
          </span>
        </div>
      </div>

      <div class="relative top-64 flex flex-col items-center">
        <AppAvatar size="xlarge" :letra="terceiroLugar.nome[0]" />
        <div class="mt-2">{{ terceiroLugar.nome }}</div>
        <div class="flex items-center gap-1 text-green-500 dark:text-green-400">
          <IconIndianRupee :size="24" />
          <span class="text-2xl font-medium">
            {{ terceiroLugar.saldo }}
          </span>
        </div>
      </div>
    </div>

    <div class="mt-96" v-if="podioData.length">
      <div
        v-for="(aluno, idx) in resto"
        :key="aluno.id"
        class="mb-2 flex justify-between rounded border border-surface-300 bg-surface-0 p-4 dark:border-surface-700 dark:bg-surface-900"
      >
        <div class="relative flex flex-1 items-center gap-4">
          <div class="absolute top-1/2 -translate-y-1/2 text-xl">
            {{ idx + 4 }}º
          </div>
          <AppAvatar size="large" :letra="aluno.nome[0]" class="ms-12" />
          <span class="mr-2">{{ aluno.nome }}</span>
        </div>

        <span class="flex items-center text-surface-600 dark:text-surface-400">
          <span class="mr-8 flex items-center gap-1">
            <IconUniversity :size="16" />
            {{ aluno.instituicao }}
          </span>
          <span class="flex items-center gap-1">
            <IconBuilding :size="16" />
            {{ aluno.departamento }}
          </span>
        </span>

        <span
          class="flex flex-1 items-center justify-end gap-1 text-base font-black text-green-500 dark:text-green-400"
        >
          <IconIndianRupee :size="16" />
          <span>{{ aluno.saldo }}</span>
        </span>
      </div>
    </div>
  </div>
</template>
