<script setup>
import { onMounted } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import ProductForm from "~/components/products/form.vue";

const props = defineProps({
  title: String,
  item: Object,
});

const form = useForm({
  name: props.item.name,
  file: props.item.file_url,
  buyPrice: props.item.buy_price,
  sellPrice: props.item.sell_price,
  stock: props.item.stock,
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
        form.post(route('products.update', { product: item.id }), {
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