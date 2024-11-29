const AuthService = {
  login: async (loginRequest) => {
    const res = await useApiRequest('/login', {
      method: 'POST',
      body: loginRequest,
    });
    return res;
  },
  loginProfessor: async (loginRequest) => {
    const res = await useApiRequest('/login/professor', {
      method: 'POST',
      body: loginRequest,
    });
    return res;
  },
  logout: async () => {
    // > TODO @VictorReisCarlota
  },
};

export default AuthService;
