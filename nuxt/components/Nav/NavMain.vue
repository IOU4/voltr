<script setup lang="ts">
const menu = useNav();
const route = useRoute();
const headerRef = ref(null)
const routeTitle = computed(() => {
  const parts = route.path.split('/').filter(Boolean);
  return parts.length > 0 ? parts[parts.length - 1] : 'home';
})
onClickOutside(headerRef, () => menu.value.setMenu())
</script>

<template>
  <header ref="headerRef"
    class="w-full fixed top-0 right-0 px-4 flex justify-between bg-white items-center shadow-md z-10">
    <!-- logo  -->
    <NuxtLink to="/" class="logo w-20 h-20">
      <img src="~assets/logo.png" alt="voltr logo">
    </NuxtLink>

    <!-- route-name -->
    <div class="text-primary-600 absolute left-1/2 -translate-x-1/2 capitalize">{{ routeTitle }}</div>

    <!-- profile -->
    <div class="flex gap-4 items-center">
      <IconsList class="icon" stroke="stroke-primary-600" :class="menu.nav ? 'bg-primary-100 p-1 rounded-md' : ''"
        @click="menu.setMenu('nav')" />
      <IconsNotif class="icon" stroke="stroke-primary-600"
        :class="menu.notification ? 'bg-primary-100 p-1 rounded-md' : 'fill-white'"
        @click="menu.setMenu('notification')" />
      <div style="background-image:url('https://api.dicebear.com/9.x/notionists/svg');" 
        class="profile-img" @click="menu.setMenu('profile')" />
    </div>

    <!-- notifications  -->
    <transition>
      <div v-show="menu.notification" class="floating-nav">
        notifications
      </div>
    </transition>

    <!-- nav -->
    <transition>
      <div v-show="menu.nav" class="floating-nav text-lg">
        <PageMenu />
      </div>
    </transition>

    <!-- profile-menu -->
    <transition>
      <div v-show="menu.profile" class="floating-nav">
        <ProfileMenu />
      </div>
    </transition>
  </header>
</template>

<style lang="postcss">
.router-link-exact-active {
  @apply underline decoration-primary-400 underline-offset-4 decoration-2 text-primary-600;
}
</style>
