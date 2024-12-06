import { defineStore } from 'pinia';
import { useUnidadeStore } from '@/stores/unidadeStore';
import { useToast } from 'primevue/usetoast';

export const useUsuarioStore = defineStore('usuarioStore', {
  state: () => ({
    _user: {},
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
      // > TODO aqui devera enviar uma requisição para o servidor para invalidar o token @VictorReisCarlota
    },
  },
  persist: true,
});
