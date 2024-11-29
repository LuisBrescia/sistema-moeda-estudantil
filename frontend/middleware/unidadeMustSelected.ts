import { useUnidadeStore } from '@/stores/unidadeStore';
import { useToast } from "primevue/usetoast";

export default defineNuxtRouteMiddleware(async (to, from) => {
  const unidadeStore = useUnidadeStore();  
  if (!unidadeStore.unidade) {
    const toast = useToast();
    toast.add({ severity: 'warn', summary: 'Aviso', detail: 'É necessário se conectar à uma unidade para acessar esta funcionalidade.', life: 3000 })

    return navigateTo(from.fullPath || '/admin/home/');
  }
});
