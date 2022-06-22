<script setup lang="ts">
import { DateTime } from 'luxon';
import { AlertType } from '~~/composables/useAlert';
import { ReserveData } from '~~/composables/useItem';

const showResrve = useShowReserve();
const reserveData = ref<ReserveData>({
  take_at: DateTime.now().toISO(),
  description: ''
});
const confirmReserve = ref(false);
const emit = defineEmits(['upd'])

const handleSubmit = async () => {
  const cAlert = useAlert();
  const { id: item_id } = useItem().value;
  const { data: { id: user_id } } = useUser();
  const api_url = useApiUrl();
  const res = await fetch(`${api_url}/item/reserve`, {
    method: 'post',
    body: JSON.stringify({ item_id, user_id, ...reserveData.value })
  }).then(res => res.json());
  if (res?.reserved) cAlert.value.showAlert('item reserved succesfuly', AlertType.SUCCESS)
  else cAlert.value.showAlert(`failed: ${res.error}`, AlertType.FAIL)
  confirmReserve.value = false;
  emit('upd')
}

</script>

<template>
  <modal :show="showResrve" @close="showResrve = false">
    <p class="text-3xl text-primary-700 text-center">Reserve an Item</p>
    <FormKit type="form" v-model="reserveData" @submit="confirmReserve = true" :preserve="true" :actions="false"
      class="w-48">
      <FormKit type="datetime-local" name="take_at" label="Taking time"
        help="choose the day and time for taking the item" :min="DateTime.now().toISO()"
        :validation="`required|date_after:${DateTime.now().toISO()}`" validation-visibility="live" />
      <FormKit type="textarea" name="description" placeholder="this is a ..." validation="required|length:15"
        label="Description" />
      <div class="flex justify-between">
        <FormKit type="submit" />
        <button class="btn-outline" @click.prevent="showResrve = false">cancel</button>
      </div>
    </FormKit>
  </modal>
  <modal :show="confirmReserve">
    <p class="text-2xl text-center my-6">confirm the reservation of this item ?</p>
    <div class="flex justify-center gap-2">
      <button class="btn-outline" @click="confirmReserve = false; showResrve = false">
        cancel</button>
      <FormKit type="button" @click="handleSubmit">Reserve</FormKit>
    </div>
  </modal>
</template>
