
const FranquiaService = {
  getAll: async (): Promise<any> => {
    const { data } = await useApiRequest<any>('/franquias', {
      method: 'GET',
    });

    return data;
  },
};

export default FranquiaService;
