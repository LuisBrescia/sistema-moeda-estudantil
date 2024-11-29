import { defineStore } from 'pinia'

export const useViewWrapperStore = defineStore('viewWrapperStore', {
  state: () => ({
    _sidebarOpen: true,
  }),
  getters: {
    sidebarOpen: (state) => state._sidebarOpen
  },
  actions: {
    toggleSidebar() {
      this._sidebarOpen = !this._sidebarOpen
    },
  },
  persist: true
})