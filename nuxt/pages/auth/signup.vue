<script setup lang="ts">
import { AlertType } from '~~/composables/useAlert';

const user = useUser();
const password = ref('');
const passwordConfirmation = ref('');
const apiUrl = useApiUrl();
const handleSubmit = async () => {
  const cAlert = useAlert();
  if (passwordConfirmation.value != password.value) return cAlert.value.showAlert("password confirmation doesn't match", AlertType.FAIL);
  const data = await fetch(`${apiUrl}/signup`, {
    method: "POST",
    body: JSON.stringify({
      "email": user.data.email,
      "username": user.data.username,
      "phone": user.data.phone,
      "password": password.value
    }),
    headers: { "Content-Type": "application/json" }
  }).then(res => res.json()).catch(err => console.error(err));
  if (!data?.logged) cAlert.value.showAlert(`error occurred: ${data?.error}`, AlertType.FAIL);
  else {
    user.setUser(data.user);
    cAlert.value.showAlert(`account created successfully, welcome ${user.data.username} !!`, AlertType.SUCCESS);
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
      <CInput label="username" placeholder="jhon doe" v-model="user.data.username" required />
      <CInput label="email" placeholder="jhondoe@example.com" type="email" v-model="user.data.email" required />
      <CInput label="phone number" placeholder="002120------" type="tel" v-model="user.data.phone" required />
      <CInput label="password" placeholder="*****" span="only alphanumeric" type="password" v-model="password"
        required />
      <CInput label="confirm_password" placeholder="*****" type="password" v-model="passwordConfirmation" required />
      <div class="flex justify-between">
        <input type="submit" value="Sign Up"
          class="w-24 p-4 rounded-md bg-primary-500 focus:shadow-md hover:shadow-md hover:ring-2 text-white" />
        <div class="flex flex-col justify-end gap-2">
          <NuxtLink class="nuxtlink" to="/auth">already have an account?</NuxtLink>
          <NuxtLink class="nuxtlink" to="/auth/resetpassword">register as organization</NuxtLink>
        </div>
      </div>
    </form>
    <!-- <NuxtLink to="/" class="nuxtlink">go home</NuxtLink> -->
  </div>
</template>
