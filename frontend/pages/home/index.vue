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
breadcrumbStore.setBreadcrumb([{ name: 'Info geral', to: '/home' }]);
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
          <div class="mr-8 mt-4 flex items-center">
            <i class="pi pi-users mr-2" />
            <span>332 Active Users</span>
          </div>
          <div class="mr-8 mt-4 flex items-center">
            <i class="pi pi-globe mr-2" />
            <span>9402 Sessions</span>
          </div>
          <div class="mt-4 flex items-center">
            <i class="pi pi-clock mr-2" />
            <span>2.32m Avg. Duration</span>
          </div>
        </div>
      </div>
      <div class="mt-4 lg:mt-0">
        <Button label="Add" class="mr-2" outlined icon="pi pi-user-plus" />
        <Button label="Save" icon="pi pi-check" />
      </div>
    </div>
  </div>
</template>
