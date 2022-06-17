<script setup lang="ts">

interface PswdData {
  current: string,
  new: string,
  confirmation: string,
}
const pswdData = ref<PswdData>({ current: '', confirmation: '', new: '' })
const handleUpdate = () => console.log('changeUser');
const filterMenu = useFilterMenu();
</script>

<template>
  <div class="bg-primary-50 p-4 rounded-md" :class="{ 'ring-1 ring-primary-400': filterMenu.isPasswordExpanded }">
    <div class="text-lg flex justify-between cursor-pointer" @click="filterMenu.togglePassword()">
      <span>Password Info</span>
      <IconsArrowR class=" w-6 h-6 inline transition-transform"
        :class="filterMenu.isPasswordExpanded ? '-rotate-90' : 'rotate-90'" />
    </div>
    <div class="flex flex-col mt-4 transition-all" v-if="filterMenu.isPasswordExpanded">
      <FormKit type="form" v-model="pswdData" :actions="false" @submit="handleUpdate">
        <FormKit type="password" name="current" validation="required|length:5" label="Current Password" />
        <FormKit type="password" name="current" validation="required|length:5" label="New Password" />
        <FormKit type="password" name="current" validation="required|length:5" label="Confirm Password" />
        <FormKit type="submit">Update</FormKit>
      </FormKit>
    </div>
  </div>
</template>

<style>
</style>
