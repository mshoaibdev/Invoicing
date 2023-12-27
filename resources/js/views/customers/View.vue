<script setup>
import useCustomers from '@/composables/customers'

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
  'editCustomer',
  'deleteCustomer',
  'createEstimate',
  'viewEstimates',
  'viewInvoices',
  'createInvoice',
])


const { updateCustomer, errors, respResult, isLoading, getCustomer, customerData } = useCustomers()

// mount
onMounted(async () => {
  if(props.isDialogVisible){
    await getCustomer(props.customerId)
  }
})

// createEstimate

const createEstimate = async id => {
  emit('createEstimate', id)
}

const createInvoice = async id => {
  emit('createInvoice', id)
}

// view estimates

const viewEstimates = async id => {
  emit('viewEstimates', id)
}

// viewInvoices

const viewInvoices = async id => {
  emit('viewInvoices', id)
}

// deleteCustomerConfirm

const deleteCustomerConfirm = async id => {
  emit('deleteCustomer', id)
}

// editCustomer

const editCustomer = async id => {
  emit('editCustomer', id)
}

const dialogModelValueUpdate = val => {
  emit('update:isDialogVisible', val)
}
</script>

<template>
  <VDialog
    :width="$vuetify.display.smAndDown ? 600 : '60%'"
    :model-value="isDialogVisible"
    @update:model-value="dialogModelValueUpdate"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="dialogModelValueUpdate(false)" />
    <VCard>
      <VCardText>
        <VRow>
          <VCol 
            cols="12"
            lg="3"
            md="6"
            sm="6"
          >
            <p class="text-sm text-uppercase text-disabled">
              Customer Details
            </p>

            <VTable>
              <tbody>
                <tr>
                  <th>
                    Customer Name:
                  </th>
                  <td>
                    {{ customerData.name }}
                  </td>
                </tr>
                <tr>
                  <th>
                    Email:
                  </th>
                  <td>
                    <a :href="`mailto:${customerData.email}`">{{ customerData.email }}</a>
                  </td>
                </tr>
                <tr>
                  <th>
                    Phone:
                  </th>
                  <td>
                    <a :href="`tel:${customerData.phone}`">{{ customerData.phone }}</a>
                  </td>
                </tr>
                <tr>
                  <th>
                    Address:
                  </th>
                  <td>
                    {{ customerData.address }}
                  </td>
                </tr>
                <tr>
                  <th>
                    Lead Type:
                  </th>
                  <td>
                    {{ customerData.lead_type }}
                  </td>
                </tr>
                <tr>
                  <th>
                    Status
                  </th>
                  <td>
                    {{ customerData.status }}
                  </td>
                </tr>
                <tr>
                  <th>
                    Lead Representative:
                  </th>
                  <td>
                    {{ customerData.lead_representative }}
                  </td>
                </tr>
                <tr>
                  <th>
                    In Progress:
                  </th>
                  <td>
                    {{ customerData.in_progress ? 'Yes' : 'No' }}
                  </td>
                </tr>
                <tr>
                  <th>
                    Last Service:
                  </th>
                  <td>
                    {{ customerData.last_service }}
                  </td>
                </tr>
                <tr>
                  <th>
                    Date Added:
                  </th>
                  <td>
                    {{ customerData.date }}
                  </td>
                </tr>
              </tbody>
            </VTable>
          </VCol>

          <VCol 
            cols="12"
            lg="3"
            md="6"
            sm="6"
          >
            <p class="text-sm text-uppercase text-disabled text-center">
              Email
            </p>
  
            <VList class="text-left mt-2">
              <VBtn
                block
                variant="text"
                class="mt-2"
                @click="createInvoice(customerData.id)"
              >
                Create Invoice
              </VBtn> 

              <VBtn
                block
                variant="text"
                class="mt-2"
                @click="createEstimate(customerData.id)"
              >
                Create Estimate
              </VBtn> 

              <VBtn
                block
                variant="text"
                class="mt-2"
              >
                Download Receipt
              </VBtn> 

              <VBtn
                block
                variant="text"
                class="mt-2"
              >
                Review
              </VBtn> 
            </VList>

            <p class="text-sm text-uppercase text-disabled text-center mt-2">
              Service history
            </p>
  
            <VList class="text-left ">
              <VBtn
                block
                variant="text"
                @click="viewEstimates(customerData.id)"
              >
                Estimates
              </VBtn> 
             
              <VBtn
                block
                variant="text"
                class="mt-2"
                @click="viewInvoices(customerData.id)"
              >
                Invoices
              </VBtn> 
            </VList>
          </VCol>
          <VCol 
            cols="12"
            lg="3"
            md="6"
            sm="6"
          >
            <p class="text-sm text-uppercase text-disabled text-center">
              Schedule
            </p>
  
            <VList class="text-left mt-2">
              <VBtn
                block
                variant="text"
              >
                Estimate
              </VBtn> 

              <VBtn
                block
                variant="text"
              >
                Service
              </VBtn>
            </VList>
          </VCol>
          <VCol cols="12">
            <div class="d-flex justify-space-between py-1">
              <h6 class="text-h6">
                Notes:
              </h6>
              <h5 class="text-body-1">
                {{ customerData.notes }}
              </h5>
            </div>
          </VCol>
        </VRow>
      </VCardText>

      <VCardActions class="d-flex justify-end">
        <VBtn
          color="primary"
          text
          @click="editCustomer(customerData.id)"
        >
          Edit
        </VBtn>

        <VBtn
          color="error"
          text
          @click="deleteCustomerConfirm(customerData.id)"
        >
          Delete
        </VBtn>
      </VCardActions>
    </VCard>
  </VDialog>
</template>

<style scoped>
th,td {
  padding: 0rem !important;
}
</style>