<script setup lang="ts">
definePageMeta({ middleware: 'admin' })
const menu = ref('users');
</script>

<template>
  <div>
    <ul class="flex flex-wrap text-sm text-center text-primary-500 border-b border-primary-500">
      <li class="mr-2">
        <button @click="menu = 'pending'" :class="menu == 'pending' ? 'tab-active' : 'tab'">pending</button>
      </li>
      <li class="mr-2">
        <button @click="menu = 'users'" :class="menu == 'users' ? 'tab-active' : 'tab'">users</button>
      </li>
      <li class="mr-2">
        <button @click="menu = 'items'" :class="menu == 'items' ? 'tab-active' : 'tab'">items</button>
      </li>
    </ul>
    <div>
      <AllUsers v-if="menu == 'users'" />
      <AllItems v-if="menu == 'items'" />
      <PendingApproveItems v-if="menu == 'pending'" />
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
