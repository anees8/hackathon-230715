<script setup>
import { BImg } from 'bootstrap-vue-next';
import MenuItem from './Menu/MenuItem.vue';
import logo from '../../assets/logo/icon1.png'
const menuTree = [
{
label: "Dashboard",
icon: "gauge",
name: "dashboard",
},
{
label: "Users",
icon: "users",
name: "users",
},
{
label: "Orders",
icon: "arrow-right",
name: "orders",
},
{
label: "Logout",
icon: "arrow-right",
name: "logout",
},


];

</script>
<template>
   <aside>
    <div class="logo border border-light border-start-0  border-end-0 border-top-0 border-bottom-1"> <div class="d-flex align-items-between  justify-content-center h-100"><div> <BImg :src="logo" height="50" class="mx-3"/></div><div> <h1>TAILORS</h1></div></div> </div>
  
    <MenuItem v-for="(item, index) in menuTree"
    :key="index"
    :label="item.label"
    :icon="item.icon"
    :name="item.name" />
   </aside>
  </template>
  <style scoped>
aside {
  z-index: 1;
min-height: 100vh;
width: 16rem;
background-color: #27374D;
color:#DDE6ED;
transition: all 0.3s ease;
}
.logo {
z-index: 10;
height: 4rem;
padding:0.5rem;
background-color: #27374D;
color:white;
}
</style>