// ? Usar caso precisa de configuração geral extra ao usar a api
export const useFetchData: typeof useFetch = (request, opts?) => {
  return useFetch(`/api${request}`, {
    ...opts,
    onRequest({ request, options }) {
        // Set the request headers
    },
    // onRequestError({ request, options, error }) {
    //     // Handle the request errors
    // },
    // onResponse({ request, response, options }) {
    //     // Process the response data
    //     return response._data
    // },
    // onResponseError({ request, response, options }) {
    //     // Handle the response errors
    // },
  })
}