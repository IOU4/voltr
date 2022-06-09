<script setup lang="ts">
import { type Item } from '~~/composables/useItem';

const items = useItems();
const api_url = useApiUrl();
onMounted(async () => {
  const data: Item[] = await fetch(`${api_url}/items`).then(res => res.json());
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

    <nuxt-link to="/items/create" class="item-button hover:bg-white bg-primary-500 fixed bottom-6 left-[38%]  group">
      <span class="group-hover:text-primary-700 text-white ">create one</span>
      <IconsPlus class="w-6 h-6" stroke="group-hover:stroke-primary-600 stroke-white" />
    </nuxt-link>
  </div>
</template>
