<template>
  <div>
    <p class="text-sm text-center my-8 font-light">
      Temporibus minima perferendis deserunt sequi odit soluta doloremque saepe, accusantium dolorem
      quis porro. Magni,
      cupiditate.</p>
    <form class="space-y-4">
      <CInput label="username or email" placeholder="jhon doe" />
      <CInput label="password" placeholder="*****" />
      <div class="flex justify-between">
        <CInput type="submit" value="SingIn" class="w-24" />
        <div class="flex flex-col justify-end gap-2">
          <NuxtLink class="nuxtlink" to="/auth/singup">don't have an account?</NuxtLink>
          <NuxtLink class="nuxtlink" to="/auth/resetpassword">forgot your password?</NuxtLink>
          <NuxtLink class="nuxtlink" to="/auth/resetpassword">login as organization</NuxtLink>
        </div>
      </div>
    </form>
  </div>
</template>
