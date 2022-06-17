<script setup lang="ts">
interface Props {
  stroke?: string
}
const { stroke = "stroke-primary-600" } = defineProps<Props>()
</script>
<template>
  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#000000" viewBox="0 0 256 256">
    <rect width="256" height="256" fill="none"></rect>
    <polyline points="172 104 113.3 160 84 132" fill="none" :class="stroke" stroke-linecap="round"
      stroke-linejoin="round" stroke-width="12"></polyline>
    <circle cx="128" cy="128" r="96" fill="none" :class="stroke" stroke-linecap="round" stroke-linejoin="round"
      stroke-width="12"></circle>
  </svg>
</template>

