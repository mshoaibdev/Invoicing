<script setup>
import useInvoices from '@/composables/invoices'
import { VDataTableServer } from 'vuetify/labs/VDataTable'
import { formatCurrency } from '@core/utils/formatters'
import ViewInvoice from './View.vue'
import AddInvoice from './Add.vue'
import EditInvoice from './Edit.vue'

const props = defineProps({
  
  customerId: {
    type: Number,
    required: false,
  },
})

const { invoices, totalRecords, isLoading, fetchInvoices, currentPage, headers, deleteInvoice, itemsPerPage, searchQuery, paginationData, filters, resolveInvoiceStatusVariantAndIcon } = useInvoices()
const selectedRows = ref([])
const isEditInvoiceDialogVisible = ref(false)
const isViewInvoiceDialogVisible = ref(false)
const isAddInvoiceDialogVisible = ref(false)
const isConfirmDialogVisible = ref(false)
const invoiceId = ref(0)
const customerId = ref(0)


// mount
onMounted(async () => {
  

  if(props.customerId){
    customerId.value = props.customerId

    filters.customerId = props.customerId
  }
  await fetchInvoices()
})

const tableColumns = ref([])

// computed 

const updateTableColumns = () => {

  const storageColumns = JSON.parse(localStorage.getItem('invoices.table'))

  if(storageColumns) {
    tableColumns.value =  storageColumns.filter(column => column.visible === true)

  } else {
    tableColumns.value = headers
  }

}


updateTableColumns()


const toggleTableColumns = async items => {

  headers.forEach(header => {
    header.visible = items.includes(header.title)
  })


  localStorage.setItem('invoices.table', JSON.stringify(headers))

  updateTableColumns()
 
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
  await fetchInvoices()
}
</script>

<template>
  <VCard
    v-if="invoices"
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
            <VBtn
              prepend-icon="tabler-plus"
              @click="isAddInvoiceDialogVisible = true"
            >
              Create Invoice
            </VBtn>
          </div>
        </VCol>
        <VCol
          lg="6"
          md="6"
          sm="8"
          cols="12"
        >
          <!--
            <AppSelect
            v-model="tableColumns"
            label="Select Column Visibility "
            multiple
            eager
            :items="headers"
            @update:model-value="toggleTableColumns"
            > 
            <template #selection="{ item, index }">
            <VChip v-if="index < 4">
            <span>{{ item.title }}</span>
            </VChip>
            <span
            v-if="index === 4"
            class="text-grey text-caption align-self-center"
            >
            (+{{ tableColumns.length - 4 }} others)
            </span>
            </template>
            </AppSelect>
          -->
        </VCol>
        <VCol
          lg="3"
          md="3"
          cols="12"
          sm="6"
        >
          <AppTextField
            v-model="searchQuery"
            label="Search Invoices"
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
      :headers="tableColumns"
      :items="invoices"
      class="text-no-wrap"
    >
      <template #item.invoice_number="{ item }">
        <div class="d-flex align-center">
          <a
            href="javascript:;" 
              
            @click="viewInvoice(item.raw.id)"
          >
            {{ item.raw.invoice_number }}
          </a>
        </div>
      </template>
      

      <template #item.customer.email="{ item }">
        <a
          :href="`mailto:${item.raw.customer.email}`"
          class="text-decoration-none"
        >
          {{ item.raw.customer.email }}
        </a>
      </template>


      <template #item.customer.phone="{ item }">
        <a
          :href="`tel:${item.raw.customer.phone}`"
          class="text-decoration-none"
        >
          {{ item.raw.customer.phone }}
        </a>
      </template>

      
      <template #item.total="{ item }">
        <div class="d-flex align-center">
          <span class="me-3">
            {{ formatCurrency(item.raw.total) }}
          </span>
        </div>
      </template>

      <template #item.status="{ item }">
        <div class="d-flex align-center">
          <VBadge
            v-if="item.raw.payment_status"
            :content="item.raw.payment_status"
            color="primary"
            class="ms-3"
          />
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
            
      <!-- Actions -->
      <template #item.actions="{ item }">
        <IconBtn @click="deleteInvoiceConfirm(item.raw.id)">
          <VIcon icon="tabler-trash" />
        </IconBtn>
        <IconBtn @click="viewInvoice(item.raw.id)">
          <VIcon icon="tabler-eye" />
        </IconBtn>
        <IconBtn @click="editInvoice(item.raw.id)">
          <VIcon icon="tabler-pencil" />
        </IconBtn>
      </template>
    </VDataTableServer>
    <ViewInvoice
      v-if="isViewInvoiceDialogVisible"
      v-model:isDialogVisible="isViewInvoiceDialogVisible"
      :invoice-id="invoiceId"
      @edit-invoice="editInvoice"
      @delete-invoice="deleteInvoiceConfirm"
    />

    <AddInvoice
      v-if="isAddInvoiceDialogVisible"
      v-model:isDialogVisible="isAddInvoiceDialogVisible"
      @refetch-data="fetchInvoices"
    />

    <EditInvoice
      v-if="isEditInvoiceDialogVisible"
      v-model:isDialogVisible="isEditInvoiceDialogVisible"
      :invoice-id="invoiceId"
      @refetch-data="fetchInvoices"
    />
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
