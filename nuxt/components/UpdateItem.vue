<script setup lang='ts'>
import { Item } from '~~/composables/useItem';
interface Props {
  item: Item
};

const { item } = defineProps<Props>();
const updateData: Item = {
  id: item.id,
  title: item.title,
  description: item.description,
  category: item.category,
  city: item.city,
  address: item.address
}
const route = useRoute();
const cities = await useGetCities();
const categories = await useGetCategories();
const emit = defineEmits(['close']);
const confirmUpdate = ref(false);
const handleSubmit = async () => {
  await useUpdateItem(updateData, route.path == '/');
  emit('close');
}
</script>

<template>
  <FormKit :preserve="true" :actions="false" type="form" v-model="updateData" @submit="confirmUpdate = true">
    <FormKit type="text" name="title" validation="required|length:5" placeholder="title" label="Title" />
    <FormKit type="textarea" name="description" placeholder="this is a ..." validation="required|length:15"
      label="Description" />
    <FormKit type="select" name="category" label="Choose a category" :options="categories" validation="required" />
    <FormKit type="select" name="city" label="Choose a city" :options="cities" validation="required" />
    <FormKit type="textarea" name="address" label="address" placeholder="cartier, ZIP..." />
    <div class="flex space-x-2">
      <FormKit type="submit">Update</FormKit>
      <button class="btn-outline" @click.prevent="$emit('close')">Cancel</button>
    </div>
  </FormKit>
  <Modal :show="confirmUpdate" @close="$emit('close')">
    <p class="text-xl my-3">confirm item delete?</p>
    <div class="flex ">
      <button class="btn-danger mr-2" @click="handleSubmit">update</button>
      <button class="btn-outline" @click="$emit('close')">cancel</button>
    </div>
  </Modal>
</template>
