export const commonMixins = {
    data() {
        return {
            isLoading: false
        }
    },
    methods: {
        showAlert({title = "", icon = "success", message = ""}) {
            Swal.fire({
                title: title,
                text: message,
                icon: icon,
            })
        }
    }
}
//can be add more mixins
