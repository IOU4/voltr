<script setup lang="ts">
const pending_items = ref(await useGetApprovePendingItems())
const confirmRefusetItem = ref(false);
const confirmApproveItem = ref(false);
let item_id: number | null = null;
const askForApprove = (itemId: number) => { item_id = itemId; confirmApproveItem.value = true }
const askForRefuse = (itemId: number) => { item_id = itemId; confirmRefusetItem.value = true }
const handleRefuse = async () => {
  useApproveItem(item_id, true);
  confirmRefusetItem.value = false;
  pending_items.value = await useGetApprovePendingItems()
}
const handleApprove = async () => {
  useApproveItem(item_id);
  confirmApproveItem.value = false
  pending_items.value = await useGetApprovePendingItems()
}
</script>

<template>
  <div>

    <div>
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10">
        <table class="w-full text-sm text-left text-gray-500 ">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
            <tr>
              <th scope="col" class="px-6 py-3"> title </th>
              <th scope="col" class="px-6 py-3"> descritption </th>
              <th scope="col" class="px-6 py-3"> category </th>
              <th scope="col" class="px-6 py-3"> city </th>
              <th scope="col" class="px-6 py-3"> Created_at </th>
              <th scope="col" class="px-6 py-3"> Author </th>
              <th scope="col" class="px-6 py-3"> <span class="sr-only">Delete</span> </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in pending_items" class="bg-white border-b ">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"> {{ item.title }} </th>
              <td class="px-6 py-4"> {{ item.description }} </td>
              <td class="px-6 py-4">{{ item.category }} </td>
              <td class="px-6 py-4">{{ item.city }} </td>
              <td class="px-6 py-4">{{ item.created_at }} </td>
              <td class="px-6 py-4 text-right space-x-2">
                <button class="font-medium text-primary-600 hover:underline "
                  @click="askForApprove(item.id)">approve</button>
                <button class="font-medium text-red-600 hover:underline" @click="askForRefuse(item.id)">refuse</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <Modal :show="confirmApproveItem" @close="confirmApproveItem = false">
      <p class="text-xl my-3">confirm item approve?</p>
      <div class="flex ">
        <button class="btn-danger mr-2" @click="handleApprove">confirm</button>
        <button class="btn-outline" @click="confirmApproveItem = false">cancel</button>
      </div>
    </Modal>
    <Modal :show="confirmRefusetItem" @close="confirmRefusetItem = false">
      <p class="text-xl my-3">confirm item refuse?</p>
      <div class="flex ">
        <button class="btn-danger mr-2" @click="handleRefuse">confirm</button>
        <button class="btn-outline" @click="confirmRefusetItem = false">cancel</button>
      </div>
    </Modal>
  </div>
</template>

<style scoped lang="postcss">
.tab {
  @apply inline-block p-4 rounded-t-lg cursor-pointer
}

.tab-active {
  @apply inline-block p-4 text-white bg-primary-400 rounded-t-lg border-b-0 cursor-pointer
}
</style>
