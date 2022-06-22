export default defineNuxtRouteMiddleware(() => {
  const adminToken = sessionStorage.getItem("AD");
  if (!adminToken) return navigateTo('/');
})
