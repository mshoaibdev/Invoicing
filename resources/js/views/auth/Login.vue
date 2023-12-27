<script setup>
import useAuth from '@/composables/auth'
import jwtService from '@/composables/jwtService'
import { useAppAbility } from '@/plugins/casl/useAppAbility'
import authV1BottomShape from '@images/svg/auth-v1-bottom-shape.svg?raw'
import authV1TopShape from '@images/svg/auth-v1-top-shape.svg?raw'
import { VNodeRenderer } from '@layouts/components/VNodeRenderer'
import { themeConfig } from '@themeConfig'

import {
  emailValidator,
  requiredValidator,
} from '@validators'
import { VForm } from 'vuetify/components/VForm'

const ability = useAppAbility()
const isPasswordVisible = ref(false)
const route = useRoute()

const router = useRouter()
const { login, errors, respData, isBusy } = useAuth()

const { setUser, setToken, setUserAbilities } = jwtService()

const form = ref({
  email: 'admin@admin.com',
  password: 'password',
  remember: false,
})


const refVForm = ref()

const onSubmit = () => {
  refVForm.value?.validate().then(async ({ valid: isValid }) => {
    if (isValid)
      await login(form.value)

    if (respData.value?.status === 200) {

      const { token, userData, userAbilities } = respData.value.data

      setUser(userData)
      setToken(token)
      setUserAbilities(userAbilities)

      ability.update(userAbilities)

      router.push({ name: 'dashboard' })
      
    }
    
  })
}
</script>



<template>
  <div class="layout-wrapper layout-blank ">
    <div class="auth-wrapper d-flex align-center justify-center pa-4">
      <div class="position-relative my-sm-16">
        <!-- 👉 Top shape -->
        <VNodeRenderer
          :nodes="h('div', { innerHTML: authV1TopShape })"
          class="text-primary auth-v1-top-shape d-none d-sm-block"
        />

        <!-- 👉 Bottom shape -->
        <VNodeRenderer
          :nodes="h('div', { innerHTML: authV1BottomShape })"
          class="text-primary auth-v1-bottom-shape d-none d-sm-block"
        />

        <!-- 👉 Auth Card -->
        <VCard
          class="auth-card pa-4"
          max-width="448"
        >
          <div class="justify-center d-flex">
            <VImg
              :src="themeConfig.app.logo"
              height="200"
              width="200"
            />
          </div> 

          <div>
            <h4 class="text-h4 font-weight-semibold mb-1 text-center">
              Welcome to {{ themeConfig.app.title }}!
            </h4>
            <p class="mb-0 text-center">
              Please sign-in to your account
            </p>
          </div>

          <VCardText>
            <VForm
              ref="refVForm"
              @submit.prevent="onSubmit"
            >
              <VRow>
                <!-- email -->
                <VCol cols="12">
                  <AppTextField
                    v-model="form.email"
                    label="Email"
                    type="email"
                    autofocus
                    :rules="[requiredValidator, emailValidator]"
                    :error-messages="errors.email"
                  />
                </VCol>

                <!-- password -->
                <VCol cols="12">
                  <AppTextField
                    v-model="form.password"
                    label="Password"
                    :rules="[requiredValidator]"
                    :type="isPasswordVisible ? 'text' : 'password'"
                    :error-messages="errors.password"
                    :append-inner-icon="isPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'"
                    @click:append-inner="isPasswordVisible = !isPasswordVisible"
                  />

                  <!-- remember me checkbox -->
                  <div class="d-flex align-center justify-space-between flex-wrap mt-2 mb-4">
                    <VCheckbox
                      v-model="form.remember"
                      label="Remember me"
                    />

                    <RouterLink
                      class="text-primary ms-2 mb-1"
                      :to="{ name: 'forgot-password' }"
                    >
                      Forgot Password?
                    </RouterLink>
                  </div>

                  <!-- login button -->
                  <VBtn
                    block
                    type="submit"
                    :loading="isBusy"
                  >
                    Login
                  </VBtn>
                </VCol>
              </VRow>
            </VForm>
          </VCardText>
        </VCard>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
@use "@core-scss/template/pages/page-auth.scss";
</style>

<style>
.auth-wrapper {
  background-position: center !important;
  background-repeat: no-repeat !important;
  background-size: auto !important;
}
</style>
