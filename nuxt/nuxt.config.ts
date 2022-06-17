import { defineNuxtConfig } from 'nuxt'

// https://v3.nuxtjs.org/api/configuration/nuxt.config
export default defineNuxtConfig({
  css: ['~/main.css'],
  build: {
    postcss: {
      postcssOptions: {
        plugins: {
          tailwindcss: {},
          autoprefixer: {},
        }
      }
    }
  },
  modules: ['@formkit/nuxt', '@vueuse/nuxt'],
  experimental: {
    reactivityTransform: true
  },
  ssr: false
})
