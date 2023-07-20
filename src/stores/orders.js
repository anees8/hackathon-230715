import { defineStore } from "pinia";
import axios from "axios";
import moment from "moment";

export const useOrdersStore = defineStore("ordersStore", {
  state: () => ({
    orders: [],
    order: {},
    fields: [
      { key: "id", label: "ID" },
      { key: "product_id", label: "Product ID" },
      { key: "price", label: "Product Price" },
      { key: "tailor", label: "Tailor Detail" },
      { key: "quantity", label: "Quantity" },
      { key: "cart_value", label: "Todal Order Value" },
      { key: "created_at", label: "Created Date" },
      { key: "actions", label: "Action" }
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
    ],
  }),

  actions: {
    async getOrders() {
        this.isBusy = true;
        try {
          let url = "orders";
          if (this.perPage) {
            url += `?perPage=${this.perPage}`;
          }
          if (this.currentPage > 1) {
            url += `${this.perPage ? "&" : "?"}page=${this.currentPage}`;
          }
          const response = await axios.get(url);
          this.orders = response.data.data.orders.data;
          this.currentPage = response.data.data.orders.current_page;
          this.rows = response.data.data.orders.total;
  
          this.isBusy = false;
        } catch (error) {
          if (error.response) {
            this.errors = error.response.data.errors;
          }
          this.isBusy = false;
        }
      },
      editOrder(id) {
      this.order = this.orders.find((order) => order.id == id);
      this.modal = !this.modal;
    },
    async uploadData() {
        const formData = new FormData();
        let config = {
          header: { "content-type": "multipart/form-data" }
        };
        this.isBusy = true;
        let url = "orders";
        if (this.order.quantity) {
          formData.append("quantity", this.order.quantity);
        }
       

      
        if (!this.order.id) {
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
              url + "/" + this.order.id,
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
    deleteOrder(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want to Delete this Order : " + id,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete",
        cancelButtonText: "No, cancel"
      }).then((result) => {
        if (result.isConfirmed) {
          let url = "orders/";

          axios
            .delete(url + id)
            .then((res) => {
              this.getOrders();
              Swal.fire("Deleted!", "Order  has been deleted.", "success");
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
        this.getOrders();
      },
    resetForm() {
      this.errors = {};
      this.order = {};
      this.isBusy = false;
    },
    hideModel() {
      this.modal = !this.modal;
      this.getOrders();
      this.resetForm();
    }
  }
});
