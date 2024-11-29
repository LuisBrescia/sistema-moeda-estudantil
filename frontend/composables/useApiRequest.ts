import { useUsuarioStore } from '@/stores/usuarioStore'
import { useUnidadeStore } from '@/stores/unidadeStore';

interface RequestOptions {
  headers?: Record<string, string>;
  [key: string]: any;
}

export const useApiRequest = <T>(url: string, options: RequestOptions = {}): Promise<{ data: T }> => {
  const config = useRuntimeConfig();
  const usuarioStore = useUsuarioStore();
  const unidadeStore = useUnidadeStore();

  const defaultHeaders = {
    'Authorization': `Bearer ${usuarioStore.token ?? ''}`,
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'X-UID': unidadeStore.unidade ? unidadeStore.unidade.id.toString() : '',
  };

  return $fetch(`${config.public.baseURL}${url}`, {
    ...options,
    onResponseError: (error: any) => {
      if (error.response.status === 401) {
        console.log('Usuário não autorizado');
        usuarioStore.logout({ forced: true });
        return;
      }

      throw error.response;
    },
    headers: {
      ...defaultHeaders,
      ...(options.headers || {}),
    }
  })
}