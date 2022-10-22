<script setup>
import Img from "./img.vue";
import Edit from "./edit.vue";
import Create from "./create.vue";
import Icon from "~/components/icon.vue";
import Dialog from "~/plugins/@rizkhal/modal/components/dialog.vue";

const props = defineProps({
  inertable: Object,
});
</script>
<template>
  <div class="p-4">
    <Inertable
      :actions="[
        {
          text: 'Tambah',
          action: 'create',
        },
      ]"
      @create="
        $modal.open({
          title: 'Tambah Produk',
          component: Create,
        })
      "
      :data="inertable"
    >
      <template #buy_price="{ item: { buy_price } }">
        <span>Rp. {{ buy_price }}</span>
      </template>
      <template #sell_price="{ item: { sell_price } }">
        <span>Rp. {{ sell_price }}</span>
      </template>
      <template #file_url="{ item: { name, file_url } }">
        <div class="w-24 h-24 flex items-center">
          <img
            :src="file_url"
            :alt="name"
            class="cursor-pointer rounded-md"
            @click.prevent="
              $modal.open({
                item: {
                  name,
                  file_url,
                },
                component: Img,
                maxWidth: '4xl',
              })
            "
          />
        </div>
      </template>
      <template #action="{ item }">
        <div class="flex flex-row space-x-2">
          <button
            @click.prevent="
              $modal.open({
                item,
                component: Edit,
              })
            "
            type="button"
            class="w-1/2 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm p-2 text-center sm:w-auto"
          >
            <Icon name="PencilSquareIcon" class="w-4 h-4" />
          </button>
          <button
            @click.prevent="
              $modal.open({
                url: {
                  name: 'products.destroy',
                  params: {
                    product: item.id,
                  },
                },
                maxWidth: 'md',
                position: 'center',
                component: Dialog,
                message: 'Apakah anda yakin? tindakan ini akan menghapus produk secara permanen!',
              })
            "
            type="button"
            class="w-1/2 text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-200 font-medium inline-flex items-center justify-center rounded-lg text-sm p-2 text-center sm:w-auto"
          >
            <Icon name="TrashIcon" class="w-4 h-4" />
          </button>
        </div>
      </template>
    </Inertable>
  </div>
</template>