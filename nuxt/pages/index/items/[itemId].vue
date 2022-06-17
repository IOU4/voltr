<script setup lang="ts">
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
import { ItemImage } from '~~/composables/useItem';
import { DateTime } from 'luxon';

const item = useItem();
const route = useRoute();
const api_url = useApiUrl();
definePageMeta({ pageTransition: true })
const itemsImages = await useFetch<ItemImage[]>(`${api_url}/item/images?id=${route.params.itemId}`).then(res => res.data);
const showSave = ref(false)

const handleResreve = () => {
  const showReserve = useShowReserve();
  showReserve.value = true;
}
const handleSave = () => {
  showSave.value = true;
}
</script>

<template>
  <div class="mt-4 grid gap-4 w-full lg:grid-cols-2">
    <!-- title -->
    <div class="text-primary-700 text-4xl lg:col-span-2"> {{ item.title }} </div>

    <!-- carousel -->
    <carousel :items-to-show="1">
      <slide v-for="image in [{ id: 0, image: item.cover }, ...itemsImages]" :key="image.id"
        class="w-[98%] h-80 lg:h-[75vh] bg-slate-100 flex justify-center items-center rounded-md overflow-hidden">
        <img :src="`http://localhost/imgs/${image.image}`" class="max-h-full max-w-full" draggable="false">
      </slide>

      <template #addons>
        <navigation />
        <pagination />
      </template>
    </carousel>

    <div class="space-y-4">
      <!-- description -->
      <div>
        <span class="text-lg font-bold block"> Description: </span>
        <span class="text-sm font-light"> {{ item.description }} </span>
      </div>

      <!-- location -->
      <div class="flex items-end text-sm font-light gap-1 ">
        <IconsLocation />
        <span class="mr-4">{{ item.city }}</span>
        <IconsMap />
        <span>{{ item.address }}</span>
      </div>

      <!-- date -->
      <div class="text-xs">
        <span>published at:</span>
        <span class="font-light ml-2">{{ DateTime.fromSQL(item.created_at).toHTTP() }}</span>
      </div>

      <!-- owner -->
      <div>
        <div class="flex gap-2 items-center mb-2">
          <div class="bg-cover bg-center w-10 h-10 rounded-full"
            style="background-image:url('https://api.lorem.space/image/face?hash=33791');"> </div>
          <p class="text-sm text-primary-500">{{ item.author_name }}</p>
        </div>
      </div>

      <!-- actions -->
      <div class="flex space-x-2">
        <button class="btn-outline space-x-2 flex flex group" @click="handleResreve">
          <span class="text-primary-700 text-sm group-hover:text-white ">Reserve</span>
          <IconsArrowR class="w-5 h-5" stroke="stroke-primary-600 group-hover:stroke-white" />
        </button>
        <button class="btn-outline space-x-2 flex flex group">
          <span class="text-primary-700 text-sm group-hover:text-white ">Message</span>
          <IconsChat class="h-5 w-5" stroke="stroke-primary-600 group-hover:stroke-white" />
        </button>
        <button class="btn-outline space-x-2 flex flex group" @click="handleSave">
          <span class="text-primary-700 text-sm group-hover:text-white ">Save</span>
          <IconsTag class="h-5 w-5" stroke="stroke-primary-600 group-hover:stroke-white" />
        </button>
      </div>

      <!-- phone -->
      <button class="btn-outline space-x-2 flex flex hover:bg-white bg-primary-500  group">
        <span class="group-hover:text-primary-700 text-sm text-white ">palaceholder</span>
        <IconsPhone class="w-5 h-5" stroke="group-hover:stroke-primary-600 stroke-white" />
      </button>
    </div>
  </div>
  <Save :show="showSave" @close="showSave = false" />
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
