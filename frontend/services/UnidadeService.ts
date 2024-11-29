import type { Pagination } from "@/types/common/Pagination";
import type { Unidade, UnidadeRequest, UnidadeGetAllQuerys } from "@/types/Unidade";

const UnidadeService = {
  // data: Unidade[]; // This line is not necessary
  // meta: Pagination; // This line is not necessary
  getAll: async (querys?: UnidadeGetAllQuerys): Promise<{ data: Unidade[], meta: Pagination }> => {
    const queryString = new URLSearchParams();

    if (querys?.page) {
      queryString.append('page', querys.page.toString());
    }

    if (querys?.perPage) {
      queryString.append('per_page', querys.perPage.toString());
    }

    if (querys?.all) {
      queryString.append('all', querys.all.toString());
    }

    const res = await useApiRequest(`/unidades?${queryString}`, {
      method: 'GET',
    });

    return res as { data: Unidade[], meta: Pagination };
  },

  getById: async (id: number): Promise<Unidade> => {
    const { data } = await useApiRequest<Unidade>(`/unidades/${id}`, {
      method: 'GET',
    });

    return data;
  },

  create: async (unidade: UnidadeRequest): Promise<Unidade> => {
    const { data: created } = await useApiRequest<Unidade>('/unidades', {
      method: 'POST',
      body: unidade,
    });

    return created;
  },

  update: async (id: number, unidade: Unidade): Promise<Unidade> => {
    const { data } = await useApiRequest<Unidade>(`/unidades/${id}`, {
      method: 'PUT',
      body: unidade,
    });

    return data;
  },

  delete: async (id: number): Promise<void> => {
    await useApiRequest<void>(`/unidades/${id}`, {
      method: 'DELETE',
    });
  }
};

export default UnidadeService;
