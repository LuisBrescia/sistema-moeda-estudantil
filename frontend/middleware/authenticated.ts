import { useUsuarioStore } from '@/stores/usuarioStore';

export default defineNuxtRouteMiddleware(() => {
  const usuarioStore = useUsuarioStore();
  try {
    if (!usuarioStore.token) {
      return navigateTo('/login');
    }
  } catch (error) {
    console.log(error);
  }
  // > TODO aqui devera enviar uma requisição para o servidor para validar o token @VictorReisCarlota
});
