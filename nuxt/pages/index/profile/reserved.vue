<script setup lang="ts">
const items = ref(await useFetchReservedItems());
const filterStatus = ref<string | null>('pending')
const filtredItems = computed(() => items.value.filter(e => e.reserve_status == filterStatus.value))
</script>

<template>
  <div>
    <ul class="flex flex-wrap text-sm text-center text-primary-500 border-b border-primary-500">
      <li class="mr-2">
        <button @click="filterStatus = 'accepted'"
          :class="filterStatus == 'accepted' ? 'tab-active' : 'tab'">accepted</button>
      </li>
      <li class="mr-2">
        <button @click="filterStatus = 'rejected'"
          :class="filterStatus == 'rejected' ? 'tab-active' : 'tab'">rejected</button>
      </li>
      <li class="mr-2">
        <button @click="filterStatus = 'pending'"
          :class="filterStatus == 'pending' ? 'tab-active' : 'tab'">pending</button>
      </li>
    </ul>
    <div class="heading flex justify-between py-4 mb-2">
      <h1 class="text-primary-800 text-2xl">Reserved Items:</h1>
      <IconsSearch class="icon" />
    </div>
    <div class="grid lg:grid-cols-2 gap-y-10 gap-x-4">
      <div v-for="item in filtredItems">
        <Item v-if="item.reserve_status == filterStatus" :key="item.id" :item="item" :is-reserve="true" />
      </div>
    </div>
  </div>
</template>

<style scoped lang="postcss">
.tab {
  @apply inline-block p-4 rounded-t-lg cursor-pointer
}

.tab-active {
  @apply inline-block p-4 text-white bg-primary-400 rounded-t-lg border-b-0 cursor-pointer
}
</style>
