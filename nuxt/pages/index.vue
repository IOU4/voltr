<script setup lang="ts">
const count = ref<number>(0)
</script>
<template>
  <div class="border border-indigo-200 rounded-lg shadow lg grid place-items-center m-20 ">
    <button class="text-primary-300 border rounded-md shadow-md px-4 py-2 active:opacity-50" @click="count++">click
      me!</button>
    <p>{{ count }}</p>
  </div>
</template>
