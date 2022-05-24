<script setup lang="ts">
interface Props {
  label?: string
  placeholder?: string
  type?: string,
  value?: string
  span?: string | null
}

const { label = '', placeholder = '', type = "text", value = '', span = null } = defineProps<Props>();
</script>
<template>
  <div class=" group flex flex-col space-y-2">
    <label v-if="label" class="text-primary-400 font-medium">
      {{ label }}:
      <span v-if="span" class="text-xs font-light"> {{ span }}</span>
    </label>
    <input :type="type" :placeholder="placeholder" v-model="value"
      class="p-4 rounded-md border border-primary-500 placeholder:text-xs text-disabled focus:shadow-primary-500 focus:shadow  focus:outline-none focus:ring-2 focus:text-black appearance-none ring-primary-500"
      :class="type == 'submit' ? 'bg-primary-500 text-center text-white font-bold shadow' : ''">
  </div>
</template>
