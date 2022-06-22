<script setup lang="ts">
const handleLogout = () => {
  const router = useRouter();
  const user = useUser();
  user.setUser();
  router.push('/auth')
}
</script>

<template>
  <nav class="flex gap-8">
    <nuxt-link to="/" class="link">
      <IconsHome class="w-5 h-5" />
      <span>Home</span>
    </nuxt-link>
    <nuxt-link to="/profile" class="link">
      <IconsPerson class="w-5 h-5" />
      <span> profile </span>
    </nuxt-link>
    <button class="link" @click="handleLogout">
      <IconsLogout class="w-5 h-5" />
      <span>Logout</span>
    </button>
  </nav>
</template>
<style scoped lang="postcss">
.link {
  @apply text-lg text-primary-800 flex items-center space-x-2 rounded-md p-2
}

.link:hover {
  @apply ring-1;
}
</style>
