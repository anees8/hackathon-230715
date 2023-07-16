import { defineStore } from 'pinia'
import axios from "axios";
import router from "../router/index";

export const useLoginStore = defineStore("loginStore", {
  state: () => ({
      user: {
          email: "",
          password: "",
      },       
      loading: true,
      accessToken: localStorage.getItem("token"),
      errors: {},
    
  }),

  getters: {
      getAccessToken: (state) => state.accessToken,
  },
  mutations: {},
  actions: {
      
      async login() {
          this.loading = true;
          try {
              const response = await axios.post("login", this.user);
              this.setToken(response.data.data.token);
              console.log(response.data);
              if (response.data.data.token) {
                  axios.defaults.headers.common["Authorization"] =
                      "Bearer " + response.data.data.token;
              }
          } catch (error) {
              if (error.response) {
                  this.errors = error.response.data.errors;
              }
              this.loading = false;
          }
      },
      async logout() {
          this.loading = true;
          try {
              const response = await axios.get("logout");
          } catch (error) {
              if (error.response) {
                  this.errors = error.response.data.errors;
              }
          }
      },

      setToken: function (token) {
          this.accessToken = token;
          localStorage.setItem("token", token);
          this.errors = {};
          this.user.email = null;
          this.user.password = null;
          this.loading = false;
          router.push({ name: "dashboard" });
      },
      removeToken: function () {
          this.logout();
          this.accessToken = null;
          localStorage.removeItem("token");
          router.push({ name: "login" });
      },
      resetForm: function () {
          this.errors = {};
          this.user.email = null;
          this.user.password = null;
          this.loading = false;
      },
  },
});
