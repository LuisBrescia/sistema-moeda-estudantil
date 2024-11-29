import type { Operador } from '~/types/Operador';

const OperadorService = {
  getAll: async (): Promise<Operador[]> => {
    const { data } = await useApiRequest<Operador[]>('/operadores', {
      method: 'GET',
    });

    return data;
  },

  getById: async (id: number): Promise<Operador> => {
    const { data } = await useApiRequest<Operador>(`/operadores/${id}`, {
      method: 'GET',
    });

    return data;
  },

  create: async (operador: Operador): Promise<Operador> => {
    const { data } = await useApiRequest<Operador>('/operadores', {
      method: 'POST',
      body: JSON.stringify(operador),
    });

    return data;
  },

  update: async (id: number, operador: Operador): Promise<Operador> => {
    const { data } = await useApiRequest<Operador>(`/operadores/${id}`, {
      method: 'PUT',
      body: JSON.stringify(operador),
    });

    return data;
  },

  delete: async (id: number): Promise<void> => {
    await useApiRequest<void>(`/operadores/${id}`, {
      method: 'DELETE',
    });
  },
};

export default OperadorService;
