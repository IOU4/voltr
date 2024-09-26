export default defineNuxtConfig({
  runtimeConfig: {
    public: {
      apiBase: "http://localhost:80/api",
      imgsBase: "http://localhost:80/imgs" 
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
