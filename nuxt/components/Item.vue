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

interface Props {
  item?: Item
}
const {
  item
} = defineProps<Props>();
</script>

<template>
  <div class="w-full">
    <div class="cover-photo"></div>
    <div class="details">
      <p>title : {{ item.title }}</p>
      <p>description: {{ item.description }}</p>
      <p>category: {{ item.category }}</p>
      <p>di: {{ item.id }}</p>
    </div>
  </div>
</template>
