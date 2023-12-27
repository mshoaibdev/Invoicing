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
    :width="$vuetify.display.smAndDown ? 600 : '80%'"
    :model-value="isDialogVisible"
    @update:model-value="dialogModelValueUpdate"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="dialogModelValueUpdate(false)" />
    <VCard v-if="invoiceData.customer">
      <VRow>
        <VCol 
          cols="12"
          lg="4"
          md="4"
          sm="4"
        >
          <VCardText title="Invoice Details">
            <p class="text-sm text-uppercase ">
              Invoice ID {{ invoiceData.invoice_id }}
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
                    Payment Status:
                  </th>
                  <td>
                    {{ invoiceData.status }}
                  </td>
                </tr>

                <tr>
                  <th>
                    Payment Method:
                  </th>
                  <td>
                    {{ invoiceData.payment_method }}
                  </td>
                </tr>


                <tr>
                  <th>
                    Invoice Date:
                  </th>
                  <td>
                    {{ invoiceData.invoice_date }}
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
          </VCardText>
        </VCol>

        <VCol 
          cols="12"
          lg="8"
          md="8"
          sm="8"
        >
          <VCardText>
            <p class="text-sm text-uppercase text-disabled">
              Invoice Items
            </p>

            <VTable>
              <thead>
                <tr>
                  <th>Description</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(item, index) in invoiceData.items"
                  :key="index"
                >
                  <td>{{ item.description }}</td>
                  <td>{{ item.quantity }}</td>
                  <td>{{ formatCurrency(item.cost) }}</td>
                  <td>{{ formatCurrency(item.total) }}</td>
                </tr>
              </tbody>
            </VTable>
          </VCardText>



          <VCardText>
            <p class="text-sm text-uppercase text-disabled">
              Invoice Summary
            </p>

            <VTable>
              <tbody>
                <tr>
                  <th>
                    Invoice link:
                  </th>
                  <td>
                    <a :href="invoiceData.invoice_link" target="_blank">{{ invoiceData.invoice_link }}</a>
                  </td>
                </tr>
                <tr>
                  <th>
                    Subtotal:
                  </th>
                  <td>
                    {{ formatCurrency(invoiceData.subtotal) }}
                  </td>
                </tr>

             
                <tr>
                  <th>
                    Tax:
                  </th>
                  <td>
                    {{ formatCurrency(invoiceData.tax_amount ?? 0) }}
                  </td>
                </tr>

                <tr>
                  <th>
                    Total:
                  </th>
                  <td>
                    {{ formatCurrency(invoiceData.total) }}
                  </td>
                </tr>
              </tbody>
            </VTable>
          </VCardText>
        </VCol>
      </VRow>
    </VCard>
  </VDialog>
</template>

