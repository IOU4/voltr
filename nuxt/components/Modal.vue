<script setup lang="ts">
const props = defineProps<{
  show: Boolean
}>()

const emits = defineEmits(['close']);
const modalRef = ref(null)
onClickOutside(modalRef, () => emits('close'));
</script>

<template>
  <Transition name="modal">
    <div v-if="show"
      class="fixed z-10 inset-0 w-screen h-screen bg-slate-800 bg-opacity-20 flex items-center justify-center transition-opacity duration-300 ease-linear">
      <div ref="modalRef"
        class="w-[94%] min-h-[5em] md:w-[50em] p-4 bg-white rounded-md shadow-lg transition-all duration-300 ease-linear flex flex-col ">
        <slot></slot>
      </div>
    </div>
  </Transition>
</template>

<style lang='postcss'>
.modal-default-button {
  float: right;
  @apply p-2 rounded-md ring-1 ring-primary-400;
}

.modal-enter-from {
  opacity: 0;
}

.modal-leave-to {
  opacity: 0;
}

.modal-enter-from .modal-container,
.modal-leave-to .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
