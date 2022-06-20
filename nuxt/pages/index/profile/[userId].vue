<script setup lang="ts">
const { data: { id: user_id } } = useUser();
const route = useRoute();
if (route.params.userId == `${user_id}`) navigateTo('/profile');
const user = await useGetUser(route.params.userId as string);
</script>

<template>
  <div class="space-y-8">
    <h3 class="text-2xl">{{ user.username }}</h3>
    <ProfileInfo :user_id="route.params.userId as string" />
    <BasicInfo :user="user" />
  </div>
</template>
