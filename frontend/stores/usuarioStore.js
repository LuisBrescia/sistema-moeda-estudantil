import { defineStore } from 'pinia';

export const useUsuarioStore = defineStore('usuarioStore', {
  state: () => ({
    _user: { name: '', saldo: 0, id: 0 },
    _token: null,
  }),
  getters: {
    user: (state) => state._user,
    token: (state) => state._token,
  },
  actions: {
    setToken(token) {
      this._token = token;
    },
    setUsuario(user) {
      this._user = user;
    },
    updateSaldo() {
      const saldo_total = Number(this._user.saldo) + 1000;
      this._user.saldo = saldo_total;
    },
    setSaldo(saldo) {
      this._user.saldo = saldo;
    },
    async login(res) {
      this.setUsuario(res.user);
      this.setToken(res.access_token);
    },
    async logout({ forced } = { forced: false }) {
      this._token = null;
      this._user = {};
      
      return navigateTo('/home');  
    },
    async enviarEmailRecebimentoPontos(alunoId, quantidade) {
      try {
        const response = await fetch(`/api/notify-email`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${this._token}`,
          },
          body: JSON.stringify({
            aluno_id: alunoId,
            quantidade,
          }),
        });

        const data = await response.json();

        if (response.ok) {
          console.log(data.message); 
        } else {
          console.error(data.error); 
        }
      } catch (error) {
        console.error('Erro ao enviar e-mail de notificação:', error);
      }
    },
  },
  persist: true,
});
