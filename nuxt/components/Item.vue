<script setup lang="ts">
import { Item } from '~~/composables/useItem'
import { DateTime } from 'luxon';

interface Props {
  item?: Item,
  isReserve?: boolean,
}
const { item = defaultItem, isReserve = false } = defineProps<Props>();
const showReserve = useShowReserve();
const { data: { id: user_id } } = useUser();
const storedItem = useItem();
const confirmDelete = ref(false);
const confirmReject = ref(false);
const confirmAccept = ref(false);

const updateStateItem = () => {
  storedItem.value = item;
  sessionStorage.setItem("ITEM", JSON.stringify(item));
}
const handleReserve = () => {
  storedItem.value = item;
  sessionStorage.setItem('ITEM', JSON.stringify(item));
  showReserve.value = true;
}
const handleAccept = () => { useAcceptItem(item.id); confirmAccept.value = false }
const handleReject = () => { useRejectItem(item.id); confirmReject.value = false }
const handleUpdate = () => { console.log('handleDelete') }
const handleDelete = () => { useDeleteItem(item.id); confirmDelete.value = false }
</script>

<template>
  <div class="w-full rounded-md border hover:shadow-2xl transition-shadow relative">
    <NuxtLink @click="updateStateItem" :to="`/items/${item.id}`">
      <div class="bg-slate-100 bg-no-repeat bg-contain bg-center w-full h-96 rounded-md"
        :style="`background-image: url('http://localhost/imgs/${item.cover}');`">
      </div>
      <div class="p-4 space-y-4">
        <div class="flex gap-2 items-center mb-2">
          <div class="bg-cover bg-center w-10 h-10 rounded-full"
            style="background-image:url('https://api.lorem.space/image/face?hash=33791');"> </div>
          <p class="text-sm text-primary-500">{{ item.author_name }}</p>
          <p class="text-xs ml-auto mt-auto text-slate-300">{{ DateTime.fromSQL(item.created_at).toRelative() }}
          </p>
        </div>
        <p class="text-3xl text-primary-400 ">{{ item.title }}</p>
        <p class="text-sm text-primary-700">{{ item.description }}</p>
      </div>
    </NuxtLink>
    <div class="flex space-x-2 p-4" v-if="!isReserve && item.author_id != user_id">
      <button class="btn-outline flex space-x-2 group " @click="handleReserve">
        <span class="text-primary-700 text-sm group-hover:text-white ">reserve</span>
        <IconsArrowR class="w-5 h-5" stroke="stroke-primary-600 group-hover:stroke-white" />
      </button>
      <button class="btn-outline group">
        <IconsChat class="h-5 w-5" stroke="stroke-primary-600 group-hover:stroke-white" />
      </button>
    </div>
    <div v-else-if="item.reserver_id && isReserve" class="p-4 space-y-2">
      <div class="mb-3">
        <p class="text-sm text-primary-500"> reservation info:</p>
        <p class="h-[0.05rem] w-full bg-primary-500"></p>
      </div>
      <NuxtLink to="/">
        reserve request by:
        <span class="hover:underline text-primary-400">{{ item.reserver_name }}</span>
      </NuxtLink>
      <p><span class="text-sm text-disabled">{{ item.reserver_name }} said:</span> {{ item.reserve_description }}</p>
      <p class="text-sm text-disabled">at: {{ DateTime.fromSQL(item.reserved_at).toFormat("yyyy LLL dd, HH:mm") }}</p>
      <button class="btn mr-3" @click="confirmAccept = true"> accept</button>
      <button class="btn-danger" @click="confirmReject = true">reject</button>
    </div>
    <div v-if="item.author_id == user_id && item.status != 'pending_reserve'"
      class="p-4 flex justify-end absolute bottom-1 right-1">
      <button class="btn mr-3" @click="handleUpdate">Update</button>
      <button class="btn-danger" @click="confirmDelete = true">Delete</button>
    </div>
    <Modal :show="confirmDelete" @close="confirmDelete = false">
      <p class="text-xl my-3">confirm item delete?</p>
      <div class="flex ">
        <button class="btn-danger mr-2" @click="handleDelete">confirm</button>
        <button class="btn-outline" @click="confirmDelete = false">cancel</button>
      </div>
    </Modal>
    <Modal :show="confirmReject" @close="confirmReject = false">
      <p class="text-xl my-3">confirm item reject?</p>
      <div class="flex ">
        <button class="btn-danger mr-2" @click="handleReject">Reject</button>
        <button class="btn-outline" @click="confirmReject = false">Cancel</button>
      </div>
    </Modal>
    <Modal :show="confirmAccept" @close="confirmAccept = false">
      <p class="text-xl my-3">confirm item accept?</p>
      <div class="flex ">
        <button class="btn mr-2" @click="handleAccept">Accept</button>
        <button class="btn-outline" @click="confirmReject = false">Cancel</button>
      </div>
    </Modal>
  </div>
</template>
