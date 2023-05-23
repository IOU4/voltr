<script setup lang="ts">
interface Props {
  user_id?: string
}
const { data: { id: logged_user_id } } = useUser();
const { user_id = '0' } = defineProps<Props>();
const totals = await useUserTotals(user_id || logged_user_id);
</script>
<template>
  <div class="flex gap-4 flex-col lg:flex-row">
    <div class="card w-full md:w-fit">
      <div class="card_header">
        <span class="text-disabled">Listed Items: </span>
        <IconsPerson />
      </div>
      <div class="mb-2">
        <span class="text-xl lg:text-3xl ">{{ totals.items }} &ThickSpace;</span>
        <span>in Total</span>
      </div>
      <div class="text-blue-500">
        <span class="lg:text-xl">{{ totals.active }} &ThickSpace;</span>
        <span>Active</span>
      </div>
      <div class="text-primary-300">
        <span class="lg:text-xl ">{{ totals.reserved }} &ThickSpace;</span>
        <span>Reserved</span>
      </div>
    </div>
    <div class="card w-full md:w-fit">
      <div class="card_header">
        <span class="text-disabled">Reserved Items: </span>
        <IconsPerson />
      </div>
      <div class="mb-2">
        <span class="lg:text-4xl text-2xl">{{ totals.reservations }} &ThickSpace;</span>
        <span>in Total</span>
      </div>
    </div>
  </div>
</template>
<style scoped lang="postcss">
.card {
  @apply border border-disabled w-fit rounded-md py-2 px-4 shadow-lg
}

.card_header {
  @apply flex space-x-4 items-center
}
</style>
