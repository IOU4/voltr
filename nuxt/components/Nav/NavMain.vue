<script setup lang="ts">
const isListVisible = ref<boolean>(false);
const isNotifVisible = ref<boolean>(false);
const isProfileVisible = ref<boolean>(false);
</script>

<template>
  <header class="w-full absolute top-0 px-4 flex justify-between items-center shadow-md rounded-b-md">

    <!-- logo  -->
    <div class="logo w-20 h-20">
      <img src="~assets/logo.png" alt="voltr logo">
    </div>

    <!-- route-name -->
    <div class="text-primary-600">{{ $route.name }}</div>

    <!-- profile -->
    <div class="flex gap-4 items-center">
      <IconsList class="icon" stroke="stroke-primary-600" :class="isListVisible ? 'bg-primary-100 p-1 rounded-md' : ''"
        @click="isListVisible = !isListVisible ; isNotifVisible = false; isProfileVisible = false" />
      <IconsNotif class="icon" stroke="stroke-primary-600"
        :class="isNotifVisible ? 'bg-primary-100 p-1 rounded-md' : 'fill-white'"
        @click="isNotifVisible = !isNotifVisible; isListVisible = false; isProfileVisible = false" />
      <div class="profile-img"
        @click="isProfileVisible = !isProfileVisible; isListVisible = false; isNotifVisible = false" />
    </div>

    <!-- notifications  -->
    <transition>
      <div v-show="isNotifVisible" class="floating-nav">
        notifications
      </div>
    </transition>

    <!-- nav -->
    <transition>
      <nav v-show="isListVisible" class="floating-nav">
        <nuxt-link to="/">home</nuxt-link>
        <nuxt-link to="/auth">camps</nuxt-link>
        <nuxt-link to="/auth">profile</nuxt-link>
        <nuxt-link to="/auth">
          <IconsLogout class="w-5 h-5" />
        </nuxt-link>
      </nav>
    </transition>

    <!-- profile-menu -->
    <transition>
      <div v-show="isProfileVisible" class="floating-nav">
        profile
      </div>
    </transition>
  </header>
</template>

<style scoped lang="postcss">
.icon {
  @apply w-6 h-6 cursor-pointer;
}

.profile-img {
  background-image: url("https://api.lorem.space/image/face?hash=33791");
  @apply w-14 h-14 rounded-full bg-center bg-cover cursor-pointer;
}

.router-link-active {
  @apply underline decoration-primary-400 underline-offset-4 decoration-2 text-primary-600;
}

.v-enter-active {
  @apply transition-opacity duration-500 ease-linear;
}

.v-enter-from {
  @apply opacity-0;
}

.floating-nav {
  @apply absolute -bottom-16 right-0 flex items-center py-4 px-3 gap-4 bg-primary-100 rounded-md shadow-md;
}
</style>
