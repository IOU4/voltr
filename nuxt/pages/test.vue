<script setup lang="ts">
const counter = useCount();
const otherCounter = useOtherCount();
const { data, pending, error, refresh } = await useFetch(
  'https://api.nuxtjs.dev/mountains',
)

</script>

<template>
  <div>Counter: {{ counter }}</div>
  <div>Counter: {{ otherCounter }}</div>
  <div>
    <button class="font-mono" @click="counter++"> + </button>
    <button class="font-mono" @click="otherCounter++"> + </button>
  </div>
</template>
