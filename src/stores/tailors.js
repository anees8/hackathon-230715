import { defineStore } from "pinia";
import axios from "axios";
import moment from "moment";

export const useTailorsStore = defineStore("tailorsStore", {
  state: () => ({
    tailors: [],
    tailor: {},
    selectedProductType:{},
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
        key: "phone",
        label: "Phone",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "product_types",
        label: "Experience IN",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "daily_commission",
        label: "Today Comission",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "total_commission",
        label: "Total Commission",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "address",
        label: "Address",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "max_units_per_day",
        label: "Max Order Per Day",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "commission_limit",
        label: "Daily Coummission Limit",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "show",
        label: "View Orders",
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
    async getTailors() {
      this.isBusy = true;
      try {
        let url = "tailors";
        if (this.perPage) {
          url += `?perPage=${this.perPage}`;
        }
        if (this.currentPage > 1) {
          url += `${this.perPage ? "&" : "?"}page=${this.currentPage}`;
        }
        const response = await axios.get(url);
        this.tailors = response.data.data.tailors.data;
        this.currentPage = response.data.data.tailors.current_page;
        this.rows = response.data.data.tailors.total;

        this.isBusy = false;
      } catch (error) {
        if (error.response) {
          this.errors = error.response.data.errors;
        }
        this.isBusy = false;
      }
    },
    editTailor(id) {
      this.tailor = this.tailors.find((tailor) => tailor.id == id);
      this.modal = !this.modal;
    },
    async uploadData() {
      const formData = new FormData();
      let config = {
        header: { "content-type": "multipart/form-data" }
      };
      this.isBusy = true;
      let url = "tailors";
      if (this.tailor.name) {
        formData.append("name", this.tailor.name);
      }
      if (this.tailor.phone) {
        formData.append("phone", this.tailor.phone);
      }
      if (this.tailor.email) {
        formData.append("email", this.tailor.email);
      }
      if (this.tailor.address) {
        formData.append("address", this.tailor.address);
      }
      if (this.tailor.max_units_per_day) {
        formData.append("max_units_per_day", this.tailor.max_units_per_day);
      }
      if (this.tailor.commission_limit) {
        formData.append("commission_limit", this.tailor.commission_limit);
      }

      if (!this.tailor.id) {
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
            url + "/" + this.tailor.id,
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
    deleteTailor(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want to Delete this Tailor : " + id,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete",
        cancelButtonText: "No, cancel"
      }).then((result) => {
        if (result.isConfirmed) {
          let url = "tailors/";

          axios
            .delete(url + id)
            .then((res) => {
              this.getTailors();
              Swal.fire("Deleted!", "Tailor has been deleted.", "success");
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
      this.getTailors();
    },
    resetForm() {
      this.errors = {};
      this.tailor = {};
      this.isBusy = false;
    },
    hideModel() {
      this.modal = !this.modal;
      this.getTailors();
      this.resetForm();
    }
  }
});
