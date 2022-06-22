<script setup lang="ts">
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
import { DateTime } from 'luxon';
definePageMeta({ pageTransition: true })

const route = useRoute();
const router = useRouter();
const item = ref(await useGetItem(route.params.itemId as string));
const itemsImages = await useItemImages(route.params.itemId as string);
const showSave = ref(false)
const confirmDelete = ref(false);
const confirmUpdate = ref(false);
const confirmReject = ref(false);
const confirmAccept = ref(false);
const handleDelete = () => { useDeleteItem(item.value.id); confirmDelete.value = false; router.back() }
const handleAccept = () => { useAcceptItem(item.value.id); confirmAccept.value = false }
const handleReject = () => { useRejectItem(item.value.id); confirmReject.value = false }

const handleResreve = () => {
  const showReserve = useShowReserve();
  showReserve.value = true;
}
const handleSave = () => {
  showSave.value = true;
}

const refreshItem = async () => item.value = await useGetItem(route.params.itemId as string);

const { data: { id: user_id } } = useUser();
</script>

<template>
  <div class="mt-4 grid gap-6 w-full lg:grid-cols-2">
    <div class="text-primary-700 text-4xl lg:col-span-2"> {{ item.title }} </div>
    <carousel :items-to-show="1">
      <slide v-for="image in [{ id: 0, image: item.cover }, ...itemsImages]" :key="image.id"
        class="w-[98%] h-80 lg:h-[75vh] bg-slate-100 flex justify-center items-center rounded-md overflow-hidden">
        <img :src="`http://localhost/imgs/${image.image}`" class="max-h-full max-w-full" draggable="false">
      </slide>

      <template #addons>
        <navigation />
        <pagination />
      </template>
    </carousel>
    <div class="flex flex-col gap-y-4">
      <div>
        <span class="text-lg font-bold block"> Description: </span>
        <span class="text-sm font-light"> {{ item.description }} </span>
      </div>
      <div class="flex items-end text-sm font-light gap-1 ">
        <IconsLocation />
        <span class="mr-4">{{ item.city }}</span>
        <IconsMap />
        <span>{{ item.address }}</span>
      </div>
      <div class="text-xs">
        <span>published at:</span>
        <span class="font-light ml-2">{{ DateTime.fromSQL(item.created_at).toHTTP() }}</span>
      </div>
      <NuxtLink to="/profile" class="flex gap-2 items-center mb-2">
        <div class="bg-cover bg-center w-10 h-10 rounded-full"
          style="background-image:url('https://api.lorem.space/image/face?hash=33791');"> </div>
        <p class="text-sm text-primary-500">{{ item.author_id == user_id ? 'you' : item.author_name }}</p>
      </NuxtLink>
      <div v-if="item.author_id != user_id" class="flex space-x-2"
        :class="item.status != 'active' ? 'opacity-40 pointer-events-none' : ''">
        <button class=" btn-outline space-x-2 flex flex group" @click="handleResreve">
          <span class="group-hover:text-white ">Reserve</span>
          <IconsArrowR class="w-5 h-5" stroke="stroke-primary-600 group-hover:stroke-white" />
        </button>
        <button class="space-x-2 flex flex group"
          :class="!item.saved && item.status == 'active' ? 'btn-outline' : 'btn-disabled'" @click="handleSave">
          <span class=" group-hover:text-white ">{{ item.saved ? 'saved' : 'save' }}</span>
          <IconsTag class="h-5 w-5" stroke="stroke-primary-600 group-hover:stroke-white" />
        </button>
        <!-- phone -->
        <a :href="`tel:${item.author_phone}`"
          class="btn-outline space-x-2 flex flex hover:bg-white bg-primary-500  group w-min">
          <span class="group-hover:text-primary-700 text-white ">{{ item.author_phone }}</span>
          <IconsPhone class="w-5 h-5" stroke="group-hover:stroke-primary-600 stroke-white" />
        </a>
      </div>
      <div v-else class="mt-auto lg:pb-8 space-y-10">
        <div v-if="item.status == 'pending_reserve'" class="space-y-2">
          <div class="mb-3">
            <p class="text-sm text-primary-500"> reservation info:</p>
            <p class="h-[0.05rem] w-full bg-primary-500"></p>
          </div>
          <NuxtLink to="/">
            reserve request by:
            <span class="hover:underline text-primary-400">{{ item.reserver_name }}</span>
          </NuxtLink>
          <p><span class="text-sm text-disabled">{{ item.reserver_name }} said:</span> {{ item.reserve_description }}
          </p>
          <p class="text-sm text-disabled">at: {{ DateTime.fromSQL(item.reserved_at).toFormat("yyyy LLL dd, HH:mm") }}
          </p>
          <button class="btn mr-3" @click="confirmAccept = true"> accept</button>
          <button class="btn-danger" @click="confirmReject = true">reject</button>
        </div>
        <div class="flex">
          <button class="btn mr-3" @click="confirmUpdate = true">Update</button>
          <button class="btn-danger" @click="confirmDelete = true">Delete</button>
        </div>
      </div>
    </div>
  </div>
  <Save :show="showSave" @close="() => { showSave = false; refreshItem() }" />
  <Modal :show="confirmUpdate" @close="confirmUpdate = false">
    <UpdateItem :item="item" @close="confirmUpdate = false" @upd="refreshItem" />
  </Modal>
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
  <Reserve @upd="refreshItem" />
</template>

<style lang="postcss">
.carousel__prev--in-active,
.carousel__next--in-active {
  display: none;
}

.carousel__prev,
.carousel__next {
  @apply bg-primary-600 rounded-md ring-2 ring-white;
}

.carousel__pagination-button {
  @apply bg-primary-100 w-5 h-3;
}

.carousel__pagination-button--active {
  @apply bg-primary-700
}
</style>
