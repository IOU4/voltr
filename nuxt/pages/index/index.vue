<script setup lang="ts">

enum Categories {
  BOOKS = 'books',
  ELECTRONICS = "electronics"
}

interface Item {
  id?: number,
  title?: string,
  description?: string,
  author_id?: number,
  author_name?: string,
  cover?: string,
  category?: Categories,
  created_at?: string,
  updated_at?: string
}

const items = useItems();
const api_url = useApiUrl();
onMounted(async () => {
  const data: Item[] = await fetch(`${api_url.value}/items`).then(res => res.json());
  items.value = data;
})
</script>

<template>
  <div>
    <div v-for="item in items" :key="item.id">
      <Item :item="item" />
    </div>
  </div>
</template>
