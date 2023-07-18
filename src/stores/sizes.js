import { defineStore } from "pinia";
import axios from "axios";
import moment from "moment";

export const useSizesStore = defineStore("sizesStore", {
  state: () => ({
    sizes: [],
    size: {},
    fields: [
      { key: "id", label: "ID" },
      { key: "name", label: "Name" },
      { key: "actions", label: "Action" }
    ],
    isBusy: false,
    modal: false,
    errors: {}
  }),

  actions: {
    async getSizes() {
      this.isBusy = true;
      try {
        let url = "sizes";
        const response = await axios.get(url);
        this.sizes = response.data.data.sizes;
        this.isBusy = false;
      } catch (error) {
        if (error.response) {
          this.errors = error.response.data.errors;
        }
        this.isBusy = false;
      }
    },
    editSize(id) {
      this.size = this.sizes.find((size) => size.id == id);
      this.modal = !this.modal;
    },
    async uploadData() {
        const formData = new FormData();
        let config = {
          header: { "content-type": "multipart/form-data" }
        };
        this.isBusy = true;
        let url = "sizes";
        if (this.size.name) {
          formData.append("name", this.size.name);
        }
  
  
        if (!this.size.id) {
          try {
            const response = await axios.post(url, formData, config);
  
            this.hideModel();
          } catch (error) {
            if (error.response) {
              this.errors = error.response.data.errors;
            }
            this.isBusy = false;
          }
        } else {
          formData.append("_method", "put");
          try {
            const response = await axios.post(
              url + "/" + this.size.id,
              formData,
              config
            );
  
            this.hideModel();
          } catch (error) {
            if (error.response) {
              this.errors = error.response.data.errors;
            }
            this.isBusy = false;
          }
        }
      },
    deleteSize(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want to Delete this Size : " + id,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete",
        cancelButtonText: "No, cancel"
      }).then((result) => {
        if (result.isConfirmed) {
          let url = "sizes/";

          axios
            .delete(url + id)
            .then((res) => {
              this.getSizes();
              Swal.fire("Deleted!", "Size has been deleted.", "success");
            })
            .catch((error) => {
              this.errors = error.response.data.errors;
            });
        }
      });
    },
    dateTime(value) {
      return moment(value).format("D-MMM-Y");
    },
    resetForm() {
      this.errors = {};
      this.size = {};
      this.isBusy = false;
    },
    hideModel() {
      this.modal = !this.modal;
      this.getSizes();
      this.resetForm();
    }
  }
});
