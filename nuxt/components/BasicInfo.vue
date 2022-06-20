<script setup lang="ts">
import { UserData } from '~~/composables/useUser';

interface Props {
  user?: UserData | null
}
let { user = null } = defineProps<Props>();
const { data: loggedUser } = useUser();
const newUser = ref<UserData>(user ?? loggedUser)
const filterMenu = useFilterMenu();
const isDiabled = ref(true);
const handleUpdate = () => console.log('changeUser');
const handleCancel = () => {
  if (isDiabled.value) return isDiabled.value = false;
  newUser.value = user ?? loggedUser;
  isDiabled.value = true;
}

</script>
<template>
  <div class="bg-primary-50 p-4 rounded-md" :class="{ 'ring-1 ring-primary-500': filterMenu.isInfoExpanded }">
    <div class="text-lg flex justify-between cursor-pointer " @click="filterMenu.toggleInfo()">
      <span>Basic Info</span>
      <IconsArrowR class=" w-6 h-6 inline transition-transform"
        :class="filterMenu.isInfoExpanded ? '-rotate-90' : 'rotate-90'" />
    </div>
    <div class="flex flex-col mt-4 transition-all" v-if="filterMenu.isInfoExpanded">
      <FormKit :preserve="true" type="form" v-model="newUser" :actions="false" @submit="handleUpdate">
        <FormKit type="text" name="username" prefix="prefix" :disabled="isDiabled" validation="required|length:5"
          placeholder="name" label="Name" />
        <FormKit type="email" name="email" placeholder="email" :disabled="isDiabled" validation="email"
          label="Email adress" />
        <FormKit type="tel" label="Phone number" name="phone" :disabled="isDiabled" placeholder="xxx-xxx-xxxx"
          validation="matches:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/" :validation-messages="{
            matches: 'Phone number must be in the format xxx-xxx-xxxx',
          }" validation-visibility="dirty" />
        <div class="flex space-x-2" v-if="!user">
          <FormKit type="submit" :disabled="isDiabled">Update</FormKit>
          <Transition name="slide-up" mode="out-in">
            <button v-if="isDiabled" class="btn-outline" @click.prevent="handleCancel">Edit</button>
            <button v-else class="btn-outline" @click.prevent="handleCancel">Cancel</button>
          </Transition>
        </div>
      </FormKit>
    </div>
  </div>
</template>
