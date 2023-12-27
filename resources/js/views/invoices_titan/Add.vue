<script setup>
import useCustomers from '@/composables/customers'
import useInvoices from '@/composables/invoices'

import { emailValidator, requiredValidator } from '@validators'
import { formatCurrency } from '@core/utils/formatters'

const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  estimateId: {
    type: Number,
    required: false,
  },
})

const emit = defineEmits([
  'refetchData',
  'update:isDialogVisible',
])

const paymentMethods = ["Bank Account", "Stripe", "Paypal"]
const paymentStatuses = ['Draft', 'Unpaid', 'Paid', 'Overdue', 'Cancelled', 'Refunded']

const initialState = {
  completion_date: '',
  due_date: '',
  note: '',
  customer_id: '',
  estimate_id: '',
  payment_method: '',
  payment_status: 'Draft',
  sub_total: 0,
  tax_amount: 0,
  total: 0,
  items: [
    {
      id: 1,
      type: "",
      location: "",
      service: "",
      description: "",
      price: 0,
      discount: 0,
      total: 0,
      discount_type: 'fixed',
    },
  ],
}

const formData = ref({ ...initialState })
const customerData = ref({})
const isAddEstimateDialogVisible = ref(false)

const {  getCustomer, customerData: customer } = useCustomers()

const { storeInvoice, errors, respResult, isLoading } = useInvoices()



onMounted(async () => {
  if(props.isDialogVisible){
    
  }
})


const calculateSubTotal = () => {
  formData.value.sub_total = 0
  formData.value.total = 0
  formData.value.items.forEach(item => {
    formData.value.sub_total += parseFloat(item.total)
    formData.value.total += parseFloat(item.total)

  })
}


const generateItemTotal = index => {
  const item = formData.value.items[index]
  const { price, discount } = item

  if (item.discount_type === 'percentage') {
    item.total = parseFloat(price) - (parseFloat(price) * parseFloat(discount) / 100)
  } else {

    item.total = parseFloat(price) - parseFloat(discount)
  }

  calculateSubTotal()
}

const addItem = () => {
  formData.value.items.push({
    id: formData.value.items.length + 1,
    type: "",
    location: "",
    service: "",
    description: "",
    price: 0,
    discount: 0,
    total: 0,
    discount_type: 'fixed',

  })
}

const removeItem = index => {
  formData.value.items.splice(index, 1)
  calculateSubTotal()
}

const refForm = ref()

const resetFormData = () => {
  formData.value = {
    ...initialState,
  }
  nextTick(() => {
    refForm.value?.reset()
    refForm.value?.resetValidation()
  })
}

const onSubmit = async() => {
  refForm.value?.validate().then(async ({ valid: isValid }) => {
    if (isValid){
      const formNewData = new FormData()

      formNewData.append('completion_date', formData.value.completion_date)
      formNewData.append('due_date', formData.value.due_date)
      formNewData.append('estimate_id', formData.value.estimate_id)
      formNewData.append('payment_method', formData.value.payment_method)
      formNewData.append('payment_status', formData.value.payment_status)
     
      formNewData.append('customer_id', formData.value.customer_id)
      formNewData.append('sub_total', formData.value.sub_total)
      formNewData.append('tax_amount', formData.value.tax_amount)
      formNewData.append('total', formData.value.total)

      if (formData.value.note) {
        formNewData.append('note', formData.value.note)
      }

      const items = formData.value.items

      for (let index = 0; index < items.length; index++) {
        const item = items[index]

        formNewData.append(`items[${index}][type]`, item.type)
        formNewData.append(`items[${index}][location]`, item.location)
        formNewData.append(`items[${index}][service]`, item.service)
        formNewData.append(`items[${index}][description]`, item.description)
        formNewData.append(`items[${index}][price]`, item.price)
        formNewData.append(`items[${index}][discount]`, item.discount)
        formNewData.append(`items[${index}][discount_type]`, item.discount_type)

        formNewData.append(`items[${index}][total]`, item.total)
      }

      try {
        await storeInvoice(formNewData)
        if (respResult.value.status === 200) {
          emit('refetchData')
          emit('update:isDialogVisible', false)
          resetFormData()
        }
      } catch (error) {
        console.log(error)
      }
    }
  })
}

const dialogModelValueUpdate = val => {
  emit('update:isDialogVisible', val)
}
</script>

