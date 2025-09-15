export default defineNuxtConfig({
  runtimeConfig: {
    public: {
      apiBase: "/api",
      imgsBase: "/imgs" 
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
