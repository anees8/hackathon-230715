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
 <div v-if="isLoading">
        <BContainer fluid>
        <BRow class="align-items-center justify-content-center vh-100 text-center">
            <BCol>
            <BSpinner></BSpinner>
          </BCol>
        </BRow>
    </BContainer>
      </div>
      <div v-else>
        <div class="sidebar">
      <Sidebar  v-if="!['login', 'notfound', 'logout'].includes($route.name)"/>
<div class="content">
      <RouterView />
    </div>
      </div>
      </div>
</template>

<style scoped>
.sidebar {
  display: flex;
}

.sidebar .content {
  flex: 1 1 0;
 
}
</style>
