<template>
  <div>
    <p class="text-sm text-center my-8 font-light">
      Temporibus minima perferendis deserunt sequi odit soluta doloremque saepe, accusantium dolorem
      quis porro. Magni,
      cupiditate.</p>
    <form class="space-y-4">
      <CInput label="username" placeholder="jhon doe" />
      <CInput label="email" placeholder="jhondoe@example.com" />
      <CInput label="password" placeholder="*****" span="only alphanumeric" />
      <CInput label="confirm_password" placeholder="*****" />
      <div class="flex justify-between">
        <CInput type="submit" value="Singup" class="w-24" />
        <div class="flex flex-col justify-end gap-2">
          <NuxtLink class="nuxtlink" to="/auth/login">already have an account?</NuxtLink>
          <NuxtLink class="nuxtlink" to="/auth/resetpassword">register as organization</NuxtLink>
        </div>
      </div>
    </form>
  </div>
</template>
