<script setup lang="ts">
const users = ref(await useGetUsers());
const confirmDeleteUser = ref(false);
let user_id: number | null = null;
const askForDeleteUser = (id: number) => { user_id = id; confirmDeleteUser.value = true }
const handleDeleteUser = async () => { useDeleteUser(user_id); confirmDeleteUser.value = false; users.value = await useGetUsers() }
</script>

<template>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10">
    <table class="w-full text-sm text-left text-gray-500 ">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
        <tr>
          <th scope="col" class="px-6 py-3"> Name </th>
          <th scope="col" class="px-6 py-3"> Email </th>
          <th scope="col" class="px-6 py-3"> Phone </th>
          <th scope="col" class="px-6 py-3"> Created_at </th>
          <th scope="col" class="px-6 py-3"> <span class="sr-only">Edit</span> </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" class="bg-white border-b ">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"> {{ user.username }} </th>
          <td class="px-6 py-4"> {{ user.email }} </td>
          <td class="px-6 py-4"> {{ user.phone }} </td>
          <td class="px-6 py-4">{{ user.created_at }} </td>
          <td class="px-6 py-4 text-right">
            <button class="font-medium text-red-600 hover:underline" @click="askForDeleteUser(user.id)">delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <Modal :show="confirmDeleteUser" @close="confirmDeleteUser = false">
    <p class="text-xl my-3">confirm user delete?</p>
    <div class="flex ">
      <button class="btn-danger mr-2" @click="handleDeleteUser()">confirm</button>
      <button class="btn-outline" @click="confirmDeleteUser = false">cancel</button>
    </div>
  </Modal>
</template>
