<script setup>
defineProps({
  item: Object,
});
</script>
<template>
  <div class="bg-white shadow rounded-md">
    <h1 class="p-2 text-4xl font-bold border-b">{{ item.name }}</h1>
    <div class="flex items-center justify-center">
      <img :src="item.file_url" alt="Image" class="w-full" />
    </div>
  </div>
</template>