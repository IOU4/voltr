export default defineNuxtRouteMiddleware((to) => {
  const token = useToken()
  if (token.value == null && !to.path.match(/\/auth\/?.*/)) return navigateTo('/auth');
})
