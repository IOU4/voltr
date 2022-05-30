<script setup lang="ts">
const user = useUser();
const token = useToken();
const password = ref('');
const passwordConfirmation = ref('');
const apiUrl = useApiUrl();
const hadleSubmit = async () => {
  if (passwordConfirmation.value != password.value) return alert('password not match');
  const data = await fetch(`${apiUrl.value}/singup`, {
    method: "POST",
    body: JSON.stringify({

    }),
    headers: { "Content-Type": "application/json" }
  }).then(res => res.json()).catch(err => console.error(err));
  if (!data?.logged) alert(data?.error || 'error occured');
  else {
    user.value = data.user;
    token.value = 'token';
    sessionStorage.setItem('TOKEN', token.value);
    sessionStorage.setItem('DATA', JSON.stringify(data.user));
    navigateTo('/');
  }
  console.log(data);
}
</script>
<template>
  <div>
    <p class="text-sm text-center my-8 font-light">
      Temporibus minima perferendis deserunt sequi odit soluta doloremque saepe, accusantium dolorem
      quis porro. Magni,
      cupiditate.</p>
    <form @submit.prevent="hadleSubmit" class="space-y-4">
      <CInput label="username" placeholder="jhon doe" v-model="user.username" required />
      <CInput label="email" placeholder="jhondoe@example.com" type="email" v-model="user.email" required />
      <CInput label="phone number" placeholder="002120------" type="tel" v-model="user.phone" required />
      <CInput label="password" placeholder="*****" span="only alphanumeric" type="password" v-model="user.password"
        required />
      <CInput label="confirm_password" placeholder="*****" type="password" v-model="passwordConfirmation" required />
      <div class="flex justify-between">
        <input type="submit" value="SingIn"
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
