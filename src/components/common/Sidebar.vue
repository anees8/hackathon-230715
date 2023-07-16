<script setup>
import MenuItem from './Menu/MenuItem.vue';
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
    <div class="logo"><h2  class=" text-center">TAILORS</h2></div>
    <hr class="m-0"/>
    <MenuItem v-for="(item, index) in menuTree"
    :key="index"
    :label="item.label"
    :icon="item.icon"
    :name="item.name" />
   </aside>
  </template>
  <style scoped>
aside {
min-height: 100vh;
width: 16rem;
background-color: #3F2305;
color:#DFD7BF;
transition: all 0.3s ease;
}
.logo {
height: 4rem;
padding:1rem;
background-color: #F2EAD3;
color:#3F2305;
}
</style>