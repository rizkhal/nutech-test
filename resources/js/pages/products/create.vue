<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import ProductForm from "~/components/products/form.vue";

defineProps({
  title: String,
});

const form = useForm({
  name: null,
  file: null,
  buyPrice: null,
  sellPrice: null,
  stock: null,
});
</script>
<template>
  <div class="flex flex-col">
    <div class="p-2 border-b">
      <h1 class="font-semibold text-xl">{{ title }}</h1>
    </div>

    <ProductForm
      :loading="form.processing"
      :errors="form.errors"
      @submit="
        form.post(route('products.store'), {
          onSuccess: () => {
            $modal.close();
          },
        })
      "
      v-model:name="form.name"
      v-model:file="form.file"
      v-model:buyPrice="form.buyPrice"
      v-model:sellPrice="form.sellPrice"
      v-model:stock="form.stock"
    />
  </div>
</template>