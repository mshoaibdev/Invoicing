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
])


const { getCustomer, customerData } = useCustomers()

// mount
onMounted(async () => {
  if(props.isDialogVisible){
    await getCustomer(props.customerId)
  }
})


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
    :width="$vuetify.display.smAndDown ? 600 : '50%'"
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
            lg="12"
            md="12"
            sm="12"
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
                    <a :href="`tel:${customerData?.billing?.phone}`">{{ customerData?.billing?.phone }}</a>
                  </td>
                </tr>
                <tr>
                  <th>
                    Billing Address :
                  </th>
                  <td />
                </tr>

                <tr>
                  <th>
                    Name
                  </th>
                  <td>
                    {{ customerData?.billing?.name }}
                  </td>
                </tr>

                <tr>
                  <th>
                    Address
                  </th>
                  <td>
                    {{ customerData?.billing?.address_street_1 }}
                  </td>
                </tr>

                <tr>
                  <th>
                    City
                  </th>
                  <td>
                    {{ customerData?.billing?.city }}
                  </td>
                </tr>

                <tr>
                  <th>
                    State
                  </th>
                  <td>
                    {{ customerData?.billing?.state }}
                  </td>
                </tr>

                <tr>
                  <th>
                    Zip
                  </th>
                  <td>
                    {{ customerData?.billing?.zip }}
                  </td>
                </tr>
               
                <tr>
                  <th>
                    Date Added:
                  </th>
                  <td>
                    {{ customerData.created_at }}
                  </td>
                </tr>
              </tbody>
            </VTable>
          </VCol>
        </VRow>
      </VCardText>

      <VCardActions class="d-flex justify-end">
        <VBtn
          color="primary"
          variant="text"
          @click="editCustomer(customerData.id)"
        >
          <VIcon
            icon="tabler-edit"
            class="me-2"
          />
          Edit
        </VBtn>

        <VBtn
          color="error"
          variant="text"
          @click="deleteCustomerConfirm(customerData.id)"
        >
          <VIcon
            icon="tabler-trash"
            class="me-2"
          />
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
