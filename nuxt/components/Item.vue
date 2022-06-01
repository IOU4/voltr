<script setup lang="ts">
import { type Item } from '~~/store';

interface Props {
  item?: Item
}
const {
  item = defaultItem
} = defineProps<Props>();
</script>

<template>
  <div class="w-full rounded-md hover:shadow-lg border border-primary-600">
    <div class="cover bg-slate-100 bg-no-repeat bg-contain bg-center w-full h-72 rounded-md">
      <!-- <img src="https://api.lorem.space/image/face?hash=33791" alt=""> -->
    </div>
    <div class="details p-2">
      <p>title : {{ item.title }}</p>
      <p>description: {{ item.description }}</p>
      <p>category: {{ item.category }}</p>
      <p>id: {{ item.id }}</p>
    </div>
  </div>
</template>

<style lang="postcss">
.cover {
  background-image: url("http://localhost/imgs/books.webp");
}
</style>

