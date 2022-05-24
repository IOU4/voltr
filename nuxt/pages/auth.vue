<template>
  <div class="h-screen pt-2 flex flex-col items-center">
    <div class="w-32 h-32">
      <img src="~assets/logo.png" alt="voltr logo">
    </div>
    <AuthNav v-if="$route.path != '/auth/resetpassword'" />
    <NuxtPage class="max-w-xl" />
  </div>
</template>
<style>
.nuxtlink {
  @apply text-xs text-primary-400 text-right;
}

.nuxtlink:hover {
  @apply underline;
}
</style>
