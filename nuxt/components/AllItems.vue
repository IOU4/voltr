<script setup lang="ts">
const items = ref(await useGetAllItems());
const confirmDeleteItem = ref(false);
let item_id: number = 0;
const askForDeleteItem = (id: number) => { item_id = id; confirmDeleteItem.value = true }
const handleDeleteItem = async () => { useDeleteItem(item_id); confirmDeleteItem.value = false; items.value = await useGetAllItems() }
</script>

<template>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10">
    <table class="w-full text-sm text-left text-gray-500 ">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
        <tr>
          <th scope="col" class="px-6 py-3"> title </th>
          <th scope="col" class="px-6 py-3"> descritption </th>
          <th scope="col" class="px-6 py-3"> category </th>
          <th scope="col" class="px-6 py-3"> city </th>
          <th scope="col" class="px-6 py-3"> Status </th>
          <th scope="col" class="px-6 py-3"> Created_at </th>
          <th scope="col" class="px-6 py-3"> <span class="sr-only">Delete</span> </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in items" class="bg-white border-b ">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"> {{ item.title }} </th>
          <td class="px-6 py-4"> {{ item.description }} </td>
          <td class="px-6 py-4">{{ item.category }} </td>
          <td class="px-6 py-4">{{ item.city }} </td>
          <td class="px-6 py-4">{{ item.status }} </td>
          <td class="px-6 py-4">{{ item.created_at }} </td>
          <td class="px-6 py-4 text-right">
            <button @click="askForDeleteItem(item.id)" class="font-medium text-red-600 hover:underline">delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <Modal :show="confirmDeleteItem" @close="confirmDeleteItem = false">
    <p class="text-xl my-3">confirm item delete?</p>
    <div class="flex ">
      <button class="btn-danger mr-2" @click="handleDeleteItem()">confirm</button>
      <button class="btn-outline" @click="confirmDeleteItem = false">cancel</button>
    </div>
  </Modal>
</template>
