<script setup lang="ts">
import { AlertType } from '~~/composables/useAlert';

const myAlert = useAlert()
const bg = computed(() => {
  switch (myAlert.value.type) {
    case AlertType.FAIL:
      return 'bg-red-300';
    case AlertType.SUCCESS:
      return 'bg-emerald-300';
    case AlertType.FAIL:
      return 'bg-blue-300';
  }
})
</script>

<template>
  <Transition name="alert">
    <div v-if="myAlert.isVisibile"
      class="fixed z-10 bottom-2 left-0 right-0 flex justify-center items-center transition-opacity duration-300 ease-linear">
      <div
        class="w-[95%] md:max-w-[95%] md:min-w-[50em] md:w-fit py-2 p-4 rounded-md shadow-lg transition-all duration-300 ease-linear flex justify-between items-center"
        :class="bg">
        <p>{{ myAlert.content }}</p>
        <button @click="myAlert.isVisibile = false" class="p-2 ring-1 ring-white rounded-md text-white">close</button>
      </div>
    </div>
  </Transition>
</template>

<style lang='postcss'>
.alert-enter-from {
  opacity: 0;
}

.alert-leave-to {
  opacity: 0;
}

.alert-enter-from .modal-container,
.alert-leave-to .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
:
