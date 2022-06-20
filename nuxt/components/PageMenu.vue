<script setup lang="ts">
const handleLogout = () => {
  const router = useRouter();
  const user = useUser();
  user.setUser();
  router.push('/auth')
}
</script>

<template>
  <nav class="flex gap-3">
    <nuxt-link to="/">home</nuxt-link>
    <nuxt-link to="/camps">camps</nuxt-link>
    <nuxt-link to="/profile">profile</nuxt-link>
    <button @click="handleLogout">
      <IconsLogout class="w-5 h-5" />
    </button>
  </nav>
</template>
