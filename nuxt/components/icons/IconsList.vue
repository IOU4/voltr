<script setup lang="ts">
interface Props {
  stroke?: string
}
const { stroke = "stroke-primary-600" } = defineProps<Props>()
</script>
<template>
  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#000000" viewBox="0 0 256 256">
    <rect width="256" height="256" fill="none"></rect>
    <line x1="40" y1="128" x2="216" y2="128" fill="none" :class="stroke" stroke-linecap="round" stroke-linejoin="round"
      stroke-width="12"></line>
    <line x1="40" y1="64" x2="216" y2="64" fill="none" :class="stroke" stroke-linecap="round" stroke-linejoin="round"
      stroke-width="12"></line>
    <line x1="40" y1="192" x2="216" y2="192" fill="none" :class="stroke" stroke-linecap="round" stroke-linejoin="round"
      stroke-width="12"></line>
  </svg>
</template>
