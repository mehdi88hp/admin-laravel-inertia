import Swal from "sweetalert2";

export default function (error) {
  let html = 'خطایی به وجود آمد';

  if (error.response) {
    const data = error.response.data;

    if (data.errors) {
      //validation error
      html = Object.values(data.errors).join('<br>')
    } else if (data.message) {
      //exception error
      html = data.message
    }
  }

  Swal.fire({
    type: 'error',
    html,
    title: error.response.status || ''
  })
}
