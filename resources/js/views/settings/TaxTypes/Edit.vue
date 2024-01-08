<script setup>
import useTaxTypes from '@/composables/taxTypes'


import {
  requiredValidator,
} from '@validators'

const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  taxTypeId: {
    type: Number,
    required: true,
  },
})

const emit = defineEmits([
  'refetchData',
  'update:isDialogVisible',
])

const { updateTaxType, respResult, isLoading, getTaxType, taxTypeData } = useTaxTypes()

const refForm = ref()
const formData = ref({})


onMounted(async () => {
  if(props.isDialogVisible){
    await getTaxType(props.taxTypeId)
    formData.value = taxTypeData.value
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

      

      await updateTaxType(props.taxTypeId, {
        ...formData.value,
        ... {
          '_method': 'PUT',
        },
      })
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
    <VCard title="Update Tax Type">
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
              <VTextField
                v-model="formData.name"
                label="Name"
                name="name"
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
                Update
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
