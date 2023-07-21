import { defineStore } from "pinia";
import axios from "axios";
import moment from "moment";

export const useSkusStore = defineStore("skusStore", {
  state: () => ({
    skus: [],
    sku: {},
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
        key: "sku_code",
        label: "SKU Code",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "price",
        label: "Price",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "size",
        label: "Size",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "product_type",
        label: "Category",
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
    async getSkus() {
      this.isBusy = true;
      try {
        let url = "skus";
        if (this.perPage) {
          url += `?perPage=${this.perPage}`;
        }
        if (this.currentPage > 1) {
          url += `${this.perPage ? "&" : "?"}page=${this.currentPage}`;
        }
        const response = await axios.get(url);
        this.skus = response.data.data.skus.data;
        this.currentPage = response.data.data.skus.current_page;
        this.rows = response.data.data.skus.total;

        this.isBusy = false;
      } catch (error) {
        if (error.response) {
          this.errors = error.response.data.errors;
        }
        this.isBusy = false;
      }
    },
    editSku(id) {
      this.sku = this.skus.find((sku) => sku.id == id);
      this.modal = !this.modal;
    },
    async uploadData() {
      const formData = new FormData();
      let config = {
        header: { "content-type": "multipart/form-data" }
      };
      this.isBusy = true;
      let url = "skus";
      if (this.sku.name) {
        formData.append("name", this.sku.name);
      }
      if (this.sku.sku_code) {
        formData.append("sku_code", this.sku.sku_code.toUpperCase());
      }
      if (this.sku.price) {
        formData.append("price", this.sku.price);
      }
      if (this.sku.size_id) {
        formData.append("size_id", this.sku.size_id);
      }
      if (this.sku.product_type_id) {
        formData.append("product_type_id", this.sku.product_type_id);
      }

      if (!this.sku.id) {
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
            url + "/" + this.sku.id,
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
    deleteSku(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want to Delete this SKU : " + id,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete",
        cancelButtonText: "No, cancel"
      }).then((result) => {
        if (result.isConfirmed) {
          let url = "skus/";

          axios
            .delete(url + id)
            .then((res) => {
              this.getSkus();
              Swal.fire("Deleted!", "Sku has been deleted.", "success");
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
      this.getSkus();
    },
    resetForm() {
      this.errors = {};
      this.sku = {};
      this.isBusy = false;
    },
    hideModel() {
      this.modal = !this.modal;
      this.getSkus();
      this.resetForm();
    }
  }
});
