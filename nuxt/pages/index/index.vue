<script setup lang="ts">
import { type Item } from '~~/store';

const items = useItems();
const api_url = useApiUrl();
onMounted(async () => {
  const data: Item[] = await fetch(`${api_url.value}/items`).then(res => res.json());
  items.value = data;
})
</script>

<template>
  <div>
    <div class="heading flex justify-between py-4 mb-2">
      <h1 class="text-primary-500 text-lg">Available Items:</h1>
      <IconsSearch class="icon" />
    </div>
    <div class="flex flex-col gap-10">
      <Item v-for="item in items" :key="item.id" :item="item" />
    </div>
  </div>
</template>
