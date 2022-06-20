<script setup lang="ts">
const user = useUser();
</script>
<template>
  <div class="flex flex-col space-y-6 w-64">
    <h3 class="text-xl">{{ user.data.username }} &ThickSpace;<span class="wave">👋</span></h3>
    <div class="flex flex-col gap-y-3">
      <nuxt-link class="link" to='/profile'>
        <IconsPerson class="w-6 h-6" />
        <span>My profile</span>
      </nuxt-link>
      <nuxt-link class="link" to='/profile/items'>
        <IconsList class="w-6 h-6" />
        <span>All items</span>
      </nuxt-link>
      <nuxt-link class="link" to='/profile/saved'>
        <IconsTag class="w-6 h-6" />
        <span>Saved items</span>
      </nuxt-link>
      <nuxt-link class="link" to='/profile/reserved'>
        <IconsChecked class="w-6 h-6" />
        <span>Reserved items</span>
      </nuxt-link>
    </div>
  </div>
</template>

<style scoped lang="postcss">
.link {
  @apply text-lg text-primary-800 flex items-center space-x-4 rounded-md
}

.link:hover {
  @apply ring-1;
}

.wave {
  animation-name: wave-animation;
  animation-duration: 2.5s;
  animation-iteration-count: infinite;
  transform-origin: 70% 70%;
  display: inline-block;
}

@keyframes wave-animation {
  0% {
    transform: rotate(0deg);
  }

  10% {
    transform: rotate(14deg);
  }

  20% {
    transform: rotate(-8deg);
  }

  30% {
    transform: rotate(14deg);
  }

  40% {
    transform: rotate(-4deg);
  }

  50% {
    transform: rotate(10deg);
  }

  60% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(0deg);
  }
}
</style>
