<script setup>
import { Inertia } from "@inertiajs/inertia";

defineProps({
  url: Object,
  message: null,
});
</script>
<template>
  <div class="p-6 text-center">
    <svg class="mx-auto mb-4 w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    <div class="mb-5">
      <h3 class="mb-2 text-2xl font-bold text-gray-800">Apakah anda yakin?</h3>
      <span class="text-gray-500">
        {{ message ?? "Tindakan ini akan menghapus data secara permanen!" }}
      </span>
    </div>
    <div class="flex flex-row justify-center items-center space-x-2">
      <button
        class="w-1/2 text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto;"
        @click.stop="
          Inertia.delete(route(url.name, url.params), {
            onSuccess: () => $modal.close(),
          })
        "
      >
        Ya, Hapus!
      </button>
      <button @click.stop="$modal.close()" type="button" class="w-1/2 text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:ring-gray-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto;">Batal</button>
    </div>
  </div>
</template>