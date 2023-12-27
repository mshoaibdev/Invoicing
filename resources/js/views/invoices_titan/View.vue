<script setup>
import useInvoices from '@/composables/invoices'
import { formatCurrency } from '@core/utils/formatters'

const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  invoiceId: {
    type: Number,
    required: true,
  },
})

const emit = defineEmits([
  'update:isDialogVisible',
  'editCustomer',
  'deleteCustomer',
])


const { getInvoice, invoiceData } = useInvoices()

// mount
onMounted(async () => {
  if(props.isDialogVisible){
    await getInvoice(props.invoiceId)
  }
})

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
    <VCard v-if="invoiceData.customer">
      <VRow>
        <VCol 
          cols="12"
          lg="6"
          md="6"
          sm="6"
        >
          <p class="text-sm text-uppercase text-disabled">
            Invoice Details
          </p>

          <VTable>
            <tbody>
              <tr>
                <th>
                  Customer Name:
                </th>
                <td>
                  {{ invoiceData.customer.name }}
                </td>
              </tr>

              <tr>
                <th>
                  Email:
                </th>
                <td>
                  <a :href="`mailto:${invoiceData.customer.email}`">{{ invoiceData.customer.email }}</a>
                </td>
              </tr>

              <tr>
                <th>
                  Phone:
                </th>
                <td>
                  <a :href="`tel:${invoiceData.customer.phone}`">{{ invoiceData.customer.phone }}</a>
                </td>
              </tr>

              <tr>
                <th>
                  Address:
                </th>
                <td>
                  {{ invoiceData.customer.address }}
                </td>
              </tr>

              <tr>
                <th>
                  Completion Date:
                </th>
                <td>
                  {{ invoiceData.completion_date }}
                </td>
              </tr>

              <tr>
                <th>
                  Due Date:
                </th>
                <td>
                  {{ invoiceData.due_date }}
                </td>
              </tr>

              <tr>
                <th>
                  Notes:
                </th>
                <td>
                  {{ invoiceData.notes }}
                </td>
              </tr>
            </tbody>
          </VTable>
        </VCol>

        <VCol 
          cols="12"
          lg="6"
          md="6"
          sm="6"
        >
          <p class="text-sm text-uppercase text-disabled">
            Invoice Items
          </p>

          <VTable>
            <thead>
              <tr>
                <th>Item Description</th>
                <th>Item Quantity</th>
                <th>Item Price</th>
                <th>Item Total</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(item, index) in invoiceData.items"
                :key="index"
              >
                <td>{{ item.description }}</td>
                <td>{{ item.quantity }}</td>
                <td>{{ formatCurrency(item.price) }}</td>
                <td>{{ formatCurrency(item.total) }}</td>
              </tr>
            </tbody>
          </VTable>
        </VCol>
      </VRow>
    </VCard>
  </VDialog>
</template>

