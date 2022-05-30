<script setup lang="ts">
interface Props {
  label?: string
  placeholder?: string
  type?: string,
  span?: string | null
  modelValue?: Object | null
  required?: boolean
}
defineEmits(['update:modelValue']);

const { label = '', placeholder = '', type = "text", span = null, modelValue = null, required = false } = defineProps<Props>();
const pattern = "00212[0-9]{9}";
</script>
<template>
  <div class=" group flex flex-col space-y-2">
    <label v-if="label" class="text-primary-400 font-medium">
      {{ label }}:
      <span v-if="span" class="text-xs font-light"> {{ span }}</span>
    </label>
    <input :type="type" :placeholder="placeholder" :value="modelValue" :pattern="type == 'tel' ? pattern : null"
      :required="required" @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
      class="p-4 rounded-md border border-primary-500 placeholder:text-xs palceholder:text-disabled focus:shadow-primary-500 focus:shadow text-black">
  </div>
</template>
