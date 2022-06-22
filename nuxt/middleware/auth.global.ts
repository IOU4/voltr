import { AlertType } from "~~/composables/useAlert";

export default defineNuxtRouteMiddleware((to) => {
  const { token } = useUser()
  const nav = useNav();
  const cAlert = useAlert();
  nav.value.setMenu();
  if (token == null && !to.path.match(/\/auth\/?.*/)) {
    cAlert.value.showAlert('please login fitst', AlertType.INFO);
    return navigateTo('/auth');
  }
})
