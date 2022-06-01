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
  <div class="flex flex-col gap-2">
    <Item v-for="item in items" :key="item.id" :item="item" />
  </div>
</template>
