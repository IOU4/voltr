<script setup lang="ts">
</script>
<template>
  <div>
    <NuxtLink :to="$route.redirectedFrom?.fullPath ?? '/'"
      class="flex items-center border group w-fit rounded-md px-2 py-1 text-primary-500 border-primary-500 hover:bg-primary-500 hover:text-white transition-colors">
      <IconsArrowL stroke="stroke-primary-500 group-hover:stroke-white" class="w-5 h-5 relative -left-1" />
      <span>back</span>
    </NuxtLink>
    <NuxtPage />
  </div>
</template>
