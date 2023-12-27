<script setup>
import useCustomers from '@/composables/customers'
import { emailValidator, requiredValidator } from '@validators'
import leadTypes from '@/data/leadTypes'
import leadStatus from '@/data/leadStatus'

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
  'refetchData',
  'update:isDialogVisible',
])

const { updateCustomer, respResult, isLoading, getCustomer, customerData } = useCustomers()

const formData = ref({})
const refForm = ref()
const users = ref([])

onMounted(async () => {
  if(props.isDialogVisible){
    await getCustomer(props.customerId)
    formData.value = customerData.value

    if(!customerData.value.date) {
      formData.value.date = moment().format('YYYY-MM-DD')
    }
  }
})


const resetFormData = () => {
 
  nextTick(() => {
    refForm.value?.reset()
    refForm.value?.resetValidation()
  })
}

const onSubmit = async() => {
  refForm.value?.validate().then(async ({ valid: isValid }) => {
    if (isValid){
      
      await updateCustomer(props.customerId, formData.value)
      if (respResult.value.status === 200) {
        emit('refetchData')
        emit('update:isDialogVisible', false)
        resetFormData()
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
    :width="$vuetify.display.smAndDown ? 'auto' : 1000"
    :model-value="props.isDialogVisible"
    persistent
    @update:model-value="dialogModelValueUpdate"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="dialogModelValueUpdate(false)" />
    <VCard title="Update Customer">
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
              <AppTextField
                v-model="formData.name"
                label="Customer Name"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <AppTextField
                v-model="formData.email"
                label="Email"
                :rules="[requiredValidator, emailValidator]"
              />
            </VCol>
            <VCol
              cols="12"
              md="6"
            >
              <AppTextField
                v-model="formData.phone"
                label="Phone"
                :rules="[requiredValidator]"
              />
            </VCol>
            <VCol
              cols="12"
              md="6"
            >
              <AppTextField
                v-model="formData.address"
                label="Address"
                :rules="[requiredValidator]"
              />
            </VCol>


            <VCol
              cols="12"
              md="6"
            >
              <VSelect
                v-model="formData.lead_type"
                label="Lead Type"
                :rules="[requiredValidator]"
                item-title="name"
                item-value="id"
                :items="leadTypes"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <VSelect
                v-model="formData.status"
                label="Lead Status"
                :rules="[requiredValidator]"
                item-title="name"
                item-value="id"
                :items="leadStatus"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <AppDateTimePicker
                v-model="formData.date"
                :rules="[requiredValidator]"
                density="compact"
                placeholder="Select Date"
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
              <VTextarea
                v-model="formData.notes"
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
                Update Customer
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
