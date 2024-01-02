<script setup>
import useCustomers from '@/composables/customers'
import leadTypes from '@/data/leadTypes'
import { VDataTableServer } from 'vuetify/labs/VDataTable'
import ViewCustomer from './View.vue'
import AddCustomer from './Add.vue'
import EditCustomer from './Edit.vue'
import ability from '@/plugins/casl/ability'


const { customers, totalRecords, isLoading, fetchCustomers, deleteMultipleCustomer, updateCustomerStatus, currentPage, headers, deleteCustomer, itemsPerPage, searchQuery, filters, paginationData, customersByStatus } = useCustomers()
const selectedRows = ref([])
const isEditCustomerDialogVisible = ref(false)
const isViewCustomerDialogVisible = ref(false)
const isAddCustomerDialogVisible = ref(false)
const isAddEstimateDialogVisible = ref(false)
const isAddInvoiceDialogVisible = ref(false)
const isCustomerInvoicesDialogVisible = ref(false)
const isConfirmDialogVisible = ref(false)
const isCustomerEstimatesDialogVisible = ref(false)
const showSelectCheckboxes = ref(true)
const isMobileViewPort = ref(false)
const customerId = ref(0)


// filterCustomers
const filterCustomers = () => {

  fetchCustomers()
}

// updateProgressStatus

const updateProgressStatus = async (id, status) => {

  await updateCustomerStatus(id, { status })
  await fetchCustomers()
  
}

const tableColumns = ref([])

// computed 

const updateTableColumns = () => {

  const storageColumns = JSON.parse(localStorage.getItem('customers.table'))

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


  localStorage.setItem('customers.table', JSON.stringify(headers))

  updateTableColumns()
 
}



// viewCustomerEstimates

const viewCustomerEstimates = async id => {
  customerId.value = id

  isViewCustomerDialogVisible.value = false
  isCustomerEstimatesDialogVisible.value = true
}

const viewCustomerInvoices = async id => {
  customerId.value = id

  isViewCustomerDialogVisible.value = false
  isCustomerInvoicesDialogVisible.value = true
}

// viewEstimate

const createEstimate = async id => {
  customerId.value = id

  isViewCustomerDialogVisible.value = false
  isAddEstimateDialogVisible.value = true
}

// createInvoice

const createInvoice = async id => {
  customerId.value = id

  isViewCustomerDialogVisible.value = false
  isAddInvoiceDialogVisible.value = true
}

// mount
onMounted(async () => {

  // check viewport size if mobile then show only 2 columns in table
  if(window.innerWidth < 768) {
    tableColumns.value = headers.slice(0, 1)
    showSelectCheckboxes.value = false
    isMobileViewPort.value = true
  }

  await fetchCustomers()
})

const editCustomer = id => {
  customerId.value = id
  isEditCustomerDialogVisible.value = true
}

const viewCustomer = id => {
  customerId.value = id
  isViewCustomerDialogVisible.value = true
}

const deleteCustomerConfirm = id => {
  isConfirmDialogVisible.value = true
  customerId.value = id
}

const deleteMultipleCustomerConfirm = () => {
  isConfirmDialogVisible.value = true
}

const confirmDelete = async ev => {
  if(ev === false) {
    isConfirmDialogVisible.value = false
    
    return
  }

  if(selectedRows.value.length) {
    await deleteMultipleCustomer(selectedRows.value)
    selectedRows.value = []
  }
  else{
    await deleteCustomer(customerId.value)
  }

  isConfirmDialogVisible.value = false
  isViewCustomerDialogVisible.value = false
  await fetchCustomers()
}
</script>

