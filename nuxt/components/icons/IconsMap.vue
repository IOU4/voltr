<script setup lang="ts">
interface Props {
  stroke?: string
}
const { stroke = "stroke-primary-600" } = defineProps<Props>()
</script>
<template>
  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#000000" viewBox="0 0 256 256">
    <rect width="256" height="256" fill="none"></rect>
    <polyline points="96 184 32 200 32 56 96 40" fill="none" :class="stroke" stroke-linecap="round"
      stroke-linejoin="round" stroke-width="12"></polyline>
    <polygon points="160 216 96 184 96 40 160 72 160 216" fill="none" :class="stroke" stroke-linecap="round"
      stroke-linejoin="round" stroke-width="12"></polygon>
    <polyline points="160 72 224 56 224 200 160 216" fill="none" :class="stroke" stroke-linecap="round"
      stroke-linejoin="round" stroke-width="12"></polyline>
  </svg>
</template>




