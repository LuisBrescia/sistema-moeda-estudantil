import { defineEventHandler, readBody, createError, H3Event } from 'h3';
import { ofetch } from 'ofetch';

export const crudApiHandler = (apiBaseURL: string) => {
  return defineEventHandler(async (event: H3Event) => {
    const method = event.method;
    const query = getQuery(event);
    const id = query.id;
    const apiURL = id ? `${apiBaseURL}/${id}` : apiBaseURL;

    console.log(`Requisição ${method} ${apiURL}`);

    const headers: Record<string, string> = {
      'Content-Type': 'application/json',
      // > Adicionar bearer token
    };

    // await new Promise(resolve => setTimeout(resolve, 1000));

    const fetchApi = async (method: string, body?: any) => {
      try {
        return await ofetch(apiURL, {
          method,
          headers,
          body,
        });
      } catch (error: any) {
        console.error(`Erro na requisição ${method} ${apiURL}:`, error);
        throw error;
      }
    };

    type HttpMethod = 'GET' | 'POST' | 'PUT' | 'DELETE';

    const handlers: Record<HttpMethod, () => Promise<any>> = {
      GET: () => fetchApi('GET'),
      POST: async () => {
        const body = await readBody(event);
        return fetchApi('POST', body);
      },
      PUT: async () => {
        const body = await readBody(event);
        return fetchApi('PUT', body);
      },
      DELETE: () => fetchApi('DELETE'),
    };

    if (method in handlers) {
      const handler = handlers[method as HttpMethod];
      return await handler();
    } else {
      throw createError({
        statusCode: 405,
        statusMessage: 'Método não permitido',
      });
    }
  });
};
