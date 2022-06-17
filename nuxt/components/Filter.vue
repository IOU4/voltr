<script setup lang="ts">

const isExpanded = ref(true);
const options = useFilterOptions();
const filter = useFilter();
const handleChange = () => {
  filter.value.getFiltredItems();
}
</script>

<template>
  <div class="bg-primary-50 p-4 rounded-md" :class="isExpanded ? 'ring-1 ring-primary-500' : ''">
    <div class="text-xl flex justify-between text-primary-800 cursor-pointer" @click="isExpanded = !isExpanded">
      <span>Filter Options:</span>
      <IconsArrowR class=" w-6 h-6 inline transition-transform" :class="isExpanded ? '-rotate-90' : 'rotate-90'" />
    </div>
    <div class="flex flex-col mt-4 transition-all" v-if="isExpanded">
      <FormKit type="radio" v-model="filter.option" @input="handleChange" :options="options" />
    </div>
  </div>
</template>
