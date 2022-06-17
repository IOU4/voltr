<script setup lang="ts">
import { AlertType } from '~~/composables/useAlert';

const apiUrl = useApiUrl();
const password = ref('');
const user = useUser();
const handleSubmit = async () => {
  const cAlert = useAlert();
  const data = await fetch(`${apiUrl}/login`, {
    headers: { "Content-Type": "application/json" },
    method: "POST",
    body: JSON.stringify({
      email: user.data.email,
      password: password.value
    })
  }).then(res => res.json()).catch(err => console.error(err));
  if (data?.error) cAlert.value.showAlert(`error: ${data?.error}`, AlertType.FAIL);
  else {
    user.setUser(data.user)
    cAlert.value.showAlert('lggedin succefully', AlertType.SUCCESS);
    navigateTo('/');
  }
}
</script>

<template>
  <div>
    <p class="text-sm text-center my-8 font-light">
      Temporibus minima perferendis deserunt sequi odit soluta doloremque saepe, accusantium dolorem
      quis porro. Magni,
      cupiditate.</p>
    <form @submit.prevent="handleSubmit" class="space-y-4">
      <CInput label="email" type="email" placeholder="jhon doe" v-model="user.data.email" required />
      <CInput label="password" type="password" placeholder="*****" v-model="password" required />
      <div class="flex justify-between">
        <input type="submit" value="SingIn"
          class="w-24 p-4 rounded-md bg-primary-500 focus:shadow-md hover:shadow-md hover:ring-2 text-white" />
        <div class=" flex flex-col justify-end gap-2">
          <NuxtLink class="nuxtlink" to="/auth/singup">don't have an account?</NuxtLink>
          <NuxtLink class="nuxtlink" to="/auth/resetpassword">forgot your password?</NuxtLink>
          <NuxtLink class="nuxtlink" to="/auth/resetpassword">login as organization</NuxtLink>
        </div>
      </div>
    </form>
    <!-- <button class="p-4 bg-primary-500 text-white rounded-md " @click="handleClick">check</button> -->
  </div>
</template>
