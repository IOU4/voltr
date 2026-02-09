<template>
  <div class="border border-disabled rounded-md space-x-4 py-4 ">
    <NuxtLink to="/auth" class="text-xl text-disabled font-bold px-2 py-4 ">Login</NuxtLink>
    <NuxtLink to="/auth/signup" class="text-xl text-disabled font-bold px-2 py-4 ">create account</NuxtLink>
  </div>
</template>
<style scoped lang="postcss">
.router-link-exact-active {
  @apply text-primary-500 ring-2 ring-primary-500 rounded-md;
}
</style>
