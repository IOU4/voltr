<script setup lang="ts">
const items = await useFetchSavedItems();
</script>
<template>
  <div>
    <div class="heading flex justify-between py-4 mb-2">
      <h1 class="text-primary-800 text-2xl">Saved Items:</h1>
      <IconsSearch class="icon" />
    </div>
    <div class="grid lg:grid-cols-2 gap-y-10 gap-x-4">
      <Item v-for="item in items" :key="item.id" :item="item" />
    </div>
  </div>
</template>
