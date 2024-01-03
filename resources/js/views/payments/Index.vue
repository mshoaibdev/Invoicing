<script setup>
import usePayments from '@/composables/payments'
import { VDataTableServer } from 'vuetify/labs/VDataTable'
import { formatCurrency } from '@core/utils/formatters'
import ability from '@/plugins/casl/ability'

const props = defineProps({
  
  customerId: {
    type: Number,
    required: false,
  },
})

const { payments, totalRecords, isLoading, fetchPayments, currentPage, headers, deleteInvoice, itemsPerPage, searchQuery, paginationData, filters, resolvePaymentstatusVariantAndIcon } = usePayments()
const selectedRows = ref([])
const isConfirmDialogVisible = ref(false)
const isViewInvoiceDialogVisible = ref(false)
const isSendInvoiceDialogVisible = ref(false)
const invoiceId = ref(0)
const customerId = ref(0)
const invoice = ref({})


// mount
onMounted(async () => {
  

  if(props.customerId){
    customerId.value = props.customerId

    filters.customerId = props.customerId
  }
  await fetchPayments()
})


const sendInvoice = async item => {
  
  invoice.value = item
  isSendInvoiceDialogVisible.value = true
}


const editInvoice = id => {
  invoiceId.value = id
  isEditInvoiceDialogVisible.value = true
}

const viewInvoice = id => {
  invoiceId.value = id
  isViewInvoiceDialogVisible.value = true
}

const deleteInvoiceConfirm = id => {
  isConfirmDialogVisible.value = true
  invoiceId.value = id
}

const confirmDelete = async ev => {
  if(ev === false) {
    isConfirmDialogVisible.value = false
    
    return
  }
  await deleteInvoice(invoiceId.value)
  isConfirmDialogVisible.value = false
  isViewInvoiceDialogVisible.value = false
  await fetchPayments()
}
</script>

<template>
  <VCard
    v-if="payments"
    id="invoice-list"
  >
    <VCardText class="d-flex align-center flex-wrap gap-4">
      <VRow>
        <VCol
          lg="3"
          md="3"
          sm="4"
          cols="12"
        >
          <div class="me-3 d-flex gap-3">
            <!--
              <VBtn
              v-if="ability.can('Create', 'payments-create')"
              prepend-icon="tabler-plus"
              :to="{ name: 'create-invoice' }"
              >
              Create Invoice
              </VBtn>
            -->
          </div>
        </VCol>
      
        <VCol
          offset="6"
          lg="3"
          md="3"
          cols="12"
          sm="6"
        >
          <AppTextField
            v-model="searchQuery"
            label="Search Payments"
            density="compact"
          />
        </VCol>
      </VRow>
    </VCardText>


    <VDivider />

    <VDataTableServer
      v-model="selectedRows"
      v-model:items-per-page="itemsPerPage"
      v-model:page="currentPage"
      :loading="isLoading"
      :items-length="totalRecords"
      :headers="headers"
      :items="payments"
      class="text-no-wrap"
    >
      <template #item.amount="{ item }">
        <div class="d-flex align-center">
          <span class="me-3">
            {{ formatCurrency(item.raw.amount) }}
          </span>
        </div>
      </template>


      <template #item.title="{ item }">
        <div class="d-flex align-center">
          <a
            href="javascript:;" 
              
            @click="viewInvoice(item.raw.id)"
          >
            {{ item.raw.title }}
          </a>
        </div>
      </template>
    </VDataTableServer>
   
    <ConfirmDialog
      v-model:isDialogVisible="isConfirmDialogVisible"
      cancel-title="Cancelled"
      confirm-title="Deleted"
      confirm-msg="Invoice deleted successfully."
      confirmation-question="Are you sure you want to delete this invoice? This action cannot be undone."
      cancel-msg="Invoice deletion cancelled."
      @confirm="confirmDelete"
    />
  </VCard>
</template>

<style lang="scss">
#invoice-list {
  .invoice-list-actions {
    inline-size: 8rem;
  }

  .invoice-list-filter {
    inline-size: 12rem;
  }
}
</style>
