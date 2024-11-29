import { defineStore } from 'pinia'
import type { Unidade } from '@/types/Unidade'
import { useBreadcrumbStore } from '@/stores/breadcrumbStore'

export const useUnidadeStore = defineStore('unidadeStore', {
  state: () => ({
    _unidade: null as Unidade | null,
  }),
  getters: {
    unidade: (state) => state._unidade
  },
  actions: {
    setUnidade(unidade: Unidade | null) {
      this._unidade = unidade

      if (!unidade) return

      const breadcrumbStore = useBreadcrumbStore()
      const breadcrumbAtual = breadcrumbStore.breadcrumb
      breadcrumbAtual[0] = { name: unidade.nome_fantasia, to: '/' }
      breadcrumbStore.setBreadcrumb(breadcrumbAtual)
    },
  },
  persist: true
})