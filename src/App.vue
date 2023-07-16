<script setup>
import {  RouterView } from 'vue-router';
import Sidebar from './components/common/Sidebar.vue'
</script>

<template>
  <header   v-if="!
        ['login'].includes(
          $route.name
        )
      ">
    <div>
    <Sidebar/>
    </div>
  </header>

  <RouterView />
</template>

<style scoped>

</style>
