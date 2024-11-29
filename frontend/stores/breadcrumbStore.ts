import { defineStore } from 'pinia'

type BreadcrumbItem = {
  name: string;
  to: string;
}

export const useBreadcrumbStore = defineStore('breadcrumbStore', {
  state: () => ({
    breadcrumb: [] as BreadcrumbItem[],
    _key: 0
  }),
  getters: {
    key: (state) => state._key
  },
  actions: {
    setBreadcrumb(breadcrumb: BreadcrumbItem[]) {
      this.breadcrumb = breadcrumb
    },
    newKey() {
      this._key++
    }
  },
  persist: false
})