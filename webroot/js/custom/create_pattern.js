const partnerType = document.getElementById('input_partner_type')
const inputsPJ = [...document.querySelectorAll('[data-input-pj]')]
const inputsPF = [...document.querySelectorAll('[data-input-pf]')]

partnerType.addEventListener('change', (event) => {
  const typeSelect = event.target.value
  if (typeSelect === 'pj') {
    addRequired(inputsPJ)
    removeRequired(inputsPF)
  } else {
    addRequired(inputsPF)
    removeRequired(inputsPJ)
  }
})

function addRequired(array) {
  array.forEach((input) => input.classList.add('required'))
}

function removeRequired(array) {
  array.forEach((input) => input.classList.remove('required'))
}