<template>
  <VDialog
    :width="$vuetify.display.smAndDown ? 'auto' : '90%'"
    :model-value="props.isDialogVisible"
    persistent
    @update:model-value="dialogModelValueUpdate"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="dialogModelValueUpdate(false)" />
    <VCard title="Create Invoice">
      <VCardText>
        <!-- 👉 Form -->
        <VForm
          ref="refForm"
          @submit.prevent="onSubmit"
        >
          <VRow>
            <VCol
              cols="12"
              md="6"
            >
              <AppDateTimePicker
                v-model="formData.completion_date"
                :rules="[requiredValidator]"
                density="compact"
                label="Select Completion Date"
                :config="{
                  altInput: true,
                  altFormat: 'F j, Y',
                  dateFormat: 'Y-m-d',
                  disableMobile: true,
                }"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <AppDateTimePicker
                v-model="formData.due_date"
                :rules="[requiredValidator]"
                density="compact"
                label="Select Due Date"
                :config="{
                  altInput: true,
                  altFormat: 'F j, Y',
                  dateFormat: 'Y-m-d',
                  disableMobile: true,
                }"
              />
            </VCol>

            <VCol
              cols="12"
              md="12"
            >
              <div
                v-if="customerData.name"
                class="scrollable-table"
              >
                <h3 class="font-weight-medium mb-3">
                  Customer Details:
                </h3>

                <table>
                  <tbody>
                    <tr>
                      <td class="pe-6">
                        Name:
                      </td>
                      <td class="font-weight-semibold">
                        {{ customerData.name }}
                      </td>
                    </tr>
                    <tr>
                      <td class="pe-6">
                        Phone:
                      </td>
                      <td>{{ customerData.phone }}</td>
                    </tr>
                    <tr>
                      <td class="pe-6">
                        Address:
                      </td>
                      <td>{{ customerData.address }}</td>
                    </tr>
                    <tr>
                      <td class="pe-6">
                        Lead Type:
                      </td>
                      <td>{{ customerData.lead_type }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </VCol>
            <VCol cols="12">
              <div
                v-for="(product, index) in formData.items"
                :key="index"
                class="ma-sm-2 mb-2 border px-2 py-2 rounded-md"
              >
                <VCard flat>
                  <!-- 👉 Left Form -->
                  <VRow>
                    <VCol
                      sm="12"
                      cols="12"
                      md="3"
                    >
                      <AppTextField
                        v-model="product.type"
                        :rules="[requiredValidator]"
                        label="Type"
                      />
                    </VCol>
                    <VCol
                      sm="12"
                      cols="12"
                      md="3"
                    >
                      <AppTextField
                        v-model="product.location"
                        :rules="[requiredValidator]"
                        label="Location"
                      />
                    </VCol>
                    <VCol
                      sm="12"
                      cols="12"
                      md="3"
                    >
                      <AppTextField
                        v-model="product.service"
                        :rules="[requiredValidator]"
                        label="Service"
                      />
                    </VCol>
                    <VCol
                      sm="12"
                      cols="12"
                      md="3"
                    >
                      <VTextarea
                        v-model="product.description"
                        rows="2"
                        label="Description"
                        placeholder="Description"
                      />
                    </VCol>
                     
                    <VCol
                      sm="12"
                      cols="12"
                      md="3"
                    >
                      <AppTextField
                        v-model="product.price"
                        :rules="[requiredValidator]"
                        type="number"
                        min="0"
                        label="Price"
                        @update:model-value="generateItemTotal(index)"
                      />
                    </VCol>
                    <VCol
                      sm="12"
                      cols="12"
                      md="3"
                    >
                      <div class="d-flex gap-2 ">
                        <div style="width: 120px;">
                          <AppTextField
                            v-model="product.discount"
                            type="number"
                            min="0"
                            label="Discount"
                            @update:model-value="generateItemTotal(index)"
                          />
                        </div>
                        <div style="width: 160px;">
                          <AppSelect
                            v-model="product.discount_type"
                            :items="[
                              { value: 'fixed', title: 'Fixed' },
                              { value: 'percentage', title: 'Percentage' },
                            ]"
                            label="Discount Type"
                            dense
                            @update:model-value="generateItemTotal(index)"
                          />
                        </div>
                      </div>
                    </VCol>
                    <VCol
                      sm="12"
                      cols="12"
                      md="3"
                    >
                      <h3 class="my-2">
                        <span class="d-inline ">Item Total: </span>
                        <span class="text-body-1">{{
                          formatCurrency(
                            product.total,
                          )
                        }}</span>
                      </h3>
                    </VCol>
                    <VCol
                      sm="12"
                      cols="12"
                      md="3"
                    >
                      <VBtn
                        icon
                        size="x-small"
                        color="error"
                        :disabled="index === 0"
                        @click="removeItem(index)"
                      >
                        <VIcon
                          size="20"
                          icon="tabler-x"
                        />
                      </VBtn>
                    </VCol>
                  </VRow>
                </VCard>
              </div>

              <div class="mt-4 ma-sm-2">
                <VBtn @click="addItem">
                  Add Item
                </VBtn>
              </div>
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <AppSelect
                v-model="formData.payment_method"
                :items="paymentMethods"
                label="Payment Method"
                class="mb-2"
                density="compact"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <AppSelect
                v-model="formData.payment_status"
                :items="paymentStatuses"
                label="Payment Status"
                class="mb-2"
                density="compact"
                :rules="[requiredValidator]"
              />
            </VCol>


            <VCardText class="d-flex justify-end flex-wrap flex-column flex-sm-row">
              <h2 class="mb-2">
                Total:
                {{
                  formatCurrency(
                    formData.sub_total
                  )
                }}
              </h2>
            </VCardText>

            <VCol
              cols="12"
              md="12"
            >
              <VTextarea
                v-model="formData.note"
                clearable
                clear-icon="tabler-circle-x"
                label="Notes"
              />
            </VCol>

            <VCol
              cols="12"
              class="d-flex flex-wrap gap-4 justify-end"
            >
              <VBtn
                type="submit"
                :loading="isLoading"
                :disabled="isLoading"
                @click="refForm?.validate()"
              >
                Create Invoice
              </VBtn>
              <VBtn
                color="secondary"
                variant="tonal"
                @click="dialogModelValueUpdate(false)"
              >
                Cancel
              </VBtn>
            </VCol>
          </VRow>
        </VForm>
      </VCardText>
    </VCard>
  </VDialog>

</template>

<style scoped>
.flatpickr-calendar.open {
  z-index: 9999
}
</style>
