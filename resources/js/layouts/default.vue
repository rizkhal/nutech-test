<script setup>
import { watch, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useToast } from "vue-toast-notification";

const toast = useToast();

const sidebarState = ref(false);

const props = defineProps({
  auth: Object,
  flash: Object,
  navigators: String,
  breadcrumbs: Object,
});

Inertia.on("success", (event) => {
  sidebarState.value = false;
});

watch(
  () => props.flash,
  (payload) => {
    if (payload) {
      if (payload.success) {
        toast.success(payload.success, {
          position: "top-right",
        });
      }

      if (payload.error) {
        toast.error(payload.error, {
          position: "top-right",
        });
      }

      if (payload.info) {
        toast.info(payload.info, {
          position: "top-right",
        });
      }

      if (payload.warning) {
        toast.warning(payload.warning, {
          position: "top-right",
        });
      }
    }
  },
  { deep: true },
);
</script>
<template>
  <div>
    <slot />
  </div>
</template>