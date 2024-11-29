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
            <IconIndianRupee class="mr-2" />
            {{
              usuarioStore.user.saldo
                ? usuarioStore.user.saldo.toFixed(2)
                : '00.00'
            }}
          </div>
          <div class="mr-8 mt-4 flex items-center">
            <IconBuilding class="mr-2" />
            <span>
              {{ usuarioStore.user.instituicao_id }}
            </span>
          </div>
          <div class="mr-8 mt-4 flex items-center">
            <IconBuilding class="mr-2" />
            <span>
              {{ usuarioStore.user.departamento_id }}
            </span>
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
