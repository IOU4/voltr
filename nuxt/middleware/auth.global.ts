export default defineNuxtRouteMiddleware((to) => {
  const token = useToken()
  // console.log(token.value);
  if (to.path.match(/\/auth\/?.*/))
    if (token.value != null) return navigateTo('/');
})
