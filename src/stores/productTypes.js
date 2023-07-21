import { defineStore } from "pinia";
import axios from "axios";
import moment from "moment";

export const useProductTypesStore = defineStore("productTypesStore", {
  state: () => ({
    productTypes: [],
    productType: {},
    fields: [
      {
        key: "id",
        label: "ID",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "name",
        label: "Name",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "created_at",
        label: "Created Date",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "actions",
        label: "Action",
        thClass: "text-center",
        tdClass: "text-center"
      }
    ],
    isBusy: false,
    modal: false,
    errors: {},
    perPage: 10,
    currentPage: 1,
    rows: null,
    options: [
      { value: 5, text: "5" },
      { value: 10, text: "10" },
      { value: 50, text: "50" },
      { value: 100, text: "100" }
    ]
  }),

  actions: {
    async getProductTypes() {
      this.isBusy = true;
      try {
        let url = "product_types";
        if (this.perPage) {
          url += `?perPage=${this.perPage}`;
        }
        if (this.currentPage > 1) {
          url += `${this.perPage ? "&" : "?"}page=${this.currentPage}`;
        }
        const response = await axios.get(url);
        this.productTypes = response.data.data.product_types.data;
        this.currentPage = response.data.data.product_types.current_page;
        this.rows = response.data.data.product_types.total;

        this.isBusy = false;
      } catch (error) {
        if (error.response) {
          this.errors = error.response.data.errors;
        }
        this.isBusy = false;
      }
    },
    editProductType(id) {
      this.productType = this.productTypes.find(
        (productType) => productType.id == id
      );
      this.modal = !this.modal;
    },
    async uploadData() {
      const formData = new FormData();
      let config = {
        header: { "content-type": "multipart/form-data" }
      };
      this.isBusy = true;
      let url = "product_types";
      if (this.productType.name) {
        formData.append("name", this.productType.name.toLowerCase());
      }

      if (!this.productType.id) {
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
            url + "/" + this.productType.id,
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
    deleteProductType(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want to Delete this Product Type : " + id,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete",
        cancelButtonText: "No, cancel"
      }).then((result) => {
        if (result.isConfirmed) {
          let url = "product_types/";

          axios
            .delete(url + id)
            .then((res) => {
              this.getProductTypes();
              Swal.fire(
                "Deleted!",
                "Product Type has been deleted.",
                "success"
              );
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
    setPerPage(value) {
      this.perPage = value;
      this.currentPage = 1;
      this.getProductTypes();
    },
    resetForm() {
      this.errors = {};
      this.productType = {};
      this.isBusy = false;
    },
    hideModel() {
      this.modal = !this.modal;
      this.getProductTypes();
      this.resetForm();
    }
  }
});
