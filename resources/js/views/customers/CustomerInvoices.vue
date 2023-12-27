<script setup>
import Invoices from '@/views/invoices/Index.vue'

const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  customerId: {
    type: Number,
    required: true,
  },
})

const emit = defineEmits([
  'update:isDialogVisible',
])


const dialogModelValueUpdate = val => {
  emit('update:isDialogVisible', val)
}
</script>

<template>
  <VDialog
    :width="$vuetify.display.smAndDown ? 600 : '90%'"
    :model-value="isDialogVisible"
    @update:model-value="dialogModelValueUpdate"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="dialogModelValueUpdate(false)" />
    <VCard v-if="customerId">
      <Invoices :customer-id="customerId" />
    </VCard>
  </VDialog>
</template>

