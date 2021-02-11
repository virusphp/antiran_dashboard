<template id="my-template">
    <swal-title>
      Sukses Loading
    </swal-title>
    <swal-icon type="warning" color="red"></swal-icon>
    <swal-button type="confirm">
      Save As
    </swal-button>
    <swal-button type="cancel">
      Cancel
    </swal-button>
    <swal-button type="deny">
      Close without Saving
    </swal-button>
    <swal-param name="allowEscapeKey" value="false" />
    <swal-param
      name="customClass"
      value='{ "popup": "my-popup" }' />
</template>