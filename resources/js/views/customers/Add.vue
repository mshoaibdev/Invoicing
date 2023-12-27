<script setup>
import useCustomers from '@/composables/customers'
import { emailValidator, requiredValidator } from '@validators'
import leadTypes from '@/data/leadTypes'
import leadStatus from '@/data/leadStatus'
import moment from 'moment'

const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
})

const emit = defineEmits([
  'refetchData',
  'update:isDialogVisible',
])

const { storeCustomer, errors, respResult, isLoading } = useCustomers()

onMounted(() => {
  if(props.isDialogVisible){
  }
})

const initialState = {
  name: '',
  email: '',
  email: '',
  phone: '',
  address: '',
  date: moment().format('YYYY-MM-DD'),
  lead_type: '',
  status: '',
}

const users = ref([
  
])

const formData = ref({ ...initialState })
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

      for (const key in formData.value) {
        if (Object.hasOwnProperty.call(formData.value, key)) {
          formNewData.append(key, formData.value[key])
        }
      }
      await storeCustomer(formNewData)
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
    <DialogCloseBtn @click="dialogModelValueUpdate(false)" />
    <VCard title="Add New Customer">
      <VCardText>
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
                label=" Email"
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
                label="Date"
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
                  Create Customer
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
