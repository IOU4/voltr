<script setup lang="ts">
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
import { ItemImage } from '~~/composables/useItem';
const item = useItem();
const route = useRoute();
const api_url = useApiUrl();
definePageMeta({ pageTransition: true })
const itemsImages = await useFetch<ItemImage[]>(`${api_url.value}/item/images?id=${route.params.id}`).then(res => res.data);
</script>

<template>
  <div class="mt-4 space-y-4">
    <div class="text-primary-700 text-2xl flex items-center">
      <span> {{ item.title }} </span>
      <span class="ml-auto text-xs"> at: {{ item.created_at }}</span>
    </div>
    <carousel :items-to-show="1">
      <slide v-for="image in itemsImages" :key="image.id">
        <div class="w-[98%] h-80 bg-primary-50 flex justify-center items-center "><img
            :src="`http://localhost/imgs/${image.name}`" alt=""></div>
      </slide>

      <template #addons>
        <navigation />
        <pagination />
      </template>
    </carousel>

    <div class="text-sm font-light">{{ item.description }}</div>
  </div>
</template>

<style lang="postcss">
.carousel__prev--in-active,
.carousel__next--in-active {
  display: none;
}

.carousel__prev,
.carousel__next {
  @apply bg-primary-600 rounded-md ring-2 ring-white;
}

.carousel__pagination-button {
  @apply bg-primary-100 w-5 h-3;
}

.carousel__pagination-button--active {
  @apply bg-primary-700
}
</style>
