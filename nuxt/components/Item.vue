<script setup lang="ts">
import { Item } from '~~/composables/useItem'
import { DateTime } from 'luxon';

interface Props {
  item?: Item
}
const {
  item = defaultItem
} = defineProps<Props>();

const updateStateItem = () => {
  const sItem = useItem();
  sItem.value = item;
  sessionStorage.setItem("ITEM", JSON.stringify(item));
}
</script>

<template>
  <NuxtLink @click="updateStateItem" :to="`/items/${item.id}`"
    class="w-full rounded-md border hover:shadow-2xl transition-shadow">
    <div class="bg-slate-100 bg-no-repeat bg-contain bg-center w-full h-96 rounded-md"
      :style="`background-image: url('http://localhost/imgs/${item.cover}');`">
    </div>
    <div class="p-4 space-y-4">
      <div class="flex gap-2 items-center mb-2">
        <div class="bg-cover bg-center w-10 h-10 rounded-full"
          style="background-image:url('https://api.lorem.space/image/face?hash=33791');"> </div>
        <p class="text-sm text-primary-500">{{ item.author_name }}</p>
        <p class="text-xs ml-auto mt-auto text-slate-300">{{ DateTime.fromSQL(item.created_at).toRelative() }}
        </p>
      </div>
      <p class="text-3xl text-primary-400 ">{{ item.title }}</p>
      <p class="text-sm text-primary-700">{{ item.description }}</p>
      <div class="flex space-x-2">
        <button class="item-button group ">
          <span class="text-primary-700 text-sm group-hover:text-white ">reserve</span>
          <IconsArrowR class="w-5 h-5" stroke="stroke-primary-600 group-hover:stroke-white" />
        </button>
        <button class="item-button group">
          <IconsChat class="h-5 w-5" stroke="stroke-primary-600 group-hover:stroke-white" />
        </button>
      </div>
    </div>
  </NuxtLink>
</template>


