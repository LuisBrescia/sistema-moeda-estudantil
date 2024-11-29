<script setup>
import { useBreadcrumbStore } from '@/stores/breadcrumbStore';
import { useUsuarioStore } from '@/stores/usuarioStore';
import { useUnidadeStore } from '@/stores/unidadeStore';

definePageMeta({
  layout: 'professor',
  middleware: ['authenticated'],
});

const usuarioStore = useUsuarioStore();
const unidadeStore = useUnidadeStore();
const breadcrumbStore = useBreadcrumbStore();
breadcrumbStore.setBreadcrumb([
  { name: 'Distribuir pontos', to: '/professor/home/distribuir' },
]);
</script>

<template>
  <main class="p-4">
    <div class="bg-surface-0 px-6 py-8 dark:bg-surface-950 md:px-12 lg:px-20">
      <ul class="m-0 mb-4 flex list-none items-center p-0 font-medium">
        <li>
          <a
            class="cursor-pointer leading-normal text-surface-500 no-underline dark:text-surface-300"
          >
            Application
          </a>
        </li>
        <li class="px-2">
          <i
            class="pi pi-angle-right leading-normal text-surface-500 dark:text-surface-300"
          />
        </li>
        <li>
          <span class="leading-normal text-surface-900 dark:text-surface-0">
            Analytics
          </span>
        </li>
      </ul>
      <div class="flex flex-col items-start lg:flex-row lg:justify-between">
        <div>
          <div
            class="text-3xl font-medium text-surface-900 dark:text-surface-0"
          >
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
  </main>
</template>
