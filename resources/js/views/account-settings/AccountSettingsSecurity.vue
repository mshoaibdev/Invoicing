<script setup>
import useAccount from '@/composables/account'

const { updatePassword,  respResult, isBusy } = useAccount()

const isCurrentPasswordVisible = ref(false)
const isNewPasswordVisible = ref(false)
const isConfirmPasswordVisible = ref(false)
const currentPassword = ref('')
const newPassword = ref('')
const confirmPassword = ref('')

const passwordRequirements = [
  'Minimum 8 characters long - the more, the better',
  'At least one lowercase character',
  'At least one number, symbol, or whitespace character',
]

const initialState = {
  current_password: '',
  password: '',
  password_confirmation: '',
}

const formData = ref({ ...initialState })
const refForm = ref()

const rules = {
  required: value => !!value || 'Required.',
  min: v => v.length >= 8 || 'Min 8 characters',
}

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
      await updatePassword(formData.value)
      if (respResult.value.status === 200) {
        resetFormData()
      }
    }
  })
}

const generatePassword = () => {
  const password = Math.random().toString(36).slice(-10)

  formData.value.password = password
  formData.value.password_confirmation = password
}
</script>

<template>
  <VRow>
    <!-- SECTION: Change Password -->
    <VCol cols="12">
      <VCard title="Change Password">
        <VForm
          ref="refForm"
          @submit.prevent="onSubmit"
        >
          <VCardText class="pt-0">
            <!-- 👉 Current Password -->
            <VRow class="mb-3">
              <VCol
                cols="12"
                md="4"
              >
                <!-- 👉 current password -->
                <VTextField
                  v-model="formData.current_password"
                  :rules="[rules.required, rules.min]"
                  :type="isCurrentPasswordVisible ? 'text' : 'password'"
                  :append-inner-icon="isCurrentPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'"
                  label="Current Password"
                  @click:append-inner="isCurrentPasswordVisible = !isCurrentPasswordVisible"
                />
              </VCol>
              <VCol
                cols="12"
                md="4"
              >
                <!-- 👉 new password -->
                <VTextField
                  v-model="formData.password"
                  :rules="[rules.required, rules.min]"
                  hint="At least 8 characters"
                  :type="isNewPasswordVisible ? 'text' : 'password'"
                  :append-inner-icon="isNewPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'"
                  label="New Password"
                  @click:append-inner="isNewPasswordVisible = !isNewPasswordVisible"
                />
              </VCol>

              <VCol
                cols="12"
                md="4"
              >
                <!-- 👉 confirm password -->
                <VTextField
                  v-model="formData.password_confirmation"
                  :type="isConfirmPasswordVisible ? 'text' : 'password'"
                  :append-inner-icon="isConfirmPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'"
                  label="Confirm New Password"
                  @click:append-inner="isConfirmPasswordVisible = !isConfirmPasswordVisible"
                />
              </VCol>
            </VRow>
          </VCardText>

          <!-- 👉 Password Requirements -->
          <VCardText>
            <h6 class="text-base font-weight-medium mb-3">
                Password Requirements:
            </h6>
            <ul class="card-list">
                <li v-for="item in passwordRequirements" :key="item" class="password-item">
                  <span class="password-icon">
                    <VIcon size="8" icon="tabler-circle" class="me-3" />
                  </span>
                  <span class="password-text">{{ item }}</span>
                </li>
            </ul>
          </VCardText>

          <!-- 👉 Action Buttons -->
          <VCardText class="d-flex flex-wrap gap-4">
            <VBtn
              type="submit"
              @click="refForm?.validate()"
              class="securitybtnForMobileSize"
            >
              <span class="securityfontForMobileSize">Update password</span> 
            </VBtn>

            <VBtn
              type="reset"
              color="secondary"
              variant="tonal"
            >
             <span class="securityfontForMobileSize">Reset</span> 
            </VBtn>
          </VCardText>
        </VForm>
      </VCard>
    </VCol>
  </VRow>
</template>

<style scoped lang="scss">
@use "@/@layouts/styles/mediaStyles.scss";

.card-list {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.password-item {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.password-icon {
  margin-right: 10px;
}

.password-text {
  word-wrap: break-word;
}


</style>