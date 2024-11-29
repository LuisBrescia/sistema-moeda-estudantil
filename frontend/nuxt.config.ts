import ptBR from './config/locales/pt-BR.json';
import jpJA from './config/locales/jp-JA.json';

export default defineNuxtConfig({
  compatibilityDate: '2024-04-03',
  devtools: { enabled: true },
  ssr: false,
  modules: [
    '@primevue/nuxt-module',
    '@nuxtjs/tailwindcss',
    '@nuxtjs/color-mode',
    'nuxt-lucide-icons',
    '@pinia/nuxt',
    'pinia-plugin-persistedstate',
  ],
  runtimeConfig: {
    public: {
      baseURL: process.env.BASE_URL || 'http://localhost',
    },
  },
  primevue: {
    importTheme: { from: '@/config/themes/Brescia.js' },
    options: {
      ripple: false,
      locale: { ...ptBR },
      theme: {
        options: {
          darkModeSelector: '.dark',
        },
      },
    },
  },
  colorMode: {
    preference: 'system',
    fallback: 'light',
    classSuffix: '',
  },
  tailwindcss: {
    cssPath: ['@/assets/css/main.css', { injectPosition: 0 }],
    configPath: '@/tailwind.config.ts',
    exposeConfig: false,
    viewer: true,
  },
  css: ['primeicons/primeicons.css', '@/assets/css/main.css'],
  lucide: {
    namePrefix: 'Icon',
  },
  build: {
    transpile: ['primevue'],
  },
});
