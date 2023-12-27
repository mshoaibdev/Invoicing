
const contactForm = document.querySelector('#contact-form')
const contactFormBtn = document.querySelector('#contact-form-btn')

if (contactForm) {
  contactForm.addEventListener('submit', function (e) {
    e.preventDefault()
    sendEmail(contactForm, contactFormBtn)
  })
}


const contactFormModal = document.querySelector('#contact-form-modal')
const contactFormBtnModal = document.querySelector('#contact-form-btn-modal')

if (contactFormModal) {
  contactFormModal.addEventListener('submit', function (e) {
    e.preventDefault()
    sendEmail(contactFormModal, contactFormBtnModal)
  })
}


sendEmail = (formEle, btnEle) => {
  
  const url = formEle.action
  const method = formEle.method
  const submitBtnText = btnEle.textContent
  const submitBtnLoadingText = 'Sending...'
  const submitBtnLoadingHtml = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ${submitBtnLoadingText}`

  const formData = new FormData(formEle)

  // disable button
  btnEle.disabled = true
  btnEle.innerHTML = submitBtnLoadingHtml

  // submit form via axios
  axios({
    method: method,
    url: url,
    data: formData,
  })
    .then(function (response) {

      // enable button
      btnEle.disabled = false
      btnEle.innerHTML = submitBtnText

      Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: response.data.message,
      })


      // hide success message after 8 seconds
      setTimeout(function () {
        formEle.reset()

        location.reload()
      }, 5000)

      // scroll to top
      window.scrollTo(0, 0)

      // redirect to dashboard
    })
    .catch(function (error) {

      // handle error

      // enable button
      btnEle.disabled = false
      btnEle.innerHTML = submitBtnText

      if (error.response && error.response.data && error.response.data.errors) {

        // sweet alert

        const errors = error.response.data.errors

        let errorMessage = ''

        for (const key in errors) {
          if (errors.hasOwnProperty(key)) {
            const element = errors[key]

            errorMessage += `<li>${element}</li>`
          }
        }

        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          html: `<ul>${errorMessage}</ul>`,
        })
      
      }


      // scroll to top
      window.scrollTo(0, 0)
    })

}



