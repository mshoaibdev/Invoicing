<script setup>
import { emailValidator, requiredValidator } from '@validators'
import useInvoices from '@/composables/invoices'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  invoice: {
    type: Object,
    required: true,
  },
})

const emit = defineEmits([
  'update:isDialogVisible',
])


const { sendInvoice } = useInvoices()


const refForm = ref('')
const isLoading = ref(false)

const formData = ref({
  // from: props.invoice.customer.email,
  to: props.invoice.customer.email,
  subject: 'New Invoice',
  body: `Hello ${props.invoice.customer.name}, <br /> You have received a new invoice from {COMPANY_NAME}.<br />Please download using the button below:`,
})

const resetFormData = () => {
  formData.value = {
    from: '',
    to: '',
    subject: '',
    body: '',
  }
  nextTick(() => {
    refForm.value?.reset()
    refForm.value?.resetValidation()
  })
}

const sendInvoiceHandler = async() => {
  isLoading.value = true
  await sendInvoice(props.invoice.id, formData.value).then(resp => {
    if (resp.status === 200) {
      toast.success('Invoice sent successfully')

      emit('update:isDialogVisible', false)
      resetFormData()
    }
  })
    .finally(() => {
      isLoading.value = false
    })
}

const onSubmit = async() => {
  refForm.value?.validate().then(async ({ valid: isValid }) => {
    if (isValid){
      sendInvoiceHandler()
    }
  })
}

const dialogModelValueUpdate = val => {
  emit('update:isDialogVisible', val)
}
</script>

<template>
  <VDialog
    :width="$vuetify.display.smAndDown ? 1200 : '40%'"
    :model-value="isDialogVisible"
    @update:model-value="dialogModelValueUpdate"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="dialogModelValueUpdate(false)" />
    <VCard
      v-if="props.invoice"
      title="Send Invoice"
    >
      <VCardText title="Send Invoice">
        <VForm
          ref="refForm"
          @submit.prevent="onSubmit"
        >
          <VRow>
            <VCol 
              cols="12"
              lg="12"
              md="12"
              sm="12"
            >
              <VTextField
                v-model="formData.to"
                label="To"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol 
              cols="12"
              lg="12"
              md="12"
              sm="12"
            >
              <VTextField
                v-model="formData.subject"
                label="Subject"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol cols="12">
              <VLabel>Body </VLabel>
              <VuetifyTiptap
                v-model="formData.body"
                rounded
                :max-height="465"
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
                {{ isLoading ? 'Sending...' : 'Send' }}
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

