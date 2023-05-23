export default defineNuxtConfig({
  runtimeConfig: {
    public: {
      apiBase: process.env.API_BASE,
      imgsBase: process.env.IMGS_BASE
    }
  },
  css: ['~/main.css'],
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    }
  },
  modules: ['@formkit/nuxt', '@vueuse/nuxt'],
  experimental: {
    reactivityTransform: true
  },
  ssr: false
})
