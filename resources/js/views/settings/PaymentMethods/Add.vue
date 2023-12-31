<script setup>
import paymentMethods from '@/@core/utils/paymentMethods'
import usePaymentMethods from '@/composables/paymentMethods'


import {
  requiredValidator,
} from '@validators'

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

const { storePaymentMethod, respResult, isLoading } = usePaymentMethods()

const refForm = ref()

const initialState = {
  name: '',
  is_default: false,
  is_gateway: false,
  is_enabled: false,
  live_identifier: '',
  live_secret: '',
  sandbox_identifier: '',
  sandbox_secret: '',
  mode: 'sandbox',
  description: '',
}

onMounted(async () => {
  if(props.isDialogVisible){
  }
})



const formData = ref({ ...initialState })

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

      await storePaymentMethod(formData.value)
      if (respResult.value.status === 200) {
        emit('refetchData')
        emit('update:isDialogVisible', false)
        resetFormData()
      }
    }
  })
}


const onFormReset = () => {
  resetFormData()
  emit('update:isDialogVisible', false)
}


const dialogModelValueUpdate = val => {
  emit('update:isDialogVisible', val)
}
</script>

<template>
  <VDialog
    :width="$vuetify.display.smAndDown ? 'auto' : 800"
    :model-value="props.isDialogVisible"
    @update:model-value="dialogModelValueUpdate"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="dialogModelValueUpdate(false)" />
    <VCard title="Add Payment Method">
      <VCardText>
        <!-- 👉 Form -->
        <VForm
          ref="refForm"
          @submit.prevent="onSubmit"
        >
          <VRow>
            <VCol
              cols="12"
              md="12"
            >
              <VAutocomplete
                v-model="formData.name"
                :items="paymentMethods"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol
              cols="12"
              md="12"
            >
              <VTextarea
                v-model="formData.description"
                label="Description"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol
              cols="12"
              md="12"
            >
              <VSwitch
                v-model="formData.is_default"
                label="Make It Default"
              />
            </VCol>

            <VCol
              cols="12"
              md="12"
            >
              <VSwitch
                v-model="formData.is_enabled"
                label="Make It Enabled"
              />
            </VCol>

            <VCol
              cols="12"
              md="12"
            >
              <VSwitch
                v-model="formData.is_gateway"
                label="Is This Online Payment Gateway"
              />
            </VCol>


            <VCol
              cols="12"
              md="12"
            >
              <VSelect
                v-model="formData.mode"
                :items="['sandbox', 'live']"
                label="Mode"
              />
            </VCol>
            <VCol
              cols="12"
              md="12"
            >
              <span class="text-h6 font-weight-bold">
                Live Credentials
              </span>
              <VDivider />
            </VCol>



            <VCol
              cols="12"
              md="12"
            >
              <VTextField
                v-model="formData.live_identifier"
                label="Live Identifier"
              />
            </VCol>

            <VCol
              cols="12"
              md="12"
            >
              <VTextField
                v-model="formData.live_secret"
                label="Live Secret"
              />
            </VCol>

            <VCol
              cols="12"
              md="12"
            >
              <span class="text-h6 font-weight-bold">
                Sandbox Credentials
              </span>
              <VDivider />
            </VCol>

            <VCol
              cols="12"
              md="12"
            >
              <VTextField
                v-model="formData.sandbox_identifier"
                label="Sandbox Identifier"
              />
            </VCol>

            <VCol
              cols="12"
              md="12"
            >
              <VTextField
                v-model="formData.sandbox_secret"
                label="Sandbox Secret"
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
                Add New
              </VBtn>
              <VBtn
                color="secondary"
                variant="tonal"
                @click="onFormReset"
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
