import './assets/main.css'



import { createApp } from 'vue'
import { createPinia } from 'pinia'
import {BootstrapVueNext} from 'bootstrap-vue-next'

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue-next/dist/bootstrap-vue-next.css";
import { library } from "@fortawesome/fontawesome-svg-core";
import {faArrowRight,faUsers,faGauge,faPen,faPlus,faBasketShopping,faS,faRightFromBracket,faBarcode,faP,faT} from "@fortawesome/free-solid-svg-icons";
import { faUser,faTrashAlt} from '@fortawesome/free-regular-svg-icons';

import {
    FontAwesomeIcon,
    FontAwesomeLayers,
    FontAwesomeLayersText,
} from "@fortawesome/vue-fontawesome";

library.add(faArrowRight,faUser,faUsers,faGauge,faPen,faPlus,faTrashAlt,faBasketShopping,faS,faRightFromBracket,faBarcode,faP,faT);
import App from './App.vue'

import router from './router'
import axios from "axios";

import Swal from 'sweetalert2';
window.Swal=Swal;

axios.defaults.baseURL = "http://127.0.0.1:8000/api/";

axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("token");
axios.defaults.headers.common["Access-Control-Allow-Origin"] = "*";

const app = createApp(App)
app.use(BootstrapVueNext)
app.component("FontAwesomeIcon", FontAwesomeIcon);
app.component("FontAwesomeLayers", FontAwesomeLayers);
app.component("FontAwesomeLayersText", FontAwesomeLayersText);

app.use(createPinia())
app.use(router)

app.mount('#app')
