<script setup>
import { number } from "~/helpers";
import File from "~/components/form/file.vue";
import Input from "~/components/form/input.vue";
import Number from "~/components/form/number.vue";
import Button from "~/components/form/button.vue";

defineProps({
  name: {
    type: [String, null],
    required: true,
  },
  file: {
    type: [Object, String, null],
    required: true,
  },
  buyPrice: {
    type: [String, null],
    required: true,
  },
  sellPrice: {
    type: [String, null],
    required: true,
  },
  stock: {
    type: [String, null],
    required: true,
  },
  errors: {
    type: Object,
  },
  loading: {
    type: Boolean,
    default: () => false,
  },
});

defineEmits(["submit", "update:file", "update:name", "update:buyPrice", "update:sellPrice", "update:stock"]);
</script>
<template>
  <div class="p-3">
    <form class="flex flex-col space-y-3">
      <Input label="Nama Barang" :error="errors.name" v-model="name" @change="$emit('update:name', $event.target.value)" :required="true" />

      <Number label="Harga Beli" :error="errors.buyPrice" v-model="buyPrice" @change="$emit('update:buyPrice', number($event.target.value))" prefix="Rp." :required="true" />

      <Number label="Harga Jual" :error="errors.sellPrice" v-model="sellPrice" @change="$emit('update:sellPrice', number($event.target.value))" prefix="Rp." :required="true" />

      <Number label="Stok" :error="errors.stock" v-model="stock" @change="$emit('update:stock', number($event.target.value))" :required="true" />

      <File label="File" :error="errors.file" v-model="file" @onChange="$emit('update:file', $event)" :required="true" />

      <div class="w-max">
        <Button :loading="loading" @click.prevent="$emit('submit')" label="Simpan" />
      </div>
    </form>
  </div>
</template>