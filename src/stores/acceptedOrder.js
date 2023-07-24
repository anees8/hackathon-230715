import { defineStore } from "pinia";
import axios from "axios";
import moment from "moment";
import { useRoute } from 'vue-router';


export const useTailorAcceptedOrdersStore = defineStore("tailoracceptedordersStore", {
  
  state: () => ({
    orders: [],
    tailor_id:useRoute().params.id,

    fields: [
      {
        key: "id",
        label: "ID",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "product_id",
        label: "Product Detail",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "product_size",
        label: "Product Size",
        thClass: "text-center",
        tdClass: "text-center"
      },
      
      {
        key: "product_type",
        label: "Product Type",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "qty",
        label: "Order Qty",
        thClass: "text-center",
        tdClass: "text-center"
      },
      {
        key: "commission",
        label: "Commission",
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
        key: "actions",
        label: "Action",
        thClass: "text-center",
        tdClass: "text-center"
      }
    ],

    isBusy: false,
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
    
    async getOrders(id) {
     
      this.isBusy = true;
      try {
        let url = "tailor_wise_accepted_order/"+id;
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
   
    setPerPage(value) {
      this.perPage = value;
      this.currentPage = 1;
    },  
  }
});
