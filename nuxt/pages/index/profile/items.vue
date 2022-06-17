<script setup lang="ts">

const option = useFilter();
const options = useFilterOptions();
onMounted(() => option.value.getFiltredItems())
</script>
<template>
  <div>
    <p class="text-2xl mb-6">Manage My Items:</p>
    <Filter />
    <div class="space-y-4 mt-2">
      <h2 class="text-2xl my-6">{{ options.find(e => e.value == option.option).label }}:</h2>
      <div class="grid lg:grid-cols-2 gap-y-10 gap-x-4">
        <div v-if="option.filtredItems.length == 0" class="text-sm text-center text-disabled">No items yet!</div>
        <Item v-for="item in option.filtredItems" :key="item.id" :item="item" :is-reserve="true" />
      </div>
    </div>
  </div>
</template>

