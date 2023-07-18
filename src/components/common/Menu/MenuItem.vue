<script setup>
import {RouterLink} from 'vue-router';


defineProps({
  label: {
    type: String,
    required: true
  },
  name: {
    type: String,
    required: true
  },
  icon: {
    type: String,
    required: true
  }
});
</script>
<template>
    <div>
    <RouterLink
      class="nav-link p-3"
      v-bind:to="{ name: name }"
    >
    <div class="fw-bold">
        <div>
          <font-awesome-icon class="mx-4"  v-if="icon" :icon="icon" />

          <span >{{ label }} </span>
        </div>
        </div>
    </RouterLink>
</div>
    <hr class="m-0"/>
</template>
<style scoped>
 .router-link-exact-active,.nav-link:hover {
  
    
      cursor: pointer;
      background-color: #DDE6ED;
      color:#27374D;
     
    }
    
</style>