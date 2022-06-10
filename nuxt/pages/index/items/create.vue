<script setup lang="ts">
import { Cities, Item, Categories } from "~~/composables/useItem";

interface ItemImages {
  images?: {
    name: string,
    file: File
  }[]
}
const formData: Item = {};
const itemImages: ItemImages = {};
const categories = ref<Categories[]>([]);
const cities = ref<Cities[]>([]);
const step = ref(1);
const api_url = useApiUrl();
const { id } = useUser();
const router = useRouter();

const submitItem = async () => {
  const data = new FormData();
  for (const key in formData) {
    if (key == 'tmp_cover' && formData.tmp_cover.length) {
      data.append('cover', formData[key][0].file);
      continue;
    }
    data.append(key, formData[key]);
  }
  data.append('author_id', id);
  fetch(`${api_url}/item/create`, {
    method: 'post',
    body: data
  }).then(res => res.json()).then(data => {
    if (data.created) {
      formData.id = data.item.id;
      step.value = 2;
    }
    else alert(`error occured: ${JSON.stringify(data.errors)}`)
  });
}

const submitImages = () => {
  const data = new FormData();
  itemImages?.images.forEach((img, index) => data.append(`img-${index}`, img.file));
  data.append('id', formData.id.toString());
  fetch(`${api_url}/item/images`, {
    method: 'post',
    body: data
  }).then(res => res.json()).then(data => { if (data?.stored) router.push('/') })
}

onMounted(async () => {
  const ctgrs = await fetch('http://localhost/api/categories').then(res => res.json()) as Categories[]
  const cts = await fetch('http://localhost/api/cities').then(res => res.json()) as Cities[]
  categories.value = ctgrs;
  cities.value = cts;
});
</script>

<template>
  <div class="mt-4 w-full flex justify-center">
    <div class="lg:w-[45rem] w-full">
      <FormKit v-if="step == 1" :preserve="true" type="form" v-model="formData" @submit="submitItem">
        <FormKit type="text" name="title" validation="required|length:5" placeholder="title" label="Title" />
        <FormKit type="textarea" name="description" placeholder="this is a ..." validation="required|length:15"
          label="Description" />
        <FormKit type="file" name="tmp_cover" label="Cover Photo" accept=".png,.jepg,.jpg,.webp"
          help="image to be shown as cover" />
        <FormKit type="select" name="category" label="Choose a category" :options="categories" validation="required" />
        <FormKit type="select" name="city" label="Choose a city" :options="cities" validation="required" />
        <FormKit type="textarea" name="address" label="address" placeholder="cartier, ZIP..." />
      </FormKit>
      <FormKit v-else v-model="itemImages" :actions="false" :preserve="true" type="form" @submit="submitImages">
        <FormKit type="file" name="images" label="Item images"
          help="choose up to 5 images (hold ctrl for multiple select!)" multiple />
        <div class="flex gap-2 items-center">
          <FormKit type="submit">Upload</FormKit>
          <button class="w-24 ring-1 ring-primary-500 p-4 rounded-md focus:shadow-lg hover:shadow-lg text-primary-500"
            @click="step = 1">
            back</button>
          <p class="ml-auto">step: 2/2</p>
        </div>
      </FormKit>
    </div>
  </div>
</template>
