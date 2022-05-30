<script setup lang="ts">
const user = useUser();
const apiUrl = useApiUrl();
const token = useToken();
const password = ref('');
const handleSubmit = async () => {
  const data = await fetch(`${apiUrl.value}/login`, {
    headers: { "Content-Type": "application/json" },
    method: "POST",
    body: JSON.stringify({
      email: user.value.email,
      password: password.value
    })
  }).then(res => res.json()).catch(err => console.error(err));
  if (data?.error) alert(data?.error || 'wrong credetials');
  else {
    user.value = data.user;
    token.value = 'token';
    sessionStorage.setItem('TOKEN', token.value);
    sessionStorage.setItem('DATA', JSON.stringify(data.user));
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
      <CInput label="email" type="email" placeholder="jhon doe" v-model="user.email" required />
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
