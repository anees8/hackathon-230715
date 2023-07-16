<script setup>
import {RouterView} from 'vue-router';
import {ref} from 'vue';
import Sidebar from './components/common/Sidebar.vue'
const isLoading = ref(true);

// Simulate page loading
setTimeout(() => {
  isLoading.value = false;
}, 2000);

</script>
<template>
 <header v-if="!['login', 'notfound', 'logout'].includes($route.name)">
      <div v-if="isLoading">
        <BContainer fluid>
        <BRow class="align-items-center justify-content-center vh-100 text-center">
            <BCol>
            <BSpinner></BSpinner>

            <BSkeletonIcon class="h3">Loading....</BSkeletonIcon>
        
          </BCol>
        </BRow>
    </BContainer>
      </div>
      <div v-else>
        <Sidebar/>
      </div>
    </header>

  <RouterView />

</template>

<style scoped>

</style>
