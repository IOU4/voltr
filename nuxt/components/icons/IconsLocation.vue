<script setup lang="ts">
interface Props {
  stroke?: string
}
const { stroke = "stroke-primary-600" } = defineProps<Props>()
</script>
<template>
  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#000000" viewBox="0 0 256 256">
    <rect width="256" height="256" fill="none"></rect>
    <line x1="56" y1="232" x2="200" y2="232" fill="none" :class="stroke" stroke-linecap="round" stroke-linejoin="round"
      stroke-width="12"></line>
    <circle cx="128" cy="104" r="32" fill="none" :class="stroke" stroke-linecap="round" stroke-linejoin="round"
      stroke-width="12"></circle>
    <path d="M208,104c0,72-80,128-80,128S48,176,48,104a80,80,0,0,1,160,0Z" fill="none" :class="stroke"
      stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
  </svg>
</template>
