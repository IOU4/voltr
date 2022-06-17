<script setup lang="ts">
import { AlertType } from '~~/composables/useAlert';

defineProps<{
  show: boolean
}>()
const emit = defineEmits(['close']);
const handleSave = () => {
  const { id: item_id } = useItem().value;
  const { data: { id: user_id } } = useUser();
  const api_url = useApiUrl();
  const cAlert = useAlert();
  fetch(`${api_url}/item/save`, {
    method: 'post',
    body: JSON.stringify({ user_id, item_id })
  }).then(res => {
    if (res.ok) cAlert.value.showAlert('item saved succefully', AlertType.SUCCESS)
    else cAlert.value.showAlert('error occured while saving', AlertType.FAIL)
    emit('close');
  })

}
</script>
<template>
  <modal @close="$emit('close')" :show="show">
    <p class="text-2xl text-primary-800 my-5">Confirm the Save of this item?</p>
    <div class="flex justify-between">
      <button class="btn" @click="handleSave">Confirm</button>
      <button class="btn-outline" @click="$emit('close')">Cancel</button>
    </div>
  </modal>
</template>
