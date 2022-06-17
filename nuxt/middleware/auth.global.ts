export default defineNuxtRouteMiddleware((to) => {
  const { token } = useUser()
  const nav = useNav();
  nav.value.setMenu();
  if (token == null && !to.path.match(/\/auth\/?.*/)) return navigateTo('/auth');
})
