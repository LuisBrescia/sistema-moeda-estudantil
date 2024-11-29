import { useUsuarioStore } from '@/stores/usuarioStore';
import { useToast } from 'primevue/usetoast';

export default defineNuxtRouteMiddleware(async () => {
  const usuarioStore = useUsuarioStore();
  if (usuarioStore.token) {
    return navigateTo('/home');
  }

  // > TODO: COLOCAR VERIFICACAO SE O TOKEN E VALIDO @VictorReisCarlota
});
