<script setup>
import usePaymentMethods from '@/composables/paymentMethods'
import ability from '@/plugins/casl/ability'
import Add from './PaymentMethods/Add.vue'
import Edit from './PaymentMethods/Edit.vue'
import { VDataTableServer } from 'vuetify/labs/VDataTable'

const { fetchPaymentMethods, paymentMethods,  headers, searchQuery, itemsPerPage, currentPage, totalRecords, isLoading, deletePaymentMethod, updatePaymentMethodStatus } = usePaymentMethods()

const paymentMethodId = ref('')
const isConfirmDialogOpen = ref(false)
const isAddNewDialogVisible = ref(false)
const isEditDialogVisible = ref(false)

onMounted(() => {
  fetchPaymentMethods()
})

const editPaymentMethod = paymentMethod => {
  paymentMethodId.value = paymentMethod
  isEditDialogVisible.value = true
}

const paymentMethodDelete = async confirm => {
  if(confirm){
    await deletePaymentMethod(paymentMethodId.value)
    fetchPaymentMethods()
  }
}

const updatePaymentMethodStatusHandle = async (paymentMethodId, event) => {
  await updatePaymentMethodStatus(paymentMethodId, { is_enabled: event })

  // fetchPaymentMethods()
}

const confirmDelete = paymentMethod => {
  paymentMethodId.value = paymentMethod
  isConfirmDialogOpen.value = true
}
</script>

<template>
  <section>
    <VRow>
      <VCol cols="12">
        <VCard title="Payment Methods">
          <VDivider />

          <VCardText class="d-flex flex-wrap py-4 gap-4">
            <VRow>
              <VCol
                lg="3"
                md="3"
                sm="4"
                cols="12"
              >
                <VBtn
                  v-if="ability.can('Create', 'payment-methods-create')"
                  prepend-icon="tabler-plus"
                  @click="isAddNewDialogVisible = true"
                >
                  Add New Payment Method
                </VBtn>
              </VCol>

              <VCol
                offset="5"
                lg="4"
                md="4"
                sm="4"
                cols="12"
              >
                <VTextField
                  v-model="searchQuery"
                  placeholder="Search"
                  density="compact"
                />
              </VCol>
            </VRow>
          </VCardText>

          <VDivider />

          <VDataTableServer
            v-model:items-per-page="itemsPerPage"
            v-model:page="currentPage"
            :loading="isLoading"
            :items-length="totalRecords"
            :headers="headers"
            :items="paymentMethods"
            class="text-no-wrap"
          >
            <template #item.is_enabled="{ item }">
              <VSwitch
                v-model="item.raw.is_enabled"
                label="Enabled"
                @update:model-value="updatePaymentMethodStatusHandle(item.raw.id, $event)"
              />
            </template>

            
            <template #item.actions="{ item }">
              <IconBtn
                v-if="ability.can('Update', 'payment-methods-edit')" 
                @click="editPaymentMethod(item.raw.id)"
              >
                <VIcon icon="tabler-pencil" />
              </IconBtn>

              <IconBtn
                v-if="ability.can('Delete', 'payment-methods-delete')"
                @click="confirmDelete(item.raw.id)"
              >
                <VIcon icon="tabler-trash" />
              </IconBtn>
            </template>
          </VDataTableServer>
        </VCard>
      </VCol>
    </VRow>
  

    <Add
      v-if="isAddNewDialogVisible"
      v-model:isDialogVisible="isAddNewDialogVisible"
      @refetch-data="fetchPaymentMethods"
    />
    <Edit
      v-if="isEditDialogVisible"
      v-model:isDialogVisible="isEditDialogVisible"
      :payment-method-id="paymentMethodId"
      @refetch-data="fetchPaymentMethods"
    />

    <ConfirmDialog
      v-model:isDialogVisible="isConfirmDialogOpen"
      cancel-title="Cancelled"
      confirm-title="Deleted"
      confirm-msg="payment Method deleted successfully."
      confirmation-question="Are you sure you want to delete payment Method, This action is irreversible?"
      cancel-msg="payment Method deletion cancelled."
      @confirm="paymentMethodDelete"
    />
  </section>
</template>