<template>
  <VCard
    v-if="customers"
    id="invoice-list"
  >
    <VCardText class="d-flex align-center flex-wrap gap-4">
      <VRow>
        <VCol
          lg="3"
          md="4"
          sm="6"
          cols="12"
        >
          <div class="me-3 d-flex gap-3">
            <VBtn
              v-if="ability.can('Create', 'customers-create')"
              prepend-icon="tabler-plus"
              @click="isAddCustomerDialogVisible = true"
            >
              Create Customer
            </VBtn>
          </div>
        </VCol>
        <VCol
          lg="6"
          md="6"
          sm="6"
        />
        <VCol
          lg="3"
          md="6"
          sm="6"
          cols="12"
        >
          <AppTextField
            v-model="searchQuery"
            label="Search Customers"
            density="compact"
          />
        </VCol>
        <!--
          <VCol
          lg="4"
          md="6"
          sm="6"
          cols="12"
          >
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
          </VCol>
       
          <VCol
          lg="2"
          md="6"
          sm="6"
          >
          <AppSelect
          v-model="filters.lead_type"
          label="Select Lead Type"
          clearable
          item-title="name"
          item-value="id"
          clear-icon="tabler-x"
          :items="leadTypes"
          @update:model-value="filterCustomers"
          />
        
          </VCol>
        -->
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
      loading-text="Loading... Please wait"
      :show-select="showSelectCheckboxes"
      :items="customers"
      class="text-no-wrap"
    >
      <template #item.name="{ item }">
        <div class="">
          <a
            href="javascript:;" 
            class="d-block"
              
            @click="viewCustomer(item.raw.id)"
          >
            {{ item.raw.name }}
          </a>

          <a
            :href="`mailto:${item.raw.email}`"
            class="text-decoration-none text-sm text-secondary"
          >
            {{ item.raw.email }}
          </a>

          <IconBtn
            v-if="isMobileViewPort"
            @click="viewCustomer(item.raw.id)"
          >
            <VIcon icon="tabler-eye" />
          </IconBtn>
        </div>
      </template>


      <template #item.phone="{ item }">
        <a
          :href="`tel:${item.raw.phone}`"
          class="text-decoration-none"
        >
          {{ item.raw.phone }}
        </a>
      </template>


      <template #item.in_progress="{ item }">
        <VSwitch
          v-model="item.raw.in_progress"
          color="primary"
          :label="item.in_progress ? 'Yes' : 'No'"
          @change="updateProgressStatus(item.raw.id, item.raw.in_progress)"
        />
      </template>

            
      <template #item.actions="{ item }">
        <IconBtn
          v-if="ability.can('Delete', 'customers-delete')"
          @click="deleteCustomerConfirm(item.raw.id)"
        >
          <VIcon icon="tabler-trash" />
        </IconBtn>
        <IconBtn
          v-if="ability.can('Read', 'customers-view')"
          @click="viewCustomer(item.raw.id)"
        >
          <VIcon icon="tabler-eye" />
        </IconBtn>
        <IconBtn
          v-if="ability.can('Update', 'customers-edit')"
          @click="editCustomer(item.raw.id)"
        >
          <VIcon icon="tabler-pencil" />
        </IconBtn>
      </template>

      <template #tfoot>
        <div 
          v-if="selectedRows.length"
          class="mx-3"
        >
          <VBtn
            v-if="selectedRows.length"
            color="error"
            text
            @click="deleteMultipleCustomerConfirm(selectedRows)"
          >
            Delete Selected ({{ selectedRows.length }})
          </VBtn>
        </div>
      </template>
    </VDataTableServer>



    <ViewCustomer
      v-if="isViewCustomerDialogVisible"
      v-model:isDialogVisible="isViewCustomerDialogVisible"
      :customer-id="customerId"
      @edit-customer="editCustomer"
      @delete-customer="deleteCustomerConfirm"
      @view-invoices="viewCustomerInvoices"
    />

    <AddCustomer
      v-if="isAddCustomerDialogVisible"
      v-model:isDialogVisible="isAddCustomerDialogVisible"
      :customer-id="customerId"
      @refetch-data="fetchCustomers"
    />

    <EditCustomer
      v-if="isEditCustomerDialogVisible"
      v-model:isDialogVisible="isEditCustomerDialogVisible"
      :customer-id="customerId"
      @refetch-data="fetchCustomers"
    />
    


    <ConfirmDialog
      v-model:isDialogVisible="isConfirmDialogVisible"
      cancel-title="Cancelled"
      confirm-title="Deleted"
      confirm-msg="Customer deleted successfully."
      confirmation-question="Are you sure you want to delete selected customer(s)? This action cannot be undone."
      cancel-msg="Customer deletion cancelled."
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
